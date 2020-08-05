<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Deposit extends Model
{
    protected $guarded = [];

    // function sale()
    // {
    //     if ($this->type == 'vivo') {
    //          return $this->belongsTo(AliveSale::class, 'sale_id');
    //      }
    //      if ($this->type == 'cerdo') {
    //          return $this->belongsTo(PorkSale::class, 'sale_id');
    //      }
    //      if ($this->type == 'fresco') {
    //          return $this->belongsTo(FreshSale::class, 'sale_id');
    //      }
    //      if ($this->type == 'procesado') {
    //          return $this->belongsTo(ProcessedSale::class, 'sale_id');
    //      }
    // }

    function sale()
    {
        return $this->morphTo();
    }

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
         // if ($this->type == 'vivo') {
         //     return AliveSale::find($this->sale_id)->client;
         // }
         // if ($this->type == 'cerdo') {
         //     return PorkSale::find($this->sale_id)->client;
         // }
         // if ($this->type == 'fresco') {
         //     return FreshSale::find($this->sale_id)->client;
         // }
         // if ($this->type == 'procesado') {
         //     return ProcessedSale::find($this->sale_id)->client;
         // }
        return $this->sale->client;
    }

    function scopeSalesReport($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start . ' 00:00:00', $end. ' 23:59:59'])
            ->sum('amount');
    }
}
