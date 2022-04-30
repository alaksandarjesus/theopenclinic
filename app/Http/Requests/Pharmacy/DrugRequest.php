<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class DrugRequest extends FormRequest
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
            'uuid' => 'nullable|exists:pharmacy_drugs,uuid',
            'name' => 'required|min:3|max:50|unique:pharmacy_drugs,name,'.$this->uuid.',uuid',
            'unit' => 'required|min:3|max:20',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'tax' => 'required|numeric',
            'description' => 'nullable|min:3|max:200',
            'compositions' => 'nullable',
            'compositions.*' => 'nullable|exists:pharmacy_compositions,uuid',
            'category' => 'required|exists:pharmacy_categories,uuid'
        ];
    }
}
