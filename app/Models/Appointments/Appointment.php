<?php

namespace App\Models\Appointments;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Appointments\PreconsultationField;
use App\Models\Appointments\Preconsultation;
use App\Models\Payments\Payment;

class Appointment extends Model
{
    use SoftDeletes;

    protected $table = 'appointments';

    protected $hidden = ['id', 'doctor_id', 'patient_id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function doctor(){
        return $this->hasOne('App\Models\User\User', 'id', 'doctor_id');
    }

    
    public function patient(){
        return $this->hasOne('App\Models\User\User', 'id', 'patient_id');
    }

    public function consultation(){
        return $this->hasOne('App\Models\Consultation\Consultation', 'appointment_id', 'id');
    }

    public function getFormattedAttribute(){
        return (object)[
            'date' => Carbon::parse($this->datetime)->format('d-m-Y'),
            'time' => Carbon::parse($this->datetime)->format('H:i'),
        ];
    }

    public function getCanEditAttribute(){
        $appointment_date = Carbon::parse($this->datetime);
        $now = Carbon::now();
        return  $now->isBefore($appointment_date);
    }

    public function getCanConsultAttribute(){
        $appointment_date = Carbon::parse($this->datetime);
        $date_start = Carbon::now()->startOfDay();
        $date_end = Carbon::now()->endOfDay();
        return $date_start->isBefore($appointment_date) && $date_end->isAfter($appointment_date);
    }

    public function payments(){

        return $this->hasMany('App\Models\Payments\Payment', 'appointment_id', 'id');
    }

    public function getPaidAttribute(){

        return Payment::where('appointment_id', $this->id)->sum('amount');
    }

    public function preconsultation_value($field_uuid, $value = NULL){

        $field = PreconsultationField::where('uuid', $field_uuid)->first();
        if(empty($field)){
            return NULL;
        }

        $row = Preconsultation::where('preconsultation_field_id', $field->id)
                    ->where('appointment_id', $this->id)
                    ->when($value, function($query) use ($value){
                        return $query->where('value', $value);
                    })
                    ->first();
        if(empty($row)){
            return NULL;
        }
        return $row->value;
    }

}
