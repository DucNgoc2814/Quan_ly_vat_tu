<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getLocationsByCustomerId($customer_id)
    {
        $locations = Location::where('customer_id', $customer_id)->get();
        return response()->json($locations);
    }
    public function setDefaultAddress(Request $request)
    {
        $locationId = $request->input('location_id');

        // Lấy thông tin location được chọn
        $location = Location::findOrFail($locationId);

        // Đặt tất cả các địa chỉ của customer_id hiện tại thành không mặc định
        Location::where('customer_id', $location->customer_id)->update(['is_active' => 0]);

        // Cập nhật địa chỉ được chọn thành mặc định
        $location->is_active = 1;
        $location->save();

        return response()->json(['success' => true, 'message' => 'Thiết lập mặc định thành công']);
    }


    public function getLocationsByCustomerIdIsactive($customerId)
    {
        // Lấy tất cả các location của customer có isactive = 1
        $locations = Location::where('customer_id', $customerId)
                              ->where('isactive', 1)
                              ->get();

        return response()->json($locations);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
