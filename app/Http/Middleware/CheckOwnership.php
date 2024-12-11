<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use App\Models\Contract;
use App\Models\Import_order;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;

class CheckOwnership
{
    public function handle($request, Closure $next)
    {
        try {
            $token = Session::get('token');
            $payload = JWTAuth::setToken($token)->getPayload();
            $role = $payload->get('role');
            $userId = $payload->get('id');
            if ($role == '1') {
                return $next($request);
            }

            $orderSlug = $request->route('slug');
            $importOrderSlug = $request->route('slug');
            $contract_number = $request->route('id');

            // Kiểm tra đơn hàng xuất
            if ($orderSlug && $request->is('don-hang/*')) {
                $order = Order::where('slug', $orderSlug)->firstOrFail();
                if ($order->employee_id !== $userId) {
                    return redirect()->back()
                        ->with('error', 'Không có quyền truy cập đơn hàng này');
                }
            }

            // Kiểm tra đơn hàng nhập
            if ($importOrderSlug && $request->is('don-hang-nhap/*')) {
                $importOrder = Import_order::where('slug', $importOrderSlug)->firstOrFail();
                if ($importOrder->employee_id !== $userId) {
                    return redirect()->back()
                        ->with('error', 'Không có quyền truy cập đơn nhập này');
                }
            }

            // Kiểm tra hợp đồng  
            if ($contract_number && $request->is('hop-dong/*')) {
                $contract = Contract::where('id', $contract_number)->firstOrFail();
                if ($contract->employee_id !== $userId) {
                    return redirect()->back()
                        ->with('error', 'Không có quyền truy cập hợp đồng này');
                }
            }

            return $next($request);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Lỗi xác thực, vui lòng thử lại');
        }
    }
}
