@extends('admin.layouts.master')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('order.index') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-arrow-left-line align-bottom me-1"></i>Trang danh sách</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="assets/images/users/avatar-1.jpg"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <p>Tên người đặt</p>
                        <h4 class="fs-16 mb-1">{{ $data->first()->order->customer->name }}</h4>
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Thông tin khách hàng</h5>
                        </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                <i class="ri-github-fill"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control" id="gitUsername"
                            value="{{ $data->first()->order->customer->email }}" readonly>
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                <i class="ri-global-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="websiteInput"
                            value="{{ $data->first()->order->customer->number_phone }}" readonly>
                    </div>
                    <div class="d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                <i class="ri-pinterest-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="pinterestName"
                            value="{{ $data->first()->order?->customer?->customer_rank?->name ?? 'Không có khuyến mãi' }}"
                            readonly>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                <h3>Thông tin đơn hàng: {{ $data->first()->order->slug }}</h3>
                                {{-- <h3>Thông tin giao hàng</h3> --}}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="javascript:void(0);">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="customer_name" class="form-label">Tên người nhận</label>
                                            <input type="text" class="form-control" id="customer_name"
                                                value="{{ $data->first()->order->customer_name }}" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="created_at" class="form-label">Ngày đặt hàng</label>
                                            <input type="text" class="form-control" id="created_at"
                                                value="{{ $data->first()->order->created_at }}" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="number_phone" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" id="number_phone"
                                                value="{{ $data->first()->order->number_phone }}" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email </label>
                                            <input type="email" class="form-control" id="email"
                                                value="{{ $data->first()->order->email }}" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="payment_id" class="form-label">Phương thức thanh toán</label>
                                            <input type="text" class="form-control" id="payment_id"
                                                value="{{ $data->first()->order->payment->name }}" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="status_id" class="form-label">Trạng thái đơn hàng </label>
                                            <input type="text" class="form-control" id="status_id"
                                                placeholder="Enter your email"
                                                value="{{ $data->first()->order->orderStatus->name }}" readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Địa chỉ giao hàng </label>
                                            <input type="text" class="form-control" id="address"
                                                value="{{ $data->first()->order->address }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="table-responsive table-card p-4">
                        <table class="table table-nowrap table-striped-columns mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn vị</th>
                                    <th scope="col">Giá sản phẩm</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $orderDetail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $orderDetail->variations?->name ?? 'Không có thông tin sản phẩm' }}</td>
                                        <td>
                                            {{-- @if ($orderDetail->products->galleries->first()->url && Storage::exists($orderDetail->products->galleries->first()->url))
                                            <img src="{{ \Storage::url($orderDetail->products->galleries->first()->url) ?? 'Không có ảnh'}}" width="100px" alt="">
                                        @endif --}}
                                            {{ $orderDetail->variations?->product?->galleries?->first()?->url ?? 'Không có ảnh' }}
                                        </td>
                                        <td>{{ $orderDetail->quantity }}</td>
                                        <td>{{ $orderDetail->variations?->product?->unit?->name ?? 'Không có đơn vị' }}
                                        </td>
                                        <td>{{ number_format($orderDetail->price) }}</td>
                                        <td>{{ number_format($orderDetail->quantity * $orderDetail->price) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex justify-content-between">
                        <h3 class="fw-bold">Tổng cộng:</h3>
                        <h4>{{ number_format($data->first()->order->total_amount) }}đ</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="fw-bold">Số tiền đã trả:</h3>
                        <h4>{{ number_format($data->first()->order->paid_amount) }}đ</h4>
                    </div>
                </div>
            </div>

            <div class="card mt-n5 ">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h2 class="fw-bold">Tổng thanh toán:</h2>
                        <h3>{{ number_format($data->first()->order->total_amount - $data->first()->order->paid_amount) }}đ</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary">Xuất hóa đơn</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection

@section('scripts-list')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
@endsection

@section('styles-list')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
