<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permissionId)
    {
        dd($permissionId);
        return $next($request);
    }
}
