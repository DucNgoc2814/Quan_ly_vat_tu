<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class CheckJWTAuth
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['message' => 'Người dùng chưa đăng nhập'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Chưa đăng nhập'], 401);
        }
        return $next($request);
    }
}
