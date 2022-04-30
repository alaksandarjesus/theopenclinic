<?php

namespace App\Models\Pharmacy\Invoice;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'pharmacy_invoices';

    protected $hidden = ['id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $casts = [
        'submitted' => 'boolean',
        'total' => 'float',
        'tax' => 'float', 
        'discount' => 'float',
        'subtotal' =>'float'
    ];

    public function customer(){
        return $this->hasOne('App\Models\User\User', 'id', 'customer_id');
    }

    public function items(){
        return $this->hasMany('App\Models\Pharmacy\Invoice\Item', 'invoice_id', 'id');
    }

    public function getFormattedAttribute(){
        return (object)[
            'invoice_date' => Carbon::parse($this->invoice_date)->format('d-m-Y'),
            'subtotal' => $this->subtotal?number_format($this->subtotal, 2):'0.00',
            'tax' => $this->tax?number_format($this->tax, 2):'0.00',
            'discount' => $this->discount?number_format($this->discount, 2):'0.00',
            'total' => $this->total?number_format($this->total, 2):'0.00',
        ];
    }
}
