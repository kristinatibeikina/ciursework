<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'date_start'=>$this->date_start,
            'date_end'=>$this->date_end,
            'legal_age'=>$this->legal_age,
            'id_housing'=>$this->id_housing,
            'photo'=>$this->photo,
            'enabled'=>$this->enabled,
            'id_region'=>$this->id_region,
            'id_status'=>$this->id_status,
            'id_guid'=>$this->id_guid,
            'list'=>FeedbackResource::collection($this->list)
        ];

    }
}
