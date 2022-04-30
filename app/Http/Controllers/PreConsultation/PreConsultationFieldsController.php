<?php

namespace App\Http\Controllers\PreConsultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments\PreconsultationField;
use App\Http\Requests\Appointments\PreconsultationFieldRequest;
use Illuminate\Support\Str;


class PreConsultationFieldsController extends Controller
{
    public function index(){

        $fields = PreconsultationField::orderBy('name', 'ASC')->get();

        return view('preconsultation-fields.index', compact('fields'));
    }


    public function store(PreconsultationFieldRequest $request){
        $validated = (object) $request->validated();
        $field = new PreconsultationField;
        $field->uuid = Str::uuid();
        $field->name = $validated->name;
        $field->type = $validated->type;
        $field->values = $validated->values;
        $field->order = $validated->order;
        $field->created_by = $request->user->id;
        $field->save();

        return response()->json(['redirect' => url('/preconsultation-fields')]);
    }

    public function update(PreconsultationFieldRequest $request){
        $validated = (object) $request->validated();
        $field = PreconsultationField::where('uuid', $validated->uuid)->first();
        $field->name = $validated->name;
        $field->type = $validated->type;
        $field->values = $validated->values;
        $field->order = $validated->order;
        $field->updated_by = $request->user->id;
        $field->save();

        return response()->json(['redirect' => url('/preconsultation-fields')]);
    }

    public function delete($uuid, Request $request){
        $field = PreconsultationField::where('uuid', $uuid)->first();
        if(empty($field)){
            $err = [
                'message' => 'Missing Field',
                'errors' => ['Unidentified Rolename']
            ];
            return response()->json($err, 422);
        }

        // todo: to check if any drug is connected. If yes, drug to be removed
        $field->deleted_by = $request->user->id;
        $field->save();
        $field->delete();
        return response()->json(['redirect' => url('/preconsultation-fields')]);
    }
}
