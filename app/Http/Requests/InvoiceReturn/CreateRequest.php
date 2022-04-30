<?php

namespace App\Http\Requests\InvoiceReturn;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'items' => 'required',
            'items.*.item' => 'required',
            'items.*.item.uuid' => 'required|exists:pharmacy_invoice_items,uuid',
            'items.*.qty' => 'required|numeric',
            'items.*.price' => 'required|numeric',
            'items.*.tax' => 'required|numeric',
            'items.*.total' => 'required|numeric',
            'items.*.comments'=> 'nullable|max:255'
        ];
    }
}
