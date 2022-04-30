<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RouteLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $url = $request->fullUrl();
        $name = 'guest';
        $id = '0';
        if (session()->has('user')) {
            $userObj = session()->get('user');
            $name = $userObj->name;
            $id = $userObj->id;
        }

        Log::info('User: ' . $name . ' with id: ' . $id . ' accessed url: ' . $url);

        return $next($request);
    }
}
