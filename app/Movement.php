<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
	protected $guarded = [];

	function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    function movable()
    {
        return $this->morphTo();
    }
}
