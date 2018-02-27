<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\{Price, Product};

class PriceController extends Controller
{
    function index()
    {
        $pork = Price::where('product_id', '1')->get();
        $fresh = Price::where('product_id', '2')->get();
        $alive = Price::where('product_id', '3')->get();
        $processed = Price::where('product_id', '>', '3')->get();
        $prices = Price::all();

        return view('prices.index', compact('fresh', 'alive', 'processed', 'pork', 'prices'));
    }

    function update(Request $request)
    {
        Price::find($request->product)->update([
            'price' => $request->price
        ]);
        return back();
    }

    function format()
    {
        $date = Date::now()->format('l, j-F-Y');
        $pork = Price::where('product_id', '1')->get();
        $fresh = Price::where('product_id', '2')->get();
        $alive = Price::where('product_id', '3')->get();
        $processed = Price::where('product_id', '>', '3')->get();
        $prices = Price::all()->pluck('name', 'id');

        return view('prices.format', compact('date', 'fresh', 'alive', 'processed', 'pork'));
    }
}
