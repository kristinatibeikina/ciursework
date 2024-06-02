<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookedTourRequest extends FormRequest
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
                'id_status_application'=>'required',
                'response'=>'regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u'
            ];
        }
        return [
            'id_tour'=>'required',
            'count_children'=>'required|numeric',
            'count_adults'=>'required|numeric',
            'wishes'=>'required|regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u|string',
            'response'=>'regex:/^[А-Яа-яЁё,\_.,!@#$%^&*()+=\[\]\{\}\:;"<>,.?\-\s]+$/u',
            'id_status_application'=>'required',
            'id_user'=>'',
            'tel'=>['required', 'regex:/^(7|8)\d{10}$/'],
            'email'=>'required|email',
            'date_application'=>'',
        ];
    }
    public function messages()
    {
        return[
            'response.regex'=>'Должна использоваться кириллица и символы',
            'wishes.regex'=>'Должна использоваться кириллица и символы',
            'required'=>'Обязательно для ввода',
            'unique'=>'Значение должно быть уникально',
            'string'=>'Должен быть текст',
            'email'=>'Не соответствуюет формату почты',
            'phone.regex' => 'Формат телефонного номера неверен. Он должен начинаться с +7 или 8 и содержать 10 цифр.'
        ];
    }
}
