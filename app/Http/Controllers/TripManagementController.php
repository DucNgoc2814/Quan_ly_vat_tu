<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\LoginAdminRequest;
use App\Models\Order;
use App\Models\OrderStatusTime;
use App\Models\Role_employee;
use App\Models\Trip;
use App\Models\Trip_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class TripManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function notFound()
    {
        return view('admin.404');
    }
    public function login()
    {
        return view('admin.components.tripmanagement.login');
    }
    public function loginPost(LoginAdminRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        try {
            $employee = Employee::where('email', $request->email)->first();
            if (!$employee) {
                return redirect()->route('orderconfirm.login')->with('error', 'Email hoặc mật khẩu không tồn tại trên hệ thống');
            }
            if (!$employee->is_active) {
                return redirect()->route('orderconfirm.login')->with('error', 'Tài khoản đã bị vô hiệu hóa');
            }
            // Kiểm tra thông tin đăng nhập
            if (!password_verify($request->password, $employee->password)) {
                return redirect()->route('orderconfirm.login')->with('error', 'Thông tin đăng nhập không chính xác');
            }

            // Lưu thông tin người dùng vào session
            Session::put('employee', $employee);

            return redirect()->route('orderconfirm.index')->with('success', 'Đăng nhập thành công');
        } catch (Exception $e) {
            return redirect()->route('orderconfirm.login')->with('error', 'Không thể đăng nhập, thử lại lần sau');
        }
    }


    public function index()
    {
        if (!Session::has('employee')) {
            return redirect()->route('orderconfirm.login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }
        $employee = Session::get('employee');
        // dd($employee);
        $trips = Trip::where('employee_id', $employee->id)->get();

        return view('admin.components.tripmanagement.index', compact('employee', 'trips'));
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        if (!Session::has('employee')) {
            return redirect()->route('orderconfirm.login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }
        $data = Trip_detail::whereHas('trip', function ($query) use ($id) {
            $query->where('id', $id);
        })->with(['order', 'trip'])->get();
        return view('admin.components.tripmanagement.detail', compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        if ($order) {
            OrderStatusTime::create([
                'order_id' => $order->id,
                'order_status_id' => 4,
                // 'time' => now()
            ]);
            $order->update(['status_id' => 4]);

            $tripDetail = Trip_detail::where('order_id', $order->id)->first();
            if ($tripDetail) {
                $trip = Trip::find($tripDetail->trip_id);
                if ($trip) { // Check if the trip exists
                    $uncompletedOrders = Trip_detail::where('trip_id', $trip->id)
                        ->whereHas('order', function ($query) {
                            $query->where('status_id', '!=', 4);
                        })
                        ->count();

                    if ($uncompletedOrders === 0) {
                        $updated = $trip->update(['status' => 2]);
                        if ($updated) {
                            // Update cargoCar is_active to 0
                            $cargoCar = $trip->cargoCar; // Assuming a relationship exists in Trip model
                            if ($cargoCar) {
                                $cargoCar->update(['is_active' => 0]);
                            }
                        } else {
                            return back()->with('error', 'Không thể cập nhật trạng thái chuyến đi');
                        }
                    }
                } else {
                    return back()->with('error', 'Không tìm thấy chuyến đi');
                }
            }
        }

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }



    public function dashboard()
    {
        return view('admin.dashboardnv');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
