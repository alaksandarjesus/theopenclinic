<?php

namespace App\Models\Pharmacy\Invoice;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'pharmacy_invoice_items';

    protected $hidden = ['id','invoice_id','drug_id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function drug(){
        return $this->hasOne('App\Models\Pharmacy\Drug', 'id', 'drug_id');
    }

    public function invoice(){
        return $this->hasOne('App\Models\Pharmacy\Invoice\Invoice', 'id', 'invoice_id');
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
