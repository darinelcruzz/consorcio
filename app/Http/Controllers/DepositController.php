<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AliveSale;
use App\FreshSale;
use App\PorkSale;
use App\ProcessedSale;
use App\Deposit;

class DepositController extends Controller
{
    function index()
    {
        $alive = AliveSale::all();
        $fresh = FreshSale::all();
        $pork = PorkSale::all();
        $processed = ProcessedSale::all();
        $due = $this->getDueSales($alive, $fresh, $pork, $processed);



        return view('deposits.index', compact('alive', 'fresh', 'pork', 'processed', 'due'));
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

    function store(Request $request)
    {
        $this->validate($request, ['amount' => 'required']);

        $deposit = Deposit::create($request->all());

        return back();
    }
}
