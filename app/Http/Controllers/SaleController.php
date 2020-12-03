<?php

namespace App\Http\Controllers;

use App\{ProcessedSale, AliveSale, FreshSale, PorkSale, Price, Client};
use Illuminate\Http\Request;

class SaleController extends Controller
{
    function index($type)
    {
        return view('sales.index', compact('type'));
    }

    function create($type)
    {
        return view('sales.create', compact('type'));
    }

    function store(Request $request, $type)
    {
        dd($request->all());

        $model = getSaleModel($type);

        $model::create($request->except('items'));

        return redirect(route('sale.index', $type));
    }

    function show(SaleMovement $saleMovement)
    {
        //
    }

    function edit(SaleMovement $saleMovement)
    {
        //
    }

    function update(Request $request, SaleMovement $saleMovement)
    {
        //
    }

    function destroy(SaleMovement $saleMovement)
    {
        //
    }
}
