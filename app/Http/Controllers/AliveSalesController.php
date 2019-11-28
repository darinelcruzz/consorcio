<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePAFSale;
use App\{AliveSale, Client, Product, Price};

class AliveSalesController extends Controller
{
    private $data;
    private $moreData;

    function __construct()
    {
        $this->data = ['type' => 'alive', 'color' => 'primary', 'skin' => 'blue', 'tipo' => 'vivo'];
        $this->moreData = array_merge($this->data, [
            'clients' => Client::buyers('vivo'),
            'prices' => Price::pricesWithNames(3)
        ]);
    }

    function index()
    {
        return view('sales.index')->with($this->data);
    }

    function create()
    {
        $lastSale = AliveSale::all()->last();
        $lastFolio = $this->getFolio();
        return view('sales.create', $this->moreData)
            ->with(compact('lastSale', 'lastFolio'));
    }

    function store(StorePAFSale $request)
    {
        $lastSale = AliveSale::all()->last();
        $lastFolio = $lastSale->folio + 1;
        
        $sale = AliveSale::create($request->all());

        $this->updateInventory($request->quantity);

        $days = $request->credit * 8;

        $sale->update([
            'status' => $request->credit == '0' ? 'pagado': 'credito',
            'credit' => $request->credit == '0' ? 0: 1,
            'series' => substr($sale->date, 0, 4) == '2020' ? 'C': 'B',
            'days' => $days > 16 ? 15: $days
        ]);

        $sale->client->computeBalance();
        $sale->client->computeUnpaidNotes();

        if (AliveSale::where('series', 'C')->count() == 1) {
            $sale->update([
                'folio' => 1
            ]);
        } else {
            $sale->update([
                'folio' => $lastFolio
            ]);
        }

        return redirect(route('alive.index'));
    }

    function edit(AliveSale $sale)
    {
        return view('sales.edit', $this->moreData)->with('sale', $sale);
    }

    function update(Request $request, AliveSale $sale)
    {
        $this->modifyInventory($sale->quantity, $request->quantity);
        $sale->update($request->all());

        $sale->client->computeBalance();
        $sale->client->computeUnpaidNotes();

        return redirect(route('alive.index'));
    }

    function updateInventory($quantity)
    {
        $former = Product::where('name', 'pollo vivo')->first();
        $current = $former->quantity - $quantity;
        $former->update(['quantity' => $current]);
    }

    function modifyInventory($oldQuantity, $newQuantity)
    {
        $product = Product::where('name', 'pollo vivo')->first();
        $quantity = $product->quantity + $oldQuantity - $newQuantity;

        $product->update(['quantity' => $quantity]);
    }

    public function getFolio()
    {
        $lastQ = AliveSale::all()->last();
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
        AliveSale::create([
            'folio' => $request->folio,
            'date' => $request->selected_date,
            'client_id' => 1,
            'status' => 'cancelada',
        ]);

        return redirect(route('alive.index'));
    }

    function fillfield()
    {
        $canceled = AliveSale::where('status', 'cancelada')->get();

        foreach ($canceled as $sale) {
            $sale->update([
                'client_id' => 1,
            ]);
        }

        return 'RELLENADAS';
    }
}
