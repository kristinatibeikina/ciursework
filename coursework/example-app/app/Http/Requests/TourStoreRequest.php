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
                'name'=>'required|unique:tours,name|regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u|string',
                'description'=>'required|string|regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u|string',
                'price'=>'',
                'date_start'=>'required',
                'date_end'=>'required',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
                'legal_age'=>'required',
                'enabled'=>'required|regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u|string',
                'id_region'=>'required',
            ];
        }if(request()->isMethod('PUT')){
            return [
                'id_status'=>'',
                'id_guid'=>'',
                'legal_age'=>'',
                'price'=>'',
                'id_housing'=>''
            ];

        }



    }
    public function messages()
    {
        return[
            'regex'=>'Должна использоваться кириллица и символы',
            'required'=>'Обязательно для ввода',
            'unique'=>'Значение должно быть уникально',
            'string'=>'Должен быть текст',
            'max:2048'=>'Максимальный размер 2 МБ',
            'image'=>'Должно быть фото',
            'mimes:jpeg,png,jpg,gif,svg'=>'Принимаемые форматы jpeg,png,jpg,gif,svg',
        ];
    }
}
