<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;
use URL;

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
        Pulse::user(fn($user) => [
            'name' => "$user->nomclient $user->prenomclient",
            'extra' => $user->emailclient,
        ]);

        $host = config('app.url');

        URL::forceRootUrl($host);

        if (str_starts_with($host, 'https://')) {
            URL::forceScheme('https');
        }
    }
}
root:
