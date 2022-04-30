<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use SoftDeletes;

    protected $table = 'payments';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];


    public function appointment(){
        return $this->hasOne('App\Models\Appointments\Appointment', 'id', 'appointment_id');
    }

    public function getFormattedAttribute(){
        return (object)[
            'date' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'time' => Carbon::parse($this->created_at)->format('H:i'),
        ];
    }

}
