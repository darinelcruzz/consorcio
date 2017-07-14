<?php

Route::get('salir', function ()
{
    Auth::logout();

    return redirect('/');
})->name('getout');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['prefix' => 'clientes', 'as' => 'client.'], function () {
    Route::get('/', [
        'uses' => 'ClientController@index',
        'as' => 'index'
    ]);

    Route::get('agregar', [
        'uses' => 'ClientController@create',
        'as' => 'create'
    ]);

    Route::post('agregar', [
        'uses' => 'ClientController@store',
        'as' => 'store'
    ]);

    Route::get('editar/{id}', [
        'uses' => 'ClientController@edit',
        'as' => 'edit'
    ]);

    Route::post('editar', [
        'uses' => 'ClientController@update',
        'as' => 'update'
    ]);

    Route::get('detalles/{id}', [
        'uses' => 'ClientController@details',
        'as' => 'details'
    ]);
});

Route::get('ventas/cerdo', [
    'uses' => 'PorkSalesController@index',
    'as' => 'pork.index'
]);

Route::get('ventas/cerdo/agregar', [
    'uses' => 'PorkSalesController@create',
    'as' => 'pork.create'
]);

Route::post('ventas/cerdo/agregar', [
    'uses' => 'PorkSalesController@store',
    'as' => 'pork.store'
]);

Route::get('ventas/vivo', [
    'uses' => 'AliveSalesController@index',
    'as' => 'alive.index'
]);

Route::get('ventas/vivo/agregar', [
    'uses' => 'AliveSalesController@create',
    'as' => 'alive.create'
]);

Route::post('ventas/vivo/agregar', [
    'uses' => 'AliveSalesController@store',
    'as' => 'alive.store'
]);

Route::get('ventas/fresco', [
    'uses' => 'FreshSalesController@index',
    'as' => 'fresh.index'
]);

Route::get('ventas/fresco/agregar', [
    'uses' => 'FreshSalesController@create',
    'as' => 'fresh.create'
]);

Route::post('ventas/fresco/agregar', [
    'uses' => 'FreshSalesController@store',
    'as' => 'fresh.store'
]);

// Shippings
Route::get('embarques', [
    'uses' => 'ShippingsController@index',
    'as' => 'shipping.index'
]);

Route::get('embarques/agregar', [
    'uses' => 'ShippingsController@create',
    'as' => 'shipping.create'
]);

Route::post('embarques/agregar', [
    'uses' => 'ShippingsController@store',
    'as' => 'shipping.store'
]);

// Products
Route::get('productos', [
    'uses' => 'ProductsController@index',
    'as' => 'product.index'
]);

Route::post('productos', [
    'uses' => 'ProductsController@store',
    'as' => 'product.store'
]);
