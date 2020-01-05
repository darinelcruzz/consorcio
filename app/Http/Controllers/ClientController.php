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
        $this->validate($request, [
            'name' => 'required|unique:clients',
        ]);

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'rfc' => $request->rfc,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'products' => serialize($request->products),
            'notes' => $request->notes ? $request->notes : 0,
            'days' => $request->days ? $request->days : 0,
            'credit' => empty($request->credit) ? 0: 1,
        ]);

        return redirect(route('client.index'));
    }

    function edit(Client $client)
    {
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
            'products' => serialize($request->products),
            'notes' => !empty($request->credit) ? $request->notes : 0,
            'days' => !empty($request->credit) ? $request->days : 0,
            'credit' => empty($request->credit) ? 0: 1,
        ]);

        return redirect(route('client.index'));
    }

    function show(Client $client)
    {
        $products = ['Vivo' => 'primary', 'Fresco' => 'warning', 'Cerdo' => 'baby', 'Procesado' => 'success'];
        
        return view('clients.show', compact('client', 'products'));
    }

    function destroy(Client $client)
    {
        $client->delete();

        return redirect(route('client.index'));
    }
}
