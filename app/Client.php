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

    function getIsMissingAttribute()
    {
        $recent = 0;
        foreach (unserialize($this->products) as $product) {
            switch ($product) {
                case 'vivo':
                    if ($this->alivesales->last()) {
                        $recent += datediff($this->alivesales->last()->date) < 4 ? 1: 0;
                    }
                    break;
                case 'fresco':
                    if ($this->freshsales->last()) {
                        $recent += datediff($this->freshsales->last()->date) < 4 ? 1: 0;
                    }
                    break;
                case 'cerdo':
                    if ($this->porksales->last()) {
                        $recent += datediff($this->porksales->last()->date) < 4 ? 1: 0;
                    }
                    break;
                case 'procesado':
                    if ($this->processedsales->last()) {
                        $recent += datediff($this->processedsales->last()->date) < 4 ? 1: 0;
                    }
                    break;
            }
        }

        return $recent == 0;
    }

    function getUnpaidNotesAttribute()
    {
        $notes = 0;
        foreach ($this->alivesales->where('status', '!=', 'pagado') as $sale) {
            if ($sale->status != 'cancelada') $notes += 1;
        }
        foreach ($this->porksales->where('status', '!=', 'pagado') as $sale) {
            if ($sale->status != 'cancelada') $notes += 1;
        }
        foreach ($this->freshsales->where('status', '!=', 'pagado') as $sale) {
            if ($sale->status != 'cancelada') $notes += 1;
        }
        foreach ($this->processedsales->where('status', '!=', 'pagado') as $sale) {
            if ($sale->status != 'cancelada') $notes += 1;
        }

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
        $balance = $this->alivesales->where('credit', 1)->where('status', '!=' ,'pagado')->sum(function ($sale) {
                        return $sale->amount - $sale->deposit_total;
                    }) +
                    $this->porksales->where('credit', 1)->where('status', '!=' ,'pagado')->sum(function ($sale) {
                        return $sale->amount - $sale->deposit_total;
                    }) +
                    $this->freshsales->where('credit', 1)->where('status', '!=' ,'pagado')->sum(function ($sale) {
                        return $sale->amount - $sale->deposit_total;
                    }) +
                    $this->processedsales->where('credit', 1)->where('status', '!=' ,'pagado')->sum(function ($sale) {
                        return $sale->amount - $sale->deposit_total;
                    });

        return $balance;
    }

    function scopeBuyers($query, $product)
    {
        return $query->orderBy('name', 'asc')->get()
            ->filter(function ($item) use ($product) {
                return strpos($item->products, $product);
            })->pluck('name', 'id')->toArray();
    }
}
