<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Adjustment, Product, PorkSale, AliveSale, FreshSale, ProcessedSale, Shipping};

class MovementsController extends Controller
{
    function index(Request $request)
    {
        $from = $request->from ? $request->from: date('Y-m-d');
        $to = $request->to ? $request->to: date('Y-m-d');

        $adjustments = Adjustment::whereBetween('date', [$from, $to])->get();
        $pork = PorkSale::whereBetween('date', [$from, $to])->get();
        $fresh = FreshSale::whereBetween('date', [$from, $to])->get();
        $alive = AliveSale::whereBetween('date', [$from, $to])->get();
        $shippings = Shipping::where('product', '!=', '20')->whereBetween('date', [$from, $to])->get();

        $processed = $this->getProcessedSales($from, $to);
        $processed_sh = $this->getProcessedShippings($from, $to);

        return view('products.movements', compact('adjustments', 'shippings', 'pork', 'alive', 'fresh', 'processed', 'processed_sh', 'from', 'to'));
    }

    public function getProcessedSales($from, $to)
    {
        $processed = ProcessedSale::where('status', '!=', 'cancelada')->whereBetween('date', [$from, $to])->get();

        $all_processed_sales = [];
        $names = [
            '4' => 'Grande', '5' => 'Mediano', '6' => 'Chico', '7' => 'Junior', '8' => 'Petit', '9' => 'Mini',
            '10' => 'Pechuga sin hueso', '11' => 'Pechuga con hueso', '12' => 'Pierna y muslo', '13' => 'Alas picosas', '14' => 'Ala (1 y 2)', '15' => 'Molleja',
            '16' => 'Víscera mixta', '17' => 'Pollo adobado', '21' => 'Milanesa de pechuga', '22' => 'Pechuga deshuesada marinada'
        ];

        foreach ($processed as $sale) {
            foreach (unserialize($sale->products) as $product) {
                array_push($all_processed_sales, [
                    'date' => $sale->date,
                    'product' => $names[$product['i']],
                    'folio' => $sale->folio,
                    'quantity' => $product['b']
                ]);
            }
        }

        return $all_processed_sales;
    }

    public function getProcessedShippings($from, $to)
    {
        $processed = Shipping::where('product', '20')->whereBetween('date', [$from, $to])->get();

        $all_processed_sales = [];
        $names = [
            '4' => 'Grande', '5' => 'Mediano', '6' => 'Chico', '7' => 'Junior', '8' => 'Petit', '9' => 'Mini',
            '10' => 'Pechuga sin hueso', '11' => 'Pechuga con hueso', '12' => 'Pierna y muslo', '13' => 'Alas picosas', '14' => 'Ala (1 y 2)', '15' => 'Molleja',
            '16' => 'Víscera mixta', '17' => 'Pollo adobado', '21' => 'Milanesa de pechuga', '22' => 'Pechuga deshuesada marinada'
        ];

        foreach ($processed as $sale) {
            foreach (unserialize($sale->processed) as $product) {
                array_push($all_processed_sales, [
                    'date' => $sale->date,
                    'product' => $names[$product['i']],
                    'folio' => $sale->remission,
                    'quantity' => $product['q']
                ]);
            }
        }

        return $all_processed_sales;
    }
}
