<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\{Shipping, Product};

class ShippingsController extends Controller
{
    function index()
    {
        $shippings = Shipping::all();

        return view('shippings.index', compact('shippings'));
    }

    function show(Shipping $shipping)
    {
        return view('shippings.show', compact('shipping'));
    }

    function create()
    {
        $today = Date::now();

        $products = Product::where([
            ['processed', '!=', 1],
            ['name', '!=', 'Pollo fresco']
        ])->pluck('name', 'id');

        $processed = Product::where('processed', 1)->get();

        return view('shippings.create', compact('today', 'products', 'processed'));
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
            'amount' => 'required',
            'pproducts' => 'sometimes|required'
        ]);

        $shipping = Shipping::create($request->all());

        if ($request->product != 20) {
            $product = Product::find($request->product);

            $product->update([
                'quantity' => $product->quantity + $request->quantity
            ]);
        } else {
            $products = [];

            for ($i = 0; $i < count($request->quantities); $i++) {
                $product = [];
                if($request->quantities[$i] > 0) {
                    $product['i'] =  $request->pproducts[$i];
                    $product['p'] =  $request->prices[$i];
                    $product['q'] =  $request->quantities[$i];
                    array_push($products, $product);

                    $pproduct = Product::find($request->pproducts[$i]);
                    $pproduct->update([
                        'quantity' => $pproduct->quantity + $request->quantities[$i]
                    ]);
                }
            }

            $shipping->update([
                'processed' => serialize($products)
            ]);
        }

        return redirect('embarques');
    }
}
