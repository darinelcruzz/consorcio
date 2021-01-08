<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;
use Jenssegers\Date\Date;
use App\{Deposit, Client, Shipping, Product, AliveSale, FreshSale, PorkSale, ProcessedSale, Movement};

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
        $range = date('d/m/Y', strtotime($request->start)) . ' - ' . date('d/m/Y', strtotime($request->end));

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
        $range = date('d/m/Y', strtotime($request->start)) . ' - ' . date('d/m/Y', strtotime($request->end));
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
        $range = $start->format('d/m/Y'). ' - ' . $end->format('d/m/Y');

        return view('reports.sales', compact('alive', 'fresh', 'processed', 'pork','range'));
    }

    function product(ReportRequest $request)
    {
        $range = date('d/m/Y', strtotime($request->start)) . ' - ' . date('d/m/Y', strtotime($request->end));

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

        elseif ($request->product_id >= 4) {
            $data = Movement::where('movable_type', 'App\ProcessedSale')
                ->whereIn('product_id', $request->product_id == 4 ? [4, 5, 6, 7, 8, 9, 23]: [10, 11, 12, 13, 14, 15, 16, 17, 21, 22, 24])
                ->with('product', 'processed_sale', 'movable.client:id,name')
                ->whereHas('processed_sale', function ($query) use ($request) {
                    $query->whereBetween('date', [$request->start, $request->end]);                    
                })
                ->get()
                ->groupBy(['product.name', function ($item) {
                    return $item->movable->client->name;
                }], $preservedKeys = true);

            $product = $request->product_id == 4 ? 'Rangos': 'Cortes';
            $view = $request->product_id == 4 ? 'range': 'curt';

            return view('reports.' . $view, compact('product', 'data', 'range'));
        }

        return view('reports.product', compact('products', 'product', 'range'));
    }

    function prices(ReportRequest $request)
    {
        $range = date('d/m/Y', strtotime($request->start)) . ' - ' . date('d/m/Y', strtotime($request->end));

        $data = Movement::whereHas('alive_sale', function ($query) use ($request) {
                $query->whereBetween('date', [$request->start, $request->end]);                    
            })
            ->orWhereHas('fresh_sale', function ($query) use ($request) {
                $query->whereBetween('date', [$request->start, $request->end]);                    
            })
            ->orWhereHas('pork_sale', function ($query) use ($request) {
                $query->whereBetween('date', [$request->start, $request->end]);                    
            })
            ->orWhereHas('processed_sale', function ($query) use ($request) {
                $query->whereBetween('date', [$request->start, $request->end]);                    
            })
            ->whereNotIn('product_id', [4, 5, 6, 7, 8, 9, 23])
            ->with('product', 'movable.client:id,name')
            ->orderBy('product_id')
            ->get()
            // ->groupBy(['product.price', 'product.name', 'price']);
            ->groupBy(['product.price', function ($item) {
                if ($item->product->price == 4) {
                    return $item->product->price;
                }
                return $item->product->name;
            }, function ($item)
            {
                return (string) $item->price;
            }], $preservedKeys = true);

        // dd($data);

        return view('reports.prices', compact('data', 'range'));
    }

}
