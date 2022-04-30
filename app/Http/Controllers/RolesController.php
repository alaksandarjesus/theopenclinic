<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Str;
use App\Models\User\UserRoleRelation;

class RolesController extends Controller
{
    public function index(){

        $roles = Role::orderBy('name', 'ASC')->get();

        return view('roles.index', compact('roles'));
    }

    public function get($uuid){

        $role = Role::where('uuid', $uuid)->first();

        return response()->json($role);
    }

    public function store(RoleRequest $request){
        $validated = (object) $request->validated();
        $role = new Role;
        $role->uuid = Str::uuid();
        $role->name = $validated->name;
        $role->created_by = $request->user->id;
        $role->save();

        return response()->json(['redirect' => url('/roles')]);
    }

    public function update(RoleRequest $request){
        $validated = (object) $request->validated();
        $role = Role::where('uuid', $validated->uuid)->first();
        $role->name = $validated->name;
        $role->updated_by = $request->user->id;
        $role->save();

        return response()->json(['redirect' => url('/roles')]);
    }

    public function delete($uuid, Request $request){
        $role = Role::where('uuid', $uuid)->first();
        if(empty($role)){
            $err = [
                'message' => 'Missing Role',
                'errors' => ['Unidentified Rolename']
            ];
            return response()->json($err, 422);
        }
        $user_role_relation_count = UserRoleRelation::where('role_id', $role->id)->count();
        if($user_role_relation_count){
            $err = [
                'message' => 'Role mapped to user',
                'errors' => ['Role is mapped to a user']
            ];
            return response()->json($err, 422);
        }
        $role->deleted_by = $request->user->id;
        $role->save();
        $role->delete();
        return response()->json(['redirect' => url('/roles')]);
    }
}
