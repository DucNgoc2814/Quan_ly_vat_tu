<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Facades\Session;

class CheckCustomer
{
    public function handle($request, Closure $next)
    {
        try {
            $token = Session::get('token');
            $dataToken = JWTAuth::setToken($token)->getPayload();
            if (!$token || $dataToken->get('role') != "customer") {
                return redirect()->route('login')->with('authorization', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại');
            } else{
                return $next($request);
            }
        } catch (Exception $e) {
            Session::forget('token');
            return redirect()->route('login')->with('authorization', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại');
        }
    }
}
