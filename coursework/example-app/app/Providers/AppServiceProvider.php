<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Tour;
use App\Observers\TourObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Tour::observe(TourObserver::class);
    }
}
