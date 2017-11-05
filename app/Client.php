<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'address', 'rfc', 'phone',
        'cellphone', 'credit', 'notes', 'products', 'days'
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

    function getAllSales($start, $end)
    {
        $pork = $this->porksales->where('date', '>=', $start)->where('date', '<=', $end);
        $fresh = $this->freshsales->where('date', '>=', $start)->where('date', '<=', $end);
        $alive = $this->alivesales->where('date', '>=', $start)->where('date', '<=', $end);
        $processed = $this->processedsales->where('date', '>=', $start)->where('date', '<=', $end);

        $sales = [];

        foreach ($pork as $sale) {
            array_push($sales, $sale);
        }
        foreach ($alive as $sale) {
            array_push($sales, $sale);
        }
        foreach ($processed as $sale) {
            array_push($sales, $sale);
        }
        foreach ($fresh as $sale) {
            array_push($sales, $sale);
        }

        return $sales;
    }

    function getUnpaidNotesAttribute()
    {
        $notes = $this->alivesales->where('status', '!=', 'pagado')->count() +
            $this->porksales->where('status', '!=', 'pagado')->count() +
            $this->freshsales->where('status', '!=', 'pagado')->count() +
            $this->processedsales->where('status', '!=', 'pagado')->count();

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
