<?php

namespace App\Models\Pharmacy\Purchase;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'pharmacy_purchase_order_items';

    protected $hidden = ['id','order_id','drug_id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function drug(){
        return $this->hasOne('App\Models\Pharmacy\Drug', 'id', 'drug_id');
    }

    public function inventory(){
        return $this->hasMany('App\Models\Pharmacy\Purchase\Inventory', 'purchase_order_item_id', 'id')->orderBy('updated_at', 'DESC');
    }

    public function order(){
        return $this->hasOne('App\Models\Pharmacy\Purchase\Order', 'id', 'order_id');
    }

    public function getFormattedAttribute(){
        return (object)[
            'qty' => $this->qty?number_format($this->qty, 2):'0.00',
            'tax' => $this->tax?number_format($this->tax, 2):'0.00',
            'cost' => $this->cost?number_format($this->cost, 2):'0.00',
            'total' => $this->total?number_format($this->total, 2):'0.00',
        ];
    }
}
