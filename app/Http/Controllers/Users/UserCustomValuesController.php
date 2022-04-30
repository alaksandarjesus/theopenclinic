<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UserCustomValueRequest;
use App\Models\User\UserCustomValue;
use App\Models\User\UserCustomField;
use App\Models\User\User;

class UserCustomValuesController extends Controller
{
    
    public function save(UserCustomValueRequest $request){

        $validated = (object)$request->validated();

        $user = User::where('uuid', $validated->user_uuid)->first();

        UserCustomValue::where('user_id', $user->id)->update(['deleted_by' => $request->user->id]);
        UserCustomValue::where('user_id', $user->id)->delete();

        foreach($validated->fields as $field){
            $field = (object)$field;

            $fieldObj = UserCustomField::where('uuid', $field->uuid)->first();
            $row = new UserCustomValue();
            $row->user_id = $user->id;
            $row->user_custom_field_id = $fieldObj->id;
            $row->value = $field->value;
            $row->created_by = $request->user->id;
            $row->save();
        }

        return response()->json(['reload' => true]);
    }
}
