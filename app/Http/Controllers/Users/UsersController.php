<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Str;
use App\Models\User\UserRoleRelation;
use App\Http\Requests\Users\UpdateLoginInfoRequest;
use App\Http\Requests\Users\UpdateBasicInfoRequest;
use App\Http\Requests\Users\UpdateRoleInfoRequest;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\SearchRequest;
use Carbon\Carbon;


class UsersController extends Controller
{
    public function index(Request $request){

        $role_uuid = $request->query('role', NULL);
        $q = $request->query('q', NULL);
        $users = User::when(($role_uuid), function($query) use ($role_uuid){
            $role = Role::where('uuid',$role_uuid)->first();
            if(empty($role->id)){
                return $query->where('id', '<', 1);
            }
            $user_ids = UserRoleRelation::where('role_id', $role->id)->pluck('user_id')->toArray();
            if(empty($user_ids)){
                return $query->where('id', '<', 1);
            }
            return $query->whereIn('id', $user_ids);

        })->when(($q), function($query) use ($q){
            
            return $query->where('username', 'LIKE' ,'%'.$q.'%')
            ->orWhere('name', 'LIKE' ,'%'.$q.'%')
            ->orWhere('email', 'LIKE' ,'%'.$q.'%')
            ->orWhere('mobile', 'LIKE' ,'%'.$q.'%');

        })->where('id', '<>', 1)->orderBy('name', 'ASC')->paginate(env('PAGINATION_ITEMS_COUNT'));

        $users->appends(['role'=>$role_uuid, 'q' => $q]);

        $roles = Role::orderBy('name', 'ASC')->get();

        return view('users.index', compact('users', 'roles'));
    }

    public function get($uuid){

        $user = User::where('uuid', $uuid)->first();

        return response()->json($user);
    }

    public function create(){
        $user = new User();
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('users.form', compact('user', 'roles'));
    }

    public function edit($uuid){
        $user = User::where('uuid', $uuid)->first();
        $roles = Role::orderBy('name', 'ASC')->get();
        if(empty($user)){
            return redirect()->to('404');
        }
        return view('users.form', compact('user', 'roles'));
    }

    public function store(UserCreateRequest $request){
        $validated = (object) $request->validated();

        if(empty($validated->uuid)){
            $user = new User;
            $user->uuid = Str::uuid();
            $user->created_by = $request->user->id;

        }else{
            $user = User::where('uuid', $validated->uuid)->first();
        }

        if(empty($validated->password)){
            if(empty($validated->uuid)){
                $user->password = Str::random(40);
            }
        }else{
            $user->password = $validated->password;
        }
        $user->gender = $validated->gender;
        $user->username = $validated->username;
        $user->name = $validated->name;
        $user->email = $validated->email;
        $user->mobile = $validated->mobile;
        $user->blocked = !json_decode($validated->active);
        $user->updated_by = $request->user->id;
        if(!empty($validated->dob)){
            $user->dob = Carbon::parse($validated->dob)->format('Y-m-d');
        }
        if(!empty($validated->blood_group)){
            $user->blood_group = $validated->blood_group;
        }
        $user->save();
        $this->set_user_role($request, $user, $validated->role);
        return response()->json(['redirect' => url('/users')]);
    }

    public function set_user_role($request, $user, $role_uuids){
        $role_ids = Role::whereIn('uuid', $role_uuids)->pluck('id')->toArray();
        $user_roles = UserRoleRelation::where('user_id', $user->id)->get();
        foreach($user_roles as $role){
            $role->deleted_by = $request->user->id;
            $role->save();
            $role->delete();
        }
        foreach($role_ids as $role_id){
            $row = new UserRoleRelation;
            $row->user_id = $user->id;
            $row->role_id = $role_id;
            $row->created_by = $request->user->id;
            $row->save();
        }
        return true;
    }



    public function delete($uuid, Request $request){
        $user = User::where('uuid', $uuid)->first();
        if(empty($user)){
            $err = [
                'message' => 'Missing User',
                'errors' => ['Unidentified Username']
            ];
            return response()->json($err, 422);
        }       

        $err = [
            'message' => 'Unauthorized User Access',
            'errors' => ['Unidentified Username']
        ];
        return response()->json($err, 422);
        $user->deleted_by = $request->user->id;
        $user->save();
        $user->delete();
        return response()->json(['redirect' => url('/users')]);
    }


    public function search(SearchRequest $request){
        $validated = $request->validated();
        $q = $validated['q'];
       
        $users = User::where('name', 'like', '%'.$q.'%')
                    ->orWhere('email', 'like', '%'.$q.'%')
                    ->orWhere('mobile', 'like', '%'.$q.'%')
                    ->orWhere('username', 'like', '%'.$q.'%')
                    ->get();
        foreach($users as $user){
            $user->formatted = $user->formatted;
        }

        return response()->json(['users' => $users]);
    }
}
