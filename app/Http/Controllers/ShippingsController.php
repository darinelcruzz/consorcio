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
        // dd($request->all());
        $request->validate([
            'items' => 'required|array|min:1',
        ]);

        $attributes = $request->validate([
            'remission' => 'required',
            'date' => 'required',
            'provider' => 'required',
            'observations' => 'nullable',
            'amount' => 'required',
            'quantity' => 'sometimes|required',
            'kg' => 'sometimes|required',
            'product' => 'sometimes|required',
            'price' => 'sometimes|required',
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
        // dd($request->all());
        $request->validate([
            'items' => 'required|array|min:1',
        ]);

        $attributes = $request->validate([
            'remission' => 'required',
            'date' => 'required',
            'provider' => 'required',
            'observations' => 'required',
            'amount' => 'required',
            'quantity' => 'sometimes|required',
            'kg' => 'sometimes|required',
            'product' => 'sometimes|required',
            'price' => 'sometimes|required',
        ]);

        $shipping->update([
            'quantity' => $shipping->product < 20 ? $request->items[0]['quantity']: $request->quantity,
            'price' => $request->items[0]['price'],
        ] + $attributes);

        return redirect('embarques');
    }

    function migrate()
    {
        $shippings = Shipping::whereDoesntHave('movements')->get();

        // dd($shippings);
        
        foreach ($shippings as $shipping) {
            if ($shipping->product == '20') {
                $items = [];
                foreach (unserialize($shipping->processed) as $product) {
                    // dd($product);
                    array_push($items, [
                        'product_id' => $product['i'],
                        'quantity' => $product['q'],
                        'kg' => $product['k'] ?? 0,
                        'boxes' => $product['q'],
                        'price' => $product['p'],
                    ]);
                }
                $shipping->movements()->createMany($items);
            } else {
                $shipping->movements()->create([
                    'product_id' => $shipping->product,
                    'quantity' => $shipping->quantity,
                    'kg' => 0,
                    'boxes' => $shipping->quantity,
                    'price' => $shipping->price,
                ]);
            }
        }

        return 'EMBARQUES MIGRADOS';
    }
}
