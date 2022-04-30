<?php

namespace App\Http\Requests\Consultation;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
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
            'appointment_uuid' => 'required|exists:appointments,uuid',
            'complaints' => 'required',
            'examination' => 'required',
            'prescription' => 'required',
            'prescription.drugs' => 'nullable',
            'prescription.drugs.*.uuid' => 'required|exists:pharmacy_drugs,uuid',
            'prescription.drugs.*.days' => 'nullable|numeric',
            'prescription.drugs.*.bb' => 'nullable|numeric',
            'prescription.drugs.*.ab' => 'nullable|numeric',
            'prescription.drugs.*.bl' => 'nullable|numeric',
            'prescription.drugs.*.al' => 'nullable|numeric',
            'prescription.drugs.*.be' => 'nullable|numeric',
            'prescription.drugs.*.ae' => 'nullable|numeric',
            'prescription.drugs.*.bd' => 'nullable|numeric',
            'prescription.drugs.*.ad' => 'nullable|numeric',
            'others' => 'required|string',
        ];
    }
}
