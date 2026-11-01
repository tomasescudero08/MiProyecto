<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Service;
use App\Models\Review;

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
        Schema::defaultStringLength(191);

        // Compartir servicios y reseñas solo si las tablas ya existen en la base de datos
        if (Schema::hasTable('services')) {
            View::share('services', Service::take(4)->get());
        }

        if (Schema::hasTable('reviews')) {
            View::share('reviews', Review::where('is_approved', true)->latest()->take(3)->get());
        }
    }
}
