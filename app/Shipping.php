<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'remission', 'date', 'provider', 'product',
        'quantity', 'price', 'amount', 'observations'
    ];
}
