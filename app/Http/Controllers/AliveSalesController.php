<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePAFSale;
use App\{AliveSale, Client, Product, Price};

class AliveSalesController extends Controller
{
    private $data;
    private $moreData;

    function __construct()
    {
        $this->data = ['type' => 'alive', 'color' => 'primary', 'skin' => 'blue'];
        $this->moreData = array_merge($this->data, [
            'clients' => Client::buyers('vivo'),
            'prices' => Price::pricesWithNames(3)
        ]);
    }

    function index()
    {
        $sales = AliveSale::orderBy('id', 'desc')->paginate(10);
        return view('sales.index', compact('sales'))->with($this->data);
    }

    function search(Request $request)
    {
        $sales = AliveSale::where('folio', 'LIKE', '%' . $request->folio . '%' )
                    ->get();
        return view('sales.results', compact('sales'))->with($this->data);
    }

    function create()
    {
        $lastSale = AliveSale::all()->last();
        $lastFolio = $this->getFolio();
        return view('sales.create', $this->moreData)
            ->with(compact('lastSale', 'lastFolio'));
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

        return redirect(route('alive.index'));
    }

    function edit(AliveSale $aliveSale)
    {
        return view('sales.edit', $this->moreData)->with('sale', $aliveSale);
    }

    function update(Request $request)
    {
        $sale = AliveSale::find($request->id);
        $this->modifyInventory($sale->quantity, $request->quantity);
        $sale->update($request->all());

        return redirect(route('alive.index'));
    }

    function updateInventory($quantity)
    {
        $former = Product::where('name', 'pollo vivo')->first();
        $current = $former->quantity - $quantity;
        $former->update(['quantity' => $current]);
    }

    function modifyInventory($oldQuantity, $newQuantity)
    {
        $product = Product::where('name', 'pollo vivo')->first();
        $quantity = $product->quantity + $oldQuantity - $newQuantity;

        $product->update(['quantity' => $quantity]);
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

    function discard(Request $request)
    {
        AliveSale::create([
            'folio' => $request->folio,
            'date' => $request->selected_date,
            'client_id' => 0,
            'status' => 'cancelada',
        ]);

        return redirect(route('alive.index'));
    }
}
