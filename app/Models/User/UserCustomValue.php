<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserCustomValue extends Model
{
    use SoftDeletes;

    protected $table = 'user_custom_values';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];


    public function user_custom_field(){
        return $this->hasOne('App\Models\User\UserCustomField', 'id', 'user_custom_field_id');
    }
}
