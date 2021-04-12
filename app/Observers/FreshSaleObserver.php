<?php

namespace App\Observers;

use App\{FreshSale, Price};

class FreshSaleObserver
{
    function created(FreshSale $freshSale)
    {
        if ($freshSale->status != 'cancelada') {
            $freshSale->movements()->createMany(request('items'));
        }
    }

    function updated(FreshSale $freshSale)
    {
        if ($freshSale != 'vencida') {
            $freshSale->movements()->update([
                'price' => Price::find($freshSale->price)->price,
                'quantity' => $freshSale->quantity,
                'kg' => $freshSale->kg,
            ]);            
        }
    }
}
