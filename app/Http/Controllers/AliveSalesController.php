<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePAFSale;
use App\AliveSale;
use App\Client;
use App\Product;
use App\Price;

class AliveSalesController extends Controller
{
    function index()
    {
        $sales = AliveSale::all();
        $type = 'alive';
        $color = 'primary';
        $skin = 'blue';
        return view('sales.index', compact('sales', 'type', 'color', 'skin'));
    }

    function create()
    {
        $clients = $this->getClients();
        $prices = Price::pricesWithNames(3);
        $type = 'alive';
        $color = 'primary';
        $skin = 'blue';
        $lastSale = AliveSale::all()->last();
        $lastFolio = $this->getFolio();
        return view('sales.create', compact('clients', 'type', 'color', 'lastSale', 'lastFolio', 'skin', 'prices'));
    }

    function store(StorePAFSale $request)
    {
        $sale = AliveSale::create($request->all());

        $this->updateInventory($request->quantity);

        $days = $request->credit * 8;

        $sale->update([
            'status' => $request->credit == '0' ? 'pagado': 'credito',
            'credit' => $request->credit == '0' ? 0: 1,
            'days' => $days > 16 ? 15: $days
        ]);

        return redirect('ventas/vivo');
    }

    function getClients() {
        return Client::all()->filter(function ($item) {
            return strpos($item->products, 'vivo');
        })->pluck('name', 'id')->toArray();
    }

    function updateInventory($quantity)
    {
        $former = Product::where('name', 'pollo vivo')->first();

        $current = $former->quantity - $quantity;

        $former->update(['quantity' => $current]);
    }

    public function getFolio()
    {
        $lastQ = AliveSale::all()->last();
        if ($lastQ) {
            $lastY = fdate($lastQ->created_at, 'Y');
            if(date('Y') != $lastY) {
                return 0;
            }
            return $lastQ->folio;
        }

        return 0;
    }
}
