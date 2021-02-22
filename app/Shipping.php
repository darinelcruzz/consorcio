<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Shipping extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    function productr()
    {
        return $this->belongsTo(Product::class, 'product');
    }

    function movements()
    {
        return $this->morphMany(Movement::class, 'movable');
    }

    function getProductsAttribute()
    {
        $items = [];

        foreach ($this->movements as $m) {
            array_push($items, ['id' => $m->product_id, 'name' => $m->product->name, 'price' => $m->price, 'quantity' => $m->quantity, 'boxes' => $m->boxes, 'kg' => $m->kg]);
        }

        return $items;
    }
}
