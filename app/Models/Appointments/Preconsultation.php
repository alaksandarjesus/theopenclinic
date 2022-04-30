<?php

namespace App\Models\Appointments;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Preconsultation extends Model
{
    use SoftDeletes;

    protected $table = 'appointment_preconsultations';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];


    public function preconsultation_field(){
        return $this->hasOne('App\Models\Appointments\PreconsultationField', 'id', 'preconsultation_field_id');
    }

}
