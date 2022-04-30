<?php

namespace App\Http\Requests\Expenditures;

use Illuminate\Foundation\Http\FormRequest;

class ExpenditureRequest extends FormRequest
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
            'uuid' => 'nullable|exists:expenditures,uuid',
            'description' => 'required',
            'date' => 'required|date_format:d-m-Y',
            'amount' => 'required|numeric'
        ];
    }
}
