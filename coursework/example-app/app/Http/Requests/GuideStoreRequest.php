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
                'description'=>'required',
            ];
        }
        return [
            'name'=>'required',
            'surname'=>'required',
            'description'=>'required',
            'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_region'=>'required'
        ];
    }
}
