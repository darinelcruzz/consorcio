<?php

Route::get('/', function () {
    return view('web');
})->name('web');

Route::get('salir', function ()
{
    Auth::logout();
    return redirect('/');
})->name('getout');

//Route::get('excel/exportar', 'ExcelController@export');
//Route::get('excel/importar', 'ExcelController@import');

Route::get('tests', function () {
    $sale = \App\ProcessedSale::find(1);
    return unserialize($sale->products);
});
