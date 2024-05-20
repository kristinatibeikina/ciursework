<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(request()->isMethod('GET')) {
            return [
                'name'=>$this->name,
                'surname'=>$this->surname,
                'description'=>$this->description,
                'photo'=>$this->photo,
            ];
        }
        return[
            'name'=>$this->name,
            'surname'=>$this->surname,
            'description'=>$this->description,
            'photo'=>$this->photo,
            'id_region'=>$this->id_region,
        ];
    }
}
