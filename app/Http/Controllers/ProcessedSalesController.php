<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProcessedRequest;
use App\{ProcessedSale, Client, Product, Price};

class ProcessedSalesController extends Controller
{
    private $data;
    private $moreData;

    function __construct()
    {
        $this->data = ['type' => 'processed', 'color' => 'success', 'skin' => 'green', 'tipo' => 'procesado'];
        $this->moreData = array_merge($this->data, [
            'clients' => Client::buyers('procesado'),
            'prices' => Price::pricesWithNames(4)
        ]);
    }

    function index()
    {
        return view('sales.index')->with( $this->data);
    }

    function create()
    {
        $lastSale = ProcessedSale::all()->last();
        $lastFolio = $this->getFolio();
        return view('sales.create', $this->moreData)->with(compact('lastSale', 'lastFolio'));
    }

    function store(ProcessedRequest $request)
    {
        // dd($request->all());
        $lastSale = ProcessedSale::all()->last();
        $lastFolio = $lastSale->folio + 1;

        $sale = ProcessedSale::create($request->except(['names', 'types', 'quantities', 'prices', 'packages', 'kgs']));
        $sale->storeProducts($request);
        $days = $request->credit * 8;

        $sale->update([
            'status' => $request->credit == '0' ? 'pagado': 'credito',
            'credit' => $request->credit == '0' ? 0: 1,
            'series' => substr($sale->date, 0, 4) == '2020' ? 'C': 'B',
            'days' => $days > 16 ? 15: $days
        ]);

        $sale->client->computeBalance();
        $sale->client->computeUnpaidNotes();

        if (ProcessedSale::where('series', 'C')->count() == 1) {
            $sale->update([
                'folio' => 1
            ]);
        } else {
            $sale->update([
                'folio' => $lastFolio
            ]);
        }

        return redirect('ventas/procesado');
    }

    function show(ProcessedSale $processedsale)
    {
        return view('sales.processed', $this->data)->with(compact('processedsale'));
    }

    function edit(ProcessedSale $sale)
    {
        return view('sales.edit', $this->moreData)->with(compact('sale'));
    }

    function update(Request $request, ProcessedSale $sale)
    {
        $sale->update($request->all());

        $sale->client->computeUnpaidNotes();
        $sale->client->computeBalance();

        return redirect(route('processed.index'));
    }

    function getProducts()
    {
        $all = Product::where('processed', 1)->get();
        $products = [];

        foreach ($all as $p) {
            $product = [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price_alone
            ];

            array_push($products, (object) $product);
        }

        return $products;
    }

    public function getFolio()
    {
        $lastQ = ProcessedSale::all()->last();
        if ($lastQ) {
            $lastY = fdate($lastQ->date, 'Y', 'Y-m-d');
            if(date('Y') != $lastY) {
                return 0;
            }
            return $lastQ->folio;
        }

        return 0;
    }

    function discard(Request $request)
    {
        $lastSale = ProcessedSale::all()->last();

        ProcessedSale::create([
            'folio' => $lastSale->folio + 1,
            'date' => $request->selected_date,
            'client_id' => 1,
            'status' => 'cancelada',
        ]);

        return redirect('ventas/procesado');
    }

    function editKg(ProcessedSale $processedsale)
    {
        $type = 'processed';
        $color = 'success';
        $skin = 'green';
        return view('sales.edit_kg', compact('processedsale', 'type', 'color', 'skin'));
    }

    function storeKg(Request $request)
    {
        $this->validate($request, [
            'kgs' => 'required',
            'prices' => 'required'
        ]);

        $sale = ProcessedSale::find($request->id);

        $products = [];
        $old = unserialize($sale->products);

        for ($i = 0; $i < count($request->kgs); $i++) {
            $new = [];
            $new['i'] =  $old[$i]['i'];
            $new['p'] =  $request->prices[$i];
            $new['q'] =  $old[$i]['q'];
            $new['k'] =  $request->kgs[$i];
            $new['b'] =  $old[$i]['b'];
            array_push($products, $new);
        }

        $sale->update([
            'products' => serialize($products)
        ]);

        return redirect(route('processed.show', ['processedsale' => $request->id]));
    }

    function editProducts(ProcessedSale $processedsale)
    {
        $type = 'processed';
        $color = 'success';
        $skin = 'green';
        $productsArray = Product::where('processed', 1)->pluck('name', 'id')->toArray();
        return view('sales.edit_products', compact('processedsale', 'type', 'color', 'skin', 'productsArray'));
    }

    function storeProducts(Request $request, ProcessedSale $processedsale)
    {
        // dd($request->all());
        $this->validate($request, [
            'products' => 'required',
        ]);

        $products = [];
        $old = unserialize($processedsale->products);

        for ($i = 0; $i < count($request->products); $i++) {
            $new = [];
            $new['i'] =  $request->products[$i];
            $new['p'] =  $old[$i]['p'];
            $new['q'] =  $old[$i]['q'];
            $new['k'] =  $old[$i]['k'];
            $new['b'] =  $old[$i]['b'];
            array_push($products, $new);

            $old_product = Product::find($old[$i]['i']);
            $new_product = Product::find($request->products[$i]);
            $old_number = $old_product->quantity;
            $new_number = $new_product->quantity;
            $old_product->update([
                'quantity' => $old_number + $old[$i]['b']
            ]);
            $new_product->update([
                'quantity' => $new_number - $old[$i]['b']
            ]);
        }

        $processedsale->update([
            'products' => serialize($products)
        ]);

        return redirect(route('processed.show', $processedsale));
    }

    function fillfield()
    {
        $canceled = ProcessedSale::where('status', 'cancelada')->get();

        foreach ($canceled as $sale) {
            $sale->update([
                'client_id' => 1,
            ]);
        }

        return 'RELLENADAS';
    }
}
