<?php

namespace App\Http\Requests\back;

use Illuminate\Foundation\Http\FormRequest;

class Scope_workRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_en'=>'required|max:100',
            'name_ar'=>'required|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name_en' =>trans('validation.required'),
            'name_en' =>trans('validation.max'),
            'name_ar' => trans('validation.required'),
            'name_ar' => trans('validation.max'),
        ];
    }
}
