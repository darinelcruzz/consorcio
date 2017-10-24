<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class PorkSale extends Model
{
    protected $fillable = [
        'folio', 'client_id', 'date', 'quantity',
        'kg', 'price', 'amount', 'credit', 'days',
        'status', 'deposit'
    ];

    function client()
    {
        return $this->belongsTo(Client::class);
    }

    function pricer()
    {
        return $this->belongsTo(Price::class, 'price');
    }

    function getNiceAmountAttribute()
    {
        return '$ ' . number_format($this->amount, 2, '.', ',');
    }

    function getTypeAttribute()
    {
        return 'cerdo';
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
}
