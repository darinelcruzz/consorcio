<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\PorkSale;
use Jenssegers\Date\Date;

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

        $view->validDates = [
            Date::now()->format('l\, j F Y') => Date::now()->format('l\, j F Y'),
            Date::now()->sub('1 day')->format('l\, j F Y') => Date::now()->sub('1 day')->format('l\, j F Y'),
            Date::now()->sub('2 days')->format('l\, j F Y') => Date::now()->sub('2 days')->format('l\, j F Y'),
        ];
    }
}
