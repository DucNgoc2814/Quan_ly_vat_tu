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
                                <a href="{{ route('importOrder.index') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-arrow-left-line align-bottom me-1"></i>Trang danh sách</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-4">
            <div class="card mt-n5">
                <div class="card-body p-3">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                            <img src="{{ asset('themes/admin/assets/images/users/avatar-1.jpg') }}"
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
                        <h4 class="fs-16">{{ $data->first()->importOrder->supplier->name }}</h4>
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Thông tin nhà cung cấp</h5>
                        </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                <i class="ri-github-fill"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control" id="gitUsername"
                            value="{{ $data->first()->importOrder->supplier->email }}" readonly>
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                <i class="ri-global-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="websiteInput"
                            value="{{ $data->first()->importOrder->supplier->number_phone }}" readonly>
                    </div>
                    <div class="d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                <i class="ri-pinterest-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="pinterestName"
                            value="{{ $data->first()->importOrder->supplier->address }}" readonly>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-8">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0 d-flex justify-content-between px-2"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                <h4>Thông tin đơn hàng: {{ $data->first()->importOrder->slug }}</h4>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4 nav-item d-flex align-items-center fs-14">
                    <span class="">Người phụ trách:</span>
                    <span class="fw-medium ms-1">
                        <a href="{{ route('employees.edit', $data->first()->importOrder->employee->id ?? '1') }}">
                            {{ $data->first()->importOrder->employee->name ?? 'Chưa phân công' }}
                        </a>
                    </span>
                    {{-- Update the button in index.blade.php --}}
                    @if (JWTAuth::setToken(Session::get('token'))->getPayload()->get('role') == '1' && 
                        in_array($data->first()->importOrder->status, [1, 2]))
                        <button type="button" class="btn btn-link text-warning"
                            onclick="openAssignmentModal('importOrder', {{ $data->first()->importOrder->id }})">
                            <i class="ri-pencil-fill align-bottom"></i> Thay đổi
                        </button>
                    @endif
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="javascript:void(0);">
                                <div class="row">
                                    <!--end col-->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="created_at" class="form-label">Tổng tiền: </label>
                                            <input type="text" class="form-control" id="created_at"
                                                value="{{ number_format($data->first()->importOrder->total_amount) }} VND"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="created_at" class="form-label">Ngày đặt hàng</label>
                                            <input type="text" class="form-control" id="created_at"
                                                value="{{ $data->first()->importOrder->created_at }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="created_at" class="form-label">Số tiền đã trả: </label>
                                            <input type="text" class="form-control" id="created_at"
                                                value="{{ number_format($data->first()->importOrder->paid_amount) }} VND"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="status_id" class="form-label">Trạng thái đơn hàng </label>
                                            <input type="text" class="form-control" id="status_id"
                                                value="@if ($data->first()->importOrder->status == 1) Chờ xác nhận
                                                      @elseif($data->first()->importOrder->status == 2)Đã xác nhận
                                                      @elseif($data->first()->importOrder->status == 3)Giao hàng thành công
                                                      @elseif($data->first()->importOrder->status == 4)Đã hủy @endif"
                                                readonly
                                                style="@if ($data->first()->importOrder->status == 1) ;
                                                       @elseif($data->first()->importOrder->status == 2);
                                                       @elseif($data->first()->importOrder->status == 3);
                                                       @elseif($data->first()->importOrder->status == 4); @endif">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="created_at" class="form-label">Cần thanh toán: </label>
                                            <input type="text" class="form-control" id="created_at"
                                                value="{{ number_format($data->first()->importOrder->total_amount - $data->first()->importOrder->paid_amount) }} VND"
                                                readonly>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        @if ($data->first()->importOrder->status == 4)
                                            <!-- Kiểm tra nếu đơn hàng đã bị hủy (status == 4) -->
                                            <div class="mb-3">
                                                <label for="cancel_reason" class="form-label">Lý do hủy đơn hàng</label>
                                                <input type="text" class="form-control" id="cancel_reason"
                                                    value="{{ $data->first()->importOrder->cancel_reason }}" readonly>
                                            </div>
                                        @endif
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Danh sách sản phẩm</h5>
                        </div>
                        <table class="table table-nowrap table-striped-columns mb-0 fs-13">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã SP</th>
                                    <th scope="col">Tên SP</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn vị</th>
                                    <th scope="col">Giá sản phẩm</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $importOrderDetail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $importOrderDetail->variation?->sku ?? 'Không có thông tin sản phẩm' }}
                                        <td>{{ $importOrderDetail->variation?->name ?? 'Không có thông tin sản phẩm' }}
                                        </td>
                                        <td>{{ $importOrderDetail->quantity }}</td>
                                        <td>{{ $importOrderDetail->variation?->product?->unit?->name ?? 'Không có đơn vị' }}
                                        </td>
                                        <td>{{ number_format($importOrderDetail->price) }}</td>
                                        <td>{{ number_format($importOrderDetail->quantity * $importOrderDetail->price) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="table-responsive table-card p-4">
                        <div class="my-3 d-flex justify-content-between align-items-center">
                            <h5>Lịch sử chuyển tiền</h5>
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#createPaymentModal">
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
                </div>
            </div>
        </div>
        <!--end card-->
    </div>

    <!--end col-->
    <div class="modal fade" id="createPaymentModal" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tạo lịch sử chuyển tiền</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ route('payment.store', ['related_id' => $data->first()->importOrder->id, 'transaction_type' => 'purchase']) }}"
                        id="paymentForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="payment_id">Phương thức thanh toán</label>
                            <select class="form-select" id="paymentId" name="payment_id">
                                <option value="">Chọn Phương Thức Thanh Toán</option>
                                @foreach ($payments as $id => $name)
                                    <option value="{{ $id }}"
                                        @if (old('payment_id') == $id) selected @endif>
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
    {{-- Add this after your existing content --}}
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
@endsection
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
                    url: '{{ route('assignment.update', ['type' => 'importOrder', 'id' => ':id']) }}'
                        .replace(':id', id),
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        employee_id: employeeId, // Add employeeId to data instead of URL
                        type: 'importOrder'
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

@push('scripts')
    <script>
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
