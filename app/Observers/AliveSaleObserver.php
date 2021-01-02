<?php

namespace App\Observers;

use App\{AliveSale, Price};

class AliveSaleObserver
{
    function created(AliveSale $aliveSale)
    {
        if ($aliveSale->status != 'cancelada') {
            $aliveSale->movements()->createMany(request('items'));

            $aliveSale->update([
                'status' => request('credit') ? 'credito': 'pagado',
                'credit' => request('credit') == '0' ? 0: 1,
                'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
            ]);
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
