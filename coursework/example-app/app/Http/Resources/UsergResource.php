<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsergResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'surname'=>$this->surname,
            'name'=>$this->name,
            'patronymic'=>$this->patronymic,
            'password'=>$this->password,
            'email'=>$this->email,
            'id_role'=>$this->id_role,
        ];
    }
}
