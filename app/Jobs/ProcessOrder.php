<?php

namespace App\Jobs;

use App\Events\NewOrderCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\Variation;
use App\Models\Order_detail;
use App\Models\OrderStatusTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderData;
    public $tries = 3; // Số lần thử lại nếu job thất bại

    public function __construct($orderData)
    {
        $this->orderData = $orderData;
    }

    public function handle()
    {
        DB::beginTransaction();
        try {
            // Validate số lượng trong kho trước khi tạo đơn
            foreach ($this->orderData['variation_id'] as $key => $variationID) {
                $lockKey = 'variation_stock_' . $variationID;

                // Sử dụng Cache Lock để đồng bộ hóa truy cập
                $lock = Cache::lock($lockKey, 10); // lock trong 10 giây

                if (!$lock->get()) {
                    // Nếu không lấy được lock, đợi và thử lại
                    throw new Exception('Không thể xử lý đơn hàng lúc này, vui lòng thử lại.');
                }

                try {
                    $variation = Variation::lockForUpdate()->find($variationID);
                    if (!$variation) {
                        throw new Exception('Không tìm thấy sản phẩm.');
                    }

                    $orderQuantity = $this->orderData['product_quantity'][$key];
                    if ($orderQuantity > $variation->stock) {
                        throw new Exception('Số lượng mua của sản phẩm ' . $variation->name . ' vượt quá số lượng hàng tồn kho.');
                    }
                } finally {
                    $lock->release();
                }
            }

            // Parse customer_id from string if needed
            $customer_id = is_string($this->orderData['customer_id']) ?
                strtok($this->orderData['customer_id'], ' ') :
                $this->orderData['customer_id'];

            // Generate order code
            $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
            $timestamp = now()->format('His');
            $slug = 'DHB' . $randomChars . $timestamp;

            // Tạo đơn hàng
            $order = Order::create([
                "customer_id" => $customer_id,
                "contract_id" => $this->orderData['contract_id'] ?? null,
                'employee_id' => $this->orderData['employee_id'],
                "status_id" => 1,
                "slug" => $slug,
                "customer_name" => $this->orderData['customer_name'],
                "email" => $this->orderData['email'],
                "number_phone" => $this->orderData['number_phone'],
                "province" => $this->orderData['province_name'],
                "district" => $this->orderData['district_name'],
                "ward" => $this->orderData['ward_name'],
                "address" => $this->orderData['address'],
                "total_amount" => str_replace(',', '', $this->orderData['total_amount']),
                "paid_amount" => 0,
            ]);

            // Tạo chi tiết đơn hàng và cập nhật số lượng
            foreach ($this->orderData['variation_id'] as $key => $variationID) {
                $lockKey = 'variation_stock_' . $variationID;
                $lock = Cache::lock($lockKey, 10);

                if (!$lock->get()) {
                    throw new Exception('Không thể xử lý đơn hàng lúc này, vui lòng thử lại.');
                }

                try {
                    $variation = Variation::lockForUpdate()->find($variationID);
                    $orderQuantity = $this->orderData['product_quantity'][$key];
                    $price = $this->orderData['product_price'][$key];

                    // Final stock check
                    if ($orderQuantity > $variation->stock) {
                        return back()->with('error', 'Số lượng mua của sản phẩm ' . $variation->name . ' vượt quá số lượng hàng tồn kho.');
                    }

                    // Tạo chi tiết đơn hàng
                    Order_detail::create([
                        'order_id' => $order->id,
                        'variation_id' => $variationID,
                        'quantity' => $orderQuantity,
                        'price' => $price,
                    ]);

                    // Cập nhật số lượng tồn kho
                    $variation->stock -= $orderQuantity;
                    $variation->save();
                } finally {
                    $lock->release();
                }
            }

            // Create order status time
            OrderStatusTime::create([
                'order_id' => $order->id,
                'order_status_id' => 1,
            ]);

            // Fire events
            event(new NewOrderCreated($order));

            DB::commit();
            Log::info("Order processed successfully: {$slug}");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Lỗi xử lý đơn hàng: ' . $e->getMessage());
            throw $e;
        }
    }
}
