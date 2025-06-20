<?php

namespace App\Providers;

use App\Models\Leave;
use App\Observers\LeaveObserver;
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
        Leave::observe(LeaveObserver::class);
    }
}
