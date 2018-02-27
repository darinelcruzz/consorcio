<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\{Deposit, Client, Shipping, Product, AliveSale, FreshSale, PorkSale, ProcessedSale};

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
            $sales = ProcessedSale::rangeReport($request->startDate, $request->endDate);
            $big = $medium = $small = $junior = $petit = $mini = [];
            foreach ($sales as $sale) {
                foreach (unserialize($sale->products) as $p) {
                    $kg = isset($p['k']) ? $p['k']: 0;
                    $amount = $kg * $p['p'];

                    switch ($p['i']) {
                        case '4':
                            array_push($big, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '5':
                            array_push($medium, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '6':
                            array_push($small, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '7':
                            array_push($junior, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '8':
                            array_push($petit, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '9':
                            array_push($mini, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
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

            $data = ['Grande' => $bigG, 'Mediano' => $mediumG, 'Chico' => $smallG, 'Junior' => $juniorG, 'Petit' => $petitG, 'Mini' => $miniG];
            $product = 'Rangos';

            return view('reports.range', compact('product', 'data', 'range'));
        }
        elseif ($request->product_id == 5) {

            $sales = ProcessedSale::cutsReport($request->startDate, $request->endDate);
            $boneless = $bone = $foot = $wings = $wing = $gizzard = $visors = $pickled = [];
            foreach ($sales as $sale) {
                foreach (unserialize($sale->products) as $p) {
                    $kg = isset($p['k']) ? $p['k']: 0;
                    $amount = $kg * $p['p'];

                    switch ($p['i']) {
                        case '10':
                            array_push($boneless, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '11':
                            array_push($bone, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '12':
                            array_push($foot, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '13':
                            array_push($wings, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '14':
                            array_push($wing, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '15':
                            array_push($gizzard, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '16':
                            array_push($visors, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                        case '17':
                            array_push($pickled, ['client' => $sale->client_id, 'quantity' => $p['q'], 'kg' => $kg, 'amount' => $amount]);
                            break;
                    }
                }
            }
            $bonelessC = collect($boneless);
            $boneC = collect($bone);
            $footC = collect($foot);
            $wingsC = collect($wings);
            $wingC = collect($wing);
            $gizzardC = collect($gizzard);
            $visorsC = collect($visors);
            $pickledC = collect($pickled);

            $bonelessG = $bonelessC->groupBy('client');
            $boneG = $boneC->groupBy('client');
            $footG = $footC->groupBy('client');
            $wingsG = $wingsC->groupBy('client');
            $wingG = $wingC->groupBy('client');
            $gizzardG = $gizzardC->groupBy('client');
            $visorsG = $visorsC->groupBy('client');
            $pickledG = $pickledC->groupBy('client');

            $data = ['Pechuga sin hueso' => $bonelessG, 'Pechuga con hueso' => $boneG, 'Pierna y Muslo' => $footG, 'Alas picosas' => $wingsG,
            'Ala 1 y 2' => $wingG, 'Molleja' => $gizzardG, 'Viscera mixta' => $visorsG, 'Pollo Adobado' => $pickledG];
            $product = 'Cortes';

            return view('reports.curt', compact('product', 'data', 'range'));
        }



        return view('reports.product', compact('products', 'product', 'range'));
    }

}
