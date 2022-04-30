<?php

namespace App\Models\Pharmacy;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pharmacy\DrugCompositionRelationship;
use App\Models\Pharmacy\Composition;

class Drug extends Model
{
    use SoftDeletes;

    protected $table = 'pharmacy_drugs';

    protected $hidden = ['id','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];


    public function getCompositionsAttribute(){

        $composition_ids = DrugCompositionRelationship::where('drug_id', $this->id)->pluck('composition_id')->toArray();
       
        if(empty($composition_ids)){

            return[];
            
        }
        $compositions = Composition::whereIn('id', $composition_ids)->get();

        return $compositions;
    }

    public function category(){

        return $this->hasOne('App\Models\Pharmacy\Category', 'id', 'category_id');
    }
}
