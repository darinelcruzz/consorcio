<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FreshSale;
use App\Client;
use App\Product;

class FreshSalesController extends Controller
{
    function index()
    {
        $sales = FreshSale::all();
        $type = 'fresh';
        $color = 'warning';
        return view('sales.index', compact('sales', 'type', 'color'));
    }

    function create()
    {
        $clients = $this->getClients();
        $type = 'fresh';
        $color = 'warning';
        $lastSale = FreshSale::all()->last();
        return view('sales.create', compact('clients', 'type', 'color', 'lastSale'));
    }

    function store(Request $request)
    {
        FreshSale::create($request->all());

        $this->updateInventory($request->quantity);

        return redirect('ventas/fresco');
    }

    function getClients()
    {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'fresco');
        })->pluck('name', 'id')->toArray();
    }

    function updateInventory($quantity)
    {
        $former = Product::where('name', 'pollo fresco')->first();

        $current = $former->quantity - $quantity;

        $former->update(['quantity' => $current]);
    }
}
