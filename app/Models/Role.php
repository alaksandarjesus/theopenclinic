<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    protected $hidden = ['id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];


    public function getUsersCountAttribute(){
        $users_count = $this->hasMany('App\Models\User\UserRoleRelation', 'role_id', 'id')->count();
        return $users_count;
    }
}
