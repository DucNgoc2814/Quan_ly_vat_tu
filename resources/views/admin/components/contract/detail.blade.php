@extends('admin.layouts.master')

@section('title')
    Chi tiết hợp đồng
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chi tiết hợp đồng</h4>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                <a href="" class="btn btn-secondary">Quay lại danh sách hợp đồng</a>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary" onclick="showPdf({{ $contract->id }})">Xem hợp đồng</button>
                                <!-- Nút xem hợp đồng -->
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
                                    class="text-muted">{{ number_format($totalPaid) }}/ {{ number_format($contract->total_amount) }} VNĐ</span></p>

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
                    <div class="col-md-6">
                        <div class="my-3 d-flex justify-content-between align-items-center">
                            <h5>Danh sách đơn hàng</h5>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createOrderModal">Tạo
                                đơn hàng</button>
                        </div>
                        <table id=""
                            class="table table-bordered dt-responsive nowrap table-striped align-middle fs-14"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Tổng số tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contract->orders as $order)
                                    <tr>
                                        <td><a href="{{ route('order.indexDetail', $order->slug) }}">{{ $order->slug }}</a></td>
                                        <td>{{ number_format($order->total_amount) }}</td>
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
                    <div class="col-md-6">
                        <div class="my-3 d-flex justify-content-between align-items-center">
                            <h5>Lịch sử chuyển tiền</h5>
                            <button class="btn btn-sm btn-success" onclick="createPaymentHistory({{ $contract->id }})">Tạo
                                lịch sử chuyển tiền</button>
                        </div>
                        <table id=""
                            class="table table-bordered dt-responsive nowrap table-striped align-middle fs-14"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nội dung</th>
                                    <th>Tổng số tiền</th>
                                    <th>Ngày chuyển</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contract->orders as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ number_format($order->total_amount, 2) }} VNĐ</td>
                                        <td>{{ number_format($order->total_amount, 2) }} VNĐ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end col-->
    </div>
@endsection

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



@push('scripts')
    <script>
        function showPdf(contractId) {
            const pdfUrl = `{{ url('/hop-dong/xem-hop-dong/') }}/${contractId}/pdf`;
            document.getElementById('pdfViewer').src = pdfUrl;
            new bootstrap.Modal(document.getElementById('pdfModal')).show();
        }
    </script>
@endpush



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

        document.getElementById('submitOrder').addEventListener('click', function() {
            const recipientName = document.getElementById('recipientName').value;
            const recipientPhone = document.getElementById('recipientPhone').value;
            const province = document.getElementById('province').value;

            // Thu thập sản phẩm và số lượng
            const products = [];
            document.querySelectorAll('.product-checkbox:checked').forEach(checkbox => {
                const quantity = document.getElementById('quantity_' + checkbox.dataset.id).value;
                if (quantity > 0) {
                    products.push({
                        id: checkbox.dataset.id,
                        quantity: quantity
                    });
                }
            });

            const orderData = {
                recipient_name: recipientName,
                recipient_phone: recipientPhone,
                province: province,
                products: products,
                contract_id: {{ $contract->id }} // ID hợp đồng
            };

            // Gọi API để tạo đơn hàng
            fetch('/api/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Thêm CSRF token nếu cần
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Đơn hàng đã được tạo thành công!');
                        $('#createOrderModal').modal('hide');
                    } else {
                        alert('Có lỗi xảy ra: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endpush

<!-- Modal for Creating Order -->
<div class="modal fade" id="createOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('order.storeContract', ['contract_id' => $contract->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="recipientName" class="form-label">Tên người nhận</label>
                        <input type="text" class="form-control" id="recipientName" name="customer_name">
                    </div>
                    <div class="mb-3">
                        <label for="recipientPhone" class="form-label">Số điện thoại người nhận</label>
                        <input type="text" class="form-control" id="recipientPhone" name="number_phone">
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
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                                        <td>
                                            <input type="hidden" name="variation_id[]" value="{{ $item->variation_id }}">
                                            <input type="number" class="form-control quantity-input"
                                                id="quantity_{{ $item->id }}" min="0"
                                                style="width: 100px; height: 30px; display: none;" name="product_quantity[]">
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
                        <button type="submit" class="btn btn-primary">Tạo đơn hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
</script>

<script>
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

        // Update the location input field with the selected values (tên của tỉnh, huyện, xã)
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
