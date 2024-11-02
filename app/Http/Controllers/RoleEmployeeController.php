<?php

namespace App\Http\Controllers;

use App\Models\Role_employee;
use App\Http\Requests\StoreRole_employeeRequest;
use App\Http\Requests\UpdateRole_employeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wage' => 'required|numeric|min:0'
        ]);
        $data = [
            "name"=>$request->name,
            "wage"=>$request->wage,
        ];
        DB::table("role_employees")->insert($data);
        return redirect()->route('listPermissions')->with('success', 'Thêm quyền thành công');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRole_employeeRequest $request)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function show(Role_employee $role_employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role_employee $role_employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRole_employeeRequest $request, Role_employee $role_employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role_employee $role_employee)
    {
        //
    }
}
