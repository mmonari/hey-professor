<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        // let all models be unguarded by default
        Model::unguard();
        // prevent laxy loading in local dev
        Model::preventLazyLoading(!app()->isProduction());
    }
}
