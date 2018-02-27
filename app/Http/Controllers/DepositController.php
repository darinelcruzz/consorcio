<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use App\AliveSale;
use App\FreshSale;
use App\PorkSale;
use App\ProcessedSale;

class DepositController extends Controller
{
    function index()
    {
        $deposits = Deposit::all();

        return view('deposits.index', compact('deposits'));
    }

    function details($type, $id, $amount)
    {
        $deposits = Deposit::where('type', $type)->where('sale_id', $id)->get();

        return view('deposits.details', compact('deposits', 'type', 'id', 'amount'));
    }

    function credits()
    {
        $alive = AliveSale::where('status', '!=', 'cancelada')->get();
        $fresh = FreshSale::where('status', '!=', 'cancelada')->get();
        $pork = PorkSale::where('status', '!=', 'cancelada')->get();
        $processed = ProcessedSale::where('status', '!=', 'cancelada')->get();
        $due = $this->getDueSales($alive, $fresh, $pork, $processed);

        return view('deposits.credits', compact('alive', 'fresh', 'pork', 'processed', 'due'));
    }

    function store(Request $request)
    {
        $this->validate($request, ['amount' => 'required']);

        $deposit = Deposit::create($request->except(['dif']));

        if ($request->amount == $request->dif) {

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

            $sale->update([
                'status'=> 'pagado'
            ]);

            return redirect(route('client.details', ['client' => $sale->client_id]));

        }

        return back();
    }

    function getDueSales($alive, $fresh, $pork, $processed)
    {
        $due = [];

        foreach ($alive as $sale) {
            if ($sale->status == 'vencida') {
                array_push($due, $sale);
            }
        }
        foreach ($fresh as $sale) {
            if ($sale->status == 'vencida') {
                array_push($due, $sale);
            }
        }
        foreach ($pork as $sale) {
            if ($sale->status == 'vencida') {
                array_push($due, $sale);
            }
        }
        foreach ($processed as $sale) {
            if ($sale->status == 'vencida') {
                array_push($due, $sale);
            }
        }

        return $due;
    }
}
