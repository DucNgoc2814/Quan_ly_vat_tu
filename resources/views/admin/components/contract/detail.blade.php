@extends('admin.layouts.master')

@section('title')
    Chi tiết hợp đồng
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chi tiết hợp đồng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('contract.index') }}">Danh sách hợp đồng</a></li>
                        <li class="breadcrumb-item active">Chi tiết hợp đồng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0 py-3">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{ route('contract.index') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-arrow-left-line align-bottom me-1"></i>Quay lại</a>
                                <button class="btn btn-primary" onclick="showPdf({{ $contract->id }})">
                                    <i class="ri-file-pdf-line align-bottom me-1"></i>Xem hợp đồng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Mã hợp đồng:</strong> <span
                                    class="text-muted">{{ $contract->contract_number }}</span></p>
                            <p><strong>Ngày bắt đầu:</strong> <span
                                    class="text-muted">{{ \Carbon\Carbon::parse($contract->timestart)->format('d/m/Y') }}</span>
                            </p>
                            <p><strong>Ngày kết thúc:</strong> <span
                                    class="text-muted">{{ \Carbon\Carbon::parse($contract->timeend)->format('d/m/Y') }}</span>
                            </p>
                            <p><strong>Trạng thái:</strong> <span
                                    class="text-muted">{{ $contract->contractStatus->name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tên khách hàng:</strong> <span
                                    class="text-muted">{{ $contract->customer_name }}</span></p>
                            <p><strong>Số điện thoại:</strong> <span
                                    class="text-muted">{{ $contract->customer_phone }}</span></p>
                            <p><strong>Email:</strong> <span class="text-muted">{{ $contract->customer_email }}</span></p>
                            <p><strong>Thanh toán:</strong> <span
                                    class="text-muted">{{ number_format($contract->paid_amount) }}/
                                    {{ number_format($contract->total_amount) }} VNĐ</span></p>

                        </div>

                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex align-items-center">
                        <i class="ri-user-3-line text-muted fs-20 me-2"></i>
                        <div>
                            <span class="text-muted">Người phụ trách:</span>
                            <span class="fw-medium ms-1"><a
                                    href="{{ route('employees.edit', $contract->employee->id) }}">{{ $contract->employee->name ?? 'Chưa phân công' }}</a></span>
                            @if (JWTAuth::setToken(Session::get('token'))->getPayload()->get('role') == '1')
                                <button type="button" class="btn btn-link text-warning"
                                    onclick="openAssignmentModal('contract', {{ $contract->id }})">
                                    <i class="ri-pencil-fill align-bottom"></i> Thay đổi
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Sản phẩm</h5>
                </div>
                <div class="card-body">
                    <table id="" class="table table-bordered dt-responsive nowrap table-striped align-middle fs-14"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Tổng giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contract->contractDetails as $item)
                                <tr>
                                    <td>{{ $item->variation->sku }}</td>
                                    <td>{{ $item->variation->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price) }} VNĐ</td>
                                    <td>{{ number_format($item->quantity * $item->price) }} VNĐ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="my-3 d-flex justify-content-between align-items-center">
                        <h5>Danh sách đơn hàng</h5>
                        @if ($contract->contract_status_id == 6)
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#createOrderModal">
                                Tạo đơn hàng
                            </button>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled
                                title="{{ $statusMessages[$contract->contract_status_id] ?? 'Không thể tạo đơn hàng' }}">
                                Tạo đơn hàng
                            </button>
                        @endif
                    </div>
                    <table id="" class="table table-bordered dt-responsive nowrap table-striped align-middle fs-14"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng số tiền</th>
                                <th>Người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Ngày đặt</th>
                                <th>Người phụ trách</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contract->orders as $order)
                                <tr>
                                    <td><a href="{{ route('order.indexDetail', $order->slug) }}">{{ $order->slug }}</a>
                                    </td>
                                    <td>{{ number_format($order->total_amount) }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->number_phone }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('H:i:s d/m/Y') }}</td>
                                    <td>{{ $order->employee->name }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-{{ $order->orderStatus->color }}-subtle text-{{ $order->orderStatus->color }}">
                                            {{ $order->orderStatus->name }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-4 card">
            <div class="my-3 d-flex justify-content-between align-items-center">
                <h5>Lịch sử chuyển tiền</h5>
                @if ($contract->contract_status_id == 6)
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createPaymentModal">
                        Tạo lịch sử chuyển tiền
                    </button>
                @else
                    <button class="btn btn-sm btn-secondary" disabled
                        title="{{ $statusMessages[$contract->contract_status_id] ?? 'Không thể tạo lịch sử chuyển tiền' }}">
                        Tạo lịch sử chuyển tiền
                    </button>
                @endif
            </div>
            <table class="table table-bordered dt-responsive nowrap table-striped align-middle fs-14" style="width:100%">
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
                                        Đã xác nhận
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
    </div><!--end col-->
    </div>
@endsection
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
<div class="modal fade" id="pdfModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem hợp đồng</h5>
                <button type="button" class="btn btn-primary ms-2" id="showStatusBtn">Chi tiết trạng thái</button>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <embed id="pdfViewer" src="" type="application/pdf" width="100%" height="600px">
            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="statusHistoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lịch sử trạng thái hợp đồng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody id="statusHistoryContent">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Creating Order -->
<div class="modal fade" id="createOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('order.storeContract', ['contract_id' => $contract->id, 'customer_id' => $contract->customer_id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="recipientName" class="form-label">Tên người nhận</label>
                        <input type="text" class="form-control" id="recipientName" name="customer_name">
                        <span class="invalid-feedback" id="recipientNameError" style="display: none;"></span>
                    </div>
                    <div class="mb-3">
                        <label for="recipientPhone" class="form-label">Số điện thoại người nhận</label>
                        <input type="text" class="form-control" id="recipientPhone" name="number_phone">
                        <span class="invalid-feedback" id="recipientPhoneError" style="display: none;"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Địa chỉ người nhận</label>
                        <div class="location-select-container">
                            <div class="input-with-icons" id="input-with-icons">
                                <input type="text" id="location-input" class="form-control"
                                    placeholder="Tìm kiếm Tỉnh/ Thành phố, Quận/ Huyện, Phường/ Xã">
                                <div class="icon-container">
                                    <i class="ri-search-line"></i>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                            </div>

                            <div class="location-dropdown p-3 border" id="location-dropdown">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="provinces" class="form-label">Tỉnh/Thành phố</label>
                                        <select id="provinces" name="province" class="form-select">
                                            <option selected disabled value="">Chọn Tỉnh/Thành phố</option>
                                        </select>
                                        <input type="hidden" id="province_name" name="province_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="districts" class="form-label">Quận/Huyện</label>
                                        <select id="districts" name="district" class="form-select" disabled>
                                            <option selected disabled value="">Chọn Quận/Huyện</option>
                                        </select>
                                        <input type="hidden" id="district_name" name="district_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="wards" class="form-label">Phường/Xã</label>
                                        <select id="wards" name="ward" class="form-select" disabled>
                                            <option selected disabled value="">Chọn Phường/Xã</option>
                                        </select>
                                        <input type="hidden" id="ward_name" name="ward_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="address">Địa chỉ cụ thể(*Số nhà, đường, ngõ, ngách, cụm dân
                            cư, thôn)</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            id="address" value="{{ old('address') }}" placeholder="NHập địa chỉ cụ thể"
                            name="address">
                        <span class="invalid-feedback" id="addressError" style="display: none;"></span>

                    </div>
                    <div class="mb-3">
                        <label for="productSelect" class="form-label">Chọn sản phẩm</label>
                        <table class="table table-bordered fs-13">
                            <thead>
                                <tr>
                                    <th>Chọn</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng đã đặt</th>
                                    <th>Số lượng cần thêm</th>
                                    <th>Tồn kho</th>
                                    <th>Số lượng cần mua</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contract->contractDetails as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="product-checkbox"
                                                data-id="{{ $item->id }}" onchange="toggleQuantityInput(this)">
                                        </td>
                                        <td>{{ $item->variation->sku }}</td>
                                        <td>{{ $item->variation->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->remaining_quantity }}</td>
                                        <td>{{ $item->variation->stock }}</td>
                                        <td>
                                            <input type="hidden" name="variation_id[]"
                                                value="{{ $item->variation_id }}">
                                            <input type="number" class="form-control quantity-input"
                                                id="quantity_{{ $item->id }}" min="0"
                                                max="{{ min($item->remaining_quantity, $item->variation->stock) }}"
                                                style="width: 100px; height: 30px; display: none;"
                                                name="product_quantity[]">
                                            @error('product_quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</a>
                        <button type="submit" class="btn btn-primary" id="submitOrder">Tạo đơn hàng</button>
                    </div>
                </form>
            </div>
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
                    url: '{{ route('assignment.update', ['type' => 'contract', 'id' => ':id']) }}'
                        .replace(':id', id),
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        employee_id: employeeId, // Add employeeId to data instead of URL
                        type: 'contract'
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
    </script>
@endpush
<script>
    function toggleQuantityInput(checkbox) {
        const quantityInput = document.getElementById('quantity_' + checkbox.dataset.id);
        if (checkbox.checked) {
            quantityInput.style.display = 'block'; // Hiển thị ô nhập số lượng
        } else {
            quantityInput.style.display = 'none'; // Ẩn ô nhập số lượng
            quantityInput.value = 0; // Đặt lại giá trị về 0
        }
    }

    const locationInput = document.getElementById('location-input');
    const locationDropdown = document.getElementById('location-dropdown');
    const inputWithIcons = document.getElementById('input-with-icons');

    // Toggle dropdown visibility and show search icon when input is clicked
    locationInput.addEventListener('focus', function() {
        locationDropdown.classList.add('active');
        inputWithIcons.classList.add('focused');
    });

    // Hide search icon and dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!inputWithIcons.contains(event.target) && !locationDropdown.contains(event.target)) {
            locationDropdown.classList.remove('active');
            inputWithIcons.classList.remove('focused');
        }
    });

    // Load Provinces on page load
    async function loadProvinces() {
        try {
            const response = await fetch('https://api.mysupership.vn/v1/partner/areas/province');
            const data = await response.json();
            console.log('Provinces data:', data);
            const provinces = data.results;
            populateSelect('provinces', provinces, 'code', 'name');
        } catch (error) {
            console.error('Lỗi khi tải tỉnh/thành phố:', error);
        }
    }

    async function loadDistricts(provinceCode) {
        try {
            const response = await fetch(
                `https://api.mysupership.vn/v1/partner/areas/district?province=${provinceCode}`);
            const data = await response.json();
            console.log('Districts data:', data);
            const districts = data.results;
            populateSelect('districts', districts, 'code', 'name');
            document.getElementById('districts').disabled = false;
            document.getElementById('wards').innerHTML =
                '<option selected disabled value="">Chọn Phường/Xã</option>';
            document.getElementById('wards').disabled = true;
        } catch (error) {
            console.error('Lỗi khi tải quận/huyện:', error);
        }
    }

    async function loadWards(districtCode) {
        try {
            const response = await fetch(
                `https://api.mysupership.vn/v1/partner/areas/commune?district=${districtCode}`);
            const data = await response.json();
            console.log('Wards data:', data);
            const wards = data.results;
            populateSelect('wards', wards, 'code', 'name');
            document.getElementById('wards').disabled = false;
        } catch (error) {
            console.error('Lỗi khi tải xã/phường:', error);
        }
    }

    function populateSelect(selectId, data, codeField, nameField) {
        const select = document.getElementById(selectId);
        select.innerHTML =
            `<option selected disabled value="">Chọn ${selectId === 'provinces' ? 'Tỉnh/Thành phố' : selectId === 'districts' ? 'Quận/Huyện' : 'Phường/Xã'}</option>`;
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item[codeField];
            option.text = item[nameField];
            select.appendChild(option);
        });
    }

    // Update input value when all selects are chosen
    function updateLocationInput() {
        const province = document.getElementById('provinces').selectedOptions[0]?.text || '';
        const district = document.getElementById('districts').selectedOptions[0]?.text || '';
        const ward = document.getElementById('wards').selectedOptions[0]?.text || '';

        locationInput.value = `${province}, ${district}, ${ward}`.trim();
    }

    // Event listeners for dropdown changes
    document.getElementById('provinces').addEventListener('change', function() {
        const provinceName = this.selectedOptions[0].text;
        document.getElementById('province_name').value = provinceName; // Gán tên tỉnh vào input ẩn
        loadDistricts(this.value);
        updateLocationInput();
    });

    document.getElementById('districts').addEventListener('change', function() {
        const districtName = this.selectedOptions[0].text;
        document.getElementById('district_name').value = districtName; // Gán tên quận vào input ẩn
        loadWards(this.value);
        updateLocationInput();
    });

    document.getElementById('wards').addEventListener('change', function() {
        const wardName = this.selectedOptions[0].text;
        document.getElementById('ward_name').value = wardName; // Gán tên phường vào input ẩn
        updateLocationInput();
    });

    // Call loadProvinces when page loads
    document.addEventListener('DOMContentLoaded', loadProvinces);
