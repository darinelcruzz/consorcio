<?php

namespace App\Observers;

use App\{ProcessedSale, Price};

class ProcessedSaleObserver
{
    function created(ProcessedSale $processedSale)
    {
        if ($processedSale->status != 'cancelada') {
            $processedSale->movements()->createMany(request('items'));
        }
    }

    function updated(ProcessedSale $processedSale)
    {
        $items = request('items');
        $i = 0;

        if ($items) {
            foreach ($processedSale->movements as $movement) {
                $movement->delete();
            }

            $processedSale->movements()->createMany($items);
        }
    }
}
