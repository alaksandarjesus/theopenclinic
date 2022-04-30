<?php

namespace App\Http\Requests\Pharmacy\PurchaseInventory;

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
            'order' => 'required',
            'order.uuid' => 'required|exists:pharmacy_purchase_orders,uuid',
            'inventory' => 'required',
            'inventory.uuid' => 'required|exists:pharmacy_purchase_order_inventory,uuid',
            'inventory.qty' => 'required|numeric',
            'inventory.batch' => 'nullable|max:255',
            'inventory.expiry_date' =>'nullable|date_format:Y-m-d',
            'inventory.comments'=> 'nullable|max:255'
        ];
    }
}
