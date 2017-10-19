<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
