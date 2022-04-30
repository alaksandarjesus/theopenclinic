<?php

namespace App\Http\Requests\Appointments;

use Illuminate\Foundation\Http\FormRequest;

class PreconsultationFieldRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'nullable|exists:preconsultation_fields,uuid',
            'name' => 'required|min:3|max:30|unique:preconsultation_fields,name,'.$this->uuid.',uuid',
            'type' => 'required',
            'order' => 'required',
            'values' => 'nullable'
        ];
    }
}
