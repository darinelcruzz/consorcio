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
            if (request('origin') == 'edit') {
                $freshSale->movements()->update([
                    'price' => $freshSale->price == 28 ? request('price'): Price::find($freshSale->price)->price,
                    'quantity' => $freshSale->quantity,
                    'kg' => $freshSale->kg,
                ]);
            }         
        }
    }
}
