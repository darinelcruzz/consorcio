<?php

Auth::routes();

Route::get('clients', function()
{
    $all = App\Client::all();

    $clients = [];

    foreach ($all as $client) {

        $client = [
            'id' => $client->id,
            'name' => $client->name,
            'address' => $client->address,
            'notes' => $client->notes,
            'unpaid' => $client->unpaid_notes,
            'balance' => $client->balance,
        ];

        array_push($clients, (object) $client);

    }

    return $clients;
});

Route::get('products', function () {
    $all = \App\Product::where('processed', 1)->get();

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
});
