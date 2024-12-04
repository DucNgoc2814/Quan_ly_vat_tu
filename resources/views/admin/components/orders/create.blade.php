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
            <div class="col-lg-6">
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

                        <div class="mt-2 ">
                            <label class="form-label" for="payment_id">Phương thức thanh toán</label>
                            <select class="form-select @error('payment_id') is-invalid @enderror" id="payment_id"
                                name="payment_id" data-choices data-choices-search-false>
                                <option value="">Chọn Phương Thức Thanh Toán</option>
                                @foreach ($payments as $id => $name)
                                    <option value="{{ $id }}" @if (old('payment_id') == $id) selected @endif>
                                        {{ $name }}</option>
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
                <div class="card" id="receiver-info">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin nhận hàng</h4>
                        <button type="button" class="ri-add-line align-bottom me-1 btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addressListModal">Danh sách địa chỉ</button>
                    </div>
                    <div class="d-flex">
                        <div class="card-body col-md-6">
                            <div class="">
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
                        <div class="card-body col-md-6">
                            <div class="">
                                <label class="form-label" for="number_phone">Số điện thoại người nhận</label>
                                <input type="text" class="form-control @error('number_phone') is-invalid @enderror"
                                    id="number_phone" value="{{ old('number_phone') }}"
                                    placeholder="Nhập số điện thoại người nhận" name="number_phone">
                                @error('number_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="email">Email người nhận</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                value="{{ old('email') }}" placeholder="Nhập email người nhận" name="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
              
                        <div class="my-2">
                            <label class="form-label" for="address">Địa chỉ cụ thể(*Số nhà, đường, ngõ, ngách, cụm
                                dân
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






            </div>
            <div class="col-lg-6">
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
                                            id="product-variant-input" name="variation_id[]"
                                            onchange="updatePrice(this)">
                                            <option value="0">Chọn Sản Phẩm</option>
                                            @foreach ($variation as $variant)
                                                <option value="{{ $variant->id }}"
                                                    data-price="{{ $variant->retail_price }}"
                                                    data-stock="{{ $variant->stock }}">
                                                    {{ $variant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('variation_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-2">
                                                <label class="form-label">Giá sản phẩm</label>
                                                <input type="number" class="form-control" name="product_price[]"
                                                    id="product-price-input">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-2">
                                                <label class="form-label">Số lượng sản phẩm</label>
                                                <input type="number" class="form-control" name="product_quantity[]"
                                                    id="product-quantity-input" placeholder="Nhập số lượng">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-2">
                                                <label class="form-label">Số lượng trong kho</label>
                                                <input type="number" class="form-control" name="stock"
                                                    id="product-stock-input" readonly>
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
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="mb-0">
                                    <label class="form-label" for="total_amount">Tổng giá trị đơn hàng</label>
                                    <input type="text" class="form-control form-control" id="total_amount"
                                        value="" readonly name="total_amount">
                                    @error('total_order_value')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-0 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success w-sm">Thêm mới</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

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
        function updateAllSelects() {
            const allSelects = document.querySelectorAll('[name="variation_id[]"]');
            const selectedValues = Array.from(allSelects).map(select => select.value);

            allSelects.forEach((select, index) => {
                const currentValue = select.value;
                let options = `<option value="0">Chọn Sản Phẩm</option>`;

                @foreach ($variation as $variant)
                    options += `
                ${currentValue == "{{ $variant->id }}" || !selectedValues.includes("{{ $variant->id }}") ?
                `<option value="{{ $variant->id }}"
                                                            data-price="{{ $variant->retail_price }}"
                                                            data-stock="{{ $variant->stock }}"
                                                            ${currentValue == "{{ $variant->id }}" ? 'selected' : ''}>
                                                            {{ $variant->name }}
                                                        </option>` : ''}
            `;
                @endforeach

                select.innerHTML = options;
            });
        }
        // Hàm để cập nhật giá khi chọn sản phẩm
        function updatePrice(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];

            // Debug
            console.log('Selected option:', selectedOption);
            console.log('Data attributes:', {
                price: selectedOption.getAttribute('data-price'),
                stock: selectedOption.getAttribute('data-stock')
            });

            // Lấy giá trị
            const price = selectedOption.getAttribute('data-price') || selectedOption.dataset.price;
            const stock = selectedOption.getAttribute('data-stock') || selectedOption.dataset.stock;

            console.log('Final values:', {
                price,
                stock
            });

            // Tìm container và inputs
            const container = selectElement.closest('.col-md-12');
            const priceInput = container.querySelector('input[name="product_price[]"]');
            const stockInput = container.querySelector('input[name="stock"]');

            // Debug found elements
            console.log('Found elements:', {
                container: container,
                priceInput: priceInput,
                stockInput: stockInput
            });

            // Cập nhật giá trị
            if (priceInput && price) {
                priceInput.value = price;
                console.log('Updated price input:', priceInput.value);
            }

            if (stockInput && stock) {
                stockInput.value = stock;
                console.log('Updated stock input:', stockInput.value);
            }
            updateAllSelects();
        }

        function addProduct() {
            let id = 'product_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            // Lấy tất cả các sản phẩm đã chọn
            const selectedProducts = Array.from(document.querySelectorAll('[name="variation_id[]"]')).map(select => select
                .value);

            // Tạo options cho select mới, loại bỏ các sản phẩm đã chọn
            let productOptions = `<option value="0">Chọn Sản Phẩm</option>`;
            @foreach ($variation as $variant)
                productOptions += `
            ${!selectedProducts.includes("{{ $variant->id }}") ?
            `<option value="{{ $variant->id }}"
                                                            data-price="{{ $variant->retail_price }}"
                                                            data-stock="{{ $variant->stock }}">
                                                            {{ $variant->name }}
                                                        </option>` : ''}
        `;
            @endforeach
            let html = `
    <div class="col-md-12" id="${id}_item">
        <hr class="mb-2">
        <div class="mb-2">
            <label class="form-label" for="product-variant-input">Sản phẩm</label>
            <select class="form-select" name="variation_id[]" data-choices data-choices-search-false onchange="updatePrice(this)">
                ${productOptions}
            </select>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-2">
                    <label class="form-label">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="product_price[]">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-2">
                    <label class="form-label">Số lượng sản phẩm</label>
                    <input type="number"
                        class="form-control @error('product_quantity.*') is-invalid @enderror"
                        name="product_quantity[]"
                        placeholder="Nhập số lượng">
                    <div class="invalid-feedback d-block product-quantity-error"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-2">
                    <label class="form-label">Số lượng trong kho</label>
                    <input type="number" class="form-control" name="stock" readonly>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <button type="button" class="btn btn-danger" onclick="removeProduct('${id}_item')">
                <span class="bx bx-trash"></span> Xóa sản phẩm
            </button>
        </div>
    </div>`;

            document.getElementById('product_list').insertAdjacentHTML('beforeend', html);
            addInputListeners();
            updateAllSelects();
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

        document.addEventListener('DOMContentLoaded', function() {
            // Get old values
            const oldVariationIds = @json(old('variation_id', []));
            const oldQuantities = @json(old('product_quantity', []));
            const oldPrices = @json(old('product_price', []));

            // If there are old values, set them
            if (oldVariationIds.length > 0) {
                // Set values for default item first
                const defaultSelect = document.querySelector('#product_default_item [name="variation_id[]"]');
                const defaultPrice = document.querySelector('#product_default_item [name="product_price[]"]');
                const defaultQuantity = document.querySelector('#product_default_item [name="product_quantity[]"]');

                if (defaultSelect) defaultSelect.value = oldVariationIds[0];
                if (defaultPrice) defaultPrice.value = oldPrices[0];
                if (defaultQuantity) defaultQuantity.value = oldQuantities[0];

                // Add additional items if there were more than one
                for (let i = 1; i < oldVariationIds.length; i++) {
                    addProduct();
                }

                // Set values for additional items
                document.querySelectorAll('[name="variation_id[]"]').forEach((select, index) => {
                    if (index === 0) return; // Skip default item
                    select.value = oldVariationIds[index];
                    const priceInput = select.closest('.col-md-12').querySelector(
                        '[name="product_price[]"]');
                    const quantityInput = select.closest('.col-md-12').querySelector(
                        '[name="product_quantity[]"]');

                    if (priceInput) priceInput.value = oldPrices[index];
                    if (quantityInput) quantityInput.value = oldQuantities[index];
                });

                // Recalculate total
                calculateTotal();
            }
        });


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
                                    <button class="btn btn-link p-0 text-primary" onclick="selectAddress('${location.id}')">Chọn</button>
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

            window.deleteAddress = function(locationId) {
                if (confirm("Bạn có chắc muốn xóa địa chỉ này không?")) {
                    fetch(`/locations/${locationId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                document.querySelector('[data-bs-target="#addressListModal"]')
                                    .click(); // Refresh danh sách địa chỉ
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            };
        });
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

                fetch(`/orders/customer-location/${customerId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Reset form trước
                        document.getElementById('customer_name').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('number_phone').value = '';
                        document.getElementById('address').value = '';
                        document.getElementById('location-input').value = '';

                        if (data && data.is_active) {
                            // Cập nhật thông tin cơ bản
                            document.getElementById('customer_name').value = data.customer_name || '';
                            document.getElementById('email').value = data.email || '';
                            document.getElementById('number_phone').value = data.number_phone || '';
                            document.getElementById('address').value = data.address || '';

                            const locationInput = document.getElementById('location-input');
                            locationInput.value = `${data.province}, ${data.district}, ${data.ward}`;

                            // Tải danh sách tỉnh/thành và thêm dữ liệu hiện tại vào đầu danh sách
                            loadProvinces().then(() => {
                                const provinceSelect = document.getElementById('provinces');
                                const districtSelect = document.getElementById('districts');
                                const wardSelect = document.getElementById('wards');

                                // Thêm option hiện tại vào đầu danh sách các select
                                const currentProvinceOption = new Option(data.province, data
                                    .province_code, true, true);
                                provinceSelect.insertBefore(currentProvinceOption,
                                    provinceSelect.firstChild);

                                const currentDistrictOption = new Option(data.district, data
                                    .district_code, true, true);
                                districtSelect.innerHTML = '';
                                districtSelect.appendChild(currentDistrictOption);

                                const currentWardOption = new Option(data.ward, data.ward_code,
                                    true, true);
                                wardSelect.innerHTML = '';
                                wardSelect.appendChild(currentWardOption);

                                // Enable các select
                                provinceSelect.disabled = false;
                                districtSelect.disabled = false;
                                wardSelect.disabled = false;

                                // Cập nhật hidden inputs
                                document.getElementById('province_name').value = data.province;
                                document.getElementById('district_name').value = data.district;
                                document.getElementById('ward_name').value = data.ward;

                                // Thêm event listener cho province select
                                provinceSelect.addEventListener('change', function() {
                                    if (this.value !== data.province_code) {
                                        loadDistricts(this.value);
                                    }
                                });

                                // Thêm event listener cho district select
                                districtSelect.addEventListener('change', function() {
                                    if (this.value !== data.district_code) {
                                        loadWards(this.value);
                                    }
                                });
                            });
                        } else {
                            // Xử lý khi không có địa chỉ mặc định
                            loadProvinces().then(() => {
                                const provinceSelect = document.getElementById('provinces');
                                const districtSelect = document.getElementById('districts');
                                const wardSelect = document.getElementById('wards');

                                provinceSelect.disabled = false;
                                districtSelect.innerHTML =
                                    '<option selected disabled>Chọn Quận/Huyện</option>';
                                wardSelect.innerHTML =
                                    '<option selected disabled>Chọn Phường/Xã</option>';
                                districtSelect.disabled = true;
                                wardSelect.disabled = true;
                            });

                            // Cập nhật thông tin cơ bản nếu có
                            if (data) {
                                document.getElementById('customer_name').value = data.customer_name ||
                                    '';
                                document.getElementById('email').value = data.email || '';
                                document.getElementById('number_phone').value = data.number_phone || '';
                            }
                        }

                        document.getElementById('receiver-info').style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('receiver-info').style.display = 'block';
                    });
            });
        });
    </script>

    <script>
        function setDefaultAddress(locationId) {
            $.ajax({
                url: "{{ route('setDefaultAddress') }}",
                type: "POST",
                data: {
                    location_id: locationId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        // Cp nhật UI badges
                        $('.badge.bg-danger').remove();
                        $('button[onclick="setDefaultAddress(' + locationId + ')"]').closest('.address-item')
                            .find('strong').after('<span class="badge bg-danger ms-2">Mặc định</span>');

                        // Gọi API để lấy thông tin chi tiết địa chỉ
                        fetch(`/locations/getLocation/${locationId}`)
                            .then(response => response.json())
                            .then(data => {
                                // Cập nhật thông tin người nhận
                                document.getElementById('customer_name').value = data.customer_name;
                                document.getElementById('number_phone').value = data.number_phone;
                                document.getElementById('email').value = data.email;
                                document.getElementById('address').value = data.address;

                                // Cập nhật địa chỉ
                                document.getElementById('location-input').value =
                                    `${data.province}, ${data.district}, ${data.ward}`;

                                // Cập nhật các trường ẩn
                                document.getElementById('province_name').value = data.province;
                                document.getElementById('district_name').value = data.district;
                                document.getElementById('ward_name').value = data.ward;

                                // Đóng modal
                                const modal = bootstrap.Modal.getInstance(document.getElementById(
                                    'addressListModal'));
                                modal.hide();
                            });

                    } else {
                        alert("Có lỗi xảy ra, vui lòng thử lại.");
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Có lỗi xảy ra, vui lòng thử lại.");
                }
            });
        }
    </script>

    <script>
        function selectAddress(locationId) {
            event.preventDefault();

            fetch(`/locations/getLocation/${locationId}`)
                .then(response => response.json())
                .then(data => {
                    // Cập nhật thông tin người nhận
                    document.getElementById('customer_name').value = data.customer_name;
                    document.getElementById('number_phone').value = data.number_phone;
                    document.getElementById('email').value = data.email;
                    document.getElementById('address').value = data.address;

                    // Cập nhật địa chỉ
                    document.getElementById('location-input').value =
                        `${data.province}, ${data.district}, ${data.ward}`;

                    // Cập nhật các trường ẩn
                    document.getElementById('province_name').value = data.province;
                    document.getElementById('district_name').value = data.district;
                    document.getElementById('ward_name').value = data.ward;

                    // Đóng modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addressListModal'));
                    modal.hide();
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
