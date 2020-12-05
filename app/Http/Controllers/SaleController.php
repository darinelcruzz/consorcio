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
        $model = getSaleModel($type); // dd($request->all());

        $model::create($request->except('items'));

        return redirect(route('sale.index', $type));
    }

    function show($type, $id)
    {
        $model = getSaleModel($type); // dd($request->all());
        $sale = $model::find($id);
        return view('sales.edit', compact('sale', 'type'));
    }

    function edit($type, $id)
    {
        $model = getSaleModel($type); // dd($request->all());
        $sale = $model::find($id);
        return view('sales.edit', compact('sale', 'type'));
    }

    function update(Request $request, $type, $id)
    {
        dd($request->all());
        return "TO DO: UPDATE PAGE";
    }

    function destroy($type, $id)
    {
        return "TO DO: DESTROY PAGE";
    }
}
