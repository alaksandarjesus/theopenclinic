<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\UserCustomField;
use App\Http\Requests\Users\UserCustomFieldRequest;
use Illuminate\Support\Str;


class UserCustomFieldsController extends Controller
{
    public function index(){

        $fields = UserCustomField::orderBy('name', 'ASC')->get();

        return view('user-custom-fields.index', compact('fields'));
    }


    public function store(UserCustomFieldRequest $request){
        $validated = (object) $request->validated();
        $field = new UserCustomField;
        $field->uuid = Str::uuid();
        $field->name = $validated->name;
        $field->type = $validated->type;
        $field->values = $validated->values;
        $field->order = $validated->order;
        $field->created_by = $request->user->id;
        $field->save();

        return response()->json(['redirect' => url('/user-custom-fields')]);
    }

    public function update(UserCustomFieldRequest $request){
        $validated = (object) $request->validated();
        $field = UserCustomField::where('uuid', $validated->uuid)->first();
        $field->name = $validated->name;
        $field->type = $validated->type;
        $field->values = $validated->values;
        $field->order = $validated->order;
        $field->updated_by = $request->user->id;
        $field->save();

        return response()->json(['redirect' => url('/user-custom-fields')]);
    }

    public function delete($uuid, Request $request){
        $field = UserCustomField::where('uuid', $uuid)->first();
        if(empty($field)){
            $err = [
                'message' => 'Missing Field',
                'errors' => ['Unidentified Custom Field']
            ];
            return response()->json($err, 422);
        }

        // todo: to check if any drug is connected. If yes, drug to be removed
        $field->deleted_by = $request->user->id;
        $field->save();
        $field->delete();
        return response()->json(['redirect' => url('/user-custom-fields')]);
    }
}
