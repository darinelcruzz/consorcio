<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'address', 'rfc', 'phone',
        'cellphone', 'credit', 'notes', 'products'
    ];

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

    function getUnpaidNotesAttribute()
    {
        $notes = $this->alivesales->where('credit', 1)->count() +
            $this->porksales->where('credit', 1)->count() +
            $this->freshsales->where('credit', 1)->count() +
            $this->processedsales->where('credit', 1)->count();

        return $notes;
    }

    function getBalanceAttribute()
    {
        $balance = $this->alivesales->where('credit', 1)->where('status', 'credito')->sum('amount') +
            $this->porksales->where('credit', 1)->where('status', 'credito')->sum('amount') +
            $this->freshsales->where('credit', 1)->where('status', 'credito')->sum('amount') +
            $this->processedsales->where('credit', 1)->where('status', 'credito')->sum('amount');

        return $balance;
    }

    function getRealBalanceAttribute()
    {
        $balance = $this->alivesales->where('credit', 1)->where('status', 'credito')->sum(function ($sale) {
                        return $sale->amount - $sale->deposit_total;
                    }) +
                    $this->porksales->where('credit', 1)->where('status', 'credito')->sum(function ($sale) {
                        return $sale->amount - $sale->deposit_total;
                    }) +
                    $this->freshsales->where('credit', 1)->where('status', 'credito')->sum(function ($sale) {
                        return $sale->amount - $sale->deposit_total;
                    }) +
                    $this->processedsales->where('credit', 1)->where('status', 'credito')->sum(function ($sale) {
                        return $sale->amount - $sale->deposit_total;
                    });

        return $balance;
    }
}
