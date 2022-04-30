<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $args = '')
    {


        $user = session()->get('user');
        
        if (empty($user)) {

            if (!$request->expectsJson()) {
                
                return redirect()->to('/');

            }
            return response()->json(['redirect' => url('/')]);
        }
       
        if (empty($args) || $user->is_super_administrator) {

            $request->request->add(['user' => $user]);

            return $next($request);
        }

        $args_exploded = explode('|', $args);

        $args_trimmed = array_map(function ($role) {
            return trim($role);
        }, $args_exploded);

        $authorized = false;

        foreach ($args_trimmed as $arg) {
            if ($arg === 'administrator' && $user->is_administrator) {
                $authorized = true;
            }
            if ($arg === 'doctor' && $user->is_doctor) {
                $authorized = true;
            }
            if ($arg === 'frontdesk' && $user->is_front_desk) {
                $authorized = true;
            }
            if ($arg === 'pharmacist' && $user->is_pharmacist) {
                $authorized = true;
            }
            if ($arg === 'patient' && $user->is_patient) {
                $authorized = true;
            }
        }

        if ($authorized) {

            $request->request->add(['user' => $user]);
            
            return $next($request);
        }

        if (!$request->expectsJson()) {

            return redirect()->to('404?unauthorized=true');

        }
        $response = [
            'message' => 'Unauthorized Access',
            'errors' => ['You are not authorized to perform this action'],
        ];

        return response()->json($response, 422);
    }
}
