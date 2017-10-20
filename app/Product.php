<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [
    ];

    function getNicePriceAttribute()
    {
        return '$ ' . number_format($this->price, 2, '.', ',');
    }

    function prices()
    {
        return $this->hasMany(Price::class);
    }

    function adjustment()
    {
        return $this->hasMany(Ajustment::class);
    }

    function getPriceAloneAttribute()
    {
        if ($this->id > 8) {
            $price = $this->prices->pluck('price')->toArray();
            return $price[0];
        }

        return Price::pricesForMany();
    }

    function scopeQuantityWithNames($query)
    {
        return $query->selectRaw('id, CONCAT(name, " - ", quantity) as namequantity')
                    ->pluck('namequantity', 'id');
    }

}
