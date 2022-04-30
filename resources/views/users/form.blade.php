@extends('layouts.top-nav')

@section('content')
<div class="container">
    <form class="flex justify-center items-center user">
        <input type="hidden" class="uuid" value="{{$user->uuid}}">
        <div class="w-full lg:w-1/2">
            <h4 class="text-slate-900 text-xl font-medium my-3">{{$user->uuid?'Edit':'Create'}} User</h4>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Name</label>
                        <input type="text" name="name"  class="block w-full name" autocomplete="current-name"
                            autofocus value="{{$user->name}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Gender</label>
                        <select name="gender" class="form-select w-full gender">
                            <option value="">Select Gender</option>
                            <option value="m" {{$user->gender === 'm'?'selected':''}}>Male</option>
                            <option value="f" {{$user->gender === 'f'?'selected':''}}>Female</option>
                            <option value="o" {{$user->gender === 'o'?'selected':''}}>Other</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Username</label>
                        <input type="text" name="username" class="block w-full username"
                            autocomplete="current-username" value="{{$user->username}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Email</label>
                        <input type="text" name="email" class="block w-full email"
                            autocomplete="current-email" value="{{$user->email}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Mobile</label>
                        <input type="text" name="mobile"  class="block w-full mobile"
                            autocomplete="current-mobile" value="{{$user->mobile}}">
                    </div>
                </div>
                <div>
                <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Date of Birth</label>
                        <input type="text" name="dob"  class="block w-full dob" autocomplete="current-dob"
                            value="{{$user->dob?$user->formatted->dob:''}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Blood Group</label>
                        <select name="blood-group" class="form-select w-full blood-group">
                            <option value="">Select Blood Group</option>
                            <option value="O+" {{$user->blood_group === 'O+'?'selected':''}}>O+</option>
                            <option value="O-" {{$user->blood_group === 'O-'?'selected':''}}>O-</option>
                            <option value="A+" {{$user->blood_group === 'A+'?'selected':''}}>A+</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                    
                        <label for="" class="block mb-1 font-medium">Role</label>
                        <select name="role" class="form-select w-full role" multiple>
                            @foreach($roles as $role)
                            <option value="{{$role->uuid}}" {{$user->has_role($role->name)?'selected':''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                        <div class="text-sm font-normal text-gray-400">Ctrl+Click to select multiple roles</div>

                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="block mb-1 font-medium">Password</label>
                        <input type="text" name="password" value="" class="block w-full password"
                            autocomplete="current-password">
                        <div class="text-sm font-normal text-gray-400">Leave empty to generate random password</div>
                    </div>
                    <div>
                        <label for="active">
                            <input type="checkbox" id="active" name="active" class="active mr-2" {{$user->blocked?'':'checked'}}>Active
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-center">
                <button
                    class="bg-emerald-800 hover:bg-emerald-900 text-white float-right px-4 py-2 shadow-lg btn-submit">Submit</button>
            </div>
        </div>
    </form>
</div>


@endsection