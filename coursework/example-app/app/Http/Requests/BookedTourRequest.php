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
            ];
        }
        return [
            'id_tour'=>'required',
            'count_children'=>'required|numeric',
            'count_adults'=>'required|numeric',
            'wishes'=>'required',
            'response'=>'required',
            'id_status_application'=>'required',
            'id_user',
            'tel'=>'required',
            'email'=>'required',
            'date_application'=>'required',
        ];
    }
}
