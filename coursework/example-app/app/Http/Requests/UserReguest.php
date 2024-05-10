<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserReguest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'surname'=>'required',
            'name'=>'required',
            'patronymic',
            'password'=>'required',
            'email'=>'required',
            'id_role'=>'required',
        ];
    }
}
