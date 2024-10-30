<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Facades\Session;
class CheckAuthAdmin
{
    public function handle($request, Closure $next)
    {
        try {
            $token = Session::get('token');
            if (!$token) {
                return redirect()->route('employees.notfound')->with('error', 'backLogin');
            }
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                Session::forget('token');
                return redirect()->route('employees.notfound')->with('error', 'backLogin');
            }
        } catch (Exception $e) {
            Session::forget('token');
            return redirect()->route('employees.notfound')->with('error', 'backLogin');
        }
        return $next($request);
    }
}
