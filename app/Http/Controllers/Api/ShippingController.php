<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipping;

class ShippingController extends Controller
{
    function index() 
    {
        return Shipping::orderBy('id', 'DESC')
            ->with('productr:id,name')
            ->paginate(10);
    }

    function search($keyword) 
    {
        return Shipping::where('remission', 'LIKE', "%$keyword%")
            ->orWhere('date', 'LIKE', "%$keyword%")
            ->orWhere('provider', 'LIKE', "%$keyword%")
            ->orderBy('id', 'DESC')
            ->with('productr:id,name')
            ->paginate(10);
    }
}
