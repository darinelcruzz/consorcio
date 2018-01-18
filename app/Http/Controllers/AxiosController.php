<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Product;

class AxiosController extends Controller
{
    function clients2()
    {
        $all = Client::all();
        $clients = [];

        foreach ($all as $client) {
            $client = [
                'id' => $client->id,
                'text' => $client->name,
            ];
            array_push($clients, (object) $client);
        }

        return $clients;
    }

    function clients()
    {
        $all = Client::all();

        $clients = [];

        foreach ($all as $client) {

            $client = [
                'id' => $client->id,
                'name' => $client->name,
                'address' => $client->address,
                'notes' => $client->notes,
                'credit' => $client->credit,
                'unpaid' => $client->unpaid_notes,
                'balance' => $client->balance,
            ];

            array_push($clients, (object) $client);

        }

        $clients = collect($clients);

        return $clients->keyBy('id');
    }

    function products()
    {
        $all = Product::where('processed', 1)->get();

        $products = [];
        $price_id = '10';

        foreach ($all as $p) {

            $product = [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price_alone
            ];

            array_push($products, (object) $product);

        }

        return $products;
    }
}
