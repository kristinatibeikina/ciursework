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
                'price'=>'',
                'date_start'=>'required',
                'date_end'=>'required',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
                'legal_age'=>'required',
                //'id_housing'=>'required',
                'id_status'=>'required',
                'enabled'=>'required',
                'id_region'=>'required',
               // 'id_guid'=>'required',
            ];
        }else if(request()->isMethod('PUT')){
            return [
                'id_status'=>'required',
                'id_guid'=>'required',
            ];
        }

    }
    public function messages()
    {
        return[
            'required'=>'Обязательно для ввода',
            'unique'=>'Значение должно быть уникально',
            'string'=>'Должен быть текст',
            'max:2048'=>'Максимальный размер 2 МБ',
            'image'=>'Должно быть фото',
            'mimes:jpeg,png,jpg,gif,svg'=>'Принимаемые форматы jpeg,png,jpg,gif,svg',
        ];
    }
}
