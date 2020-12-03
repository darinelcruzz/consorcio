<?php

namespace App\Observers;

use App\PorkSale;

class PorkSaleObserver
{
    function created(PorkSale $porkSale)
    {
        $porkSale->movements()->createMany(request('items'));

        foreach ($porkSale->movements as $movement) {
        	$porkSale->update([
        		'quantity' => $movement->quantity,
        		'kg' => $movement->kg,
        		'price' => $movement->price,
        		'status' => request('credit') ? 'crédito': 'pagado',
                'credit' => request('credit') == '0' ? 0: 1,
        		'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
        	]);
        }
    }

    function deleting(PorkSale $porkSale)
    {
        //
    }
}
