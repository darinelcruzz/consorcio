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
        $this->data = ['type' => 'processed', 'color' => 'success', 'skin' => 'green'];
        $this->moreData = array_merge($this->data, [
            'clients' => Client::buyers('procesado'),
            'prices' => Price::pricesWithNames(4)
        ]);
    }

    function index()
    {
        return view('sales.index', $this->data)->with('sales', ProcessedSale::all());
    }

    function create()
    {
        $lastSale = ProcessedSale::all()->last();
        $lastFolio = $this->getFolio();
        return view('sales.create', $this->moreData)->with(compact('lastSale', 'lastFolio'));
    }

    function store(ProcessedRequest $request)
    {
        $sale = ProcessedSale::create($request->except(['types', 'quantities', 'prices', 'packages', 'kgs']));
        $sale->storeProducts($request);
        $days = $request->credit * 8;

        $sale->update([
            'status' => $request->credit == '0' ? 'pagado': 'credito',
            'credit' => $request->credit == '0' ? 0: 1,
            'days' => $days > 16 ? 15: $days
        ]);

        return redirect('ventas/procesado');
    }

    function show(ProcessedSale $processedsale)
    {
        return view('sales.processed', $this->data)->with(compact('processedsale'));
    }

    function edit(ProcessedSale $processedSale)
    {
        return view('sales.edit', $this->moreData)->with('sale', $processedSale);
    }

    function update(Request $request)
    {
        $sale = ProcessedSale::find($request->id);
        $sale->update($request->all());

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
            $lastY = fdate($lastQ->created_at, 'Y');
            if(date('Y') != $lastY) {
                return 0;
            }
            return $lastQ->folio;
        }

        return 0;
    }

    function discard(Request $request)
    {
        ProcessedSale::create([
            'folio' => $request->folio,
            'date' => $request->selected_date,
            'client_id' => 0,
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
}
