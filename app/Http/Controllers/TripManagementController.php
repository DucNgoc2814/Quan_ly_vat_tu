<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\LoginAdminRequest;
use App\Models\Contract;
use App\Models\Order;
use App\Models\OrderStatusTime;
use App\Models\Payment;
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
    public function logOut()
    {
        try {
            // Forget the employee session
            Session::forget('employee');

            // Optionally, you can also clear all session data
            Session::flush(); // Clear all session data, including employee session if needed

            // Redirect to the login page with a success message
            return redirect()->route('orderconfirm.login')->with('success', 'Đăng xuất thành công');
        } catch (Exception $e) {
            // If there is any issue during logout
            return redirect()->route('orderconfirm.login')->with('error', 'Có lỗi xảy ra, thử lại sau');
        }
    }

    public function loginPost(LoginAdminRequest $request)
    {
        try {
            // Kiểm tra thông tin đăng nhập
            $employee = Employee::where('email', $request->email)->first();
            
            if (!$employee || !password_verify($request->password, $employee->password)) {
                return redirect()->route('orderconfirm.login')
                    ->with('error', 'Thông tin đăng nhập không chính xác');
            }

            // Kiểm tra điều kiện
            if (!$employee->is_active) {
                return redirect()->route('orderconfirm.login')
                    ->with('error', 'Tài khoản đã bị vô hiệu hóa');
            }

            if ($employee->role_id != 3) {
                return redirect()->route('orderconfirm.login')
                    ->with('error', 'Bạn không có quyền truy cập');
            }

            // Tạo token JWT với custom claims
            $token = JWTAuth::customClaims([
                'sub' => $employee->id,
                'email' => $employee->email,
                'role' => $employee->role_id
            ])->fromUser($employee);

            // Verify token trước khi lưu
            JWTAuth::setToken($token)->check();

            // Lưu token và thông tin employee vào session
            Session::put([
                'token' => $token,
                'employee' => $employee
            ]);

            return redirect()->route('orderconfirm.index')
                ->with('success', 'Đăng nhập thành công');

        } catch (JWTException $e) {
            return redirect()->route('orderconfirm.login')
                ->with('error', 'Không thể đăng nhập, thử lại lần sau');
        }
    }


    public function index()
    {
        if (!Session::has('employee')) {
            return redirect()->route('orderconfirm.login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }
        $employee = Session::get('employee');
        if ($employee->role_id != 3) {
            return redirect()->route('orderconfirm.login')->with('error', 'Bạn không có quyền truy cập');
        }

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
        $payments = Payment::pluck('name', 'id');

        return view('admin.components.tripmanagement.detail', compact('data', 'payments'));
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
                                $cargoCar->update(['role' => 0]);
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
        if ($order->contract_id) {
            $contract = Contract::find($order->contract_id);
            if ($contract) {
                $contractController = new \App\Http\Controllers\ContractController();
                $contractController->checkAndUpdateContractStatus($contract);
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
