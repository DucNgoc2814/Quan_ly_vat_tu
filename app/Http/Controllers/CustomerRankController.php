<?php

namespace App\Http\Controllers;

use App\Models\Customer_rank;
use App\Http\Requests\StoreCustomer_rankRequest;
use App\Http\Requests\UpdateCustomer_rankRequest;
use Illuminate\Support\Facades\DB;

class CustomerRankController extends Controller
{

    const PATH_VIEW = 'admin.components.CustomerRanks.';

    public function index()
    {
        $data = DB::table('customer_ranks')->get();
        return view(self::PATH_VIEW . 'index', compact('data'));
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
    public function store(StoreCustomer_rankRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer_rank $customer_rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer_rank $customer_rank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomer_rankRequest $request, Customer_rank $customer_rank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer_rank $customer_rank)
    {
        //
    }
}
