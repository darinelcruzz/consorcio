<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    function create()
    {
        return view('clients.create');
    }

    function store(Request $request)
    {
        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'rfc' => $request->rfc,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'products' => serialize($request->products)
        ]);

        return redirect(route('client.index'));
    }

    function edit($id)
    {
        $client = Client::find($id);

        return view('clients.edit', compact('client'));
    }

    function update(Request $request)
    {
        Client::find($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'rfc' => $request->rfc,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'products' => serialize($request->products)
        ]);

        return redirect(route('client.index'));
    }

    function details($id)
    {
        $client = Client::find($id);

        return view('clients.details', compact('client'));
    }
}
