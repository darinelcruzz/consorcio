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
    function index()
    {
        $sales = PorkSale::all();
        $type = 'pork';
        $color = 'baby';
        $skin = 'pink';
        return view('sales.index', compact('sales', 'type', 'color', 'skin'));
    }

    function create()
    {
        $clients = $this->getClients();
        $prices = Price::pricesWithNames(1);
        $type = 'pork';
        $color = 'baby';
        $skin = 'pink';
        $lastSale = PorkSale::all()->last();
        return view('sales.create', compact('clients', 'type', 'color', 'lastSale', 'skin', 'prices'));
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

        return redirect('ventas/cerdo');
    }

    function getClients()
    {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'cerdo');
        })->pluck('name', 'id')->toArray();
    }

    function updateInventory($quantity)
    {
        $former = Product::where('name', 'cerdo')->first();

        $current = $former->quantity - $quantity;

        $former->update(['quantity' => $current]);
    }
}
