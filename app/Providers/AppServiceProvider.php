<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    }
    protected $listen = [
    \Illuminate\Auth\Events\Login::class => [
        \App\Listeners\LogAuthActivity::class,
    ],
    \Illuminate\Auth\Events\Logout::class => [
        \App\Listeners\LogLogoutActivity::class,
    ],
];
}


