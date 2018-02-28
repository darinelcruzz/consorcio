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

                    $types = ['4' => 'big', '5' => 'medium', '6' => 'small', '7' => 'junior', '8' => 'petit', '9' => 'mini'];

                    array_push(${$types[$p['i']]}, [
                        'client' => $sale->client_id,
                        'quantity' => $p['q'], 'kg' => $kg,
                        'amount' => $kg * $p['p']
                    ]);
                }
            }

            $data = [
                'Grande' => collect($big)->groupBy('client'),
                'Mediano' => collect($medium)->groupBy('client'),
                'Chico' => collect($small)->groupBy('client'),
                'Junior' => collect($junior)->groupBy('client'),
                'Petit' => collect($petit)->groupBy('client'),
                'Mini' => collect($mini)->groupBy('client')
            ];

            $product = 'Rangos';

            return view('reports.range', compact('product', 'data', 'range'));
        }
        elseif ($request->product_id == 5) {

            $sales = ProcessedSale::cutsReport($request->startDate, $request->endDate);
            $boneless = $bone = $foot = $wings = $wing = $gizzard = $visors = $pickled = [];
            foreach ($sales as $sale) {
                foreach (unserialize($sale->products) as $p) {
                    $kg = isset($p['k']) ? $p['k']: 0;

                    $types = ['10' => 'boneless', '11' => 'bone', '12' => 'foot', '13' => 'wings', '14' => 'wing',
                        '15' => 'gizzard', '16' => 'visors', '17' => 'pickled'];

                    array_push(${$types[$p['i']]}, [ // ${$types[..]} devuelve $boneless, $bone...
                        'client' => $sale->client_id,
                        'quantity' => $p['q'], 'kg' => $kg,
                        'amount' => $kg * $p['p']
                    ]);
                }
            }

            $data = [
                'Pechuga sin hueso' => collect($boneless)->groupBy('client'),
                'Pechuga con hueso' => collect($bone)->groupBy('client'),
                'Pierna y Muslo' => collect($foot)->groupBy('client'),
                'Alas picosas' => collect($wings)->groupBy('client'),
                'Ala 1 y 2' => collect($wing)->groupBy('client'),
                'Molleja' => collect($gizzard)->groupBy('client'),
                'Viscera mixta' => collect($visors)->groupBy('client'),
                'Pollo Adobado' => collect($pickled)->groupBy('client')
            ];

            $product = 'Cortes';

            return view('reports.curt', compact('product', 'data', 'range'));
        }

        return view('reports.product', compact('products', 'product', 'range'));
    }

}
