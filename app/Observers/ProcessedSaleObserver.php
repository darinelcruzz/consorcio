<?php

namespace App\Observers;

use App\ProcessedSale;

class ProcessedSaleObserver
{
    function created(ProcessedSale $processedSale)
    {
        $processedSale->movements()->createMany(request('items'));

        foreach ($processedSale->movements as $movement) {
        	$processedSale->update([
        		'quantity' => $movement->quantity,
        		'kg' => $movement->kg,
        		'status' => request('credit') ? 'crédito': 'pagado',
                'credit' => request('credit') == '0' ? 0: 1,
        		'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
        	]);

        	break;
        }
    }

    function deleting(ProcessedSale $processedSale)
    {
        //
    }
}
