<?php

namespace App\Http\Requests\Pharmacy\PurchaseInventory;

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
            'order' => 'required',
            'order.uuid' => 'required|exists:pharmacy_purchase_orders,uuid',
            'items' => 'required|array',
            'items.*.uuid' => 'required|exists:pharmacy_purchase_order_items,uuid',
            'items.*.qty' => 'required|numeric',
            'items.*.batch' => 'nullable|max:255',
            'items.*.expiry_date' =>'nullable|date_format:Y-m-d',
            'items.*.comments'=> 'nullable|max:255'
        ];
    }
}
