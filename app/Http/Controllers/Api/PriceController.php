<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Product, Price};

class PriceController extends Controller
{
    function index($type)
    {
        $items = [];

        if ($type != 23) {
            $price =  Price::find($type);
            $products = Product::where('price', 1)->get();
            foreach ($products as $product) {
                array_push($items, ['id' => $product->id, 'name' => $product->name, 'price' => $price->price]);
            }
        } else {
            $products =  Product::where('processed', 1)->where('price', '!=', 1)->get();
            foreach ($products as $product) {
                array_push($items, ['id' => $product->id, 'name' => $product->name, 'price' => $product->prices->first()->price]);
            }
        }

        return $items;
    }
}
