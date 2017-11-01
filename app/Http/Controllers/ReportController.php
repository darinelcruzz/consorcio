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
        $products = Product::where('id', '<', '17')->pluck('name', 'id');

        return view('reports.menu', compact('date', 'clients', 'products'));
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

    function product(Request $request)
    {
        if ($request->product_id == 1) {
            $products = PorkSale::whereBetween('date', [$request->startDate, $request->endDate])->get();
            $product = 'Cerdo';
        }
        elseif ($request->product_id == 2) {
            $products = FreshSale::whereBetween('date', [$request->startDate, $request->endDate])->get();
            $product = 'Pollo Fresco';
        }
        elseif ($request->product_id == 3) {
            $products = AliveSale::whereBetween('date', [$request->startDate, $request->endDate])->get();
            $product = 'Pollo Vivo';
        }

        $start =new Date(strtotime($request->startDate));
        $end =new Date(strtotime($request->endDate));
        $range = $start->format('j/M/y'). ' - ' . $end->format('j/M/y');

        return view('reports.product', compact('products', 'product', 'range'));
    }

}
