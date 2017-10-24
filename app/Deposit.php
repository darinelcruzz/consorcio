<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $guarded = [];

    function getNicePriceAttribute()
    {
        return '$ ' . number_format($this->price, 2, '.', ',');
    }


}
