<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

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
        Http::macro('refersion', function () {
            return Http::withHeaders([
                'Refersion-Public-Key' => env('REFERSION_PUBLIC_KEY'),
                'Refersion-Secret-Key' => env('REFERSION_SECRET_KEY'),
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
            ])->baseUrl('https://api.refersion.com/v2');
        });
    
    }
}
