<?php

use Illuminate\Http\Request;

// Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
//     //    Route::resource('task', 'TasksController');

//     //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
//     #adminlte_api_routes
// });

Route::group(['prefix' => 'sales', 'as' => 'api.'], function () {
    $ctrl = 'Api\SaleController';

    // Route::resource('sales', $ctrl);

    Route::get('{type}', usesas($ctrl, 'index'));
    Route::get('{type}/{keyword}', usesas($ctrl, 'search'));
    Route::get('create', usesas($ctrl, 'create'));
    Route::post('store', usesas($ctrl, 'store'));
    Route::get('edit/{sale}', usesas($ctrl, 'edit'));
    Route::post('edit', usesas($ctrl, 'update'));
    // Route::post('descartar', usesas($ctrl, 'discard'));
    // Route::post('buscar', usesas($ctrl, 'search'));
});