</script>


@push('scripts')
    <script>
        function showPdf(contractId) {
            const pdfUrl = `{{ url('/hop-dong/xem-hop-dong/') }}/${contractId}/pdf`;
            document.getElementById('pdfViewer').src = pdfUrl;
            new bootstrap.Modal(document.getElementById('pdfModal')).show();
        }
    </script>
@endpush

@push('scripts')
    <script>
        let currentContractId;

        function showPdf(contractId) {
            currentContractId = contractId;
            const pdfUrl = `{{ url('/hop-dong/xem-hop-dong/') }}/${contractId}/pdf`;
            document.getElementById('pdfViewer').src = pdfUrl;
            new bootstrap.Modal(document.getElementById('pdfModal')).show();
        }

        document.getElementById('showStatusBtn').addEventListener('click', function() {
            showStatusHistory(currentContractId);
        });

        function showStatusHistory(contractId) {
            fetch(`/hop-dong/status-history/${contractId}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('statusHistoryContent');
                    tbody.innerHTML = '';
                    data.forEach(item => {
                        const row = `
                            <tr>
                                <td>${item.contract_status.name}</td>
                                <td>${new Date(item.created_at).toLocaleString('vi-VN')}</td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                    new bootstrap.Modal(document.getElementById('statusHistoryModal')).show();
                });
        }

        function toggleQuantityInput(checkbox) {
            const quantityInput = document.getElementById('quantity_' + checkbox.dataset.id);
            if (checkbox.checked) {
                quantityInput.style.display = 'block'; // Hiển thị ô nhập số lượng
            } else {
                quantityInput.style.display = 'none'; // Ẩn ô nhập số lượng
                quantityInput.value = 0; // Đặt lại giá trị về 0
            }
        }

        document.getElementById('submitOrder').addEventListener('click', function(event) {
            event.preventDefault();

            // Kiểm tra và log FormData trước khi gửi
            const formData = new FormData(document.querySelector('form'));
            console.log('FormData before send:', Object.fromEntries(formData));

            // Thêm contract_id vào FormData
            formData.append('contract_id', '{{ $contract->id }}');

            // Kiểm tra dữ liệu sản phẩm
            const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
            if (selectedProducts.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng chọn ít nhất một sản phẩm'
                });
                return;
            }

            // Debug log for form data
            console.log('Form Data:', {
                recipientName: document.getElementById('recipientName').value,
                recipientPhone: document.getElementById('recipientPhone').value,
                address: document.getElementById('address').value,
                province: document.getElementById('province_name').value,
                district: document.getElementById('district_name').value,
                ward: document.getElementById('ward_name').value,
                contract_id: '{{ $contract->id }}',
                customer_id: '{{ $contract->customer_id }}'
            });

            // Log selected products and quantities
            const selectedProducts = [];
            document.querySelectorAll('.product-checkbox:checked').forEach(checkbox => {
                const row = checkbox.closest('tr');
                const variationId = row.querySelector('[name="variation_id[]"]').value;
                const quantity = row.querySelector('.quantity-input').value;
                selectedProducts.push({
                    variation_id: variationId,
                    quantity: quantity,
                    remaining: row.querySelector('td:nth-child(5)').textContent
                });
            });
            console.log('Selected Products:', selectedProducts);

            // Submit form using AJAX instead of regular submit
            const formData = new FormData(document.querySelector('form'));
            
            $.ajax({
                url: '{{ route('order.storeContract') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Server Response:', response);
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: response.message
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', {
                        status: status,
                        error: error,
                        response: xhr.responseText
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Có lỗi xảy ra khi tạo đơn hàng'
                    });
                }
            });
        });
    </script>
@endpush

<!-- Modal for Creating Payment History -->
<div class="modal fade" id="createPaymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo lịch sử chuyển tiền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('payment.store', ['related_id' => $contract->id, 'transaction_type' => 'contract']) }}"
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

            if (paymentId == '') {
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

@push('scripts')
    <script>
        function showDocument(url, fileType) {
            // Ngăn chặn sự kiện click lan tỏa
            event.stopPropagation();

            // Nếu là file ảnh
            Swal.fire({
                imageUrl: url,
                imageWidth: 500,
                imageHeight: 'auto',
                imageAlt: 'Chứng từ thanh toán',
                showCloseButton: true,
                showConfirmButton: false,
                width: '40%',
                customClass: {
                    image: 'img-fluid'
                }
            });
        }
    </script>
@endpush
