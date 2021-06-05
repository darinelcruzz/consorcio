<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

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

    function getNicePriceAttribute()
    {
        return '$ ' . number_format($this->price, 2, '.', ',');
    }

    public function getDate($date)
    {
        $fdate = date('d/m/Y', trtotime($this->$date));
        return $fdate;
    }

    function scopePricesWithNames($query, $id)
    {
        return $query->where('product_id', $id)
                    ->when($id < 4, function ($query) {
                        $query->orWhere('name', 'Extraordinario');
                    })
                    ->selectRaw('id, CONCAT(name, " (", price, ")") as nameprice')
                    ->pluck('nameprice', 'id');
    }

    function scopePricesForMany($query)
    {
        return $query->where('product_id', 4)
                ->pluck('price', 'id');
    }
}
