<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\{Adjustment, Product};

class AdjustmentController extends Controller
{
    function index()
    {
        $date = Date::now()->format('Y-m-d');
        $products = Product::quantityWithNames();
        $movements = Adjustment::where('description', '!=', 'mortalidad')->get();
        return view('products.adjustments', compact('date', 'products', 'movements'));
    }

    function create()
    {
        $date = Date::now()->format('Y-m-d');
        $count = Product::find(3)->quantity;
        $movements = Adjustment::where('description', 'mortalidad')->get();
        return view('adjustments.create', compact('date', 'movements', 'count'));
    }

    function store(Request $request)
    {
        $attributes = $request->validate([
            'quantity' => 'required',
            'date' => 'required',
            'product_id' => 'required',
        ]);

        $adjustment = Adjustment::create($request->all());

        $product = Product::find($request->product_id);

        $adjustment->update([
            'before' => $product->quantity
        ]);

        $product->update([
            'quantity' => $request->description == 'mortalidad' ? $product->quantity - $request->quantity: $request->quantity
        ]);

        return back();
    }

}
