<?php

namespace App\Observers;

use App\{AliveSale, Price};

class AliveSaleObserver
{
    function created(AliveSale $aliveSale)
    {
        if ($aliveSale->status != 'cancelada') {
            $aliveSale->movements()->createMany(request('items'));
        }
    }

    function updated(AliveSale $aliveSale)
    {
        if ($aliveSale != 'vencida') {
            $aliveSale->movements()->update([
                'price' => Price::find($aliveSale->price)->price,
                'quantity' => $aliveSale->quantity,
                'kg' => $aliveSale->kg,
            ]);
        }
    }
}
