<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Deposit, AliveSale, FreshSale, PorkSale, ProcessedSale};

class DepositController extends Controller
{
    function index()
    {
        // $deposits = Deposit::all();
        $deposits = Deposit::with('sale.client')->get();

        return view('deposits.index', compact('deposits'));
    }

    function details($type, $id, $amount)
    {
        $deposits = Deposit::where('type', $type)->where('sale_id', $id)->get();

        switch ($type) {
            case 'vivo':
                $sale = AliveSale::find($id);
                break;
            case 'fresco':
                $sale = FreshSale::find($id);
                break;
            case 'cerdo':
                $sale = PorkSale::find($id);
                break;
            case 'procesado':
                $sale = ProcessedSale::find($id);
                break;
        }

        return view('deposits.details', compact('deposits', 'type', 'id', 'amount', 'sale'));
    }

    function credits()
    {
        $products = [
            'vivo' => AliveSale::where('status', 'credito')->orWhere('status', 'vencida')->with('client:id,name')->get(),
            'fresco' => FreshSale::where('status', 'credito')->orWhere('status', 'vencida')->with('client:id,name')->get(),
            'procesado' => ProcessedSale::where('status', 'credito')->orWhere('status', 'vencida')->with('client:id,name')->get(),
            'cerdo' => PorkSale::where('status', 'credito')->orWhere('status', 'vencida')->with('client:id,name')->get(),
        ];

        $due = $this->getDueSales($products['vivo'], $products['vivo'], $products['vivo'], $products['vivo']);

        $colors = ['vivo' => 'primary', 'fresco' => 'warning', 'procesado' => 'success', 'cerdo' => 'baby'];

        return view('deposits.credits', compact('products', 'due', 'colors'));
    }

    function store(Request $request)
    {
        $this->validate($request, ['amount' => 'required']);

        switch ($request->type) {
            case 'vivo':
                $sale = AliveSale::find($request->sale_id); break;
            case 'fresco':
                $sale = FreshSale::find($request->sale_id); break;
            case 'cerdo':
                $sale = PorkSale::find($request->sale_id); break;
            case 'procesado':
                $sale = ProcessedSale::find($request->sale_id); break;
        }

        if ($sale->status != 'pagado') {

            $sale->deposits()->create($request->all());
            
            $sale->client->computeBalance();
            $sale->client->computeUnpaidNotes();

            if (($sale->amount - $sale->deposit_total) == 0) {
                $sale->update(['status' => 'pagado']);
            }

            return redirect(route('client.show', ['client' => $sale->client_id]));

        }

        return back();
    }

    function getDueSales($alive, $fresh, $pork, $processed)
    {
        $due = [];

        foreach (AliveSale::where('status', 'vencida')->with('client:id,name')->get() as $sale) {
            array_push($due, $sale);
        }
        foreach (FreshSale::where('status', 'vencida')->with('client:id,name')->get() as $sale) {
            array_push($due, $sale);
        }
        foreach (ProcessedSale::where('status', 'vencida')->with('client:id,name')->get() as $sale) {
            array_push($due, $sale);
        }
        foreach (PorkSale::where('status', 'vencida')->with('client:id,name')->get() as $sale) {
            array_push($due, $sale);
        }

        return $due;
    }

    function update($type)
    {
        $types = ['vivo' => 'App\AliveSale', 'fresco' => 'App\FreshSale', 'procesado' => 'App\ProcessedSale', 'cerdo' => 'App\PorkSale'];
        Deposit::whereSaleType('')->whereType($type)->update([
            'sale_type' => $types[$type]
        ]);

        return "LISTO PARA " . $type;
    }
}
