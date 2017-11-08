<?php

Route::get('salir', function ()
{
    Auth::logout();

    return redirect('/');
})->name('getout');

Route::get('excel/exportar', 'ExcelController@export');

Route::get('excel/importar', 'ExcelController@import');

Route::get('tests', function () {
    $sale = \App\ProcessedSale::find(1);
    return unserialize($sale->products);
});

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
            'credit' => $client->credit,
            'unpaid' => $client->unpaid_notes,
            'balance' => $client->balance,
        ];

        array_push($clients, (object) $client);

    }

    $clients = collect($clients);

    return $clients->keyBy('id');
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
