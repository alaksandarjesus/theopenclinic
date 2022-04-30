<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'uuid' => 'nullable|exists:pharmacy_invoices,uuid',
            'invoice_number' => 'required|unique:pharmacy_invoices,invoice_number,'.$this->uuid.',uuid',
            'invoice_date' => 'nullable',
            'customer' => 'required',
            'customer.uuid' => 'nullable|exists:users,uuid',
            'subtotal' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'total'=> 'nullable|numeric',
            'items' => 'required|array',
            'items.uuid' => 'nullable|exists:pharmacy_invoice_items,uuid',
            'items.*.drug.uuid' => 'nullable|exists:pharmacy_drugs,uuid',
            'items.*.qty' => 'nullable|numeric',
            'items.*.price' => 'nullable|numeric',
            'items.*.tax' => 'nullable|numeric',
            'items.*.total' => 'nullable|numeric',
            'submitted' => 'nullable',
            'comments' => 'nullable'
        ];
    }
}
