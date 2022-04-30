<?php

namespace App\Models\Expenditures;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Expenditure extends Model
{
    use SoftDeletes;

    protected $table = 'expenditures';

    protected $hidden = ['id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    public function getFormattedAttribute(){
        return (object)[
            'date' => Carbon::parse($this->date)->format('d-m-Y'),
        ];
    }
}
