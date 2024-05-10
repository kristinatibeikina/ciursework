<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionStoreRequest extends FormRequest
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
                'name' => 'required|unique:regions|max:255',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

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
