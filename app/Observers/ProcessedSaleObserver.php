<?php

namespace App\Observers;

use App\{ProcessedSale, Price};

class ProcessedSaleObserver
{
    function created(ProcessedSale $processedSale)
    {
        if ($processedSale->status != 'cancelada') {
            $processedSale->movements()->createMany(request('items'));

            $processedSale->update([
                'status' => request('credit') ? 'crédito': 'pagado',
                'credit' => request('credit') == '0' ? 0: 1,
                'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8
            ]);
        }
    }

    function updated(ProcessedSale $processedSale)
    {
        $items = request('items');
        $i = 0;

        if ($items) {
            foreach ($processedSale->movements as $movement) {
                $movement->update($items[$i]);
                $i += 1;
            }
        }
    }
}
