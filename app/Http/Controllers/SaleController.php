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
        $request->validate([
            "client_id" => 'required',
            "folio" => 'required',
            "series" => 'required',
            "date" => 'required',
            "price" => 'required',
            "items" => 'array|min:1|required',
            "quantity" => 'required',
            "kg" => 'required',
            "amount" => 'required',
            "credit" => 'required',
            "days" => 'required',
            "status" => 'required'
        ]);

        $model = getSaleModel($type); 
        // dd($request->all());

        $model::create($request->except('items', 'extraordinary', 'credit', 'status', 'days') + [
            'status' => $request->credit ? 'credito': 'pagado',
            'credit' => $request->credit == '0' ? 0: 1,
            'days' => $request->credit * 8 >= 16 ? 15: $request->credit * 8
        ]);

        return redirect(route('sale.index', $type));
    }

    function show($type, $id)
    {
        $model = getSaleModel($type); // dd($request->all());
        $sale = $model::find($id);
        return view('sales.show', compact('sale', 'type'));
    }

    function edit($type, $id)
    {
        $model = getSaleModel($type); // dd($request->all());
        $sale = $model::find($id);
        return view('sales.edit', compact('sale', 'type'));
    }

    function update(Request $request, $type, $id)
    {
        $model = getSaleModel($type); //dd($request->all(), $model);
        $sale = $model::find($id);
        $sale->update($request->except('items', 'origin') + [
            'status' => request('days') != '0' ? 'credito': 'pagado',
            'credit' => request('days') == '0' ? 0: 1,
        ]);

        if ($type == 'procesado') {
            return redirect(route('sale.show', [$type, $id]));
        }

        return redirect(route('sale.index', $type));
    }

    function search(Request $request)
    {
        $request->validate(['note' => 'required|regex:/^[a-zA-Z]+-[0-9]+-[a-zA-Z]$/']);

        // dd('validado');
        list($type, $folio, $series) = explode('-', strtolower($request->note));

        $model = getSaleModel($type);

        $sale = $model::where('folio', $folio)->where('series', strtoupper($series))->first();

        if($sale) {
            return redirect(route('client.show', [$sale->client, $type]));
        }

        return back();
    }

    function cancel(Request $request, $type)
    {
        $model = getSaleModel($type); //dd($request->all(), $model);
        $last = $model::all()->last();

        $model::create([
            'folio' => $last->folio + 1,
            'series' => $last->series,
            'date' => $request->selected_date,
            'client_id' => 1,
            'status' => 'cancelada',
        ]);

        return redirect(route('sale.index', $type));
    }

    function migrate($type, $series, $month)
    {
        $model = getSaleModel($type); //dd($request->all(), $model);
        $sales = $model::where('series', $series)
            ->whereMonth('date', $month)
            ->where('status', '!=', 'cancelada')
            ->whereDoesntHave('movements')
            ->get();

        $id = getProductID($type);

        if ($type == 'procesado') {
            foreach ($sales as $sale) {
                $items = [];
                foreach (unserialize($sale->products) as $product) {
                    // dd($product);
                    array_push($items, [
                        'product_id' => $product['i'],
                        'quantity' => $product['q'],
                        'kg' => $product['k'] ?? 0,
                        'boxes' => $product['b'] ?? 0,
                        'price' => $product['p'],
                        'created_at' => $sale->date
                    ]);
                }
                $sale->movements()->createMany($items);
            }
        } else {
            foreach ($sales as $sale) {
                $sale->movements()->create([
                    'product_id' => $id,
                    'quantity' => $sale->quantity,
                    'kg' => $sale->kg,
                    'price' => Price::find($sale->price)->price,
                    'created_at' => $sale->date
                ]);
            }
        }

        return "TERMINADO: " . $type . ", $month de la serie $series";
    }
}
