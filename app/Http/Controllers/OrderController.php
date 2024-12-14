<?php

namespace App\Http\Controllers;

use App\Events\NewOrderCreated;
use App\Events\OrderCancelRequested;
use App\Events\OrderStatusChanged;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Jobs\ProcessOrder;
use App\Models\Contract;
use App\Models\ContractDetail;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Order_canceled;
use App\Models\Order_detail;
use App\Models\Order_status;
use App\Models\OrderStatusTime;
use App\Models\Payment;
use App\Models\Variation;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\HTML;
use PhpOffice\PhpWord\Settings;
use Tymon\JWTAuth\Facades\JWTAuth;

// use PhpOffice\PhpWord\PhpWord;
/**
 * Handles the CRUD operations for orders in the application.
 *
 * This controller provides methods to list, create, show, edit, update, and delete orders.
 * It interacts with various models such as Order, Customer, Order_detail, Order_status, Payment, Product, and Variation.
 * The controller also handles the creation of new orders, including generating a unique order slug and storing the order details.
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.orders.';
    public function index()
    {
        $data = Order::with(['payment', 'customer', 'orderStatus'])->where('contract_id', null)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function orderContract()
    {
        $data = Order::with(['payment', 'customer', 'orderStatus', 'contract'])
            ->whereNotNull('contract_id')
            ->get();

        return view(self::PATH_VIEW . 'indexContract', compact('data'));
    }

    public function create()
    {
        $payments = Payment::pluck('name', 'id')->all();
        $customers = Customer::get();
        $status = Order_status::pluck('description', 'id')->all();
        $variation = Variation::where('stock', '>', 0)
            ->where('is_active', 1)
            ->get();
        $locations = Location::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('payments', 'customers', 'status', 'variation', 'locations'));
    }
    public function store(Request $request)
    {
        if ($request->has('contract_id')) {
            $contract = Contract::findOrFail($request->contract_id);
            if ($contract->contract_status_id != 6) {
                return back()->with('error', 'Chỉ có thể tạo đơn hàng khi hợp đồng đã được khách hàng xác nhận');
            }
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            if (!is_array($request->variation_id) || count($request->variation_id) == 0) {
                return back()->with('error', 'Không có sản phẩm nào để thêm vào đơn hàng');
            }

            foreach ($request->variation_id as $key => $variationID) {
                $variation = Variation::findOrFail($variationID);
                $orderQuantity = $request->product_quantity[$key];
                if ($orderQuantity > $variation->stock) {
                    return back()->with('error', 'Số lượng mua của sản phẩm ' . $variation->name . ' vượt quá số lượng hàng tồn kho.');
                }
            }

            $orderData = $request->all();

            $orderData['employee_id'] = JWTAuth::setToken(Session::get('token'))->getPayload()->get('id');

            // Use queue to process order
            ProcessOrder::dispatch($orderData)->onQueue('orders');

            return redirect()->route('order.index')
                ->with('success', 'Thêm mới đơn hàng thành công.');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function createordercontract($contract_id)
    {
        $contract = Contract::with('contractDetails.variation')->findOrFail($contract_id);
        $customers = Customer::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'contract',
            'customers',
        ));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();

        // Kiểm tra nếu đơn hàng đã được xác nhận thì không cho sửa
        if ($order->status_id != 1) {
            return redirect()->route('order.index')->with('error', 'Không thể sửa đơn hàng');
        }

        $payments = Payment::pluck('name', 'id')->all();
        $customers = Customer::pluck('name', 'id')->all();
        $status = Order_status::pluck('description', 'id')->all();
        $variation = Variation::where('stock', '>', 0)
            ->where('is_active', 1)
            ->get();
        $orderDetails = Order_detail::where('order_id', $order->id)->get();
        return view(self::PATH_VIEW . 'edit', compact('order', 'payments', 'customers', 'status', 'variation', 'orderDetails'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, $slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();

        // Kiểm tra nếu đơn hàng đã được xác nhận thì không cho cập nhật
        if ($order->status_id != 1) {
            return redirect()->route('order.index')->with('error', 'Không thể cập nhật đơn hàng');
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            DB::transaction(function () use ($request, $slug) {
                // Lấy đơn hàng theo slug
                $order = Order::where('slug', $slug)->firstOrFail();

                // Cập nhật thông tin cơ bản của đơn hàng
                $dataOrder = [
                    "customer_id" => $request->customer_id,
                    "customer_name" => $request->customer_name,
                    "email" => $request->email,
                    "number_phone" => $request->number_phone,
                    "province" => $request->province_name,
                    "district" => $request->district_name,
                    "ward" => $request->ward_name,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount ?? 0,
                ];

                $order->update($dataOrder);

                // Trả lại số lượng tồn kho cho các sản phẩm cũ
                foreach ($order->orderDetails as $detail) {
                    $variation = Variation::findOrFail($detail->variation_id);
                    $variation->stock += $detail->quantity;
                    $variation->save();
                }

                // Xóa chi tiết đơn hàng cũ
                $order->orderDetails()->delete();

                // Thêm chi tiết đơn hàng mới
                if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                    foreach ($request->variation_id as $key => $variationId) {
                        if ($variationId) {
                            $variation = Variation::findOrFail($variationId);
                            $quantity = $request->product_quantity[$key];
                            $price = $request->product_price[$key];

                            // Kiểm tra số lượng tồn kho
                            if ($quantity > $variation->stock) {
                                throw new Exception("Sản phẩm '{$variation->name}' không đủ số lượng trong kho.");
                            }

                            // Tạo chi tiết đơn hàng mới
                            Order_detail::create([
                                'order_id' => $order->id,
                                'variation_id' => $variationId,
                                'quantity' => $quantity,
                                'price' => $price,
                            ]);

                            // Cập nhật số lượng tồn kho
                            $variation->stock -= $quantity;
                            $variation->save();
                        }
                    }
                } else {
                    throw new Exception('Đơn hàng phải có ít nhất một sản phẩm.');
                }
            });

            return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật đơn hàng: ' . $th->getMessage());
        }
    }
    public function requestCancel(Request $request, $slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();
        $order->cancel_reason = $request->cancel_reason;
        $order->save();
        event(new OrderCancelRequested($order));
        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, $slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();

        try {
            DB::transaction(function () use ($request, $order) {

                if ($request->status == 2 && $order->contract_id == null) {
                    $minimumPayment = $order->total_amount * 0.3;
                    if ($order->paid_amount < $minimumPayment) {
                        throw new Exception('Đơn hàng cần thanh toán ít nhất 30% tổng giá trị để được xác nhận');
                    }
                }
                if ($request->status == 4 && $order->contract_id == null) {
                    if ($order->paid_amount < $order->total_amount) {
                        throw new Exception('Đơn hàng cần thanh toán đủ số tiền để hoàn thành');
                    }
                }
                if ($request->status == 5) {
                    // Record cancel reason if exists
                    if ($order->cancel_reason) {
                        DB::table('order_canceleds')->insert([
                            'order_id' => $order->id,
                            'note' => $order->cancel_reason,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        $order->cancel_reason = null;
                    }

                    foreach ($order->orderDetails as $detail) {
                        $variation = Variation::find($detail->variation_id);
                        if ($variation) {
                            $variation->stock += $detail->quantity;
                            $variation->save();
                            if ($order->contract_id) {
                                $contractDetail = DB::table('contract_details')
                                    ->where('contract_id', $order->contract_id)
                                    ->where('variation_id', $detail->variation_id)
                                    ->first();

                                if ($contractDetail) {
                                    DB::table('contract_details')
                                        ->where('contract_id', $order->contract_id)
                                        ->where('variation_id', $detail->variation_id)
                                        ->update([
                                            'remaining_quantity' => DB::raw('remaining_quantity + ' . $detail->quantity)
                                        ]);
                                }
                            }
                        }
                    }
                }

                $order->status_id = $request->status;
                $order->save();

                OrderStatusTime::create([
                    'order_id' => $order->id,
                    'order_status_id' => $request->status,
                ]);

                if ($order->contract_id) {
                    $contract = Contract::find($order->contract_id);
                    if ($contract) {
                        $contractController = new \App\Http\Controllers\ContractController();
                        $contractController->checkAndUpdateContractStatus($contract);
                    }
                }
            });

            broadcast(new OrderStatusChanged($order))->toOthers();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getCustomerLocation($customerId)
    {
        $location = Location::where('customer_id', $customerId)
            ->where('is_active', 1)
            ->first();
        return response()->json($location);
    }
    public function storeContract(StoreOrderRequest $request)
    {
        try {
            $contract = Contract::findOrFail($request->contract_id);
            $paymentRatio = $contract->paid_amount / $contract->total_amount;

            // Calculate order total
            $orderTotal = collect($contract->contractDetails)
                ->map(function ($detail, $i) use ($request) {
                    return $request->product_quantity[$i] > 0 ?
                        $detail->price * $request->product_quantity[$i] : 0;
                })->sum();
                
            $prices = [];
            foreach ($contract->contractDetails as $detail) {
                $prices[] = $detail->price;
            }
            // Validate payment ratio
            $maxAllowed = $contract->total_amount * $paymentRatio;
            if ($orderTotal > $maxAllowed) {
                throw new Exception(sprintf(
                    'Giá trị đơn hàng (%s) vượt quá giới hạn cho phép (%s) dựa trên số tiền đã thanh toán của hợp đồng (%s%%)',
                    number_format($orderTotal),
                    number_format($maxAllowed),
                    number_format($paymentRatio * 100, 1)
                ));
            }
            if (!is_array($request->variation_id) || count($request->variation_id) == 0) {
                return back()->with('error', 'Không có sản phẩm nào để thêm vào đơn hàng');
            }

            foreach ($request->variation_id as $key => $variationID) {
                $variation = Variation::findOrFail($variationID);
                $orderQuantity = $request->product_quantity[$key];
                if ($orderQuantity > $variation->stock) {
                    return back()->with('error', 'Số lượng mua của sản phẩm ' . $variation->name . ' vượt quá số lượng hàng tồn kho.');
                }
            }
            $orderData = $request->all();
            $orderData['employee_id'] = $contract->employee_id;
            $orderData['email'] = $contract->customer_email;
            $orderData['total_amount'] = $orderTotal;
            $orderData['price'] = $prices;

            ProcessOrder::dispatch($orderData);

            return redirect()->back()->with('success', 'Thêm mới đơn hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function exportInvoice($orderId)
    {
        $order = Order::with([
            'orderDetails.variations.product.unit',
            'customer',
            'tripDetail.trip.employee',
            'tripDetail.trip.cargoCar'
        ])->findOrFail($orderId);

        // Load template
        $templateProcessor = new TemplateProcessor(storage_path('app/public/templates/hoa-don.docx'));

        // Thông tin chung
        $templateProcessor->setValue('order_code', $order->slug);
        $templateProcessor->setValue('order_date', Carbon::parse($order->created_at)->format('d/m/Y'));
        $templateProcessor->setValue('export_date', Carbon::now()->format('d/m/Y'));

        // Thông tin người nhận
        $templateProcessor->setValue('customer_name', $order->customer_name);
        $templateProcessor->setValue('customer_phone', $order->number_phone);
        $templateProcessor->setValue('customer_email', $order->email);
        $templateProcessor->setValue('customer_address', $order->address . ', ' . $order->ward . ', ' . $order->district . ', ' . $order->province);

        // Thông tin người đặt
        $templateProcessor->setValue('orderer_name', $order->customer->name ?? 'Đơn hàng hợp đồng');
        $templateProcessor->setValue('orderer_phone', $order->customer->number_phone ?? '');
        $templateProcessor->setValue('orderer_email', $order->customer->email ?? '');

        // Thông tin người giao hàng
        // $templateProcessor->setValue('shipper_name', $order->tripDetail->trip->employee->name ?? 'Chưa có người giao');
        // $templateProcessor->setValue('shipper_phone', $order->tripDetail->trip->employee->number_phone ?? '');
        // $templateProcessor->setValue('vehicle', $order->tripDetail->trip->cargoCar->cargoCarType->name ?? '');
        // $templateProcessor->setValue('license_plate', $order->tripDetail->trip->cargoCar->license_plate ?? '');

        // Thông tin sản phẩm
        $products = $order->orderDetails;
        $templateProcessor->cloneRow('product_name', count($products));

        foreach ($products as $index => $product) {
            $i = $index + 1;
            $templateProcessor->setValue('stt#' . $i, $i);
            $templateProcessor->setValue('product_name#' . $i, $product->variations->name ?? '');
            $templateProcessor->setValue('product_quantity#' . $i, $product->quantity);
            $templateProcessor->setValue('product_unit#' . $i, $product->variations->product->unit->name ?? '');
            $templateProcessor->setValue('product_price#' . $i, number_format($product->price));
            $templateProcessor->setValue('product_total#' . $i, number_format($product->quantity * $product->price));
        }

        // Thông tin thanh toán
        $templateProcessor->setValue('total_amount', number_format($order->total_amount));
        $templateProcessor->setValue('paid_amount', number_format($order->paid_amount));
        $templateProcessor->setValue('remaining_amount', number_format($order->total_amount - $order->paid_amount));


        // Lưu file Word
        $docxFileName = 'Hoadon_' . $order->slug . '.docx';
        $docxFilePath = storage_path('app/public/invoices/' . $docxFileName);

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists(storage_path('app/public/invoices'))) {
            mkdir(storage_path('app/public/invoices'), 0777, true);
        }

        $templateProcessor->saveAs($docxFilePath);

        // Cấu hình PDF
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        Settings::setPdfRendererPath($domPdfPath);
        Settings::setPdfRendererName('DomPDF');

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        // Tạo HTML với font Unicode
        $html = '<style>
        body { font-family: "DejaVu Sans", sans-serif; }
        * { font-family: "DejaVu Sans", sans-serif !important; }
      </style>';
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';

        // Chuyển Word sang HTML
        $phpWord = IOFactory::load($docxFilePath);
        $htmlWriter = new HTML($phpWord);
        $html .= $htmlWriter->getContent();

        // Tạo PDF
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->render();

        // Lưu file PDF
        $pdfFileName = 'Hoadon_' . $order->slug . '.pdf';
        $pdfFilePath = storage_path('app/public/invoices/' . $pdfFileName);
        file_put_contents($pdfFilePath, $dompdf->output());

        // Download file PDF
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }
}
