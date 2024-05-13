<?php

namespace App\Providers;

use App\Models\Booked_tours;
use App\Observers\BookedTourObserver;
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
        Booked_tours::observe(BookedTourObserver::class);
    }
}
