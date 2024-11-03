<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Facades\Session;

class CheckEmployees
{
    public function handle($request, Closure $next)
    {
        try {
            $token = Session::get('token');
            $dataToken = JWTAuth::setToken($token)->getPayload();
            if (!$token || $dataToken->get('role') == null || $dataToken->get('role') == "customer") {
                return redirect()->route('employees.login')->with('authorization', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại');
            }
            return $next($request);
        } catch (Exception $e) {
            Session::forget('token');
            return redirect()->route('employees.login')->with('authorization', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại');
        }
    }
}
