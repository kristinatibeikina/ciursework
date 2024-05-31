<?php

namespace App\Observers;

use App\Models\Housing;
use App\Models\Tour;

class HousingObserver
{
    /**
     * Handle the Hausing "created" event.
     *
     * @param  \App\Models\Housing  $hausing
     * @return void
     */
    public function created(Housing $hausing)
    {
        //
    }

    /**
     * Handle the Hausing "updated" event.
     *
     * @param  \App\Models\Housing  $hausing
     * @return void
     */
    public function updated(Housing $hausing)
    {
        //
    }

    /**
     * Handle the Hausing "deleted" event.
     *
     * @param  \App\Models\Housing  $hausing
     * @return void
     */
    public function deleting(Housing $hausing)
    {
        $tour=Tour::where('id_housing', $hausing->id )->exists();
        if($tour){
            throw new \Exception("Нельзя удалить отель, находящийся в туре.");
        }
    }

    /**
     * Handle the Hausing "restored" event.
     *
     * @param  \App\Models\Housing  $hausing
     * @return void
     */
    public function restored(Housing $hausing)
    {
        //
    }

    /**
     * Handle the Hausing "force deleted" event.
     *
     * @param  \App\Models\Housing  $hausing
     * @return void
     */
    public function forceDeleted(Housing $hausing)
    {
        //
    }
}
