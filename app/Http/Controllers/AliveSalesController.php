<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AliveSale;
use App\Client;

class AliveSalesController extends Controller
{
    function index()
    {
        $sales = AliveSale::all();
        $type = 'alive';
        $color = 'primary';
        return view('sales.index', compact('sales', 'type', 'color'));
    }

    function create()
    {
        $clients = $this->getClients();
        $type = 'alive';
        $color = 'primary';
        $lastSale = AliveSale::all()->last();
        return view('sales.create', compact('clients', 'type', 'color', 'lastSale'));
    }

    function store(Request $request)
    {
        AliveSale::create($request->all());

        return redirect('ventas/vivo');
    }

    function getClients() {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'vivo');
        })->pluck('name', 'id')->toArray();
    }
}
