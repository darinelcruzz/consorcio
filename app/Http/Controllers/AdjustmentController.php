<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Adjustment;
use App\Product;

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
        Adjustment::create($request->all());

        return back();
    }

}
