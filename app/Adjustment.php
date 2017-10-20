<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Adjustment extends Model
{
    protected $guarded = [];

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getDate($date)
    {
        $fdate = new Date(strtotime($this->$date));
        return $fdate->format('D, j M Y');
    }

}
