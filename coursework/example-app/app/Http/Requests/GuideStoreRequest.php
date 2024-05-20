<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuideStoreRequest extends FormRequest
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
        if(request()->isMethod('PUT')) {
            return [
                'description'=>'required|regex:/^[А-Яа-яЁё\s]+$/u|string',
            ];
        }else if(request()->isMethod('POST')){
            return [
                'surname' => 'required|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'name' => 'required|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'description'=>'required|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'id_region'=>'required',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
            ];
        }

    }
    public function messages()
    {
        return [
            'required'=>'Обязательно для ввода',
            'regex'=>'Должна использоваться кириллица',
            'string'=>'Должен быть текст',
            'max:2048'=>'Максимальный размер 2 МБ',
            'image'=>'Должно быть фото',
            'mimes:jpeg,png,jpg,gif,svg'=>'Принимаемые форматы jpeg,png,jpg,gif,svg',
        ];
    }
}
