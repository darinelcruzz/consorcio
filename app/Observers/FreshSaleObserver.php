<?php

namespace App\Observers;

use App\FreshSale;

class FreshSaleObserver
{
    function created(FreshSale $freshSale)
    {
        $freshSale->movements()->createMany(request('items'));

        foreach ($freshSale->movements as $movement) {
        	$freshSale->update([
        		'quantity' => $movement->quantity,
        		'kg' => $movement->kg,
        		'price' => $movement->price,
        		'credit' => request('credit') == '0' ? 0: 1,
        		'status' => request('credit') ? 'crédito': 'pagado',
        		'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
        	]);
        }
    }

    function deleting(FreshSale $freshSale)
    {
        //
    }
}
