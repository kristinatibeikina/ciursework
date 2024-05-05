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
            'prise'=>$this->prise,
            'date_start'=>$this->date_start,
            'date_end'=>$this->date_end,
            'legal_age'=>$this->legal_age,
            'id_housing'=>$this->id_housing
        ];
    }
}
