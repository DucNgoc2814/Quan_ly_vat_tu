<?php

namespace App\Http\Controllers;

use App\Models\Cargo_car;
use App\Http\Requests\StoreCargo_carRequest;
use App\Http\Requests\UpdateCargo_carRequest;
use App\Models\Cargo_car_type;

class CargoCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách xe vận chuyển";
        $cargo_cars = Cargo_car::with('CargoCarType')->get();
        $loai_xe = Cargo_car_type::query()->get();
        return view('admin.components.cargo_cars.index', compact('title', 'cargo_cars','loai_xe'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $loai_xe = Cargo_car_type::query()->get();
        $title=" Thêm mới xe vận chuyển";
        return view('admin.components.cargo_cars.create',compact('title','loai_xe'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCargo_carRequest $request)
    {
        //
        if($request->isMethod('POST')){
            // dd($request->all());
            $data = [
                'cargo_car_type_id' => $request->cargo_car_type_id,
                'license_plate' => $request->license_plate,
                'is_active' => $request->is_active
            ];
            Cargo_car::create($data);
            return redirect()->route('index')->with('success','Thêm xe vận chuyển thành công');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Cargo_car $cargo_car)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cargo_car $id)
    {
        $title = "Cập nhập xe vận chuyển";
        $loai_xe = Cargo_car_type::query()->get();
        return view('admin.components.cargo_cars.edit',compact('title','loai_xe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCargo_carRequest $request, Cargo_car $id)
    {
       if($request->isMethod('PUT')){
        $cargo_car = Cargo_car::find($id);
        $data = [
            'cargo_car_type_id' => $request->cargo_car_type_id,
            'license_plate' => $request->license_plate,
            'is_active' => $request->is_active
        ];
        $cargo_car->update($data);

       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cargo_car $cargo_car)
    {
        //
    }
}
