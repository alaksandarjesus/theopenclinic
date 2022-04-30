<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'uuid' => 'nullable|exists:pharmacy_suppliers,uuid',
            'name' => 'required|min:3|max:20|unique:pharmacy_suppliers,name,'.$this->uuid.',uuid',
            'email' => 'nullable|min:3|max:30',
            'phone' => 'nullable|min:3|max:20',
            'address' => 'nullable|min:3|max:200',
            'tax_information' => 'nullable|min:3|max:200',
            'description' => 'nullable|min:3|max:200',
        ];
    }
}
