<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\AliveSale;
use App\FreshSale;
use App\PorkSale;
use App\ProcessedSale;

class WelcomeController extends Controller
{
    function home()
    {
        $salesA = AliveSale::where('status', 'credito')->get();
        $salesF = FreshSale::where('status', 'credito')->get();
        $salesP = PorkSale::where('status', 'credito')->get();
        $salesPr = ProcessedSale::where('status', 'credito')->get();
        $this->changeToExpired($salesA);
        $this->changeToExpired($salesF);
        $this->changeToExpired($salesP);
        $this->changeToExpired($salesPr);

        return view('welcome');
    }

    function changeToExpired($sales)
    {

        foreach ($sales as $sale) {
            if(date('Y-m-d') >= date('Y-m-d', strtotime("$sale->date + $sale->days days"))){
                $sale->update([
                    'status' => 'vencida'
                ]);
            }
        }
    return;
    }
}
