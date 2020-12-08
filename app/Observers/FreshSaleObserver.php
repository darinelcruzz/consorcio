<?php

namespace App\Observers;

use App\{FreshSale, Price};

class FreshSaleObserver
{
    function created(FreshSale $freshSale)
    {
        if ($freshSale->status != 'cancelada') {
            $freshSale->movements()->createMany(request('items'));
            
        	$freshSale->update([
        		'status' => request('credit') ? 'credito': 'pagado',
        		'credit' => request('credit') == '0' ? 0: 1,
        		'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
        	]);
        }
    }

    function updated(FreshSale $freshSale)
    {
        $freshSale->movements()->update([
            'price' => Price::find($freshSale->price)->price,
            'quantity' => $freshSale->quantity,
            'kg' => $freshSale->kg,
        ]);
    }
}
