<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use App\Models\Service;
use App\Models\Review;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

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
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Restablece tu contraseña - HotelPro')
                ->view('emails.reset-password', [
                    'url' => $url,
                    'expire' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
                    'heroImage' => config('mail.hero_image'),
                ]);
        });

        Schema::defaultStringLength(191);

        // Compartir servicios y reseñas solo si las tablas ya existen en la base de datos
        if (Schema::hasTable('services')) {
            View::share('services', Service::take(4)->get());
        }

        if (Schema::hasTable('reviews')) {
            View::share('reviews', Review::where('is_approved', true)->latest()->take(3)->get());
        }

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
