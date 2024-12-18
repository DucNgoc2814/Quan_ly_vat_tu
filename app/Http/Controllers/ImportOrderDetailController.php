<?php

namespace App\Http\Controllers;

use App\Models\Import_order_detail;
use App\Http\Requests\StoreImport_order_detailRequest;
use App\Http\Requests\UpdateImport_order_detailRequest;
use App\Models\Employee;
use App\Models\Payment;
use App\Models\Payment_history;

class ImportOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.import_order_details.';
    public function index($slug)
    {
        $data = Import_order_detail::whereHas('importOrder', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with(['importOrder', 'variation'])->get();
        $employees = Employee::where('role_id', '!=', '1')
        ->where('is_active', 1)
        ->select('id', 'name')
        ->get();
        $payments = Payment::pluck('name', 'id');
        $paymentHistories = Payment_history::where('related_id', $data->first()->import_order_id)->where('transaction_type', 'purchase')->get();
        return view(self::PATH_VIEW . __FUNCTION__, data: compact('data', 'payments', 'paymentHistories', 'employees'));
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
    public function store(StoreImport_order_detailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Import_order_detail $import_order_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Import_order_detail $import_order_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImport_order_detailRequest $request, Import_order_detail $import_order_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Import_order_detail $import_order_detail)
    {
        //
    }
}
