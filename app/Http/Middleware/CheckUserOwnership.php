<?php

namespace App\Http\Middleware;

use App\Models\Trip_detail;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckUserOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    $id = $request->route('id');
    $employee = Session::get('employee');
    if (!$employee) {
        return redirect()->route('orderconfirm.login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
    }
    $order = Trip_detail::whereHas('trip', function ($query) use ($id) {
        $query->where('id', $id);
    })->first();

    if (!$order || $order->trip->employee_id != $employee->id) {
        return redirect()->route('orderconfirm.index')->with('error', 'Bạn không có quyền truy cập vào tài nguyên này');
    }

    return $next($request);
}

}
