<?php

namespace App\Observers;

use App\AliveSale;

class AliveSaleObserver
{
    function created(AliveSale $aliveSale)
    {
        $aliveSale->movements()->createMany(request('items'));

        foreach ($aliveSale->movements as $movement) {
        	$aliveSale->update([
        		'quantity' => $movement->quantity,
        		'kg' => $movement->kg,
        		'price' => $movement->price,
        		'status' => request('credit') ? 'crédito': 'pagado',
                'credit' => request('credit') == '0' ? 0: 1,
        		'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
        	]);
        }
    }

    function deleting(AliveSale $aliveSale)
    {
        //
    }
}
