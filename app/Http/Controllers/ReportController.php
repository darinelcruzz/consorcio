<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Deposit;
use App\Client;
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
        $client = Client::find($request->client_id);
        $sales = $client->getAllSales($request->startDate, $request->endDate);

        return view('reports.client', compact('sales', 'client'));
    }

}
