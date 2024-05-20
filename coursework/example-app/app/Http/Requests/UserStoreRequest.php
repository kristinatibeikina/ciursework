<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        if ($request->route()->getName() === 'register') {
            return [
                'surname' => 'required|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'name' => 'required|regex:/^[А-Яа-яЁё\s]+$/u|string',
                'patronymic' => 'regex:/^[А-Яа-яЁё\s]+$/u|string',
                'password' => 'unique:users,password|required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'email' => 'required|email|unique:users,email',

            ];
        }else{
            return [
                'password' => 'required',
                'email' => 'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'required'=>'Обязательно для ввода',
            'regex'=>'Должна использоваться кириллица',
            'unique'=>'Значение должно быть уникально',
            'string'=>'Должен быть текст',
            'email'=>'Не корректный формат почты',
            'min:8'=>'Минимум 8 значений',
            'password,regex'=>'Строка должна состоять только из заглавных и строчных букв латинского алфавита, цифр и специальных символов @$!%*?&, и должна быть не короче 8 символов'
        ];
    }
}
