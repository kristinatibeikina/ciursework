<?php

namespace App\Observers;

use App\Models\Booked_tours;
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
       if($tour->date_end <= $tour->date_start) {
        // Если дата начала тура в прошлом, выбрасываем исключение
        throw new \Exception("Дата окончания тура не может быть меньше чем дата начала или ровнаа ей.");
    } // Проверяем, чтобы дата начала тура была в будущем
        if ($tour->date_start < Carbon::now()) {
            // Если дата начала тура в прошлом, выбрасываем исключение
            throw new \Exception("Дата начала тура должна быть в будущем.");
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
    public function deleting(Tour $tour)
    {
        // Проверяем, есть ли забронированные туры, связанные с удаляемым туром
        $bookedTours = Booked_tours::where('id_tour', $tour->id)->exists();
        if ($bookedTours) {

            throw new \Exception("Нельзя удалить тур, который уже забронирован.");
        }
        if ($tour->date_start <= Carbon::now() && Carbon::now()<= $tour->date_end) {
            throw new \Exception("Нельзя удалить тур когда он идет.");
        }

    }

    public function deleted(Tour $tour)
    {
        //Удаление тура когда он закончился
        if (Carbon::now()->greaterThanOrEqualTo($tour->date_end)) {
            $tour->delete();
        }
        // Находим все связанные бронирования и удаляем их
        $bookedTours = Booked_tours::where('id_tour', $tour->id)->get();
        foreach ($bookedTours as $bookedTour) {
            $bookedTour->delete();
        }
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
