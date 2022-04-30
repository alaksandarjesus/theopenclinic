<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserRoleRelation extends Model
{
    use SoftDeletes;

    protected $table = 'user_role_relation';

    protected $hidden = ['id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function role(){

        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }
}
