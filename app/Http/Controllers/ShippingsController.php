<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping;

class ShippingsController extends Controller
{
    function index()
    {
        $shippings = Shipping::all();

        return view('shippings.index', compact('shippings'));
    }

    function create()
    {
        return view('shippings.create');
    }

    function store(Request $request)
    {
        Shipping::create($request->all());

        return redirect('embarques');
    }
}
