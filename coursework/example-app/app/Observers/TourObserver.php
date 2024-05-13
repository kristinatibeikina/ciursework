<?php

namespace App\Observers;

use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TourObserver
{
    /**
     * Handle the Tour "created" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function creating(Tour $tour)
    {
        // Проверяем, чтобы дата начала тура была в будущем
        if ($tour->date_start < Carbon::now()) {
            // Если дата начала тура в прошлом, выбрасываем исключение
            throw new \Exception("Дата начала тура должна быть в будущем.");
        }if($tour->date_end <= $tour->date_start) {
        // Если дата начала тура в прошлом, выбрасываем исключение
        throw new \Exception("Дата окончания тура не может быть меньше чем дата начала или ровнаа ей.");
    }
    }

    /**
     * Handle the Tour "updated" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function updated(Tour $tour)
    {
        //
    }

    /**
     * Handle the Tour "deleted" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function deleted(Tour $tour)
    {
        //
    }

    /**
     * Handle the Tour "restored" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function restored(Tour $tour)
    {
        //
    }

    /**
     * Handle the Tour "force deleted" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function forceDeleted(Tour $tour)
    {
        //
    }
}
