<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HousingStoreRequest extends FormRequest
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
                'name'=>'required|unique:housings,name|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'photo' => 'array',
                'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'address'=>'required|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'id_region'=>'required',
                'description'=>'required|regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u|string',
            ];
        }else{
            return [
                'name'=>'required|unique:housings,name|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'photo' => 'array',
                'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'address'=>'required|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'id_region'=>'required',
                'description'=>'required|regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u|string',
            ];
        }
    }
    public function messages()
    {
        return [
            'required'=>'Обязательно для ввода',
            'regex'=>'Должна использоваться кириллица',
            'description.regex'=>'Должна использоваться кириллица и символы',
            'unique'=>'Значение должно быть уникально',
            'string'=>'Должен быть текст',
            'image'=>'Должна быть фотография',
            'mimes'=>'Формат jpeg,png,jpg,gif,svg',
            'max:2048'=>'Максимальный размер 2 м',
            'array'=>'Массив данных'
        ];
    }
}
