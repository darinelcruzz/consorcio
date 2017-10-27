<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'remission', 'date', 'provider', 'product', 'processed',
        'quantity', 'price', 'amount', 'observations'
    ];

    function productr()
    {
        return $this->belongsTo(Product::class, 'product');
    }
}
