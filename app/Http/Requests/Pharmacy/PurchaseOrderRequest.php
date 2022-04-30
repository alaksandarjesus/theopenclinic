<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderRequest extends FormRequest
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
            'uuid' => 'nullable|exists:pharmacy_purchase_orders,uuid',
            'order_number' => 'required|unique:pharmacy_purchase_orders,order_number,'.$this->uuid.',uuid',
            'order_date' => 'nullable',
            'supplier' => 'required',
            'supplier.uuid' => 'nullable|exists:pharmacy_suppliers,uuid',
            'subtotal' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'total'=> 'nullable|numeric',
            'items' => 'required|array',
            'items.uuid' => 'nullable|exists:pharmacy_purchase_order_items,uuid',
            'items.*.drug.uuid' => 'nullable|exists:pharmacy_drugs,uuid',
            'items.*.qty' => 'nullable|numeric',
            'items.*.cost' => 'nullable|numeric',
            'items.*.tax' => 'nullable|numeric',
            'items.*.total' => 'nullable|numeric',
            'submitted' => 'nullable',
            'comments' => 'nullable'
        ];
    }
}
