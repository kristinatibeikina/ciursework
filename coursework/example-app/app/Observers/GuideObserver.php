<?php

namespace App\Observers;

use App\Models\Guide;
use App\Models\Tour;

class GuideObserver
{
    /**
     * Handle the Guide "created" event.
     *
     * @param  \App\Models\Guide  $guide
     * @return void
     */
    public function created(Guide $guide)
    {
        //
    }

    /**
     * Handle the Guide "updated" event.
     *
     * @param  \App\Models\Guide  $guide
     * @return void
     */
    public function updated(Guide $guide)
    {
        //
    }

    /**
     * Handle the Guide "deleted" event.
     *
     * @param  \App\Models\Guide  $guide
     * @return void
     */
    public function deleting(Guide $guide)
    {
        $tour=Tour::where('id_guid', $guide->id )->exists();
        if($tour){
            throw new \Exception("Нельзя удалить гида так как у него имеются туры.");
        }
    }

    /**
     * Handle the Guide "restored" event.
     *
     * @param  \App\Models\Guide  $guide
     * @return void
     */
    public function restored(Guide $guide)
    {
        //
    }

    /**
     * Handle the Guide "force deleted" event.
     *
     * @param  \App\Models\Guide  $guide
     * @return void
     */
    public function forceDeleted(Guide $guide)
    {
        //
    }
}
