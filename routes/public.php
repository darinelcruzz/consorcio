<?php

Route::get('salir', function ()
{
    Auth::logout();

    return redirect('/');
})->name('getout');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('clientes', [
    'uses' => 'ClientController@index',
    'as' => 'client.index'
]);

Route::get('clientes/agregar', [
    'uses' => 'ClientController@create',
    'as' => 'client.create'
]);

Route::post('clientes/agregar', [
    'uses' => 'ClientController@store',
    'as' => 'client.store'
]);
