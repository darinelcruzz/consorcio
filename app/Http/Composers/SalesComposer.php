<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Price;
use Jenssegers\Date\Date;

class SalesComposer
{
    public function compose(View $view)
    {
        $type = request()->route()->parameter('type');
        $lastSale = getLastSale($type);

        $view->color = getBoxesColor($type);
        $view->skin = getPageColor($type);
        $view->product_id = getProductID($type);
        $view->prices = Price::pricesWithNames(getProductID($type));
        $view->lastSale = $lastSale;
        $view->folio = $lastSale->folio + 1;
        $view->series = 'C';

        $view->validDates = [
            Date::now()->format('Y-m-d') => Date::now()->format('l\, j F Y'),
            Date::now()->sub('1 day')->format('Y-m-d') => Date::now()->sub('1 day')->format('l\, j F Y'),
            Date::now()->sub('2 days')->format('Y-m-d') => Date::now()->sub('2 days')->format('l\, j F Y'),
            Date::now()->sub('3 days')->format('Y-m-d') => Date::now()->sub('3 days')->format('l\, j F Y'),
            Date::now()->sub('4 days')->format('Y-m-d') => Date::now()->sub('4 days')->format('l\, j F Y')
        ];
    }
}
