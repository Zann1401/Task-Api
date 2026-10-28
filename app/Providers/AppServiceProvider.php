<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
<<<<<<< HEAD
        Gate::define('viewApiDocs', function ($user = null) {
            return true;
        });

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }    
=======
        if (config('app.env') === 'production'){
            URL::forceScheme('https');
        }

        Gate::define("viewApiDocs", function($user = null){
            URL::forceScheme('https');
        });
>>>>>>> 676b395fa7202dab0829ec243b286da87e6a46fc
    }
}