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
        $pork = Client::where('credit', 1)->buyers('cerdo');
        $alive = Client::where('credit', 1)->buyers('vivo');
        $fresh = Client::where('credit', 1)->buyers('fresco');
        $processed = Client::where('credit', 1)->buyers('procesado');
        $date = date('Y-m-d');
        return view('reports.menu', compact('clients', 'date', 'pork', 'alive', 'fresh', 'processed'));
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
            $psales = ProcessedSale::where('date', '>=', $request->start)->where('date', '<=', $request->end)->where('status', '!=', 'cancelada')->pluck('id');
            $data = Movement::where('movable_type', 'App\ProcessedSale')
                ->whereIn('product_id', $request->product_id == 4 ? [4, 5, 6, 7, 8, 9, 23]: [10, 11, 12, 13, 14, 15, 16, 17, 21, 22, 24, 26])
                ->whereIn('movable_id', $psales)
                ->with('product', 'processed_sale', 'movable.client:id,name')
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
        $request->validate([
            'type' => 'required'
        ]);

        $range = "del " . date('d/m/Y', strtotime($request->start)) . ' al ' . date('d/m/Y', strtotime($request->end));

        $type = $request->type;

        if ($request->type == 'ventas') {

            foreach (['App\PorkSale' => 'pork', 'App\AliveSale' => 'alive', 'App\FreshSale' => 'fresh', 'App\ProcessedSale' => 'processed'] as $model => $name) {
                $sales = $model::where('date', '>=', $request->start)->where('date', '<=', $request->end)->where('status', '!=', 'cancelada')->get();
                $first_sale_id = $sales->first()->id;
                $last_sale_id = $sales->last()->id;
                
                $$name = Movement::whereYear('created_at', substr($request->start, 0, 4))
                    ->where('movable_type', $model)
                    ->whereBetween('movable_id', [$first_sale_id, $last_sale_id])
                    ->where('product_id', '<=', 10)
                    ->with('product')
                    ->orderBy('price')
                    ->get()
                    ->groupBy(function ($item) {
                        return (string) $item->price;
                    });
            }

            $cuts = Movement::whereYear('created_at', substr($request->start, 0, 4))
                ->where('movable_type', 'App\ProcessedSale')
                ->whereBetween('movable_id', [$first_sale_id, $last_sale_id])
                ->where('product_id', '>=', 10)
                ->with('product')
                ->orderBy('price')
                ->get()
                ->groupBy([function ($item) {
                    return  $item->product->name;
                }, function ($item) {
                    return (string) $item->price;
                }]);
            
            return view('reports.prices', compact('type', 'pork', 'alive', 'fresh', 'processed', 'cuts', 'range'));
        }

        $shippings = Shipping::where('date', '>=', $request->start)->where('date', '<=', $request->end)->pluck('id');

        $cuts = Movement::whereYear('created_at', substr($request->start, 0, 4))
            ->where('movable_type', 'App\Shipping')
            ->whereIn('movable_id', $shippings)
            ->with('product')
            ->orderBy('product_id')
            ->get()
            ->groupBy([function ($item) {
                return $item->product->price == 4 ? (string) $item->product->price: $item->product->name;
            }, function ($item) {
                return (string) $item->price;
            }]);
            
        return view('reports.prices', compact('type', 'cuts', 'range'));

    }

    function purchases(Request $request)
    {
        $year = substr($request->month, 0, 4);
        $month = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'][intval(substr($request->month, 5, 2)) - 1];

        $shippings = Shipping::where('date', '>=', $request->month . '-01')->where('date', '<=', $request->month . '-31')->pluck('id');

        $data = Movement::whereYear('created_at', $year)
            ->where('movable_type', 'App\Shipping')
            ->whereIn('movable_id', $shippings)
            ->with('product', 'shipping')
            ->orderBy('product_id')
            ->get()
            ->groupBy('product.name');

        return view('reports.purchases', compact('data', 'year', 'month'));
    }

    function debt(Request $request)
    {
        $type = $request->product;
        $models = ['cerdo' => 'App\PorkSale', 'vivo' => 'App\AliveSale', 'fresco' => 'App\FreshSale', 'procesado' => 'App\ProcessedSale'];
        $model = $models[$type];
        $salesByClient = $model::whereYear('created_at', now())
            ->whereIn('client_id', $request->clientes)
            ->where('status', 'credito')
            ->with('client')
            ->get()
            ->groupBy('client.name');

        // ddd($request->all(), $salesByClients);

        return view('reports.debt', compact('salesByClient', 'type'));
    }

}
