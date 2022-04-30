<?php

namespace App\Models\Appointments;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PreconsultationField extends Model
{
    use SoftDeletes;

    protected $table = 'preconsultation_fields';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];


    public function getValuesAsArrayAttribute(){
        $values = $this->values;
        if(empty($values)){
            return[];
        }
        $exploded = explode(',', $values);
        $out = array_map(function($value){
            return trim($value);
        }, $exploded);
        return $out;
    }

}
