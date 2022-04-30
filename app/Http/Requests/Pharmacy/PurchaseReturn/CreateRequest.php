<?php

namespace App\Http\Requests\Pharmacy\PurchaseReturn;

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
            'items' => 'required',
            'items.*.item' => 'required',
            'items.*.item.uuid' => 'required|exists:pharmacy_purchase_order_items,uuid',
            'items.*.inventory' => 'required',
            'items.*.inventory.uuid' => 'required|exists:pharmacy_purchase_order_inventory,uuid',
            'items.*.qty' => 'required|numeric',
            'items.*.cost' => 'required|numeric',
            'items.*.tax' => 'required|numeric',
            'items.*.total' => 'required|numeric',
            'items.*.comments'=> 'nullable|max:255'
        ];
    }
}
