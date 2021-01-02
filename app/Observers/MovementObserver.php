<?php

namespace App\Observers;

use App\{Movement, Product};

class MovementObserver
{
    function created(Movement $movement)
    {
        $current = $movement->product->quantity;
        $new = $movement->quantity;
        $movement->product->update([
            'quantity' => $current + ($movement->movable_type == 'App\Shipping' ? $new: -$new)
        ]);
    }

    function updating(Movement $movement)
    {
        $current = $movement->product->quantity;
        $reset = $movement->getOriginal('quantity');
        $movement->product->update([
            'quantity' => $current + ($movement->movable_type == 'App\Shipping' ? -$reset: $reset)
        ]);
    }

    function updated(Movement $movement)
    {
        $current = $movement->product->quantity;
        $new = $movement->quantity;
        $movement->product->update([
            'quantity' => $current + ($movement->movable_type == 'App\Shipping' ? $new: -$new)
        ]);
    }

    function deleting(Movement $movement)
    {
        $id = $movement->getOriginal('product_id');
        $quantity = $movement->getOriginal('quantity');
        $model = $movement->getOriginal('movable_type');
        $product = Product::find($id);
        $product->update([
            'quantity' => $product->quantity + ($model == 'App\Shipping' ? -$quantity: $quantity)
        ]);
    }
}
