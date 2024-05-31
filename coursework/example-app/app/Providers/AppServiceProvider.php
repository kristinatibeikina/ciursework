<?php

namespace App\Providers;

use App\Models\Booked_tours;
use App\Models\Feedback;
use App\Models\Guide;
use App\Models\Housing;
use App\Models\Region;
use App\Models\User;
use App\Observers\BookedTourObserver;
use App\Observers\FeedbackObserver;
use App\Observers\GuideObserver;
use App\Observers\HousingObserver;
use App\Observers\RegionObserver;
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
        Guide::observe(GuideObserver::class);
        Feedback::observe(FeedbackObserver::class);
        Housing::observe(HousingObserver::class);
        Region::observe(RegionObserver::class);
    }
}
