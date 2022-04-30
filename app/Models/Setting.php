<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use SoftDeletes;

    protected $table = 'settings';

    protected $hidden = ['id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

}
