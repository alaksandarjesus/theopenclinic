<?php

namespace App\Models\Pharmacy\Purchase;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'pharmacy_purchase_orders';

    protected $hidden = ['id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $casts = [
        'submitted' => 'boolean',
        'total' => 'float',
        'tax' => 'float', 
        'discount' => 'float',
        'subtotal' =>'float'
    ];

    public function supplier(){
        return $this->hasOne('App\Models\Pharmacy\Supplier', 'id', 'supplier_id');
    }

    public function items(){
        return $this->hasMany('App\Models\Pharmacy\Purchase\Item', 'order_id', 'id');
    }

    public function getFormattedAttribute(){
        return (object)[
            'order_date' => Carbon::parse($this->order_date)->format('d-m-Y'),
            'subtotal' => $this->subtotal?number_format($this->subtotal, 2):'0.00',
            'tax' => $this->tax?number_format($this->tax, 2):'0.00',
            'discount' => $this->discount?number_format($this->discount, 2):'0.00',
            'total' => $this->total?number_format($this->total, 2):'0.00',
        ];
    }
}
