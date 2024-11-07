/**
 * This is the start of the CheckPermission middleware class. The purpose of this middleware is to check if the current user has the necessary permissions to access a specific functionality in the application.
 */
<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\PermissionRoleEmployeesController;
use Illuminate\Support\Facades\DB;
class CheckPermission
{
    public function handle(Request $request, Closure $next, $permissionId)
    {
        // $token = Session::get('token');
        // $dataToken = JWTAuth::setToken($token)->getPayload();
        // $roleEmployee = $dataToken->get('role');
        // $permissionRoleEmployee = DB::table('permission_role_employees')
        //     ->where('role_employee_id', $roleEmployee)
        //     ->where('permission_id', $permissionId)
        //     ->first();
        // if (!$permissionRoleEmployee) {
        //     return back()->with('authorization', 'Bạn không có quyền truy cập chức năng này');
        // }
        return $next($request);
    }
}
