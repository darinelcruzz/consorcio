<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessedSale extends Model
{
    protected $guarded = [];

    function client()
    {
        return $this->belongsTo(Client::class);
    }

    function storeProducts($request)
    {
        $products = [];

        for ($i = 0; $i < count($request->numbers); $i++) {
            $product = [];
            if($request->numbers[$i] > 0) {
                $product['p'] =  $request->types[$i];
                $product['q'] =  $request->numbers[$i];
                $product['t'] =  $request->total[$i];
                array_push($products, $product);
            }
        }

        $this->products = serialize($products);
        $this->save();
    }
}
