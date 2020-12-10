<?php

namespace App\Observers;

use App\Movement;

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
}
