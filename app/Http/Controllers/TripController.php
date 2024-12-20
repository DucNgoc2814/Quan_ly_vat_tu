<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Employee;
use App\Models\Cargo_car;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Order;
use App\Models\OrderStatusTime;
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
         $employes = Employee::query()
             ->leftJoin('trips', function ($join) {
                 $join->on('employees.id', '=', 'trips.employee_id')
                     ->where('trips.status', '=', 1);
             })
             ->whereNull('trips.id')
             ->where('employees.role_id', '=', 3)
             ->where('employees.is_active', '=', 1)
             ->select('employees.*')
             ->get();

         $cargoCars = Cargo_car::whereDoesntHave('trips', function($query) {
                 $query->where('status', 1);
             })
             ->where('role', 0)
             ->with('cargoCarType')
             ->get();
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

            $cargo_car = Cargo_car::findOrFail($request->cargo_car_id);
            $cargo_car->update(['role' => 1]);

            $orderIds = $request->input('order_id', []);
            foreach ($orderIds as $orderId) {
                $order = Order::findOrFail($orderId);
                Trip_detail::create([
                    'trip_id' => $trip->id,
                    'order_id' => $order->id,
                    'total_amount' => $order->total_amount,
                ]);

                OrderStatusTime::create([
                    'order_id' => $order->id,
                    'order_status_id' => 3,
                ]);
                $order->update(['status_id' => 3]);
            }

            DB::commit();
            return redirect()->route('trips.index')->with('success', 'Thêm đơn vận chuyển thành công');
        } catch (\Exception $th) {
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
