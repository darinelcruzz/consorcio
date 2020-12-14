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
        return Shipping::whereHas('productr', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                    ->orWhere('name', 'like', "%$keyword%");
            })
            ->orWhere('remission', 'LIKE', "%$keyword%")
            ->orWhere('date', 'LIKE', "%$keyword%")
            ->orWhere('provider', 'LIKE', "%$keyword%")
            ->orderBy('id', 'DESC')
            ->with('productr:id,name')
            ->paginate(10);
    }
}
