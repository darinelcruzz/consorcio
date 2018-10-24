<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapPublicRoutes();
        $this->mapGuestRoutes();
        $this->mapAuthRoutes();
    }

    protected function mapPublicRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/public.php'));
    }

    protected function mapGuestRoutes()
    {
        Route::middleware(['web', 'guest'])
             ->namespace($this->namespace)
             ->group(base_path('routes/guest.php'));
    }

    protected function mapAuthRoutes()
    {
        Route::middleware(['web', 'auth'])
             ->namespace($this->namespace)
             ->group(base_path('routes/auth.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware(['web', 'auth'])
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
