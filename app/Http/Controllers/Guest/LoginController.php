<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\LoginRequest;
use App\Models\User\User;

class LoginController extends Controller
{
    public function index(){
        
        return view('guest.login.index');
    }

    public function attempt(LoginRequest $request){

        $validated = (object)$request->validated();

        $user = User::where('username', $validated->username)->first();

        $verify = $user->verify_password($validated->password);

        if(!$verify){
            $response = [
                'message' => 'Login Failed',
                'errors' => ['Username and password does not match']
            ];

            return response()->json($response, 422);
        }

        if($user->blocked){
            $response = [
                'message' => 'User Blocked',
                'errors' => ['User blocked for access. Contact Administrator']
            ];

            return response()->json($response, 422);
        }

        session()->put('user', $user);
        $redirect = url('dashboard');
        return response()->json(['redirect' => $redirect]);
    }

    public function logout(){
        session()->flush();
        return redirect()->to('/');
    }
}
