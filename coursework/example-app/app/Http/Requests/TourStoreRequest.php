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
        if(request()->isMethod('POST')){
            return [
                'name'=>'required|unique:tours,name',
                'description'=>'required|string',
                'price'=>'required',
                'date_start'=>'required',
                'date_end'=>'required',
                'legal_age'=>'required',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'id_housing'=>'required',
                'place_tour_id'=>'required',
                'id_status'=>'required',
            ];
        }else{
            return [
                'name'=>'required|unique:tours,name',
                'description'=>'required|string',
                'price'=>'required',
                'date_start'=>'required',
                'date_end'=>'required',
                'legal_age'=>'required',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'id_housing'=>'required',
                'place_tour_id'=>'required',
                'id_status'=>'required',
            ];
        }

    }
    public function messages()
    {
        return[
            'name.required'=>'Название обязательно для ввода',
            'description.required'=>'Описание обязательно для ввода)'
        ];
    }
}
