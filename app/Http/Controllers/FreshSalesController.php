<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePAFSale;
use App\{FreshSale, Client, Product, Price};

class FreshSalesController extends Controller
{
    private $data;
    private $moreData;

    function __construct()
    {
        $this->data = ['type' => 'fresh', 'color' => 'warning', 'skin' => 'yellow'];
        $this->moreData = array_merge($this->data, [
            'clients' => Client::buyers('fresco'),
            'prices' => Price::pricesWithNames(2)
        ]);
    }

    function index()
    {
        return view('sales.index')->with($this->data);
    }

    function create()
    {
        $lastSale = FreshSale::all()->last();
        $lastFolio = $this->getFolio();
        return view('sales.create', $this->moreData)
            ->with(compact('lastSale', 'lastFolio'));
    }

    function store(StorePAFSale $request)
    {
        $lastSale = FreshSale::all()->last();
        $lastFolio = $lastSale->folio + 1;
        
        $sale = FreshSale::create($request->all());
        $this->updateInventory($request->quantity);
        $days = $request->credit * 8;


        $sale->update([
            'status' => $request->credit == '0' ? 'pagado': 'credito',
            'credit' => $request->credit == '0' ? 0: 1,
            'series' => substr($sale->date, 0, 4) == '2019' ? 'B': 'A',
            'days' => $days > 16 ? 15: $days
        ]);

        if (FreshSale::where('series', 'B')->count() == 1) {
            $sale->update([
                'folio' => 1
            ]);
        } else {
            $sale->update([
                'folio' => $lastFolio
            ]);
        }

        return redirect(route('fresh.index'));
    }

    function edit(FreshSale $freshSale)
    {
        return view('sales.edit', $this->moreData)->with('sale', $freshSale);
    }

    function update(Request $request)
    {
        $sale = FreshSale::find($request->id);
        $this->modifyInventory($sale->quantity, $request->quantity);
        $sale->update($request->all());

        return redirect(route('fresh.index'));
    }

    function updateInventory($quantity)
    {
        $former = Product::where('name', 'Pollo vivo')->first();
        $current = $former->quantity - $quantity;
        $former->update(['quantity' => $current]);
    }

    function modifyInventory($oldQuantity, $newQuantity)
    {
        $product = Product::where('name', 'pollo fresco')->first();
        $quantity = $product->quantity + $oldQuantity - $newQuantity;

        $product->update(['quantity' => $quantity]);
    }

    public function getFolio()
    {
        $lastQ = FreshSale::all()->last();
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
        FreshSale::create([
            'folio' => $request->folio,
            'date' => $request->selected_date,
            'client_id' => 1,
            'status' => 'cancelada',
        ]);

        return redirect(route('fresh.index'));
    }

    function fillfield()
    {
        $canceled = FreshSale::where('status', 'cancelada')->get();

        foreach ($canceled as $sale) {
            $sale->update([
                'client_id' => 1,
            ]);
        }

        return 'RELLENADAS';
    }
}
