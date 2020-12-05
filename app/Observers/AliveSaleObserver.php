<?php

namespace App\Observers;

use App\{AliveSale, Price};

class AliveSaleObserver
{
    function created(AliveSale $aliveSale)
    {
        $aliveSale->movements()->createMany(request('items'));

        $aliveSale->update([
    		'status' => request('credit') ? 'credito': 'pagado',
            'credit' => request('credit') == '0' ? 0: 1,
    		'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
    	]);
    }

    function deleting(AliveSale $aliveSale)
    {
        //
    }
}
