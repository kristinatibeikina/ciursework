<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if ($request->route()->getName() === 'index') {
            return [
                'id'=>$this->id,
                'name' => $this->name,
                'photo' => $this->photo,

            ];
        }
        return [
            'id'=>$this->id,
            'name' => $this->name,
            'photo' => $this->photo,
            'list'=>TourResource::collection($this->list),
        ];


    }
}
