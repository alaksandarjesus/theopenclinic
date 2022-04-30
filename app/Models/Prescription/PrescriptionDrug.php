<?php

namespace App\Models\Prescription;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class PrescriptionDrug extends Model
{
    use SoftDeletes;

    protected $table = 'prescription_drugs';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function drug(){
        return $this->hasOne('App\Models\Pharmacy\Drug', 'id', 'drug_id');
    }
}
