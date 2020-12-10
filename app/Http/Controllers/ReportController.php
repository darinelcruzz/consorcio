<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;
use Jenssegers\Date\Date;
use App\{Deposit, Client, Shipping, Product, AliveSale, FreshSale, PorkSale, ProcessedSale};

class ReportController extends Controller
{
    function menu()
    {
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $date = date('Y-m-d');
        return view('reports.menu', compact('clients', 'date'));
    }

    function client(ReportRequest $request)
    {
        $client = Client::find($request->client_id);
        $sales = $client->getAllSales($request->start, $request->end);
        $range = date('j/M/y', strtotime($request->start)) . ' - ' . date('j/M/y', strtotime($request->end));

        return view('reports.client', compact('sales', 'client', 'range'));
    }

    function monthly(ReportRequest $request)
    {        
        $month = new Date(strtotime($request->month));
        $client = Client::find($request->client_id);
        
        if ($request->client_id != '0') {
            $sales = $client->getMonthlySales($request->month);
        } else {
            $pork = PorkSale::where('date', '>=', $request->month . '-01')->where('date', '<=', $request->month . '-31')->get();
            $fresh = FreshSale::where('date', '>=', $request->month . '-01')->where('date', '<=', $request->month . '-31')->get();
            $alive = AliveSale::where('date', '>=', $request->month . '-01')->where('date', '<=', $request->month . '-31')->get();
            $processed = ProcessedSale::where('date', '>=', $request->month . '-01')->where('date', '<=', $request->month . '-31')->get();

            $sales = $pork->concat($fresh)->concat($alive)->concat($processed)->groupBy('date');
        }

        // dd($sales);

        $offset = date('w', strtotime($request->month));
        $limit = date('t', strtotime($request->month));
        $weeks = [0, 1, 2, 3, 4];

        if (($offset == 6 || $offset == 5) && $limit > 29) {
            array_push($weeks, 5);
        }

        return view('reports.monthly', compact('sales', 'client', 'month', 'offset', 'limit', 'weeks'));
    }

    function shippings(ReportRequest $request)
    {

        $shippings = Shipping::whereBetween('date', [$request->start, $request->end])->get();
        $start =new Date(strtotime($request->start));
        $end =new Date(strtotime($request->end));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

        return view('reports.shippings', compact('shippings', 'range'));
    }

    function sales(ReportRequest $request)
    {
        $alive = AliveSale::salesReport($request->start, $request->end);
        $fresh = FreshSale::salesReport($request->start, $request->end);
        $processed = ProcessedSale::salesReport($request->start, $request->end);
        $pork = PorkSale::salesReport($request->start, $request->end);

        $start =new Date(strtotime($request->start));
        $end =new Date(strtotime($request->end));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

        return view('reports.sales', compact('alive', 'fresh', 'processed', 'pork','range'));
    }

    function product(ReportRequest $request)
    {
        $range = date('j/M/y', strtotime($request->start)) . ' - ' . date('j/M/y', strtotime($request->end));

        if ($request->product_id == 1) {
            $products = PorkSale::productReport($request->start, $request->end);
            $product = 'Cerdo';
        }
        elseif ($request->product_id == 2) {
            $products = FreshSale::productReport($request->start, $request->end);
            $product = 'Pollo Fresco';
        }
        elseif ($request->product_id == 3) {
            $products = AliveSale::productReport($request->start, $request->end);
            $product = 'Pollo Vivo';
        }

        elseif ($request->product_id == 4) {
            // $sales = ProcessedSale::rangeReport($request->start, $request->end);
            $data = \App\Movement::where('movable_type', 'App\ProcessedSale')
                ->whereBetween('created_at', [$request->start, $request->end])
                ->with('product', 'movable.client:id,name')
                ->get()
                ->groupBy('product.name');

            dd($data->first());
            $maxi = $big = $medium = $small = $junior = $petit = $mini = [];
            foreach ($sales as $sale) {
                // foreach ($sale->movements as $movement) {
                //     $types = ['23' => 'maxi', '4' => 'big', '5' => 'medium', '6' => 'small', '7' => 'junior', '8' => 'petit', '9' => 'mini'];

                //     array_push(${$types[$movement->product_id]}, [
                //         'client' => $sale->client_id,
                //         'quantity' => $movement->quantity, 
                //         'kg' => $movement->kg,
                //         'amount' => $sale->amount
                //     ]);
                // }
                dd($sale->movements()->with('product')->get()->groupBy('product_id'));
            }

            $data = [
                'Maxi' => collect($maxi)->groupBy('client'),
                'Grande' => collect($big)->groupBy('client'),
                'Mediano' => collect($medium)->groupBy('client'),
                'Chico' => collect($small)->groupBy('client'),
                'Junior' => collect($junior)->groupBy('client'),
                'Petit' => collect($petit)->groupBy('client'),
                'Mini' => collect($mini)->groupBy('client')
            ];

            dd($data);

            $product = 'Rangos';

            return view('reports.range', compact('product', 'data', 'range'));
        }
        elseif ($request->product_id == 5) {

            $sales = ProcessedSale::cutsReport($request->start, $request->end);
            $boneless = $bone = $foot = $wings = $wing = $gizzard = $visors = $pickled = $marinated = $milanese = $tf500 = [];
            foreach ($sales as $sale) {
                foreach (unserialize($sale->products) as $p) {
                    $kg = isset($p['k']) ? $p['k']: 0;

                    $types = ['10' => 'boneless', '11' => 'bone', '12' => 'foot', '13' => 'wings', '14' => 'wing',
                        '15' => 'gizzard', '16' => 'visors', '17' => 'pickled', '21' => 'milanese', '22' => 'marinated', '24' => 'tf500'];

                    array_push(${$types[$p['i']]}, [ // ${$types[..]} devuelve $boneless, $bone...
                        'client' => $sale->client_id,
                        'quantity' => $p['q'], 'kg' => $kg,
                        'amount' => count(unserialize($sale->products)) > 1 ? $kg * $p['p']: $sale->amount
                    ]);
                }
            }

            $data = [
                'Pechuga sin hueso' => collect($boneless)->groupBy('client'),
                'Pechuga con hueso' => collect($bone)->groupBy('client'),
                'Pierna y Muslo' => collect($foot)->groupBy('client'),
                'Alas picosas' => collect($wings)->groupBy('client'),
                'Ala 1 y 2' => collect($wing)->groupBy('client'),
                'Ala picosa TF500' => collect($tf500)->groupBy('client'),
                'Molleja' => collect($gizzard)->groupBy('client'),
                'Viscera mixta' => collect($visors)->groupBy('client'),
                'Pollo Adobado' => collect($pickled)->groupBy('client'),
                'Milanesa de pechuga' => collect($milanese)->groupBy('client'),
                'Pechuga deshuesada marinada' => collect($marinated)->groupBy('client'),
            ];

            $product = 'Cortes';

            return view('reports.curt', compact('product', 'data', 'range'));
        }

        return view('reports.product', compact('products', 'product', 'range'));
    }

}
