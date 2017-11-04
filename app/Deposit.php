<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Deposit extends Model
{
    protected $guarded = [];

    function getNiceAmountAttribute()
    {
        return '$ ' . number_format($this->amount, 2, '.', ',');
    }

    function getShortDateAttribute()
    {
        $fdate = new Date(strtotime($this->created_at));
        return $fdate->format('D, j/M/Y');
    }

    function getClientAttribute()
    {
         if ($this->type == 'vivo') {
             return AliveSale::find($this->sale_id)->client;
         }
         if ($this->type == 'cerdo') {
             return PorkSale::find($this->sale_id)->client->name;
         }
         if ($this->type == 'fresco') {
             return FreshSale::find($this->sale_id)->client->name;
         }
         if ($this->type == 'procesado') {
             return ProcessedSale::find($this->sale_id)->client->name;
         }
    }

    function scopeSalesReport($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start . ' 00:00:00', $end. ' 23:59:59'])
            ->sum('amount');
    }
}
