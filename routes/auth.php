<?php

Route::get('/', usesas('WelcomeController', 'home'));
Route::get('/series/{type}', usesas('WelcomeController', 'writeSeries'));
Route::get('/series2/{type}', usesas('WelcomeController', 'writeSeriesTwo'));

Route::group(['prefix' => 'clientes', 'as' => 'client.'], function () {
    $ctrl = 'ClientController';

    Route::get('/', usesas($ctrl, 'index'));
    Route::get('agregar', usesas($ctrl, 'create'));
    Route::post('agregar', usesas($ctrl, 'store'));
    Route::get('editar/{client}', usesas($ctrl, 'edit'));
    Route::post('editar', usesas($ctrl, 'update'));
    Route::get('{client}', usesas($ctrl, 'details'));
});

Route::group(['prefix' => 'ventas/cerdo', 'as' => 'pork.'], function () {
    $ctrl = 'PorkSalesController';

    Route::get('/', usesas($ctrl, 'index'));
    Route::get('agregar', usesas($ctrl, 'create'));
    Route::post('agregar', usesas($ctrl, 'store'));
    Route::get('editar/{porkSale}', usesas($ctrl, 'edit'))->middleware('admin');
    Route::post('editar', usesas($ctrl, 'update'));
    Route::post('descartar', usesas($ctrl, 'discard'));
    Route::get('rellenar', usesas($ctrl, 'fillfield'));
});

Route::group(['prefix' => 'ventas/vivo', 'as' => 'alive.'], function () {
    $ctrl = 'AliveSalesController';

    Route::get('/', usesas($ctrl, 'index'));
    Route::get('agregar', usesas($ctrl, 'create'));
    Route::post('agregar', usesas($ctrl, 'store'));
    Route::get('editar/{aliveSale}', usesas($ctrl, 'edit'))->middleware('admin');
    Route::post('editar', usesas($ctrl, 'update'));
    Route::post('descartar', usesas($ctrl, 'discard'));
    Route::get('rellenar', usesas($ctrl, 'fillfield'));
});

Route::group(['prefix' => 'ventas/fresco', 'as' => 'fresh.'], function () {
    $ctrl = 'FreshSalesController';

    Route::get('/', usesas($ctrl, 'index'));
    Route::get('agregar', usesas($ctrl, 'create'));
    Route::post('agregar', usesas($ctrl, 'store'));
    Route::get('editar/{freshSale}', usesas($ctrl, 'edit'))->middleware('admin');
    Route::post('editar', usesas($ctrl, 'update'));
    Route::post('descartar', usesas($ctrl, 'discard'));
    Route::get('rellenar', usesas($ctrl, 'fillfield'));
});

Route::group(['prefix' => 'ventas/procesado', 'as' => 'processed.'], function () {
    $ctrl = 'ProcessedSalesController';

    Route::get('/', usesas($ctrl, 'index'));
    Route::get('agregar', usesas($ctrl, 'create'));
    Route::post('agregar', usesas($ctrl, 'store'));
    Route::get('editar/{processedSale}', usesas($ctrl, 'edit'))->middleware('admin');
    Route::post('editar', usesas($ctrl, 'update'));
    Route::post('descartar', usesas($ctrl, 'discard'));
    Route::get('rellenar', usesas($ctrl, 'fillfield'));
    Route::get('{processedsale}', usesas($ctrl, 'show'));
    Route::get('{processedsale}/agregar-kg', usesas($ctrl, 'editKg'));
    Route::post('agregar-kg', usesas($ctrl, 'storeKg'));
});

// Deposits
Route::group(['prefix' => 'credito', 'as' => 'deposit.'], function () {
    $ctrl = 'DepositController';

    Route::get('/', usesas($ctrl, 'credits'));
    Route::get('abonos', usesas($ctrl, 'index'));
    Route::post('abonar', usesas($ctrl, 'store'));
    Route::get('detalles/{type}/{id}/{amount}', usesas($ctrl, 'details'));
});

// Shippings
Route::group(['prefix' => 'embarques', 'as' => 'shipping.'], function () {
    $ctrl = 'ShippingsController';

    Route::get('/', usesas($ctrl, 'index'));
    Route::get('agregar', usesas($ctrl, 'create'));
    Route::post('agregar', usesas($ctrl, 'store'));
    Route::get('procesado/{shipping}', usesas($ctrl, 'show'));
});

// Products
Route::get('productos', usesas('ProductsController', 'index', 'product.index'));
Route::post('productos', usesas('ProductsController', 'store', 'product.store'));

Route::get('ajustes', usesas('AdjustmentController', 'index', 'adjustment.index'));
Route::post('ajustes', usesas('AdjustmentController', 'store', 'adjustment.store'));

// Prices
Route::group(['prefix' => 'precios', 'as' => 'price.'], function () {
    $ctrl = 'PriceController';

    Route::get('/', usesas($ctrl, 'index'));
    Route::post('/', usesas($ctrl, 'update'));
    Route::get('formato', usesas($ctrl, 'format'));
});

// Reports
Route::group(['prefix' => 'reportes', 'as' => 'report.'], function () {
    $ctrl = 'ReportController';

    Route::get('menu', usesas($ctrl, 'menu'));
    Route::post('cliente', usesas($ctrl, 'client'));
    Route::post('producto', usesas($ctrl, 'product'));
    Route::post('ventas', usesas($ctrl, 'sales'));
    Route::post('embarques', usesas($ctrl, 'shippings'));
});

// Usuarios
Route::group(['prefix' => 'usuarios', 'as' => 'user.'], function () {
    $ctrl = 'UserController';

    Route::get('/', usesas($ctrl, 'index'));
    Route::get('crear', usesas($ctrl, 'create'));
    Route::post('crear', usesas($ctrl, 'store'));
    Route::get('editar/{user}', usesas($ctrl, 'edit'));
    Route::post('editar', usesas($ctrl, 'update'));
    Route::get('eliminar/{user}', usesas($ctrl, 'destroy'));
});

// Axios
Route::get('clients', usesas('AxiosController', 'clients'));
Route::get('clients2', usesas('AxiosController', 'clients2'));
Route::get('products', usesas('AxiosController', 'products'));
