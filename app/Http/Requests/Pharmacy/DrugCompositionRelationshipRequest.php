<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class DrugCompositionRelationshipRequest extends FormRequest
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
            'drug' => 'required',
            'drug.uuid' => 'required|exists:pharmacy_drugs,uuid',
            'compositions' => 'required',
            'compositions.*'=> 'required|exists:pharmacy_drug_compositions,uuid'
        ];
    }
}
