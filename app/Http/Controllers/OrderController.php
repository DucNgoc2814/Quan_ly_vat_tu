<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
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
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\HTML;
use PhpOffice\PhpWord\Settings;

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
        $variation = Variation::all();
        $locations = Location::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('payments', 'customers', 'status', 'variation', 'locations'));
    }
    public function store(Request $request)
    {
        // Kiểm tra trạng thái hợp đồng
        $contract = Contract::findOrFail($request->contract_id);
        if ($contract->contract_status_id != 6) {
            return back()->with('error', 'Chỉ có thể tạo đơn hàng khi hợp đồng đã được khách hàng xác nhận');
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            DB::transaction(function () use ($request) {
                $customer_id = strtok($request->customer_id, ' ');
                $customers = Customer::findOrFail($request->customer_id);
                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, length: 3);
                $timestamp = now()->format('His');
                $slug = 'DHB' . $randomChars . $timestamp;
                $dataOrder = [
                    "customer_id" => $customer_id,
                    "contract_id" => $request->contract_id,
                    "status_id" => 1,
                    "slug" => $slug,
                    "customer_name" => $request->customer_name ?? $customers->name,
                    "email" => $request->email ?? $customers->email,
                    "number_phone" => $request->number_phone ?? $customers->number_phone,
                    "province" => $request->province_name,
                    "district" => $request->district_name,
                    "ward" => $request->ward_name,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => 0,
                ];
                $order = Order::query()->create($dataOrder);
                OrderStatusTime::create([
                    'order_id' => $order->id,
                    'order_status_id' => 1,
                ]);
                $existingLocation = Location::where('customer_id', $order->customer_id)
                    ->where('customer_name', $order->customer_name)
                    ->where('email', $order->email)
                    ->where('number_phone', $order->number_phone)
                    ->where('province', $order->province)
                    ->where('district', $order->district)
                    ->where('ward', $order->ward)
                    ->where('address', $order->address)
                    ->first();
                if (!$existingLocation && $order->province) {
                    $locationCount = Location::where('customer_id', $order->customer_id)->count();
                    $location = new Location();
                    $location->customer_id = $order->customer_id;
                    $location->customer_name = $order->customer_name;
                    $location->email = $order->email;
                    $location->number_phone = $order->number_phone;
                    $location->province = $order->province;
                    $location->district = $order->district;
                    $location->ward = $order->ward;
                    $location->address = $order->address;
                    $location->is_active = $locationCount === 0 ? 1 : 0;
                    $location->save();
                }
                if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                    foreach ($request->variation_id as $key => $variationID) {

                        $variation = Variation::findOrFail($variationID);
                        $orderQuantity = $request->product_quantity[$key];
                        logger("Số lượng tồn kho (stock) của variation $variationID là: " . $variation->stock);
                        logger("Số lượng mua của variation $variationID là: " . $orderQuantity);
                        // Kiểm tra số lượng tồn kho để tránh giảm quá số lượng hiện có
                        if ($orderQuantity > $variation->stock) {
                            throw new Exception('Số lượng mua vượt quá số lượng hàng tồn kho.');
                        }
                        // Tạo chi tiết đơn hàng
                        Order_detail::query()->create([
                            'order_id' => $order->id,
                            'variation_id' => $variationID,
                            'quantity' => $orderQuantity,
                            'price' => $request->product_price[$key],
                        ]);
                        // Giảm số lượng hàng tồn kho
                        $variation->stock -= $orderQuantity;
                        $variation->save();
                    }
                } else {
                    throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng');
                }
            });
            return redirect()->route('order.index')->with('success', 'Thêm mới đơn hàng thành công!');
            // dd(session('success'));
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $th->getMessage());
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
        $payments = Payment::pluck('name', 'id')->all();
        $customers = Customer::pluck('name', 'id')->all();
        $status = Order_status::pluck('description', 'id')->all();
        $variation = Variation::all();
        // $variation = Variation::pluck('name', 'id')->all();
        $orderDetails = Order_detail::where('order_id', $order->id)->get();
        // dd($variation);
        return view(self::PATH_VIEW . __FUNCTION__, compact('order', 'payments', 'customers', 'status', 'variation', 'orderDetails'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, $slug)
    {
        // dd($request->all());
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            DB::transaction(function () use ($request, $slug) {
                // lấy đơn hàng theo slug
                $order = Order::where('slug', $slug)->firstOrFail();
                // Kiểm tra tính họp lệ của trạng thái mới
                $currentStatus = $order->status_id;
                $newStatus = $request->status_id ?? $currentStatus;
                $dataOrder = [
                    "customer_id" => $request->customer_id,
                    "status_id" => $newStatus,
                    "customer_name" => $request->customer_name ?? $order->name,
                    "email" => $request->email ?? $order->email,
                    "number_phone" => $request->number_phone ?? $order->number_phone,
                    "province" => $request->province_name,
                    "district" => $request->district_name,
                    "ward" => $request->ward_name,
                    "address" => $request->address,
                    "total_amount" => $request->total_amount,
                    "paid_amount" => $request->paid_amount,
                ];
                $order->update($dataOrder);
                // Trả lại số lượng hàng tồn kho trước khi cập nhật
                foreach ($order->orderDetails as $detail) {
                    $variation = Variation::findOrFail($detail->variation_id);
                    $variation->stock += $detail->quantity; // Trả lại số lượng đã bán trước đó
                    $variation->save();
                }
                // xóa chi tiết đơn hàng cũ
                $order->orderDetails()->delete();
                // Kiểm tra xem các mảng product_id có tồn tại hay ko
                if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                    foreach ($request->variation_id as $key => $variationID) {
                        // kiểm tra tính tồn tại của các mảng liên quan
                        $quantity = $request->product_quantity[$key] ?? null;
                        $price = $request->product_price[$key] ?? null;
                        // Thêm chi tiết đơn hàng mới chỉ khi có đủ thông tin
                        if ($variationID && $quantity && $price) {
                            $variation = Variation::findOrFail($variationID);
                            Order_detail::query()->create([
                                'order_id' => $order->id,
                                'variation_id' => $variationID,
                                'quantity' => $quantity,
                                'price' => $price,
                            ]);
                            // Giảm số lượng hàng tồn kho
                            $variation->stock -= $quantity;
                            $variation->save();
                        }
                    }
                } else {
                    throw new \Exception('Không có sản phẩm nào để cập nhật trong đơn hàng.');
                }
            });
            DB::commit();
            return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $th->getMessage());
        }
    }
    public function requestCancel(Request $request, $slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();
        $order->cancel_reason = $request->cancel_reason;
        $order->save();
        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, $slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();

        if ($order->status_id == 3 && $request->status == 4) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể cập nhật trạng thái từ "Đang giao" sang "Thành công"'
            ], 403);
        }

        try {
            DB::transaction(function () use ($request, $slug) {
                $order = Order::where('slug', $slug)->firstOrFail();
                $oldStatus = $order->status_id;
                $newStatus = $request->input('status');

                $order->status_id = $newStatus;

                OrderStatusTime::create([
                    'order_id' => $order->id,
                    'order_status_id' => $newStatus,
                ]);

                if ($newStatus == 6) {
                    $order->save();
                    return;
                }

                if ($order->status_id == 1 && ($newStatus == 2 || $newStatus == 3) && !$order->contract_id) {
                    if ($order->total_amount != $order->paid_amount) {
                        throw new \Exception('Không thể xác nhận đơn hàng chưa thanh toán đủ');
                    }
                }

                if ($newStatus == 5 && $oldStatus != 5) {
                    foreach ($order->orderDetails as $detail) {
                        $variation = Variation::find($detail->variation_id);
                        $variation->stock += $detail->quantity;
                        $variation->save();

                        if ($order->contract_id) {
                            $contractDetail = ContractDetail::where('contract_id', $order->contract_id)
                                ->where('variation_id', $detail->variation_id)
                                ->first();
                            if ($contractDetail) {
                                $contractDetail->remaining_quantity += $detail->quantity;
                                $contractDetail->save();
                            }
                        }
                    }

                    $canceledOrder = new Order_canceled();
                    $canceledOrder->order_id = $order->id;
                    $canceledOrder->note = $order->cancel_reason;
                    $canceledOrder->save();
                    $order->cancel_reason = null;
                }

                $order->save();
            });

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái đơn hàng thành công!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            DB::transaction(function () use ($request) {
                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, length: 3);
                $timestamp = now()->format('His');
                $slug = 'DHB' . $randomChars . $timestamp;
                $contract = Contract::findOrFail($request->contract_id);
                $prices = [];
                foreach ($contract->contractDetails as $detail) {
                    $prices[] = $detail->price;
                }
                $totalAmount = 0;
                if (count($prices) === count($request->product_quantity)) {
                    for ($i = 0; $i < count($prices); $i++) {
                        $totalAmount += $prices[$i] * $request->product_quantity[$i]; // Tính tổng tiền
                    }
                } else {
                    // Xử lý trường hợp mảng không cùng độ dài
                    throw new Exception("Mảng giá và số lượng không kh���p.");
                }
                $dataOrder = [
                    "contract_id" => $request->contract_id,
                    "status_id" => 1,
                    "slug" => $slug,
                    "customer_id" => $request->customer_id,
                    "customer_name" => $request->customer_name,
                    "email" => $contract->customer_email,
                    "number_phone" => $request->number_phone,
                    "province" => $request->province_name,
                    "district" => $request->district_name,
                    "ward" => $request->ward_name,
                    "address" => $request->address,
                    "total_amount" => $totalAmount,
                    "paid_amount" => 0,
                ];



                $order = Order::query()->create($dataOrder);
                OrderStatusTime::create([
                    'order_id' => $order->id,
                    'order_status_id' => 1,
                ]);
                if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                    if (count($request->variation_id) === count($request->product_quantity)) {
                        for ($i = 0; $i < count($prices); $i++) {
                            if ($request->product_quantity[$i] > 0 && $request->product_quantity[$i] != null) {
                                $variation = Variation::findOrFail($request->variation_id[$i]);
                                $orderQuantity = $request->product_quantity[$i];
                                // Tạo chi tiết đơn hàng
                                Order_detail::query()->create([
                                    'order_id' => $order->id,
                                    'variation_id' => $request->variation_id[$i],
                                    'quantity' => $orderQuantity,
                                    'price' => $prices[$i],
                                ]);
                                // Cập nhật remaining_quantity trong contract_details
                                $contractDetail = ContractDetail::where('contract_id', $request->contract_id)
                                    ->where('variation_id', $request->variation_id[$i])
                                    ->first();
                                if ($contractDetail) {
                                    // Kiểm tra nếu số lượng đặt không vượt quá remaining_quantity
                                    if ($orderQuantity > $contractDetail->remaining_quantity) {
                                        throw new Exception('Số lượng đặt hàng vượt quá số lượng còn lại trong hợp đồng.');
                                    }
                                    $contractDetail->remaining_quantity -= $orderQuantity;
                                    $contractDetail->save();
                                }
                                // Giảm số lượng hàng tồn kho

                                $variation->stock -= $orderQuantity;
                                $variation->save();
                            }
                        }
                    } else {
                        throw new Exception("Mảng giá và số lượng không khớp.");
                    }
                } else {
                    throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng');
                }
            });

            return redirect()->back()->with('success', 'Thêm mới đơn hàng thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đơn hàng: ' . $th->getMessage());
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
