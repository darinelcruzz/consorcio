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
