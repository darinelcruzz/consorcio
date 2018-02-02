<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePAFSale;
use App\PorkSale;
use App\Client;
use App\Product;
use App\Price;

class PorkSalesController extends Controller
{
    private $data;
    private $moreData;

    function __construct()
    {
        $this->data = ['type' => 'pork', 'color' => 'baby', 'skin' => 'pink'];
        $this->moreData = array_merge($this->data, [
            'clients' => Client::buyers('cerdo'),
            'prices' => Price::pricesWithNames(1)
        ]);
    }

    function index()
    {
        return view('sales.index', $this->data)->with('sales', PorkSale::all());
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
        $sale = PorkSale::create($request->all());

        $this->updateInventory($request->quantity);
        $days = $request->credit * 8;
        $sale->update([
            'status' => $request->credit == '0' ? 'pagado': 'credito',
            'credit' => $request->credit == '0' ? 0: 1,
            'days' => $days > 16 ? 15: $days
        ]);

        return redirect(route('pork.index'));
    }

    function edit(PorkSale $porkSale)
    {
        return view('sales.edit', $this->moreData)->with('sale', $porkSale);
    }

    function update(Request $request)
    {
        $sale = PorkSale::find($request->id);
        $this->modifyInventory($sale->quantity, $request->quantity);
        $sale->update($request->all());

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
            $lastY = fdate($lastQ->created_at, 'Y');
            if(date('Y') != $lastY) {
                return 0;
            }
            return $lastQ->folio;
        }

        return 0;
    }

    function discard($folio)
    {
        PorkSale::create([
            'folio' => $folio,
            'client_id' => 0,
            'status' => 'cancelada',
        ]);

        return redirect(route('pork.index'));
    }
}
