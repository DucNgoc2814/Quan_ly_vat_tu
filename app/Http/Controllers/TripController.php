<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Employee;
use App\Models\Cargo_car;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Order;
use App\Models\Trip_detail;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin/components/trips/';
    
    public function index()
    {
        $trips =  Trip::with(['cargoCar', 'employee'])->get();
        return view(self::PATH_VIEW . 'index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function create()
    {
        $employes = Employee::where('role_id', 4)->get();
        $cargoCars = Cargo_car::where('is_active', 0)->with('cargoCarType')->get();
        $pendingOrders = Order::where('status_id', 2)->with('orderDetails')->get();
        return view(self::PATH_VIEW . 'create', compact('employes', 'cargoCars', 'pendingOrders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        try {
            DB::beginTransaction();
            $trip = Trip::create([
                'cargo_car_id' => $request->cargo_car_id,
                'employee_id' => $request->employee_id,
                'status' => '1',
            ]);

            $orderIds = $request->input('order_id', []);
            foreach ($orderIds as $orderId) {
                $order = Order::findOrFail($orderId);
                $cargor_car = Cargo_car::findOrFail($request->cargo_car_id);
                Trip_detail::create([
                    'trip_id' => $trip->id,
                    'order_id' => $order->id,
                    'total_amount' => $order->total_amount,
                ]);

                // Update order status
                $order->update(['status_id' => 3]);
                $cargor_car->update(['is_active' => 1]);
            }

            DB::commit();
            return redirect()->route('trips.index')->with('success', 'Thêm đơn vận chuyển thành công');
        } catch (\Exception $th) {
            // echo $th->getMessage();
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi: ' . $th->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
