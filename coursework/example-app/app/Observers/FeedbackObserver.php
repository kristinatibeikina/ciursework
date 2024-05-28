<?php

namespace App\Observers;

use App\Models\Booked_tours;
use App\Models\Feedback;

class FeedbackObserver
{
    /**
     * Handle the Feedback "created" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function creating(Feedback $feedback)
    {
        $booked = Booked_tours::where('id_user', $feedback->id_user)->where('id_tour', $feedback->id_tour)->first();
        if(!$booked ){
            throw new \Exception("Оставлять комментарии могут только участники тура.");
        }

        $photosString = $feedback->photo;

        // Преобразуем строку в массив
        $photosArray = explode(',', $photosString);

        // Проверяем количество элементов в массиве
        $photoCount = count($photosArray);

        if ($photoCount > 3) {
            throw new \Exception("Больше трех фото нельзя.");
        }
    }

    /**
     * Handle the Feedback "updated" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function updated(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "deleted" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function deleted(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "restored" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function restored(Feedback $feedback)
    {
        //
    }

    /**
     * Handle the Feedback "force deleted" event.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return void
     */
    public function forceDeleted(Feedback $feedback)
    {
        //
    }
}
