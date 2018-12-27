<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\{AliveSale, FreshSale, PorkSale, ProcessedSale};

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

    function writeSeries($type)
    {
        switch ($type) {
            case 'vivo':
                foreach (AliveSale::all() as $sale) {
                    $sale->update([
                        'series' => 'A'
                    ]);
                }
                break;
            case 'fresco':
                foreach (FreshSale::all() as $sale) {
                    $sale->update([
                        'series' => 'A'
                    ]);
                }
                break;
            case 'procesado':
                foreach (ProcessedSale::all() as $sale) {
                    $sale->update([
                        'series' => 'A'
                    ]);
                }
                break;
            case 'cerdo':
                foreach (PorkSale::all() as $sale) {
                    $sale->update([
                        'series' => 'A'
                    ]);
                }
                break;
            
            default:
                return 'nada';
                break;
        }

        return 'SIN PROBLEMAS';
    }

    function writeSeriesTwo($type)
    {
        switch ($type) {
            case 'vivo':
                foreach (AliveSale::where('series', null)->get() as $sale) {
                    $sale->update([
                        'series' => 'A'
                    ]);
                }
                break;
            case 'fresco':
                foreach (FreshSale::where('series', null)->get() as $sale) {
                    $sale->update([
                        'series' => 'A'
                    ]);
                }
                break;
            case 'procesado':
                foreach (ProcessedSale::where('series', null)->get() as $sale) {
                    $sale->update([
                        'series' => 'A'
                    ]);
                }
                break;
            case 'cerdo':
                foreach (PorkSale::where('series', null)->get() as $sale) {
                    $sale->update([
                        'series' => 'A'
                    ]);
                }
                break;
            
            default:
                return 'nada';
                break;
        }

        return 'SIN PROBLEMAS';
    }
}
