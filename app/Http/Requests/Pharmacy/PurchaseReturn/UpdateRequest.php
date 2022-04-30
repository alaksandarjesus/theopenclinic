<?php

namespace App\Http\Requests\Pharmacy\PurchaseReturn;

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
            'return'=> 'required',
            'return.uuid' => 'required|exists:pharmacy_purchase_order_returns,uuid',
            'return.qty' => 'required|numeric',
            'return.cost' => 'required|numeric',
            'return.tax' => 'required|numeric',
            'return.total' => 'required|numeric',
            'return.comments'=> 'nullable|max:255'
        ];
    }
}
