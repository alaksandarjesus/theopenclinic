<?php

namespace App\Models\Pharmacy\Invoice;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Returnn extends Model
{
    use SoftDeletes;

    protected $table = 'pharmacy_invoice_returns';

    protected $hidden = ['id','invoice_item_id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function item(){
        return $this->hasOne('App\Models\Pharmacy\Invoice\Item', 'id', 'invoice_item_id');
    }

    public function getFormattedAttribute(){
        return (object)[
            'qty' => $this->qty?number_format($this->qty, 2):'0.00',
            'tax' => $this->tax?number_format($this->tax, 2):'0.00',
            'price' => $this->price?number_format($this->price, 2):'0.00',
            'total' => $this->total?number_format($this->total, 2):'0.00',
        ];
    }
}
