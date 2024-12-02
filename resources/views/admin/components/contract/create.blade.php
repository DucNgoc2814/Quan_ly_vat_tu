@extends('admin.layouts.master')

@section('title')
    Thêm hợp đồng
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm hợp đồng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hợp đồng</a></li>
                        <li class="breadcrumb-item active">Thêm hợp đồng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('contract.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="form-label" for="customer_id">Đại diện bên B</label>
                                <div class="position-relative">
                                    <input type="text" name="customer_name"
                                        class="form-control @error('customer_name') is-invalid @enderror" id="customer_id"
                                        placeholder="Nhập tên người đặt" autocomplete="off">
                                    <input type="hidden" name="customer_id" id="hidden_customer_id">
                                    <div class="customer-list-dropdown" style="display:none;">
                                        <ul class="list-group">
                                            @foreach ($customers as $customer)
                                                <li class="list-group-item customer-item" data-id="{{ $customer->id }}"
                                                    data-phone="{{ $customer->number_phone }}"
                                                    data-email="{{ $customer->email }}">
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
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="form-label">Số điện thoại bên B</label>
                                <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"
                                    class="form-control @error('customer_phone') is-invalid @enderror"
                                    placeholder="Nhập số điện thoại">
                                @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="form-label">Email bên B</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                    class="form-control @error('customer_email') is-invalid @enderror"
                                    placeholder="Nhập email">
                                @error('customer_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sản phẩm bên B mua</h4>
                        <button type="button" class="btn btn-primary" onclick="addProduct()">
                            <i class="ri-add-line align-bottom me-1"></i>Thêm sản phẩm
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row gy-4" id="product_list">
                            @if (old('variation_id'))
                                @foreach (old('variation_id') as $key => $variationId)
                                    <div class="col-md-12 d-flex mt-4" id="product_{{ $key }}_item">
                                        <div class="col-8 me-3">
                                            <label class="form-label">Sản phẩm bên B mua</label>
                                            <select class="form-select @error('variation_id.' . $key) is-invalid @enderror"
                                                name="variation_id[]" data-choices data-choices-search-false onchange="updateProductOptions()">
                                                <option value="0">Chọn Sản Phẩm</option>
                                                @foreach ($variation as $variant)
                                                    <option value="{{ $variant->id }}"
                                                        {{ $variationId == $variant->id ? 'selected' : '' }}
                                                        data-price="{{ $variant->price_export }}"
                                                        data-stock="{{ $variant->stock }}">
                                                        {{ $variant->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('variation_id.' . $key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-3 me-3">
                                            <label class="form-label">Số lượng sản phẩm</label>
                                            <input type="number"
                                                class="form-control @error('quantity.' . $key) is-invalid @enderror"
                                                name="quantity[]" value="{{ old('quantity.' . $key) }}"
                                                placeholder="Nhập số lượng">
                                            @error('quantity.' . $key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-1 d-flex align-items-end mb-3">
                                            @if ($key > 0)
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeProduct('product_{{ $key }}_item')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12 d-flex mt-4" id="product_default_item">
                                    <div class="col-md-12">
                                        <label class="form-label">Sản phẩm bên B mua</label>
                                        <select class="form-select @error('variation_id.0') is-invalid @enderror"
                                            name="variation_id[]" data-choices data-choices-search-false>
                                            <option value="0">Chọn Sản Phẩm</option>
                                            @foreach ($variation as $variant)
                                                <option value="{{ $variant->id }}"
                                                    data-price="{{ $variant->price_export }}"
                                                    data-stock="{{ $variant->stock }}">
                                                    {{ $variant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('variation_id.0')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex mt-4">
                                    <div class="col-md-12">
                                        <label class="form-label">Số lượng sản phẩm</label>
                                        <input type="number"
                                            class="form-control @error('quantity.0') is-invalid @enderror"
                                            name="quantity[]" placeholder="Nhập số lượng">
                                        @error('quantity.0')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex mt-4">
                                    <div class="col-md-12">
                                        <label class="form-label">Giá sản phẩm</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            name="price[]" placeholder="Nhập giá sản phẩm">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 d-flex">
                            <div class="col-md-5 me-2">
                                <label for="exampleInputdate" class="form-label">Ngày bắt đầu</label>
                                <input type="date" class="form-control" name="timestart" id="exampleInputdate"
                                    value="{{ old('timestart') }}">
                                @error('timestart')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-5 ">
                                <label for="exampleInputdate" class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control" name="timeend" id="exampleInputdate"
                                    value="{{ old('timeend') }}">
                                @error('timeend')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success">Thêm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateProductOptions() {
            const selects = document.querySelectorAll('select[name="variation_id[]"]');
            const selectedValues = new Set();

            selects.forEach(select => {
                if (select.value !== '0') {
                    selectedValues.add(select.value);
                }
            });
            selects.forEach(select => {
                const currentValue = select.value;
                Array.from(select.options).forEach(option => {
                    const optionValue = option.value;
                    // Không disable option đang được chọn và option mặc định
                    if (optionValue === '0' || optionValue === currentValue) {
                        option.disabled = false;
                    } else {
                        // Disable nếu đã được chọn ở select box khác
                        option.disabled = selectedValues.has(optionValue);
                    }
                });
            });
        }


        function addProduct() {
            const productCount = document.querySelectorAll('select[name="variation_id[]"]').length;
            const newId = `product_select_${productCount}`;

            const html = `
            <div class="row" id="${newId}_container">
                <div class="col-12 mt-4">
                    <label class="form-label">Sản phẩm bên B mua</label>
                    <select class="form-select" name="variation_id[]" id="${newId}" onchange="updateProductOptions()">
                        <option value="0">Chọn Sản Phẩm</option>
                        @foreach ($variation as $variant)
                            <option value="{{ $variant->id }}"
                                data-price="{{ $variant->price_export }}"
                                data-stock="{{ $variant->stock }}">
                                {{ $variant->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-4">
                    <label class="form-label">Số lượng sản phẩm</label>
                    <input type="number" class="form-control" name="quantity[]" placeholder="Nhập số lượng">
                </div>
                <div class="col-12 mt-4">
                    <label class="form-label">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="price[]" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="col-12 mt-4">
                    <button type="button" class="btn btn-danger" onclick="removeProduct('${newId}_container')">
                        <i class="ri-delete-bin-line"></i> Xóa
                    </button>
                </div>
            </div>`;

            document.getElementById('product_list').insertAdjacentHTML('beforeend', html);
            updateProductOptions();
        }

        function removeProduct(containerId) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                document.getElementById(containerId).remove();
                updateProductOptions();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            setupProductSelects();
            setupCustomerDropdown();
        });

        function setupProductSelects() {
            const selects = document.querySelectorAll('select[name="variation_id[]"]');
            selects.forEach(select => {
                select.addEventListener('change', updateProductOptions);
            });
            updateProductOptions();
        }

        function setupCustomerDropdown() {
            const customerInput = document.getElementById('customer_id');
            const dropdown = document.querySelector('.customer-list-dropdown');
            const customerItems = document.querySelectorAll('.customer-item');
            const hiddenInput = document.createElement('input');

            hiddenInput.type = 'hidden';
            hiddenInput.name = 'customer_id';
            customerInput.parentNode.appendChild(hiddenInput);
            customerInput.name = 'customer_display';

            customerInput.addEventListener('input', function() {
                const searchText = this.value.toLowerCase();
                let hasMatch = false;

                customerItems.forEach(item => {
                    const name = item.querySelector('.fw-bold').textContent.toLowerCase();
                    const phone = item.querySelector('.text-muted').textContent.toLowerCase();
                    const isMatch = name.includes(searchText) || phone.includes(searchText);

                    item.style.display = isMatch ? 'block' : 'none';
                    if (isMatch) hasMatch = true;
                });

                dropdown.style.display = hasMatch ? 'block' : 'none';
            });

            customerItems.forEach(item => {
                item.addEventListener('click', function() {
                    const customerId = this.getAttribute('data-id');
                    const name = this.querySelector('.fw-bold').textContent;
                    const phone = this.querySelector('.text-muted').textContent;
                    const email = this.getAttribute('data-email');

                    customerInput.value = name;
                    hiddenInput.value = customerId;
                    document.querySelector('input[name="customer_phone"]').value = phone;
                    document.querySelector('input[name="customer_email"]').value = email;
                    dropdown.style.display = 'none';
                });
            });

            document.addEventListener('click', function(e) {
                if (!customerInput.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
        }
    </script>
@endsection
