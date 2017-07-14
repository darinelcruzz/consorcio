<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FreshSale;
use App\Client;

class FreshSalesController extends Controller
{
    function index()
    {
        $sales = FreshSale::all();
        $type = 'fresh';
        $color = 'success';
        return view('sales.index', compact('sales', 'type', 'color'));
    }

    function create()
    {
        $clients = $this->getClients();
        $type = 'fresh';
        $color = 'success';
        return view('sales.create', compact('clients', 'type', 'color'));
    }

    function store(Request $request)
    {
        FreshSale::create($request->all());

        return redirect('ventas/fresco');
    }

    function getClients() {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'fresco');
        })->pluck('name', 'id')->toArray();
    }
}
