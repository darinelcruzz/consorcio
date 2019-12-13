<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Shipping extends Model
{
    protected $fillable = [
        'remission', 'date', 'provider', 'product', 'processed',
        'quantity', 'price', 'amount', 'observations'
    ];

    function productr()
    {
        return $this->belongsTo(Product::class, 'product');
    }

    function getProviderNameAttribute()
    {
        return ucfirst($this->provider == '1' ? 'buenaventura': $this->provider);
    }

    function getShortDateAttribute()
    {
        $fdate = new Date(strtotime($this->date));
        return $fdate->format('D, j/M/Y');
    }

    function getBadgeColorAttribute()
    {
        $colors = ['20' => 'green', '3' => 'blue', '1' => 'fuchsia', '18' => 'fuchsia', '19' => 'purple'];

        return $colors[$this->product] ?? 'default';
    }

    function getBoxesAttribute()
    {
        $boxes = 0;

        foreach (unserialize($this->processed) as $product) {
            $boxes += $product['q'];
        }

        return $boxes;
    }
}
