<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class ClientController extends Controller
{
    function index($product)
    {
    	$buyers = Client::orderBy('name', 'asc')
    		->get()
            ->filter(function ($item) use ($product) {
                return strpos($item->products, $product);
            });

    	$clients = [];

        foreach ($buyers as $client) {

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

    function show($keyword = null)
    {
        if ($keyword != null) {
            return Client::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('products', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->paginate(10);
        }

        return Client::paginate(10);
    }
}
