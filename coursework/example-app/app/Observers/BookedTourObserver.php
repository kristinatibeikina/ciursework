<?php

namespace App\Observers;

use App\Models\Booked_tours;

class BookedTourObserver
{
    /**
     * Handle the Booked_tours "created" event.
     *
     * @param  \App\Models\Booked_tours  $booked_tours
     * @return void
     */
    public function created(Booked_tours $booked_tours)
    {
        //
    }

    /**
     * Handle the Booked_tours "updated" event.
     *
     * @param  \App\Models\Booked_tours  $booked_tours
     * @return void
     */
    public function updated(Booked_tours $booked_tours)
    {
        //
    }

    /**
     * Handle the Booked_tours "deleted" event.
     *
     * @param  \App\Models\Booked_tours  $booked_tours
     * @return void
     */
    public function deleting(Booked_tours $booked_tours)
    {
        if ($booked_tours->id_status_application == 2) {
            throw new \Exception("Нельзя отказаться от бронирования когда оно одобрено");
        }
    }

    /**
     * Handle the Booked_tours "restored" event.
     *
     * @param  \App\Models\Booked_tours  $booked_tours
     * @return void
     */
    public function restored(Booked_tours $booked_tours)
    {
        //
    }

    /**
     * Handle the Booked_tours "force deleted" event.
     *
     * @param  \App\Models\Booked_tours  $booked_tours
     * @return void
     */
    public function forceDeleted(Booked_tours $booked_tours)
    {
        //
    }
}
