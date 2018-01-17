<?php

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

    Route::get('editar/{client}', [
        'uses' => 'ClientController@edit',
        'as' => 'edit'
    ]);

    Route::post('editar', [
        'uses' => 'ClientController@update',
        'as' => 'update'
    ]);

    Route::get('detalles/{client}', [
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

Route::get('ventas/cerdo/descartar/{folio}', [
    'uses' => 'PorkSalesController@discard',
    'as' => 'pork.discard'
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

Route::get('ventas/vivo/descartar/{folio}', [
    'uses' => 'AliveSalesController@discard',
    'as' => 'alive.discard'
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

Route::get('ventas/fresco/descartar/{folio}', [
    'uses' => 'FreshSalesController@discard',
    'as' => 'fresh.discard'
]);

Route::get('ventas/procesado', [
    'uses' => 'ProcessedSalesController@index',
    'as' => 'processed.index'
]);

Route::get('ventas/procesado/agregar', [
    'uses' => 'ProcessedSalesController@create',
    'as' => 'processed.create'
]);

Route::post('ventas/procesado/agregar', [
    'uses' => 'ProcessedSalesController@store',
    'as' => 'processed.store'
]);

Route::get('ventas/procesado/descartar/{folio}', [
    'uses' => 'ProcessedSalesController@discard',
    'as' => 'processed.discard'
]);

Route::get('ventas/procesado/detalles/{processedsale}', [
    'uses' => 'ProcessedSalesController@show',
    'as' => 'processed.show'
]);

Route::get('ventas/procesado/detalles/{processedsale}/editar', [
    'uses' => 'ProcessedSalesController@editKg',
    'as' => 'processed.editKg'
]);

Route::post('ventas/procesado/guardar/kilogramos', [
    'uses' => 'ProcessedSalesController@storeKg',
    'as' => 'processed.storeKg'
]);

// Deposits
Route::get('abonos', [
    'uses' => 'DepositController@index',
    'as' => 'deposit.index'
]);

Route::get('detalles/{type}/{id}/{amount}', [
    'uses' => 'DepositController@details',
    'as' => 'deposit.details'
]);

Route::get('creditos', [
    'uses' => 'DepositController@credits',
    'as' => 'deposit.credits'
]);

Route::post('creditos/abonar', [
    'uses' => 'DepositController@store',
    'as' => 'deposit.store'
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

Route::get('embarques/procesado/{shipping}', [
    'uses' => 'ShippingsController@show',
    'as' => 'shipping.show'
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

Route::get('ajustes', [
    'uses' => 'AdjustmentController@index',
    'as' => 'adjustment.index'
]);

Route::post('ajustes', [
    'uses' => 'AdjustmentController@store',
    'as' => 'adjustment.store'
]);

// Prices
Route::get('precios', [
    'uses' => 'PriceController@index',
    'as' => 'price.index'
]);

Route::post('precios', [
    'uses' => 'PriceController@update',
    'as' => 'price.update'
]);

Route::get('formato', [
    'uses' => 'PriceController@format',
    'as' => 'price.format'
]);


// Reports
Route::group(['prefix' => 'reportes', 'as' => 'report.'], function () {

    Route::get('menu', [
        'uses' => 'ReportController@menu',
        'as' => 'menu'
    ]);

    Route::post('cliente', [
        'uses' => 'ReportController@client',
        'as' => 'client'
    ]);

    Route::post('producto', [
        'uses' => 'ReportController@product',
        'as' => 'product'
    ]);

    Route::post('ventas', [
        'uses' => 'ReportController@sales',
        'as' => 'sales'
    ]);

    Route::post('embarques', [
        'uses' => 'ReportController@shippings',
        'as' => 'shippings'
    ]);

});

// Usuarios
Route::group(['prefix' => 'usuarios', 'as' => 'user.'], function () {
    $ctrl = 'UserController';

    Route::get('/', ['uses' => "$ctrl@index", 'as' => 'index']);

    Route::get('crear', ['uses' => "$ctrl@create", 'as' => 'create']);

    Route::post('crear', ['uses' => "$ctrl@store", 'as' => 'store']);

    Route::get('editar/{user}', ['uses' => "$ctrl@edit", 'as' => 'edit']);

    Route::post('editar', ['uses' => "$ctrl@update", 'as' => 'update']);

    Route::get('eliminar/{user}', ['uses' => "$ctrl@destroy", 'as' => 'destroy']);
});
