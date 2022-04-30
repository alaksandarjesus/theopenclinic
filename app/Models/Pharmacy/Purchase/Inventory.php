<?php

namespace App\Models\Pharmacy\Purchase;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Inventory extends Model
{
    use SoftDeletes;

    protected $table = 'pharmacy_purchase_order_inventory';

    protected $hidden = ['id','purchase_order_item_id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];


    public function item(){
        return $this->hasOne('App\Models\Pharmacy\Purchase\Item', 'id', 'purchase_order_item_id');
    }

    public function getFormattedAttribute(){
        return (object)[
            'qty' => $this->qty?number_format($this->qty,2):0.00,
            'expiry_date'=> $this->expiry_date?Carbon::parse($this->expiry_date)->format('d-m-Y'):NULL,
        ];
    }
}
