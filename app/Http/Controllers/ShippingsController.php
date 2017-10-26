<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping;
use App\Product;
use Jenssegers\Date\Date;

class ShippingsController extends Controller
{
    function index()
    {
        $shippings = Shipping::all();

        return view('shippings.index', compact('shippings'));
    }

    function create()
    {
        $today = Date::now();
        $products = Product::where('processed', 0)->pluck('name', 'id');
        return view('shippings.create', compact('today', 'products'));
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'remission' => 'required',
            'date' => 'required',
            'provider' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'amount' => 'required'
        ]);

        Shipping::create($request->all());

        $product = Product::find($request->product);

        $product->update([
            'quantity' => $product->quantity + $request->quantity
        ]);

        return redirect('embarques');
    }
}
