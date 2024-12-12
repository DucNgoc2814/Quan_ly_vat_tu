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
                        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Đơn bán lẻ</a></li>
                        <li class="breadcrumb-item active">Chi tiết đơn bán lẻ</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="card-header border-0 mb-4">
        <div class="row g-4">
            <div class="col-sm-auto">
                <a href="{{ route('order.index') }}" class="btn btn-success" id="addproduct-btn"><i
                        class="ri-arrow-left-line align-bottom me-1"></i>Quay lại</a>
            </div>
        </div>
    </div>
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
                            <a href="{{ route('order.invoice', $data->first()->order->id) }}"
                                class="btn btn-success btn-sm">
                                <i class="ri-download-2-fill align-middle me-1"></i>Xuất hóa đơn
                            </a>

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
                                            <td>Đã thanh toán :</td>
                                            <td class="text-end">
                                                {{ number_format($data->first()->order->paid_amount) }}</td>
                                        </tr>
                                        <tr class="border-top border-top-dashed">
                                            <th scope="row">Thanh toán (VND) :</th>
                                            <th class="text-end">
                                                @if (isset($data->first()->order->customer->customerRank->discount))
                                                    {{ number_format($data->first()->order->total_amount - $data->first()->order->paid_amount, 2) }}
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
            @if ($data->first()->order->contract_id == null)
                <div class="col-lg-12 mt-4 card p-3">
                    <div class="my-3 d-flex justify-content-between align-items-center">
                        <h5>Lịch sử chuyển tiền</h5>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createPaymentModal">
                            Tạo lịch sử chuyển tiền
                        </button>
                    </div>
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle fs-14"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Nội dung</th>
                                <th>Số tiền</th>
                                <th>PTTT</th>
                                <th>Ngày chuyển</th>
                                <th>Chứng từ</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentHistories as $payment)
                                <tr>
                                    <td>{{ $payment->note }}</td>
                                    <td>{{ number_format($payment->amount) }} VNĐ</td>
                                    <td>{{ $payment->payment->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('H:i:s d/m/Y') }}</td>
                                    <td>
                                        @if ($payment->document)
                                            @php
                                                $extension = pathinfo($payment->document, PATHINFO_EXTENSION);
                                                $documentUrl = url('storage/' . $payment->document);
                                            @endphp
                                            <button type="button" class="btn btn-sm btn-info"
                                                onclick="showDocument('{{ $documentUrl }}', '{{ $extension }}')"
                                                title="Xem chứng từ">
                                                <i class="ri-file-text-line"></i> Xem chứng từ
                                            </button>
                                        @else
                                            <span class="text-muted">Không có</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->status == 1)
                                            <span class="badge bg-success-subtle text-success">
                                                Đã thanh toán
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">
                                                Chờ xác nhận
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xl-3">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Người phụ trách</h5>
                    </div>
                    <span class="fw-medium ms-1">
                        <a href="{{ route('employees.edit', $data->first()->importOrder->employee->id ?? '1') }}">
                            {{ $data->first()->order->employee->name ?? 'Chưa phân công' }}
                        </a>
                    </span>
                    @if (JWTAuth::setToken(Session::get('token'))->getPayload()->get('role') == '1')
                        <button type="button" class="btn btn-link text-warning"
                            onclick="openAssignmentModal('order', {{ $data->first()->order->id }})">
                            <i class="ri-pencil-fill align-bottom"></i> Thay đổi
                        </button>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Người giao hàng</h5>
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

    <div class="modal fade" id="createPaymentModal" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tạo lịch sử chuyển tiền</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ route('payment.store', ['related_id' => $data->first()->order_id, 'transaction_type' => 'sale']) }}"
                        id="paymentForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="payment_id">Phương thức thanh toán</label>
                            <select class="form-select" id="paymentId" name="payment_id">
                                <option value="">Chọn Phương Thức Thanh Toán</option>
                                @foreach ($payments as $id => $name)
                                    <option value="{{ $id }}" @if (old('payment_id') == $id) selected @endif>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" id="paymentError" style="display: none;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Số tiền</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                            <span class="invalid-feedback" id="amountError" style="display: none;"></span>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                            <span class="invalid-feedback" id="noteError" style="display: none;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="document" class="form-label">Chứng từ</label>
                            <input type="file" class="form-control" id="document" name="document"
                                accept=".pdf,.jpg,.jpeg,.png">
                            <span class="invalid-feedback" id="documentError" style="display: none;"></span>
                            <small class="text-muted">Chấp nhận file: PDF, JPG, JPEG, PNG</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" id="submitPayment">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
@push('scripts')
    <script>
        document.getElementById('submitPayment').addEventListener('click', function(event) {
            event.preventDefault();

            // Lấy giá trị từ form
            const amount = document.getElementById('amount').value.trim();
            const note = document.getElementById('note').value.trim();
            const paymentId = document.getElementById('paymentId').value.trim();
            let isValid = true;

            // Reset error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');

            // Validate amount
            if (!amount || amount <= 0) {
                document.getElementById('amountError').innerText = 'Vui lòng nhập số tiền hợp lệ';
                document.getElementById('amountError').style.display = 'block';
                isValid = false;
            }


            // Validate note
            if (!note) {
                document.getElementById('noteError').innerText = 'Vui lòng nhập nội dung chuyển tiền';
                document.getElementById('noteError').style.display = 'block';
                isValid = false;
            }

            if (!paymentId) {
                document.getElementById('paymentError').innerText = 'Vui lòng chọn phương thức thanh toán';
                document.getElementById('paymentError').style.display = 'block';
                isValid = false;
            }

            if (isValid) {
                document.getElementById('paymentForm').submit();
            }
        });
    </script>
