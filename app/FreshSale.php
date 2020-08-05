<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class FreshSale extends Model
{
    protected $fillable = [
        'folio', 'client_id', 'date', 'quantity',
        'kg', 'price', 'amount', 'credit', 'days',
        'status', 'deposit', 'observations', 'series'
    ];

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
        // return $this->hasMany(Deposit::class, 'sale_id');
        return $this->morphMany(Deposit::class, 'sale');
    }

    function getDepositTotalAttribute()
    {
        return $this->deposits->where('type', 'fresco')->sum('amount');
    }

    function getNiceAmountAttribute()
    {
        return '$ ' . number_format($this->amount, 2, '.', ',');
    }

    function getTypeAttribute()
    {
        return 'fresco';
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

    function getStatusColorAttribute()
    {
        $colors = ['vencida' => 'danger', 'cancelada' => 'default', 'pagado' => 'success', 'credito' => 'warning'];
        return $colors[$this->status];
    }

    function getTypeColorAttribute()
    {
        return 'warning';
    }

    function scopeSalesReport($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end])
                    ->groupBy('credit')
                    ->selectRaw('SUM(quantity) as totalQ, SUM(kg) as totalK, SUM(amount) as totalA, credit')
                    ->get();
    }

    function scopeProductReport($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end])
                    ->where('status', '!=', 'cancelada')
                    ->groupBy('client_id')
                    ->selectRaw('client_id, SUM(quantity) as totalQ, SUM(kg) as totalK, SUM(amount) as totalA')
                    ->get();
    }
}
