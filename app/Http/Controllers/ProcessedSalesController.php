<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProcessedRequest;
use App\ProcessedSale;
use App\Client;
use App\Product;
use App\Price;

class ProcessedSalesController extends Controller
{
    function index()
    {
        $sales = ProcessedSale::all();
        $type = 'processed';
        $color = 'success';
        $skin = 'green';
        return view('sales.index', compact('sales', 'type', 'color', 'skin'));
    }

    function create()
    {
        $clients = $this->getClients();
        $prices = Price::pricesWithNames(4);
        $type = 'processed';
        $color = 'success';
        $skin = 'green';
        $products = Product::where('processed', 1)->get();
        $lastSale = ProcessedSale::all()->last();
        return view('sales.create', compact('clients', 'type', 'color', 'lastSale', 'skin', 'products', 'prices'));
    }

    function store(ProcessedRequest $request)
    {
        $sale = ProcessedSale::create($request->except(['types', 'numbers', 'total']));

        $sale->storeProducts($request);

        return redirect('ventas/procesado');
    }

    function getClients()
    {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'procesado');
        })->pluck('name', 'id')->toArray();
    }
}
