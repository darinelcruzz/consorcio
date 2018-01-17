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

    function getLittleDateAttribute()
    {
        $fdate = new Date(strtotime($this->date));
        return $fdate->format('j/M/Y');
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

        for ($i = 0; $i < count($request->quantities); $i++) {
            $product = [];
            if($request->quantities[$i] > 0) {
                $product['i'] =  $request->types[$i];
                $product['p'] =  $request->prices[$i];
                $product['q'] =  $request->quantities[$i];
                $product['b'] =  $request->packages[$i];
                array_push($products, $product);

                $pproduct = Product::find($request->types[$i]);
                $pproduct->update([
                    'quantity' => $pproduct->quantity - $request->packages[$i]
                ]);
            }
        }

        $this->products = serialize($products);
        $this->save();
    }

    function scopeSalesReport($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end])
                    ->groupBy('credit')
                    ->selectRaw('SUM(quantity) as totalQ, SUM(kg) as totalK, SUM(amount) as totalA, credit')
                    ->get();
    }

    function scopeRangeReport($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end])
                    ->where('price', '!=', 23)
                    ->get();
    }
}
