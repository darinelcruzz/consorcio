<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\{Shipping, Product};

class ShippingsController extends Controller
{
    function index()
    {
        return view('shippings.index');
    }

    function show(Shipping $shipping)
    {
        return view('shippings.show', compact('shipping'));
    }

    function create()
    {
        return view('shippings.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
        ]);

        $attributes = $request->validate([
            'remission' => 'required',
            'date' => 'required',
            'provider' => 'required',
            'product' => 'required',
            'observations' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);

        $shipping = Shipping::create($attributes);

        return redirect('embarques');
    }

    function edit(Shipping $shipping)
    {
        return view('shippings.edit', compact('shipping'));
    }

    function update(Request $request, Shipping $shipping)
    {
        $request->validate([
            'items' => 'required|array|min:1',
        ]);

        $attributes = $request->validate([
            'remission' => 'required',
            'date' => 'required',
            'provider' => 'required',
            'product' => 'required',
            'observations' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ]);

        $shipping->update($attributes);

        return redirect('embarques');
    }
}
