<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'sales', 'as' => 'api.'], function () {
    $ctrl = 'Api\SaleController';

    Route::get('{type}', usesas($ctrl, 'index'));
    Route::get('{type}/{keyword}', usesas($ctrl, 'search'));
    Route::get('create', usesas($ctrl, 'create'));
    Route::post('store', usesas($ctrl, 'store'));
    Route::get('edit/{sale}', usesas($ctrl, 'edit'));
    Route::post('edit', usesas($ctrl, 'update'));
});

Route::group(['prefix' => 'clients', 'as' => 'api.'], function () {
    $ctrl = 'Api\ClientController';

    Route::get('{client}/sales/{type}', usesas($ctrl, 'sales'));
    Route::get('{client}/sales/{type}/{keyword}', usesas($ctrl, 'search'));
    Route::get('all/{keyword?}', usesas($ctrl, 'show'));
    Route::get('/{product}', usesas($ctrl, 'index'));
});

Route::group(['prefix' => 'prices', 'as' => 'api.'], function () {
    $ctrl = 'Api\PriceController';
    Route::get('/{type}', usesas($ctrl, 'index'));
});

Route::group(['prefix' => 'shippings', 'as' => 'api.'], function () {
    $ctrl = 'Api\ShippingController';
    Route::get('/', usesas($ctrl, 'index'));
    Route::get('{keyword}', usesas($ctrl, 'search'));
});
