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
        $deposits = Deposit::whereBetween('created_at', [$request->startDate . ' 00:00:00', $request->endDate. ' 23:59:59'])
            ->sum('amount');

        $start =new Date(strtotime($request->startDate));
        $end =new Date(strtotime($request->endDate));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

        return view('reports.sales', compact('alive', 'fresh', 'processed', 'pork', 'deposits','range'));
    }

    function product(Request $request)
    {
        $start =new Date(strtotime($request->startDate));
        $end =new Date(strtotime($request->endDate));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

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
            $sales = ProcessedSale::rankReport($request->startDate, $request->endDate);
            $big = $medium = $small = $petit = $junior = $mini = [];
            foreach ($sales as $sale) {
                foreach (unserialize($sale->products) as $product) {
                    switch ($product['i']) {
                        case '4':
                            array_push($big, ['client' => $sale->client_id, 'quantity' => $product['b'], 'kg' => $product['q'], 'amount' => $product['p'] * $product['b']]);
                            break;
                        case '5':
                            array_push($medium, ['client' => $sale->client_id, 'quantity' => $product['b'], 'kg' => $product['q'], 'amount' => $product['p'] * $product['b']]);
                            break;
                        case '6':
                            array_push($small, ['client' => $sale->client_id, 'quantity' => $product['b'], 'kg' => $product['q'], 'amount' => $product['p'] * $product['b']]);
                            break;
                        case '7':
                            array_push($junior, ['client' => $sale->client_id, 'quantity' => $product['b'], 'kg' => $product['q'], 'amount' => $product['p'] * $product['b']]);
                            break;
                        case '8':
                            array_push($petit, ['client' => $sale->client_id, 'quantity' => $product['b'], 'kg' => $product['q'], 'amount' => $product['p'] * $product['b']]);
                            break;
                        case '9':
                            array_push($mini, ['client' => $sale->client_id, 'quantity' => $product['b'], 'kg' => $product['q'], 'amount' => $product['p'] * $product['b']]);
                            break;
                    }
                }
            }
            $bigC = collect($big);
            $mediumC = collect($medium);
            $smallC = collect($small);
            $juniorC = collect($junior);
            $petitC = collect($petit);
            $miniC = collect($mini);

            $bigG = $bigC->groupBy('client');
            $mediumG = $mediumC->groupBy('client');
            $smallG = $smallC->groupBy('client');
            $juniorG = $juniorC->groupBy('client');
            $petitG = $petitC->groupBy('client');
            $miniG = $miniC->groupBy('client');

            //dd($bigG);

            $product = 'Rangos';

            return view('reports.ranks', compact('bigG', 'product', 'range'));
        }
        elseif ($request->product_id == 5) {
            $products = ProcessedSale::whereBetween('date', [$request->startDate, $request->endDate])->get();
            $product = 'No disponible';
        }



        return view('reports.product', compact('products', 'product', 'range'));
    }

}
