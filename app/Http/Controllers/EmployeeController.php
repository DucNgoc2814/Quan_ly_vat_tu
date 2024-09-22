<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role_employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            })->paginate(5);

        $role_empoly = Role_employee::query()->get();
        return view('admin.components.employees.index', compact('data', 'role_empoly'));
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
            if ($request->hasFile('image')) {
                $params['image'] = $request->file('image')->store('uploads/profile', 'public') ?: null;
            }
            Employee::create($params);
            return redirect()->route('danh-sach-nhan-vien')->with('success', 'Bạn đã thêm mới thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
