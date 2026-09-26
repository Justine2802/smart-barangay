<?php

namespace App\Providers;
use Laravel\Sanctum\Sanctum;
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

    

    public function boot(): void
    {
        Sanctum::ignoreMigrations();
    }


    /**
     * Bootstrap any application services.
     */
   
}
