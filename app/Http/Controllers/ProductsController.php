<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
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
