<?php

namespace App\Http\Controllers;

use App\Models\Cargo_car_type;
use App\Http\Requests\StoreCargo_car_typeRequest;
use App\Http\Requests\UpdateCargo_car_typeRequest;
use Illuminate\Support\Facades\DB;

class CargoCarTypeController extends Controller
{
    const PATH_VIEW = 'admin.components.cargo_car_types.';
    public function index()
    
    {
        $data = DB::table('cargo_car_types')->get();
        return view(self::PATH_VIEW . 'index', compact('data')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCargo_car_typeRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Cargo_car_type $cargo_car_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cargo_car_type $cargo_car_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCargo_car_typeRequest $request, Cargo_car_type $cargo_car_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cargo_car_type $cargo_car_type)
    {
        //
    }
}
