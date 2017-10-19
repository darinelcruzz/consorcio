<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use App\Product;

class PriceController extends Controller
{
    function index()
    {
        $prices = Price::all();
        return view('prices', compact('prices'));
    }

    function store(Request $request)
    {
        return back();
    }
}
