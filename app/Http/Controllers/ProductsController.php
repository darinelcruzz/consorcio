<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Product, AliveSale, PorkSale, ProcessedSale};

class ProductsController extends Controller
{
    function index()
    {
        $processed = Product::where('processed', 1)->get();
        $alive = AliveSale::inStock();
        $pork = PorkSale::inStock();
        #$processed = ProcessedSale::inStock();
        $food = Product::where('processed', 2)->get();
        return view('products.products', compact('processed', 'pork', 'alive', 'food'));
    }

    function store(Request $request)
    {
        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'processed' => empty($request->processed) ? 0: 1,
        ]);

        return back();
    }
}
