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
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="customer_id ">Tên người đặt</label>
                            <input type="text" name="customer_id"
                                class="form-control @error('customer_id') is-invalid @enderror" id="customer_id"
                                placeholder="Nhập tên người đặt" data-choices data-choices-search-false
                                list="customer_id_list">
                            <div class="form-control div-datalist">
                                <ul id="customer_list" class="ul-datalist">
                                    @foreach ($customers as $customer)
                                        <li class="li-datalist">
                                            <i style="font-size: 22px; margin: 5px" class='bx bx-user'></i>
                                            <span class="dataCustom">{{ $customer->id }} - {{ $customer->name }} -
                                                {{ $customer->number_phone }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @error('customer_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card">
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
                                <div class="address-list">
                                    @foreach ($locations as $location)
                                        <div class="address-item mb-3">
                                            <strong>{{ $location->customer_name }}</strong> <br>
                                            (+84)
                                            {{ $location->number_phone }} <br>
                                            {{ $location->address }} <br>
                                            {{ $location->ward }}, {{ $location->district }}, {{ $location->province }}
                                            <br>
                                            @if ($location->is_active)
                                                <span class="badge bg-danger">Mặc định</span>
                                            @endif
                                            <div class="mt-2">
                                                <button class="btn btn-link p-0 text-primary"
                                                    onclick="selectAddress('{{ $location->id }}')">Cập nhật</button>
                                                @if (!$location->is_active)
                                                    <button class="btn btn-link p-0 text-danger"
                                                        onclick="deleteAddress('{{ $location->id }}')">Xóa</button>
                                                    <button class="btn btn-outline-secondary btn-sm"
                                                        onclick="setDefaultAddress('{{ $location->id }}')">Thiết lập mặc
                                                        định</button>
                                                @else
                                                    <button class="btn btn-secondary btn-sm" disabled>Thiết lập mặc
                                                        định</button>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
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
            // console.log(quantities);

            const prices = document.getElementsByName('product_price[]');

            for (let i = 0; i < quantities.length; i++) {
                total += (parseFloat(quantities[i].value) || 0) * (parseFloat(prices[i].value) || 0);
            }

            document.getElementById('total_amount').value = total.toFixed(2);
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
        document.getElementById('customer_id').addEventListener('change', function() {
            const customerId = this.value.split(' ')[0]; // Lấy id khách hàng

            fetch(`/admin/get-locations/${customerId}`)
                .then(response => response.json())
                .then(locations => {
                    const addressList = document.querySelector('.address-list');
                    addressList.innerHTML = ''; // Xóa nội dung cũ

                    locations.forEach(location => {
                        addressList.innerHTML += `
                    <div class="address-item mb-3">
                        <strong>${location.customer_name}</strong> <br>
                        (+84) ${location.number_phone} <br>
                        ${location.address} <br>
                        ${location.ward}, ${location.district}, ${location.province} <br>
                        ${location.is_active ? '<span class="badge bg-danger">Mặc định</span>' : ''}
                        <div class="mt-2">
                            <button class="btn btn-link p-0 text-primary" onclick="updateAddress(${JSON.stringify(location)})">Cập nhật</button>
                            ${!location.is_active ? `
                                                <button class="btn btn-link p-0 text-danger">Xóa</button>
                                                <button class="btn btn-outline-secondary btn-sm">Thiết lập mặc định</button>
                                            ` : `
                                                <button class="btn btn-secondary btn-sm" disabled>Thiết lập mặc định</button>
                                            `}
                        </div>
                    </div>
                    <hr>
                `;
                    });
                });
        });

        function handleAddressListClick() {
            const customerId = document.getElementById('customer_id').value.split(' ')[0];
            const addressList = document.querySelector('.address-list');

            if (!customerId) {
                addressList.innerHTML = '<div class="alert alert-warning">Hãy chọn Tên người đặt</div>';
                return;
            }

            fetch(`/admin/get-locations/${customerId}`)
                .then(response => response.json())
                .then(locations => {
                    if (locations.length === 0) {
                        addressList.innerHTML =
                            '<div class="alert alert-info">Không có địa chỉ nào cho khách hàng này</div>';
                        return;
                    }

                    addressList.innerHTML = locations.map(location => `
                <div class="address-item mb-3">
                    <strong>${location.customer_name}</strong> <br>
                    (+84) ${location.number_phone} <br>
                    ${location.address} <br>
                    ${location.ward}, ${location.district}, ${location.province} <br>
                    ${location.is_active ? '<span class="badge bg-danger">Mặc định</span>' : ''}
                    <div class="mt-2">
                        <button type="button" class="btn btn-link p-0 text-primary" onclick="selectAddress('${JSON.stringify(location).replace(/'/g, "\\'")}')">Cập nhật</button>
                    </div>
                </div>
                <hr>
            `).join('');
                });
        }

        function selectAddress(locationData) {
            const location = JSON.parse(locationData);
            document.getElementById('customer_name').value = location.customer_name;
            document.getElementById('number_phone').value = location.number_phone;
            document.getElementById('email').value = location.email;
            document.getElementById('address').value = location.address;
            document.getElementById('province_name').value = location.province;
            document.getElementById('district_name').value = location.district;
            document.getElementById('ward_name').value = location.ward;

            // Update the location input display
            document.getElementById('location-input').value =
            `${location.province}, ${location.district}, ${location.ward}`;

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addressListModal'));
            modal.hide();
        }


        function updateAddress(location) {
            // Cập nhật các trường thông tin địa chỉ
            document.getElementById('customer_name').value = location.customer_name;
            document.getElementById('number_phone').value = location.number_phone;
            document.getElementById('email').value = location.email;
            document.getElementById('address').value = location.address;

            // Đóng modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addressListModal'));
            modal.hide();
        }

        function selectAddress(locationId) {
            const location = locations.find(l => l.id === locationId);
            if (location) {
                document.getElementById('customer_name').value = location.customer_name;
                document.getElementById('number_phone').value = location.number_phone;
                document.getElementById('email').value = location.email;
                document.getElementById('address').value = location.address;
                // Đóng modal
                $('#addressListModal').modal('hide');
            }
        }
    </script>
@endsection
