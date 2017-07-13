<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PorkSale;
use App\Client;

class PorkSalesController extends Controller
{
    function index()
    {
        $sales = PorkSale::all();
        $color = 'box-primary';
        return view('sales.index', compact('sales', 'color'));
    }

    function create()
    {
        $clients = $this->getClients();
        $color = 'primary';
        return view('sales.create', compact('clients', 'color'));
    }

    function store(Request $request)
    {
        PorkSale::create($request->all());

        return redirect('ventas/cerdo');
    }

    function getClients() {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'cerdo');
        })->pluck('name', 'id')->toArray();
    }
}
