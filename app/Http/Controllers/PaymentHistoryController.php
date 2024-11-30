<?php

namespace App\Http\Controllers;

use App\Models\Payment_history;
use App\Traits\PaymentTrait;
use App\Http\Requests\StorePayment_historyRequest;
use App\Http\Requests\UpdatePayment_historyRequest;
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
        $payments = Payment_history::all();
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
                // Kiểm tra số tiền còn thiếu
                $remainingAmount = $this->getRemainingAmount($request->transaction_type, $request->related_id);

                // Nếu số tiền thanh toán lớn hơn số tiền còn thiếu
                if ($request->amount > $remainingAmount) {
                    throw new \Exception("Số tiền thanh toán (" . number_format($request->amount) . " VNĐ) lớn hơn số tiền còn thiếu (" . number_format($remainingAmount) . " VNĐ)");
                }

                // Upload document nếu có
                $document_path = null;
                if ($request->hasFile('document')) {
                    $document_path = $request->file('document')->store('payment-documents', 'public');
                }

                // Tạo payment history
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

            // Kiểm tra payment có tồn tại không
            $payment = Payment_history::find($id);
            if (!$payment) {
                throw new \Exception('Không tìm thấy giao dịch');
            }

            Log::info('Found payment', ['payment' => $payment->toArray()]);

            // Kiểm tra trạng thái hiện tại
            if ($payment->status == 1) {
                throw new \Exception('Giao dịch này đã được xác nhận trước đó');
            }

            // Cập nhật trạng thái
            $payment->status = 1;

            if (!$payment->save()) {
                throw new \Exception('Không thể cập nhật trạng thái thanh toán');
            }

            // Cập nhật số tiền đã thanh toán
            $this->updatePaidAmount(
                $payment->transaction_type,
                $payment->related_id,
                $payment->amount
            );
            log::info('Payment updated successfully');

            // Cập nhật trạng thái của đơn hàng/hợp đồng tương ứng nếu cần

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
