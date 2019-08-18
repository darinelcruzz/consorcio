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
}
