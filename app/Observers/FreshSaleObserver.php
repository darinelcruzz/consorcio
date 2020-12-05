<?php

namespace App\Observers;

use App\FreshSale;

class FreshSaleObserver
{
    function created(FreshSale $freshSale)
    {
        $freshSale->movements()->createMany(request('items'));
        
    	$freshSale->update([
    		'status' => request('credit') ? 'credito': 'pagado',
    		'credit' => request('credit') == '0' ? 0: 1,
    		'days' => request('credit') * 8 >= 16 ? 15: request('credit') * 8,
    	]);
    }

    function deleting(FreshSale $freshSale)
    {
        //
    }
}
