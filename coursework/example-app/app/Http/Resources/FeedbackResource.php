<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'count_stars'=>$this->count_stars,
            'comment'=>$this->comment,
            'date_published'=>$this->date_published,
            'photo'=>$this->photo
        ];

    }
}
