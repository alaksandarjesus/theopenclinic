<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Consultation extends Model
{
    use SoftDeletes;

    protected $table = 'consultations';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function setComplaintsAttribute($value){
        $this->attributes['complaints'] =  Crypt::encryptString($value);
    }

    public function getComplaintsAttribute($value){
        try{
            return Crypt::decryptString($value);
        }catch(DecryptException $e){
            return NULL;
        }
    }

    public function setExaminationAttribute($value){
        $this->attributes['examination'] =  Crypt::encryptString($value);
    }

    public function getExaminationAttribute($value){
        try{
            return Crypt::decryptString($value);
        }catch(DecryptException $e){
            return NULL;
        }
    }

    public function setOthersAttribute($value){
        $this->attributes['others'] =  Crypt::encryptString($value);
    }

    public function getOthersAttribute($value){
        try{
            return Crypt::decryptString($value);
        }catch(DecryptException $e){
            return NULL;
        }
    }

    public function appointment(){
        return $this->hasOne('App\Models\Appointments\Appointment', 'id', 'appointment_id');
    }

    public function prescription(){
        return $this->hasOne('App\Models\Prescription\Prescription', 'consultation_id', 'id');
    }
}
