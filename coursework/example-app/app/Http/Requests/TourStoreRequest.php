<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:tours,name',
            'description'=>'required',
            'price'=>'required',
            'date_start'=>'required',
            'date_end'=>'required',
            'legal_age'=>'required',
            'id_housing'=>'required',
            'place_tour_id'=>'required',
            'id_status'=>'required',
        ];
    }
}
