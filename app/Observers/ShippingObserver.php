<?php

namespace App\Observers;

use App\{Shipping, Price};

class ShippingObserver
{
    function created(Shipping $shipping)
    {
        $shipping->movements()->createMany(request('items'));

        if ($shipping->product < 20) {
            $movement = $shipping->movements->first();

            $shipping->update([
                'product' => $movement->product->id,
                'price' => $movement->price,
            ]);
        }
    }

    function updated(Shipping $shipping)
    {
        $items = request('items');
        $i = 0;

        foreach ($shipping->movements as $movement) {
            $movement->update($items[$i]);
            $i += 1;
        }
    }
}
