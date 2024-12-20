<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use App\Http\Requests\StoreOrder_detailRequest;
use App\Http\Requests\UpdateOrder_detailRequest;
use App\Models\Employee;
use App\Models\Payment;
use App\Models\Payment_history;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.order_details.';

    public function index($slug)
    {
        $data = Order_detail::whereHas('order', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with(['order', 'variations'])->get();
        if ($data->first() == null) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
        }
        $employees = Employee::where('role_id', '!=', '1')
            ->where('is_active', 1)
            ->select('id', 'name')
            ->get();
        $payments = Payment::pluck('name', 'id');
        $paymentHistories = Payment_history::where('related_id', $data->first()->order_id)
        ->where(function($query) {
            $query->where('transaction_type', 'sale')
                  ->orWhere('transaction_type', 'refund');
        })
        ->get();
        return view(self::PATH_VIEW . __FUNCTION__, data: compact('data', 'paymentHistories', 'employees', 'payments'));
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
    public function store(StoreOrder_detailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order_detail $order_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order_detail $order_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrder_detailRequest $request, Order_detail $order_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order_detail $order_detail)
    {
        //
    }
}
