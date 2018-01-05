<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePAFSale;
use App\FreshSale;
use App\Client;
use App\Product;
use App\Price;

class FreshSalesController extends Controller
{
    function index()
    {
        $sales = FreshSale::all();
        $type = 'fresh';
        $color = 'warning';
        return view('sales.index', compact('sales', 'type', 'color'));
    }

    function create()
    {
        $clients = $this->getClients();
        $prices = Price::pricesWithNames(2);
        $type = 'fresh';
        $color = 'warning';
        $lastSale = FreshSale::all()->last();
        $lastFolio = $this->getFolio();
        return view('sales.create', compact('clients', 'type', 'color', 'lastSale', 'lastFolio', 'prices'));
    }

    function store(StorePAFSale $request)
    {
        $sale = FreshSale::create($request->all());

        $this->updateInventory($request->quantity);

        $days = $request->credit * 8;

        $sale->update([
            'status' => $request->credit == '0' ? 'pagado': 'credito',
            'credit' => $request->credit == '0' ? 0: 1,
            'days' => $days > 16 ? 15: $days
        ]);

        return redirect('ventas/fresco');
    }

    function getClients()
    {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'fresco');
        })->pluck('name', 'id')->toArray();
    }

    function updateInventory($quantity)
    {
        $former = Product::where('name', 'pollo fresco')->first();

        $current = $former->quantity - $quantity;

        $former->update(['quantity' => $current]);
    }

    public function getFolio()
    {
        $lastQ = FreshSale::all()->last();
        if ($lastQ) {
            $lastY = fdate($lastQ->created_at, 'Y');
            if(date('Y') != $lastY) {
                return 0;
            }
            return $lastQ->folio;
        }

        return 0;
    }

    function discard($folio)
    {
        FreshSale::create([
            'folio' => $folio,
            'client_id' => 0,
            'status' => 'cancelada',
        ]);

        return redirect('ventas/fresco');
    }
}
