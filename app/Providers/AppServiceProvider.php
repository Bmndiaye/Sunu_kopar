<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; 

use Illuminate\Support\Facades\Auth; // Ajoutez cette ligne
use Illuminate\Support\Facades\View; // Ajoutez cette ligne
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::defaultStringLength(191);

        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {
            
            $view->with('authUser', Auth::user());
        });

    }
}






