<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class ProcessedSale extends Model
{
    protected $guarded = [];

    function client()
    {
        return $this->belongsTo(Client::class);
    }

    function pricer()
    {
        return $this->belongsTo(Price::class, 'price');
    }

    function deposits()
    {
        return $this->hasMany(Deposit::class, 'sale_id');
    }

    function getDepositTotalAttribute()
    {
        return $this->deposits->where('type', 'procesado')->sum('amount');
    }

    function getNiceAmountAttribute()
    {
        return '$ ' . number_format($this->amount, 2, '.', ',');
    }

    function getTypeAttribute()
    {
        return 'procesado';
    }

    function getShortDateAttribute()
    {
        $fdate = new Date(strtotime($this->date));
        return $fdate->format('D, j/M/Y');
    }

    function getDueDateAttribute()
    {
        $fdate = new Date(strtotime($this->date));
        $fdate->add('P' . $this->days . 'D');
        return $fdate->format('D, j/M/Y');
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
