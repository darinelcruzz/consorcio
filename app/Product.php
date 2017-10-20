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

    function scopeQuantityWithNames($query)
    {
        return $query->selectRaw('id, CONCAT(name, " - ", quantity) as namequantity')
                    ->pluck('namequantity', 'id');
    }

}
