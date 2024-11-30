<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Support\Facades\DB;

class PermissionRoleEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission_role_employees = DB::table("permission_role_employees")->get();
        $permissions = DB::table("permissions")->get();
        $role_employees = DB::table("role_employees")->get();
        return view('admin.components.permissions.home-permissions', compact('permissions', 'role_employees', 'permission_role_employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function permissionsToggle()
    {
        $role_id = request('role_id');
        $permission_id = request('permission_id');
        $exists = DB::table('permission_role_employees')
            ->where('role_employee_id', $role_id)
            ->where('permission_id', $permission_id)
            ->exists();
        if ($exists) {
            DB::table('permission_role_employees')
                ->where('role_employee_id', $role_id)
                ->where('permission_id', $permission_id)
                ->delete();
        } else {
            DB::table('permission_role_employees')->insert([
                'role_employee_id' => $role_id,
                'permission_id' => $permission_id
            ]);
            toastr()->success('Cấp quyền thành công!');
        }
        return response()->json(['success' => true]);
    }

}
