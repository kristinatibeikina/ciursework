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
                'name'=>'required|unique:tours,name',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'address'=>'required',
                'id_region'=>'required',
                'description'=>'required',
            ];
        }else{
            return [
                'name'=>'required|unique:tours,name',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'address'=>'required',
                'id_region'=>'required',
                'description'=>'required',
            ];
        }
    }
}
