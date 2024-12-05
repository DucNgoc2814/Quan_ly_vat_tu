<?php

namespace App\Http\Controllers;

use App\Models\Payment_history;
use App\Traits\PaymentTrait;
use App\Http\Requests\StorePayment_historyRequest;
use App\Http\Requests\UpdatePayment_historyRequest;
use App\Models\Contract;
use App\Models\Order;
use App\Models\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentHistoryController extends Controller
{
    use PaymentTrait;

    const PATH_VIEW = 'admin.components.payment_histories.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment_history::where('status', 1)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('payments'));
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


        try {
            DB::transaction(function () use ($request) {
                if ($request->transaction_type == 'contract') {
                    $contract = Contract::findOrFail($request->related_id);
                    if ($contract->contract_status_id != 6) {
                        return back()->with('error', 'Chỉ có thể tạo lịch sử thanh toán khi hợp đồng đã được khách hàng xác nhận');
                    }
                }
                if ($request->transaction_type === 'sale') {
                    $order = Order::findOrFail($request->related_id);
                    if ($order->contract_id !== null) {
                        throw new \Exception("Không thể chuyển tiền cho đơn hàng hợp đồng.");
                    }
                }
                if ($request->transaction_type === 'contract') {
                    Contract::findOrFail($request->related_id);
                }

                $remainingAmount = $this->getRemainingAmount($request->transaction_type, $request->related_id);
                if ($request->amount > $remainingAmount) {
                    throw new \Exception("Số tiền thanh toán (" . number_format($request->amount) . " VNĐ) lớn hơn số tiền còn thiếu (" . number_format($remainingAmount) . " VNĐ)");
                }

                // Xử lý document nếu có
                $document_path = null;
                if ($request->hasFile('document')) {
                    $document_path = $request->file('document')->store('payment-documents', 'public');
                }

                Payment_history::create([
                    'related_id' => $request->related_id,
                    'transaction_type' => $request->transaction_type,
                    'amount' => $request->amount,
                    'payment_date' => $request->payment_date,
                    'note' => $request->note,
                    'document' => $document_path,
                    'payment_id' => $request->payment_id
                ]);
            });

            return redirect()->back()->with('success', 'Đã thêm lịch sử chuyển tiền thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function confirm($id)
    {
        Log::info('Payment confirmation started', ['id' => $id]);

        try {
            DB::beginTransaction();
            $payment = Payment_history::find($id);
            if (!$payment) {
                throw new \Exception('Không tìm thấy giao dịch');
            }
            Log::info('Found payment', ['payment' => $payment->toArray()]);
            if ($payment->status == 1) {
                throw new \Exception('Giao dịch này đã được xác nhận trước đó');
            }

            // Cập nhật số ti��n của customer
            $customer = null;
            if ($payment->transaction_type === 'sale') {
                $order = Order::findOrFail($payment->related_id);
                $customer = $order->customer;
            } elseif ($payment->transaction_type === 'contract') {
                $contract = Contract::findOrFail($payment->related_id);
                $customer = $contract->customer;
            }

            if ($customer) {
                $customer->total_amount += $payment->amount;
                $customer->save();
            }

            $payment->status = 1;
            if (!$payment->save()) {
                throw new \Exception('Không thể cập nhật trạng thái thanh toán');
            }

            $this->updatePaidAmount(
                $payment->transaction_type,
                $payment->related_id,
                $payment->amount
            );

            Log::info('Payment updated successfully');
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xác nhận thanh toán thành công'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment confirmation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
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
