<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Facades\Session;

class CheckAuthUser
{
    public function handle($request, Closure $next)
    {
        try {
            $token = Session::get('token');
            if (!$token) {
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập');
            }
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                Session::forget('token');
                return redirect()->route('login')->with('error', 'Phiên đăng nhập không hợp lệ');
            }
        } catch (Exception $e) {
            Session::forget('token');
            return redirect()->route('login')->with('error', 'Phiên đăng nhập đã hết hạn');
        }
        return $next($request);
    }
}
