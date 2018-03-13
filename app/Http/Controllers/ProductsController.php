<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Product, AliveSale, PorkSale, ProcessedSale, Shipping};

class ProductsController extends Controller
{
    function index()
    {
        #$processed = Product::where('processed', 1)->get();
        $alive = AliveSale::inStock();
        $pork = PorkSale::inStock();
        $processed = $this->stockValues();
        $food = Product::where('processed', 2)->get();
        return view('products.products', compact('processed', 'pork', 'alive', 'food'));
    }

    function store(Request $request)
    {
        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'processed' => empty($request->processed) ? 0: 1,
        ]);

        return back();
    }

    function getSumsFromShippings()
    {
        $types = [
            '4' => 'big', '5' => 'medium', '6' => 'small', '7' => 'junior', '8' => 'petit', '9' => 'mini',
            '10' => 'boneless', '11' => 'bone', '12' => 'foot', '13' => 'wings', '14' => 'wing',
            '15' => 'gizzard', '16' => 'visors', '17' => 'pickled'
        ];

        $big = $medium = $small = $junior = $petit = $mini = $boneless = $bone = $foot = $wings = $wing = $gizzard = $visors = $pickled = [];

        $shippings = Shipping::where('product', 20)->get();

        foreach ($shippings as $shipping) {
            foreach (unserialize($shipping->processed) as $product) {
                array_push(${$types[$product['i']]}, $product['q']);
            }
        }

        return [
            'Grande' => collect($big)->sum(),
            'Mediano' => collect($medium)->sum(),
            'Chico' => collect($small)->sum(),
            'Junior' => collect($junior)->sum(),
            'Petit' => collect($petit)->sum(),
            'Mini' => collect($mini)->sum(),
            'Pechuga sin hueso' => collect($boneless)->sum(),
            'Pechuga con hueso' => collect($bone)->sum(),
            'Pierna y Muslo' => collect($foot)->sum(),
            'Alas picosas' => collect($wings)->sum(),
            'Ala 1 y 2' => collect($wing)->sum(),
            'Molleja' => collect($gizzard)->sum(),
            'Viscera mixta' => collect($visors)->sum(),
            'Pollo Adobado' => collect($pickled)->sum()
        ];
    }

    function getSumsFromSales()
    {
        $types = [
            '4' => 'big', '5' => 'medium', '6' => 'small', '7' => 'junior', '8' => 'petit', '9' => 'mini',
            '10' => 'boneless', '11' => 'bone', '12' => 'foot', '13' => 'wings', '14' => 'wing',
            '15' => 'gizzard', '16' => 'visors', '17' => 'pickled'
        ];

        $big = $medium = $small = $junior = $petit = $mini = $boneless = $bone = $foot = $wings = $wing = $gizzard = $visors = $pickled = [];

        $sales = ProcessedSale::where('status', '!=', 'cancelada')->get();

        foreach ($sales as $sale) {
            foreach (unserialize($sale->products) as $product) {
                array_push(${$types[$product['i']]}, $product['q']);
            }
        }

        return [
            'Grande' => collect($big)->sum(),
            'Mediano' => collect($medium)->sum(),
            'Chico' => collect($small)->sum(),
            'Junior' => collect($junior)->sum(),
            'Petit' => collect($petit)->sum(),
            'Mini' => collect($mini)->sum(),
            'Pechuga sin hueso' => collect($boneless)->sum(),
            'Pechuga con hueso' => collect($bone)->sum(),
            'Pierna y Muslo' => collect($foot)->sum(),
            'Alas picosas' => collect($wings)->sum(),
            'Ala 1 y 2' => collect($wing)->sum(),
            'Molleja' => collect($gizzard)->sum(),
            'Viscera mixta' => collect($visors)->sum(),
            'Pollo Adobado' => collect($pickled)->sum()
        ];
    }

    function stockValues()
    {
        $shippings = $this->getSumsFromShippings();
        $sales = $this->getSumsFromSales();

        $stock = [];

        foreach ($shippings as $key => $value) {
            $stock[$key] = $value - $sales[$key];
        }

        return $stock;
    }
}
