<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{AliveSale, FreshSale, PorkSale, ProcessedSale};

class SaleController extends Controller
{
    function index($type)
    {
        $model = getSaleModel($type);
        return $model::with(['client:id,name', 'pricer:id,name'])
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    function search($type, $keyword)
    {
        $keyword = substr($keyword, -4);
        $model = getSaleModel($type);

        return $model::where('folio', 'LIKE', "%$keyword%")
            ->orWhere('status', 'LIKE', "%$keyword%")
            ->with(['client:id,name', 'pricer:id,name'])
            ->orderBy('id', 'DESC')
            ->paginate(10);
	}
}
