<?php

namespace App\Http\Requests\back;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'name_en'=>'required|max:100',
            'name_ar'=>'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name_en' =>trans('validation.required'),
            'name_en' =>trans('validation.max'),
            'name_ar' => trans('validation.required'),
            'name_ar' => trans('validation.max'),
        ];
    }
}
