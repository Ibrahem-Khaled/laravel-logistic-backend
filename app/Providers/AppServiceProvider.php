<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
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
        // Fix for MySQL "Specified key was too long" with utf8mb4 (max index length 767/1000 bytes)
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
    }
}
