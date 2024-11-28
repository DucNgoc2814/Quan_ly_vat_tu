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
        $title = "Danh sách xe ";
        $cargo_car = Cargo_car::with('CargoCarType')->get();
        $loai_xe = Cargo_car_type::query()->get();
        return view('admin.components.cargo_cars.index', compact('title', 'cargo_car','loai_xe'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $loai_xe = Cargo_car_type::query()->get();
        $title=" Thêm mới xe ";
        return view('admin.components.cargo_cars.create',compact('title','loai_xe'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCargo_carRequest $request)
    {
        

        if($request->isMethod('POST')){
            // dd($request->all());
            $data = [
                'cargo_car_type_id' => $request->cargo_car_type_id,
                'license_plate' => $request->license_plate,
            ];
            Cargo_car::create($data);
            return redirect()->route('CargoCars.index')->with('success','Thêm xe vận chuyển thành công');

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
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCargo_carRequest $request, string $id)
     {
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        

    }
}
