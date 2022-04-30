<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Message extends Model
{
    use SoftDeletes;

    protected $table = 'messages';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function parent(){
        return $this->hasOne('App\Models\Messages\Message', 'id', 'parent_id');
    }

    public function children(){
        return $this->hasOne('App\Models\Messages\Message', 'parent_id', 'id');
    }

    public function creator(){
        return $this->hasOne('App\Models\User\User', 'id', 'created_by');
    }

    public function getFormattedAttribute(){

        return (object)[
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y H:i:s')
        ];
    }
}

