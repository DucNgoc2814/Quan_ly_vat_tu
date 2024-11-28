<?php

namespace App\Http\Controllers;

use App\Models\Payment_history;
use App\Http\Requests\StorePayment_historyRequest;
use App\Http\Requests\UpdatePayment_historyRequest;
use App\Models\Request;
use Illuminate\Support\Facades\DB;

class PaymentHistoryController extends Controller
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
    public function store(StorePayment_historyRequest $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'note' => 'required|string',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);
    
        try {
            DB::transaction(function () use ($request) {
                $document_path = null;
                if ($request->hasFile('document')) {
                    $document_path = $request->file('document')->store('payment-documents', 'public');
                }
    
                Payment_history::create([
                    'related_id' => $request->contract_id,
                    'transaction_type' => 'contract',
                    'amount' => $request['amount'],
                    'payment_date' => $request['payment_date'],
                    'note' => $request['note'],
                    'document' => $document_path
                ]);
            });
    
            return redirect()->back()->with('success', 'Đã thêm lịch sử chuyển tiền thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment_history $payment_history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment_history $payment_history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayment_historyRequest $request, Payment_history $payment_history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment_history $payment_history)
    {
        //
    }
}