@endpush

<!-- Modal hiển thị ảnh chứng từ -->
<div class="modal fade" id="documentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chứng từ thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="documentImage" src="" alt="Chứng từ" style="max-width: 100%; height: auto;">
                <iframe id="documentPdf" src="" style="width: 100%; height: 500px; display: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="assignmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thay đổi người phụ trách</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="assignmentForm">
                @csrf
                <input type="hidden" id="assignmentType" name="type">
                <input type="hidden" id="assignmentId" name="id">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tìm nhân viên</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" id="employeeSearch"
                                placeholder="Nhập tên nhân viên..." autocomplete="off">
                            <input type="hidden" name="employee_id" id="selectedEmployeeId">

                            <div id="employeeSearchResults"
                                class="position-absolute w-100 mt-1 shadow bg-white rounded-2 d-none"
                                style="max-height: 200px; overflow-y: auto; z-index: 1000;">
                                @foreach ($employees as $employee)
                                    <div class="p-2 border-bottom employee-item" data-id="{{ $employee->id }}"
                                        data-name="{{ $employee->name }}" style="cursor: pointer;">
                                        {{ $employee->name }} - {{ $employee->id }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            const searchInput = $('#employeeSearch');
            const searchResults = $('#employeeSearchResults');
            const employeeItems = $('.employee-item');
            const selectedIdInput = $('#selectedEmployeeId');

            searchInput.on('input', function() {
                const searchText = this.value.toLowerCase();

                if (searchText === '') {
                    searchResults.addClass('d-none');
                    return;
                }

                employeeItems.each(function() {
                    const employeeName = $(this).data('name').toLowerCase();
                    const employeeId = $(this).data('id').toString();

                    // Check if search text matches either name or ID
                    if (employeeName.includes(searchText) || employeeId.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                searchResults.removeClass('d-none');
            });

            searchInput.on('focus', function() {
                if (this.value) {
                    searchResults.removeClass('d-none');
                }
            });

            employeeItems.on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');

                selectedIdInput.val(id);
                searchInput.val(name);
                searchResults.addClass('d-none');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!searchInput.is(e.target) && !searchResults.is(e.target)) {
                    searchResults.addClass('d-none');
                }
            });
        });

        function openAssignmentModal(type, id) {
            $('#assignmentType').val(type);
            $('#assignmentId').val(id);
            $('#assignmentModal').modal('show');
        }

        $(document).ready(function() {
            $('#assignmentForm').on('submit', function(e) {
                e.preventDefault();

                const id = $('#assignmentId').val();
                const employeeId = $('#selectedEmployeeId').val();

                console.log('Submitting data:', {
                    id: id,
                    employee_id: employeeId
                });
                if (!employeeId) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Vui lòng chọn nhân viên",
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('assignment.update', ['type' => 'order', 'id' => ':id']) }}'
                        .replace(':id', id),
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        employee_id: employeeId, // Add employeeId to data instead of URL
                        type: 'order'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true
                            });
                            $('#assignmentModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error details:', {
                            xhr: xhr,
                            status: status,
                            error: error
                        });
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: xhr.responseJSON?.message || 'Có lỗi xảy ra',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        });
                    }
                });
            });
        });

        function showDocument(url, fileType) {
            console.log('Loading document:', {
                url: url,
                fileType: fileType
            });

            const modal = new bootstrap.Modal(document.getElementById('documentModal'));
            const imageElement = document.getElementById('documentImage');
            const pdfElement = document.getElementById('documentPdf');

            // Reset display
            imageElement.style.display = 'none';
            pdfElement.style.display = 'none';

            // Kiểm tra loại file và hiển thị tương ứng
            if (['jpg', 'jpeg', 'png'].includes(fileType.toLowerCase())) {
                // Thêm event listener trước khi set src
                imageElement.onload = function() {
                    console.log('Image loaded successfully');
                };

                imageElement.onerror = function(e) {
                    console.error('Error loading image:', {
                        src: this.src,
                        error: e
                    });
                };

                imageElement.src = url;
                imageElement.style.display = 'block';
            } else if (fileType.toLowerCase() === 'pdf') {
                pdfElement.src = url;
                pdfElement.style.display = 'block';
            }

            modal.show();
        }
    </script>
@endpush

<style>
    #documentImage {
        transition: transform 0.3s ease;
        cursor: zoom-in;
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    #documentImage.zoomed {
        transform: scale(1.5);
        cursor: zoom-out;
    }

    .modal-body {
        overflow: auto;
        max-height: 80vh;
        padding: 20px;
    }

    #documentModal .modal-dialog {
        max-width: 80%;
        margin: 30px auto;
    }
</style>
