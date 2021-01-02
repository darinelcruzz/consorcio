<?php

namespace App\Observers;

use App\{PorkSale, Price};

class PorkSaleObserver
{
    function created(PorkSale $porkSale)
    {
        if ($porkSale->status != 'cancelada') {
            $porkSale->movements()->createMany(request('items'));

        	$porkSale->update([
        		'status' => request('credit') ? 'credito': 'pagado',
                'credit' => request('credit') == '0' ? 0: 1,
        		'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
        	]);
        }
    }

    function updated(PorkSale $porkSale)
    {
        if ($porkSale != 'vencida') {
            $porkSale->movements()->update([
                'price' => Price::find($porkSale->price)->price,
                'quantity' => $porkSale->quantity,
                'kg' => $porkSale->kg,
            ]);
        }
    }
}
