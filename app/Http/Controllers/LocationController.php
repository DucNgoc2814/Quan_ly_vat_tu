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

        // Trả về thông tin địa chỉ đã được thiết lập làm mặc định
        return response()->json([
            'success' => true,
            'message' => 'Thiết lập mặc định thành công',
            'data' => [
                'customer_name' => $location->customer_name,
                'number_phone' => $location->number_phone,
                'email' => $location->email,
                'address' => $location->address,
                'province' => $location->province,
                'district' => $location->district,
                'ward' => $location->ward,
            ]
        ]);
    }
    public function getLocation($id) {
        $location = Location::find($id);
        return response()->json($location);
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
    public function destroy($id)
    {
        $location = Location::find($id);

        if ($location) {
            $location->delete(); // Xóa mềm bản ghi
            return response()->json(['success' => true, 'message' => 'Địa chỉ đã được xóa.']);
        }

        return response()->json(['success' => false, 'message' => 'Địa chỉ không tồn tại.']);
    }
}
