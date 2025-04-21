<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
            $authUser = Auth::user();
            $unreadMessages = 0;

            if ($authUser) {
                $unreadMessages = \App\Models\Message::where('user_id', '!=', $authUser->id)
                    ->where('is_read', false)
                    ->count();
            }

            $view->with([
                'authUser' => $authUser,
                'unreadMessagesCount' => $unreadMessages,
            ]);
        });
    }
}
