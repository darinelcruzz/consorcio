<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $casts = ['price' => 'int'];

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
        if ($this->id > 9 && $this->id != 23) {
            $price = $this->prices->pluck('price')->toArray();
            return array_pop($price);
        }

        return Price::pricesForMany();
    }

    function scopeQuantityWithNames($query)
    {
        return $query->selectRaw('id, CONCAT(name, " - ", quantity) as namequantity')
                    ->pluck('namequantity', 'id');
    }

}
