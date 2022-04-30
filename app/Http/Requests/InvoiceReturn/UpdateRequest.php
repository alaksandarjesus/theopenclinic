<?php

namespace App\Http\Requests\InvoiceReturn;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'invoice' => 'required',
            'invoice.uuid' => 'required|exists:pharmacy_invoices,uuid',
            'return'=> 'required',
            'return.uuid' => 'required|exists:pharmacy_invoice_returns,uuid',
            'return.qty' => 'required|numeric',
            'return.price' => 'required|numeric',
            'return.tax' => 'required|numeric',
            'return.total' => 'required|numeric',
            'return.comments'=> 'nullable|max:255'
        ];
    }
}
