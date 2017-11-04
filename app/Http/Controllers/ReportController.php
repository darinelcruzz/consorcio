<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Deposit;
use App\Client;
use App\Shipping;
use App\Product;
use App\AliveSale;
use App\FreshSale;
use App\PorkSale;
use App\ProcessedSale;

class ReportController extends Controller
{
    function menu()
    {
        $date = Date::now()->format('Y-m-d');
        $clients = Client::all()->pluck('name', 'id');

        return view('reports.menu', compact('date', 'clients'));
    }

    function client(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required',
        ]);
        $client = Client::find($request->client_id);
        $sales = $client->getAllSales($request->startDate, $request->endDate);
        $start =new Date(strtotime($request->startDate));
        $end =new Date(strtotime($request->endDate));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

        return view('reports.client', compact('sales', 'client', 'range'));
    }

    function shippings(Request $request)
    {

        $shippings = Shipping::whereBetween('date', [$request->startDate, $request->endDate])->get();

        $start =new Date(strtotime($request->startDate));
        $end =new Date(strtotime($request->endDate));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

        return view('reports.shippings', compact('shippings', 'range'));
    }

    function sales(Request $request)
    {
        $alive = AliveSale::salesReport($request->startDate, $request->endDate);
        $fresh = FreshSale::salesReport($request->startDate, $request->endDate);
        $processed = ProcessedSale::salesReport($request->startDate, $request->endDate);
        $pork = PorkSale::salesReport($request->startDate, $request->endDate);
        $deposits = Deposit::salesReport($request->startDate, $request->endDate);

        $start =new Date(strtotime($request->startDate));
        $end =new Date(strtotime($request->endDate));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

        return view('reports.sales', compact('alive', 'fresh', 'processed', 'pork', 'deposits','range'));
    }

    function product(Request $request)
    {
        if ($request->product_id == 1) {
            $products = PorkSale::productReport($request->startDate, $request->endDate);
            $product = 'Cerdo';
        }
        elseif ($request->product_id == 2) {
            $products = FreshSale::productReport($request->startDate, $request->endDate);
            $product = 'Pollo Fresco';
        }
        elseif ($request->product_id == 3) {
            $products = AliveSale::productReport($request->startDate, $request->endDate);
            $product = 'Pollo Vivo';
        }

        elseif ($request->product_id == 4) {
            $products = ProcessedSale::whereBetween('date', [$request->startDate, $request->endDate])->get();
            $product = 'No disponible';
        }
        elseif ($request->product_id == 5) {
            $products = ProcessedSale::whereBetween('date', [$request->startDate, $request->endDate])->get();
            $product = 'No disponible';
        }

        $start =new Date(strtotime($request->startDate));
        $end =new Date(strtotime($request->endDate));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

        return view('reports.product', compact('products', 'product', 'range'));
    }

}
