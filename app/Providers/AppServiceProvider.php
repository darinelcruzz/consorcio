<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Http\Composers\SalesComposer;
use App\{ProcessedSale, FreshSale, AliveSale, PorkSale, Shipping, Movement};
use App\Observers\{ProcessedSaleObserver, FreshSaleObserver, AliveSaleObserver, PorkSaleObserver, ShippingObserver, MovementObserver};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->registerViewComposers();
        $this->registerObservers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    protected function registerViewComposers()
   {
       View::composer('sales.*', SalesComposer::class);
   }

    function registerObservers()
    {
        ProcessedSale::observe(ProcessedSaleObserver::class);
        AliveSale::observe(AliveSaleObserver::class);
        FreshSale::observe(FreshSaleObserver::class);
        PorkSale::observe(PorkSaleObserver::class);
        Shipping::observe(ShippingObserver::class);
        Movement::observe(MovementObserver::class);
    }
}
