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

    function alive_sale()
    {
    	return $this->belongsTo(AliveSale::class, 'movable_id');
    }

    function fresh_sale()
    {
        return $this->belongsTo(FreshSale::class, 'movable_id');
    }

    function processed_sale()
    {
        return $this->belongsTo(ProcessedSale::class, 'movable_id');
    }

    function pork_sale()
    {
        return $this->belongsTo(PorkSale::class, 'movable_id');
    }
}
