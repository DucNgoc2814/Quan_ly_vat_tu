@extends('admin.layouts.master')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thông tin đơn hàng: {{ $data->first()->order->slug }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-9">
            <div class="d-flex justify-content-between">
                <div class="card col-6">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Trạng thái đơn hàng</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-timeline">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($data->first()->order->orderStatusTimes()->orderBy('order_status_id', 'desc')->get() as $statusTime)
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="heading{{ $statusTime->order_status_id }}">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                                href="#collapse{{ $statusTime->order_status_id }}"
                                                aria-expanded="{{ $statusTime->order_status_id <= $data->first()->order->status_id ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $statusTime->order_status_id }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div
                                                            class="avatar-title bg-{{ $statusTime->orderStatus->color }} rounded-circle">
                                                            <i class="ri-shopping-bag-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-15 mb-0 fw-semibold">
                                                            {{ $statusTime->orderStatus->name }}
                                                        </h6>
                                                        <p class="text-muted">
                                                            {{ $statusTime->created_at }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
                <div class="card col-5">
                    <div class="card-header d-flex justify-content-between">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Hóa đơn</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="apps-invoices-details.html" class="btn btn-success btn-sm"><i
                                    class="ri-download-2-fill align-middle me-1"></i>Xuất hóa đơn</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-timeline">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Tổng tiền :</td>
                                            <td class="text-end">
                                                {{ number_format($data->first()->order->total_amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Giảm giá <span
                                                    class="text-muted">({{ $data->first()->order->customer->customerRank->name ?? 'Đơn hàng hợp đồng' }})</span>:
                                            </td>
                                            <td class="text-end">
                                                {{ $data->first()->order->customer->customerRank->discount ?? 'Đơn hàng hợp đồng' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Đã thanh toán :</td>
                                            <td class="text-end">
                                                {{ number_format($data->first()->order->paid_amount) }}</td>
                                        </tr>
                                        <tr class="border-top border-top-dashed">
                                            <th scope="row">Thanh toán (VND) :</th>
                                            <th class="text-end">
                                                @if (isset($data->first()->order->customer->customerRank->discount))
                                                    {{ number_format(
                                                        $data->first()->order->total_amount * (1 - $data->first()->order->customer->customerRank->discount / 100) -
                                                            $data->first()->order->paid_amount,
                                                        2,
                                                    ) }}
                                                @else
                                                    0
                                                @endif
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá bán</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn vị</th>
                                    <th scope="col" class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $orderDetail)
                                    <tr>
                                        <td>
                                            <div class="d-flex">

                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-15"><a href="apps-ecommerce-product-details.html"
                                                            class="link-primary">{{ $orderDetail->variations?->name ?? 'Không có thông tin sản phẩm' }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($orderDetail->price) }}</td>
                                        <td>{{ $orderDetail->quantity }}</td>
                                        <td>{{ $orderDetail->variations?->product?->unit?->name ?? 'Không có đơn vị' }}
                                        </td>
                                        <td class="fw-medium text-end">
                                            {{ number_format($orderDetail->quantity * $orderDetail->price) }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xl-3">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Người giao hàng</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="link-secondary">Xem thông tin</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (isset($data->first()->order->tripDetail->trip->employee))
                        <ul class="list-unstyled mb-0 vstack gap-3">
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . $data->first()->order->tripDetail->trip->employee->image) }}"
                                            alt="" class="avatar-sm rounded">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">
                                            {{ $data->first()->order->tripDetail->trip->employee->name ?? 'Chưa có tài xế giao' }}
                                        </h6>
                                        <p class="text-muted mb-0">Tài xế</p>
                                    </div>
                                </div>
                            </li>

                            <li><i
                                    class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $data->first()->order->tripDetail->trip->employee->number_phone ?? 'Null' }}
                            </li>

                            <li>
                                <p class="text-muted mb-0">Xe giao hàng:
                                    {{ $data->first()->order->tripDetail->trip->cargoCar->cargoCarType->name ?? 'Chưa có xe giao' }}
                                </p>
                            </li>
                            <li>
                                <p class="text-muted mb-0">Biển số :
                                    {{ $data->first()->order->tripDetail->trip->cargoCar->license_plate ?? 'Chưa có xe giao' }}
                                </p>
                            </li>
                        </ul>
                    @else
                        <ul class="list-unstyled mb-0 vstack gap-3">
                            <li>
                                <div class="d-flex align-items-center">

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">
                                            Chưa có người giao hàng
                                        </h6>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    @endif

                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Người đặt hàng</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="link-secondary">Xem thông tin</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-sm rounded">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">
                                        {{ $data->first()->order->customer->name ?? 'Đơn hàng hợp đồng' }}</h6>
                                    <p class="text-muted mb-0">Người đặt</p>
                                </div>
                            </div>
                        </li>
                        <li><i
                                class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $data->first()->order->customer->email ?? 'Đơn hàng hợp đồng' }}
                        </li>
                        <li><i
                                class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $data->first()->order->customer->number_phone ?? 'Đơn hàng hợp đồng' }}
                        </li>
                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Người nhận hàng</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $data->first()->order->customer_name }}</h6>
                                </div>
                            </div>
                        </li>
                        <li><i
                                class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $data->first()->order->email }}
                        </li>
                        <li><i
                                class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $data->first()->order->number_phone }}
                        </li>
                        <li><i
                                class="ri-map-pin-line align-middle me-1 text-muted"></i>{{ $data->first()->order->address }},
                            {{ $data->first()->order->ward }}, {{ $data->first()->order->district }},
                            {{ $data->first()->order->province }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
