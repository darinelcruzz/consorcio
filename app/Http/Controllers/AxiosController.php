<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Client, Product, PorkSale, ProcessedSale, FreshSale, AliveSale, Deposit};

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

    function products($range = 1)
    {
        $all = Product::where('processed', 1)->where('price', $range)->get();

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

    function deposits($keyword = null)
    {
        if ($keyword) {
            return Deposit::orderBy('id', 'DESC')
                ->where('type', 'LIKE', "%$keyword%")
                ->orWhere('sale_id', 'LIKE', "%$keyword%")
                ->orWhere('user', 'LIKE', "%$keyword%")
                ->orWhere('id', 'LIKE', "%$keyword%")
                ->orWhere('user', 'LIKE', "%$keyword%")
                // ->with('sale:id')
                ->paginate(10);
        }

        return Deposit::orderBy('id', 'DESC')
            // ->with('sale:id')
            ->paginate(10);
    }
}
