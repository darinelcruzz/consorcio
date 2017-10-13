<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'address', 'rfc', 'phone',
        'cellphone', 'credit', 'notes', 'products'
    ];

    function porksales()
    {
        return $this->hasMany(PorkSale::class);
    }

    function processedsales()
    {
        return $this->hasMany(ProcessedSale::class);
    }

    function alivesales()
    {
        return $this->hasMany(AliveSale::class);
    }

    function freshsales()
    {
        return $this->hasMany(FreshSale::class);
    }
}
