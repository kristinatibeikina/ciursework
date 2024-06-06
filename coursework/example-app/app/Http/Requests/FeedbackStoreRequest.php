<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FeedbackStoreRequest extends FormRequest
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
    public function rules(Request $request)
    {

        return [
            'id_tour'=>'',
            'comment'=>'required|regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u',
            'count_stars'=>'required',
            'date_published'=>'',
            'photo' => 'array',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'Обязательно для ввода',
            'regex'=>'Должна использоваться кириллица и символы',
            'string'=>'Должен быть текст',
            'photo' => 'required|array',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image'=>'Должна быть фотография',
            'mimes'=>'Формат jpeg,png,jpg,gif,svg',
            'max:2048'=>'Максимальный размер 2 м',
            'array'=>'Массив данных'
        ];
    }
}
