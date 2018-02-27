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
        $movements = Adjustment::all();
        return view('products.adjustments', compact('date', 'products', 'movements'));
    }

    function store(Request $request)
    {
        $adjustment = Adjustment::create($request->all());

        $product = Product::find($request->product_id);

        $adjustment->update([
            'before' => $product->quantity
        ]);

        $product->update([
            'quantity' => $request->quantity
        ]);

        return back();
    }

}
