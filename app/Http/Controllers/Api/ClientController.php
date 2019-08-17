<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class ClientController extends Controller
{
    function index($product)
    {
    	// return Client::selectRaw('id, name, address, notes, credit')->get();
    	$buyers = Client::orderBy('name', 'asc')->get()
            ->filter(function ($item) use ($product) {
                return strpos($item->products, $product);
            });

    	$clients = [];

        foreach ($buyers as $client) {

            // $clients[$client->id] = (object) [
            //     'id' => $client->id,
            //     'name' => $client->name,
            //     'address' => $client->address,
            //     'notes' => $client->notes,
            //     'credit' => $client->credit,
            //     'unpaid' => $client->unpaid_notes,
            //     'balance' => $client->balance,
            // ];

            array_push($clients, (object) [
                'id' => $client->id,
                'name' => $client->name,
                'address' => $client->address,
                'notes' => $client->notes,
                'credit' => $client->credit,
                'unpaid' => $client->unpaid_notes,
                'balance' => $client->balance,
            ]);
        }

        return $clients;
    }
}
