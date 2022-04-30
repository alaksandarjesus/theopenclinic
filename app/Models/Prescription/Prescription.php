<?php

namespace App\Models\Prescription;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use SoftDeletes;

    protected $table = 'prescriptions';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function drugs(){
        return $this->hasMany('App\Models\Prescription\PrescriptionDrug', 'prescription_id', 'id');
    }
}
