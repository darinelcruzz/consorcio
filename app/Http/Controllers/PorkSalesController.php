<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePAFSale;
use App\{PorkSale, Client, Product, Price};

class PorkSalesController extends Controller
{
    private $data;
    private $moreData;

    function __construct()
    {
        $this->data = ['type' => 'pork', 'color' => 'baby', 'skin' => 'pink', 'tipo' => 'cerdo'];
        $this->moreData = array_merge($this->data, [
            'clients' => Client::buyers('cerdo'),
            'prices' => Price::pricesWithNames(1)
        ]);
    }

    function index()
    {
        return view('sales.index')->with( $this->data);
    }

    function create()
    {
        $lastSale = PorkSale::all()->last();
        $lastFolio = $this->getFolio();

        return view('sales.create', $this->moreData)
            ->with(compact('lastSale', 'lastFolio'));
    }

    function store(StorePAFSale $request)
    {
        $lastSale = PorkSale::all()->last();
        $lastFolio = $lastSale->folio + 1;

        $sale = PorkSale::create($request->all());

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

        if (PorkSale::where('series', 'C')->count() == 1) {
            $sale->update([
                'folio' => 1
            ]);
        } else {
            $sale->update([
                'folio' => $lastFolio
            ]);
        }

        return redirect(route('pork.index'));
    }

    function edit(PorkSale $sale)
    {
        return view('sales.edit', $this->moreData)->with('sale', $sale);
    }

    function update(Request $request, PorkSale $sale)
    {
        $this->modifyInventory($sale->quantity, $request->quantity);
        $sale->update($request->all());

        $sale->client->computeBalance();
        $sale->client->computeUnpaidNotes();

        return redirect(route('pork.index'));
    }

    function updateInventory($quantity)
    {
        $former = Product::where('name', 'cerdo')->first();

        $current = $former->quantity - $quantity;

        $former->update(['quantity' => $current]);
    }

    function modifyInventory($oldQuantity, $newQuantity)
    {
        $product = Product::where('name', 'cerdo')->first();
        $quantity = $product->quantity + $oldQuantity - $newQuantity;

        $product->update(['quantity' => $quantity]);
    }

    public function getFolio()
    {
        $lastQ = PorkSale::all()->last();
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
        PorkSale::create([
            'folio' => $request->folio,
            'date' => $request->selected_date,
            'client_id' => 1,
            'status' => 'cancelada',
        ]);

        return redirect(route('pork.index'));
    }

    function fillfield()
    {
        $canceled = PorkSale::where('status', 'cancelada')->get();

        foreach ($canceled as $sale) {
            $sale->update([
                'client_id' => 1,
            ]);
        }

        return 'RELLENADAS';
    }
}
