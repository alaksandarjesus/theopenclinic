<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DrugCompositionRelationship extends Model
{
    use SoftDeletes;

    protected $table = 'pharmacy_drug_composition_relationship';

    protected $hidden = ['id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

}
