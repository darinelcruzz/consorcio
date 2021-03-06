<?php

namespace App\Observers;

use App\{PorkSale, Price};

class PorkSaleObserver
{
    function created(PorkSale $porkSale)
    {
        if ($porkSale->status != 'cancelada') {
            $porkSale->movements()->createMany(request('items'));
        }
    }

    function updated(PorkSale $porkSale)
    {
        if ($porkSale != 'vencida') {
            // $price = $porkSale->movements()->first()->price;
            if (request('origin') == 'edit') {
                $porkSale->movements()->update([
                    'price' => $porkSale->price == 28 ? request('price'): Price::find($porkSale->price)->price,
                    'quantity' => $porkSale->quantity,
                    'kg' => $porkSale->kg,
                ]);
            }
        }
    }
}
