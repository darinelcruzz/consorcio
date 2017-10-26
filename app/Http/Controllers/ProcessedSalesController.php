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
        $lastSale = ProcessedSale::all()->last();
        return view('sales.create', compact('clients', 'type', 'color', 'lastSale', 'skin', 'products', 'prices'));
    }

    function store(ProcessedRequest $request)
    {
        $sale = ProcessedSale::create($request->except(['types', 'quantities', 'prices', 'packages']));

        $sale->storeProducts($request);

        $days = $request->credit * 8;

        $sale->update([
            'status' => $request->credit == '0' ? 'pagado': 'credito',
            'credit' => $request->credit == '0' ? 0: 1,
            'days' => $days > 16 ? 15: $days
        ]);

        return redirect('ventas/procesado');
    }

    function show(ProcessedSale $processedsale)
    {
        $type = 'processed';
        $color = 'success';
        $skin = 'green';
        return view('sales.processed', compact('processedsale', 'type', 'color', 'skin'));
    }

    function getClients()
    {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'procesado');
        })->pluck('name', 'id')->toArray();
    }

    function getProducts()
    {
        $all = Product::where('processed', 1)->get();
        $products = [];

        foreach ($all as $p) {
            $product = [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price_alone
            ];

            array_push($products, (object) $product);
        }

        return $products;
    }
}
