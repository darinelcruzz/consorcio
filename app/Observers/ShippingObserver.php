<?php

namespace App\Observers;

use App\{Shipping, Price};

class ShippingObserver
{
    function created(Shipping $shipping)
    {
        $shipping->movements()->createMany(request('items'));
        $movement = $shipping->movements->first();

        if ($shipping->product == null) {
            $shipping->update([
                'product' => $movement->product->id,
                'quantity' => $movement->quantity,
                'price' => $movement->price,
            ]);
        }

        if ($shipping->product == 20) {
            $shipping->update(['price' => $movement->price]);
        }
    }

    function updated(Shipping $shipping)
    {
        $items = request('items');

        if ($items) {
            foreach ($shipping->movements as $movement) {
                $movement->delete();
            }

            $shipping->movements()->createMany($items);
        }
    }
}
