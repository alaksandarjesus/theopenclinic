<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;


class ClinicInfoRequest extends FormRequest
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
            'clinic_name' => 'required|max:200',
            'clinic_address' => 'required|max:200',
            'clinic_tax_information' => 'required|max:200',
            'clinic_email' => 'required|max:200',
            'clinic_phone' => 'required|max:200',
        ];
    }
}
