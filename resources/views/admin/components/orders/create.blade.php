@extends('admin.layouts.master')
@section('title')
    Thêm đơn hàng
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới đơn hàng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                        <li class="breadcrumb-item active">Thêm mới đơn hàng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <form method="POST" class="form-datalist" action="{{ route('order.store') }}">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mb-2">
                        <label class="form-label" for="customer_id">Tên người đặt</label>
                        <div class="position-relative">
                            <input type="text" name="customer_id"
                                class="form-control @error('customer_id') is-invalid @enderror" id="customer_id"
                                placeholder="Nhập tên người đặt" autocomplete="off">
                            <input type="hidden" name="customer_id" id="hidden_customer_id">
                            <div class="customer-list-dropdown" style="display:none;">
                                <ul class="list-group">
                                    @foreach ($customers as $customer)
                                        <li class="list-group-item customer-item" data-id="{{ $customer->id }}">
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-user fs-4 me-2"></i>
                                                <div>
                                                    <div class="fw-bold">{{ $customer->name }}</div>
                                                    <small class="text-muted">{{ $customer->number_phone }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @error('customer_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card" id="receiver-info">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin nhận hàng</h4>
                        <button type="button" class="ri-add-line align-bottom me-1 btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addressListModal">Danh sách địa chỉ</button>

                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="customer_name">Tên người nhận</label>
                            <input type="text" class="form-control  @error('customer_name') is-invalid @enderror"
                                id="customer_name" value="{{ old('customer_name') }}" placeholder="Nhập tên người nhận "
                                name="customer_name">
                            @error('customer_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="number_phone">Số điện thoại người nhận</label>
                            <input type="text" class="form-control @error('number_phone') is-invalid @enderror"
                                id="number_phone" value="{{ old('number_phone') }}"
                                placeholder="Nhập số điện thoại người nhận" name="number_phone">
                            {{-- {{ Auth::user()->number_phone }}e"> --}}
                            @error('number_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="email">Email người nhận</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                value="{{ old('email') }}" placeholder="Nhập email người nhận" name="email">
                            {{-- {{ Auth::user()->email }} --}}
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body">
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
                                    <!-- Select Tỉnh/Thành phố -->
                                    <div class="col-md-4">
                                        <label for="provinces" class="form-label">Tỉnh/Thành phố</label>
                                        <select id="provinces" name="province" class="form-select">
                                            <option selected disabled value="">Chọn Tỉnh/Thành phố</option>
                                        </select>
                                        <input type="hidden" id="province_name" name="province_name">
                                    </div>

                                    <!-- Select Quận/Huyện -->
                                    <div class="col-md-4">
                                        <label for="districts" class="form-label">Quận/Huyện</label>
                                        <select id="districts" name="district" class="form-select" disabled>
                                            <option selected disabled value="">Chọn Quận/Huyện</option>
                                        </select>
                                        <input type="hidden" id="district_name" name="district_name">
                                    </div>

                                    <!-- Select Phường/Xã -->
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
                    <div class="card-body">
                        <div class="mb-2">
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
                    </div>
                </div>
                <!-- end card -->

                <!-- Modal for Address List -->
                <div class="modal fade" id="addressListModal" tabindex="-1" aria-labelledby="addressListModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addressListModalLabel">Danh sách địa chỉ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Khu vực này sẽ được cập nhật động bằng JavaScript -->
                                <div class="address-list">
                                    <!-- Nội dung sẽ được JavaScript thêm vào đây -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="payment_id">Phương thức thanh toán</label>
                            <select class="form-select @error('payment_id') is-invalid @enderror" id="payment_id"
                                name="payment_id" data-choices data-choices-search-false>
                                <option value="">Chọn Phương Thức Thanh Toán</option>
                                @foreach ($payments as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('payment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sản phẩm mua</h4>
                        <button type="button" class="ri-add-line align-bottom me-1 btn btn-primary"
                            onclick="addProduct()">Thêm sản phẩm</button>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="product_list">
                                <div class="col-md-12" id="product_default_item">
                                    <div class="mb-2">
                                        <label class="form-label" for="product-variant-input">Sản phẩm</label>
                                        <select class="form-select @error('variation_id') is-invalid @enderror"
                                            id="product-variant-input" name="variation_id[]" data-choices
                                            data-choices-search-false onchange="updatePrice(this)">
                                            <option value="0">Chọn Sản Phẩm</option>
                                            @foreach ($variation as $variant)
                                                <option value="{{ $variant->id }}"
                                                    data-price="{{ $variant->price_export }}"
                                                    data-stock="{{ $variant->stock }}">
                                                    {{ $variant->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('variation_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="product-price-input">Giá sản phẩm</label>
                                        <input type="number" class="form-control" id="product-price-input"
                                            name="product_price[]" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="product-quantity-input">Số lượng sản
                                                    phẩm</label>
                                                <input type="number"
                                                    class="form-control  @error('product_quantity') is-invalid @enderror"
                                                    id="product-quantity-input" name="product_quantity[]"
                                                    value="{{ old('product_quantity[]') }}" placeholder="Nhập số lượng">
                                                @error('product_quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label" for="product-stock-input">Số lượng sản
                                                    phẩm có trong kho</label>
                                                <input type="number" class="form-control" id="product-stock-input"
                                                    name="stock" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label" for="total_amount">Tổng giá trị đơn hàng</label>
                                    <input type="text" class="form-control form-control-lg" id="total_amount"
                                        value="" readonly name="total_amount">
                                    @error('total_order_value')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label" for="paid_amount">Số tiền đã trả</label>
                                    <input type="text"
                                        class="form-control form-control-lg  @error('paid_amount') is-invalid @enderror"
                                        id="paid_amount" value="{{ old('paid_amount') }}"
                                        placeholder="Nhập số tiền đã trả" name="paid_amount">
                                    @error('paid_amount')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Thêm mới</button>
                </div>
            </div>
    </form>
    <script>
        document.getElementById('product-image-input').addEventListener('change', function(event) {
            var output = document.getElementById('product-img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        });
    </script>
@endsection
@section('scripts')
    <script>
        // Hàm để thêm sản phẩm mới
        function addProduct() {
            let id = 'product_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
            <div class="col-md-12" id="${id}_item">
                <hr class="mb-2">
                <div class="mb-2">
                    <label class="form-label" for="product-variant-input">Sản phẩm</label>
                    <select class="form-select @error('variation_id') is-invalid @enderror" name="variation_id[]" data-choices data-choices-search-false onchange="updatePrice(this)">
                        <option value="0">Chọn Sản Phẩm</option>
                        @foreach ($variation as $variant)
                            <option value="{{ $variant->id }}" data-price="{{ $variant->price_export }}" data-stock="{{ $variant->stock }}">
                                {{ $variant->name }}</option>
                        @endforeach
                    </select>
                    @error('variation_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label" for="product-price-input">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="product_price[]" readonly>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="product-quantity-input">Số lượng sản phẩm</label>
                            <input type="number" class="form-control  @error('product_quantity') is-invalid @enderror" name="product_quantity[]" placeholder="Nhập số lượng" min="1" value="1">
                            @error('product_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="product-stock-input">Số lượng sản phẩm có trong kho</label>
                            <input type="number" class="form-control" name="stock" readonly>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeProduct('${id}_item')">
                        <span class="bx bx-trash"></span> Xóa sản phẩm
                    </button>
                </div>
            </div>
            `;
            document.getElementById('product_list').insertAdjacentHTML('beforeend', html);
            addInputListeners(); // Thêm sự kiện lắng nghe cho sản phẩm mới
        }
        // Hàm để tính tổng giá trị đơn hàng
        function calculateTotal() {
            let total = 0;
            const quantities = document.getElementsByName('product_quantity[]');
            const prices = document.getElementsByName('product_price[]');
            // Tính tổng dựa trên số lượng và giá
            for (let i = 0; i < quantities.length; i++) {
                total += (parseFloat(quantities[i].value) || 0) * (parseFloat(prices[i].value) || 0);
            }
            // Định dạng tổng số thành dạng có dấu chấm phân cách hàng nghìn (ví dụ: 500.000)
            const formattedTotal = total.toFixed(0).toLocaleString('vi-VN');
            // Gán giá trị đã định dạng vào ô input
            document.getElementById('total_amount').value = formattedTotal;
        }
        // Hàm để cập nhật giá khi chọn sản phẩm
        function updatePrice(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const stock = selectedOption.getAttribute('data-stock');
            const priceInput = selectElement.closest('.mb-2').nextElementSibling.querySelector(
                'input[name="product_price[]"]');
            const stockInput = selectElement.closest('.col-md-12').querySelector('input[name="stock"]');
            if (priceInput) {
                priceInput.value = price;
            }
            if (stockInput) {
                stockInput.value = stock;
            }
            calculateTotal();
        }
        // Hàm để thêm sự kiện lắng nghe cho input
        function addInputListeners() {
            document.querySelectorAll('[name="product_quantity[]"]').forEach(input => {
                input.addEventListener('input', calculateTotal);
            });
        }
        // Hàm để xóa sản phẩm
        function removeProduct(id) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                document.getElementById(id).remove();
                calculateTotal();
            }
        }
        // Gọi hàm khi trang được tải lần đầu
        document.addEventListener('DOMContentLoaded', function() {
            addInputListeners();
            calculateTotal();
        });
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const customerItems = document.querySelectorAll('.customer-item');
            const hiddenCustomerIdInput = document.getElementById('hidden_customer_id');
            const addressListContainer = document.querySelector('.address-list');

            // Xử lý khi chọn một khách hàng
            customerItems.forEach(item => {
                item.addEventListener('click', function() {
                    const customerId = this.getAttribute('data-id');
                    hiddenCustomerIdInput.value = customerId;
                    document.getElementById('customer_id').value = this.querySelector('.fw-bold')
                        .innerText;
                });
            });

            // Xử lý khi mở modal danh sách địa chỉ
            document.querySelector('[data-bs-target="#addressListModal"]').addEventListener('click', function() {
                const customerId = hiddenCustomerIdInput.value;

                // Gọi AJAX để lấy danh sách địa chỉ dựa trên customer_id
                if (customerId) {
                    fetch(`/locations/${customerId}`)
                        .then(response => response.json())
                        .then(locations => {
                            addressListContainer.innerHTML = '';
                            locations.forEach(location => {
                                addressListContainer.innerHTML += `
                            <div class="address-item mb-3">
                                <strong>${location.customer_name}</strong> <br>
                                ${location.number_phone} <br>
                                ${location.address} <br>
                                ${location.ward}, ${location.district}, ${location.province} <br>
                                ${location.is_active ? '<span class="badge bg-danger">Mặc định</span>' : ''}
                                <div class="mt-2">
                                    <button class="btn btn-link p-0 text-primary" onclick="selectAddress('${location.id}')">Cập nhật</button>
                                    ${!location.is_active ? `
                                                                                            <button class="btn btn-link p-0 text-danger" onclick="deleteAddress('${location.id}')">Xóa</button>
                                                                                            <button class="btn btn-outline-secondary btn-sm" onclick="event.preventDefault(); setDefaultAddress('${location.id}')">Thiết lập mặc định</button>
                                                                                        ` : `
                                                                                            <button class="btn btn-secondary btn-sm" disabled>Thiết lập mặc định</button>
                                                                                        `}
                                </div>
                            </div>
                            <hr>
                        `;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
    <script>
        function setDefaultAddress(locationId) {
            $.ajax({
                url: "{{ route('setDefaultAddress') }}", // Sử dụng route name 'setDefaultAddress'
                type: "POST",
                data: {
                    location_id: locationId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        // Xóa các badge Mặc định trước đó và thêm badge mới
                        $('.badge.bg-danger').remove();
                        $('button[onclick="setDefaultAddress(' + locationId + ')"]').closest('.address-item')
                            .find('strong').after('<span class="badge bg-danger ms-2">Mặc định</span>');
                    } else {
                        alert("Có lỗi xảy ra, vui lòng thử lại.");
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // In lỗi để debug
                    alert("Có lỗi xảy ra, vui lòng thử lại.");
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const customerInput = document.getElementById('customer_id');
            const dropdown = document.querySelector('.customer-list-dropdown');
            const customerItems = document.querySelectorAll('.customer-item');

            // Thêm hidden input để lưu customer_id
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'customer_id';
            customerInput.parentNode.appendChild(hiddenInput);

            // Đổi name của input hiển thị
            customerInput.name = 'customer_display';

            customerInput.addEventListener('input', function() {
                const searchText = this.value.toLowerCase();
                let hasMatch = false;

                customerItems.forEach(item => {
                    const name = item.querySelector('.fw-bold').textContent.toLowerCase();
                    const phone = item.querySelector('.text-muted').textContent.toLowerCase();

                    if (name.includes(searchText) || phone.includes(searchText)) {
                        item.style.display = 'block';
                        hasMatch = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                dropdown.style.display = hasMatch ? 'block' : 'none';
            });

            customerItems.forEach(item => {
                item.addEventListener('click', function() {
                    const customerId = this.getAttribute('data-id');
                    const name = this.querySelector('.fw-bold').textContent;
                    const phone = this.querySelector('.text-muted').textContent;

                    // Hiển thị tên và số điện thoại trong input
                    customerInput.value = `${name} - ${phone}`;
                    // Lưu ID vào hidden input
                    hiddenInput.value = customerId;

                    dropdown.style.display = 'none';
                });
            });

            document.addEventListener('click', function(e) {
                if (!customerInput.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.customer-item').forEach(item => {
            item.addEventListener('click', function() {
                const customerId = this.getAttribute('data-id');
                document.getElementById('hidden_customer_id').value = customerId;

                // AJAX request
                fetch(`/orders/customer-location/${customerId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            // Cập nhật thông tin cơ bản
                            document.getElementById('customer_name').value = data.customer_name || '';
                            document.getElementById('email').value = data.email || '';
                            document.getElementById('number_phone').value = data.number_phone || '';
                            document.getElementById('address').value = data.address || '';

                            // Cập nhật location input
                            const locationInput = document.getElementById('location-input');
                            locationInput.value = data.province && data.district && data.ward ?
                                `${data.province}, ${data.district}, ${data.ward}` : '';

                            // Cập nhật các select box và hidden inputs
                            const provinceSelect = document.getElementById('provinces');
                            const districtSelect = document.getElementById('districts');
                            const wardSelect = document.getElementById('wards');

                            // Cập nhật province
                            provinceSelect.innerHTML =
                                `<option selected value="${data.province_code}">${data.province || 'Chọn Tỉnh/Thành phố'}</option>`;
                            document.getElementById('province_name').value = data.province;
                            document.querySelector('select[name="province"]').value = data
                                .province_code;

                            // Cập nhật district
                            districtSelect.innerHTML =
                                `<option selected value="${data.district_code}">${data.district || 'Chọn Quận/Huyện'}</option>`;
                            document.getElementById('district_name').value = data.district;
                            document.querySelector('select[name="district"]').value = data
                                .district_code;

                            // Cập nhật ward
                            wardSelect.innerHTML =
                                `<option selected value="${data.ward_code}">${data.ward || 'Chọn Phường/Xã'}</option>`;
                            document.getElementById('ward_name').value = data.ward;
                            document.querySelector('select[name="ward"]').value = data.ward_code;

                            // Enable các select box
                            districtSelect.disabled = false;
                            wardSelect.disabled = false;

                            // Hiển thị thông tin người nhận
                            document.getElementById('receiver-info').style.display = 'block';
                        } else {
                            // Reset form khi không có dữ liệu
                            document.getElementById('customer_name').value = '';
                            document.getElementById('email').value = '';
                            document.getElementById('number_phone').value = '';
                            document.getElementById('address').value = '';
                            document.getElementById('location-input').value = '';

                            // Reset các select box
                            document.getElementById('provinces').innerHTML =
                                '<option selected disabled>Chọn Tỉnh/Thành phố</option>';
                            document.getElementById('districts').innerHTML =
                                '<option selected disabled>Chọn Quận/Huyện</option>';
                            document.getElementById('wards').innerHTML =
                                '<option selected disabled>Chọn Phường/Xã</option>';

                            // Reset hidden inputs
                            document.getElementById('province_name').value = '';
                            document.getElementById('district_name').value = '';
                            document.getElementById('ward_name').value = '';

                            // Disable các select phụ thuộc
                            document.getElementById('districts').disabled = true;
                            document.getElementById('wards').disabled = true;

                            // Vẫn hiển thị form
                            document.getElementById('receiver-info').style.display = 'block';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
