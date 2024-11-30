<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Models\Employee;
use App\Models\Role_employee;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\DB;
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
            session([
                'employee_id' => $employee->id,
                'token' => $token
            ]);
            return redirect('/dashboard');
        } catch (Exception $e) {
            return redirect()->route('employees.login')->with('error', 'Không thể đang nhập thử lại lần sau');
        }
    }

    public function index(Request $request)
    {
        $data = Employee::all();
        $role_empoly = Role_employee::query()->get();
        $employee = Session::get('employee');
        return view('admin.components.employees.index', compact('data', 'role_empoly', 'employee'));
    }
    public function changeQuyen($idquyen,$idStaff) {
        DB::table('permission_employees')->insert([
            'employee_id' => $idStaff,
            'permission_id' => $idquyen,
        ]);
        return redirect()->back()->with('success', 'Đã cập nhật quyền thành công');
    }
    // EmployeeController.php

    public function deletePermission($permission_id, $employee_id)
    {
        // Xóa bản ghi trong bảng permission_employees
        $deletedRows = DB::table('permission_employees')
        ->where('permission_id', $permission_id)
            ->where('employee_id', $employee_id)
            ->delete();

        if ($deletedRows > 0) {
            return response()->json(['message' => 'Permission deleted successfully']);
        } else {
            return response()->json(['message' => 'Permission not found'], 404);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $existingRole = Employee::where('role_id', 1)->exists();
        if ($existingRole) {
            $data = Role_employee::where('id', '!=', 1)->get();
        } else {
            $data = Role_employee::all();
        }
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
    public function show(Employee $employee, String $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $listpermission_employees = DB::table('permission_employees')
        ->join('permissions', 'permission_employees.permission_id', '=', 'permissions.id')
        ->where('employee_id', $id)
        ->get();
        $arrCheck = [];
        foreach ($listpermission_employees as $item) {
            $arrCheck[] = $item->id;
        }
        $listPermission= Permission::whereNotIn('id', $arrCheck)->get();
        $datae = Employee::findOrFail($id);
        $isCEO = $datae->role_id == 1;
        if ($isCEO) {
            $data = Role_employee::query()->get();
        } else {
            $data = Role_employee::where('id', '!=', 1)->get();
        }
        return view('admin.components.employees.edit', compact('datae', 'data', 'isCEO', 'listPermission', 'listpermission_employees'));
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
