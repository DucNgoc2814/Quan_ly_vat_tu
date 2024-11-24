<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Models\Employee;
use App\Models\Role_employee;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Exception;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function notFound()
    {
        return view('admin.404');
    }
    public function logOut()
    {
        Session::forget('token');
        return redirect()->route('employees.login')->with('success', 'Đăng xuất thành công');
    }
    public function login()
    {
        return view('admin.components.employees.login');
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
                return redirect()->route('employees.login')->with('error', 'Email hoặc mật khẩu không tồn tại trên hệ thống');
            }
            if (!$employee->is_active) {
                return redirect()->route('employees.login')->with('error', 'Tài khoản đã bị vô hiệu hóa');
            }
            if (!$token = auth()->guard('employee')->attempt($credentials)) {
                return redirect()->route('employees.login')->with('error', 'Thông tin đăng nhập không chính xác');
            }
            Session::put('employee', $employee);
            Session::put('token', $token);
            return redirect('/dashboard');
        } catch (Exception $e) {
            return redirect()->route('employees.login')->with('error', 'Không thể đang nhập thử lại lần sau');
        }
    }

    public function index(Request $request)
    {
        $search = $request->get("search");
        $data = Employee::select('employees.*')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")
                    ->orwhere('name', 'like', "%{$search}%")
                    ->orwhere('cccd', 'like', "%{$search}%")
                    ->orwhere('number_phone', 'like', "%{$search}%");
            })->get();

        $role_empoly = Role_employee::query()->get();
        $employee = Session::get('employee');

        return view('admin.components.employees.index', compact('data', 'role_empoly','employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Role_employee::query()->get();
        return view('admin.components.employees.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->except('_method');
            $params['is_active'] = $request->has('is_active') ? 1 : 0;
            if ($request->hasFile('image')) {
                $params['image'] = $request->file('image')->store('uploads/profile', 'public') ?: null;
            }
            // Mã hóa mật khẩu trước khi lưu
            $params['password'] = bcrypt($params['password']);
            Employee::create($params);
            return redirect()->route('employees.index')->with('success', 'Bạn đã thêm mới thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, String $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $datae = Employee::findOrFail($id);
        $data = Role_employee::query()->get();
        return view('admin.components.employees.edit', compact('datae', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, String $id)
    {
        if ($request->isMethod('put')) {

            // dd($request->all());
            $params = $request->except('_method', '_token');
            $params['is_active'] = $request->has('is_active') ? 1 : 0; // Handle the checkbox state

            $datae = Employee::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($datae->image) {
                    Storage::disk('public')->delete($datae->image);
                }
                $params['image'] = $request->file('image')->store('uploads/profile', 'public') ?: $datae->image;
            }

            $datae->update($params);

            return redirect()->route('employees.index')->with('success', 'Bạn đã cập nhật thành công thành công');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
