<?php

namespace App\Http\Controllers;

use App\Models\Order_status;
use App\Http\Requests\StoreOrder_statusRequest;
use App\Http\Requests\UpdateOrder_statuRequest;

class OrderStatusController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrder_statusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order_status $order_statu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order_status $order_statu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrder_statuRequest $request, Order_status $order_statu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order_status $order_statu)
    {
        //
    }
}
