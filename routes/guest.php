<?php

Auth::routes();

Route::get('clients', function()
{
    return App\Client::all();
});
