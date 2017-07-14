<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\PorkSale;

class PorkComposer
{
    public function compose(View $view)
    {
        $view->types = [
            'pork' => 'Cerdo',
            'alive' => 'Vivo',
            'fresh' => 'Fresco',
            'processed' => 'Procesado'
        ];
    }
}
