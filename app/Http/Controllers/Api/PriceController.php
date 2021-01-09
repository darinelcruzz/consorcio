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

        if ($type == 1) {
            $products = Product::whereIn('id', [1, 3, 18, 19])->get();
            foreach ($products as $product) {
                if ($price = Price::where('product_id', $product->id)->first()) {
                    array_push($items, ['id' => $product->id, 'name' => $product->name, 'price' => $price->price, 'enable' => true]);
                } else {
                    array_push($items, ['id' => $product->id, 'name' => $product->name, 'price' => $product->price, 'enable' => true]);
                }                
            }
        } else if ($type == 23) {
            $products =  Product::where('processed', 1)->where('price', '!=', 4)->get();
            foreach ($products as $product) {
                array_push($items, ['id' => $product->id, 'name' => $product->name, 'price' => $product->prices->first()->price, 'enable' => true]);
            }
        } else if ($type == 20) {
            $price =  Price::find(10);
            $products = Product::where('price', 4)->get();
            foreach ($products as $product) {
                array_push($items, ['id' => $product->id, 'name' => $product->name, 'price' => $price->price, 'enable' => true]);
            }
        } else {
            $price =  Price::find($type);
            $products = Product::where('price', 4)->get();
            foreach ($products as $product) {
                array_push($items, ['id' => $product->id, 'name' => $product->name, 'price' => $price->price, 'enable' => true]);
            }            
        }

        return $items;
    }
}
