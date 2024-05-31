<?php

namespace App\Observers;

use App\Models\Region;
use App\Models\Tour;

class RegionObserver
{
    /**
     * Handle the Region "created" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function created(Region $region)
    {
        //
    }

    /**
     * Handle the Region "updated" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function updated(Region $region)
    {
        //
    }

    /**
     * Handle the Region "deleted" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function deleting(Region $region)
    {
        $tour=Tour::where('id_region', $region->id )->exists();
        if($tour){
            throw new \Exception("Нельзя удалить регион, в котором имеются туры.");
        }
    }

    /**
     * Handle the Region "restored" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function restored(Region $region)
    {
        //
    }

    /**
     * Handle the Region "force deleted" event.
     *
     * @param  \App\Models\Region  $region
     * @return void
     */
    public function forceDeleted(Region $region)
    {
        //
    }
}
