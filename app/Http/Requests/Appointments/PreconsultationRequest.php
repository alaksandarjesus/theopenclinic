<?php

namespace App\Http\Requests\Appointments;

use Illuminate\Foundation\Http\FormRequest;

class PreconsultationRequest extends FormRequest
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
            'appointment' => 'required|exists:appointments,uuid',
            'fields' => 'required|array',
            'fields.*.uuid' => 'required|exists:preconsultation_fields,uuid',
            'fields.*.value' => 'required'
        ];
    }
}
