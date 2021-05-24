<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;
use DateTimeInterface;

class Deposit extends Model
{
    protected $guarded = [];

    function sale()
    {
        return $this->morphTo();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
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
        return $this->sale->client;
    }

    function scopeSalesReport($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start . ' 00:00:00', $end. ' 23:59:59'])
            ->sum('amount');
    }
}
