<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePAFSale;
use App\PorkSale;
use App\Client;
use App\Product;

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
        $type = 'pork';
        $color = 'baby';
        $skin = 'pink';
        $lastSale = PorkSale::all()->last();
        return view('sales.create', compact('clients', 'type', 'color', 'lastSale', 'skin'));
    }

    function store(StorePAFSale $request)
    {
        PorkSale::create($request->all());

        $this->updateInventory($request->quantity);

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
