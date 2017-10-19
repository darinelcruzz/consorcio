<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $guarded = [];

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

    function scopePricesWithNames($query, $id)
    {
        return $query->where('product_id', $id)
                    ->selectRaw('id, CONCAT(name, " - $", price) as nameprice')
                    ->pluck('nameprice', 'id');
    }
}
