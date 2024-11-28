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
                                <label class="form-label">Đại diện bên B</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                                    class="form-control @error('customer_name') is-invalid @enderror"
                                    placeholder="Nhập tên khách hàng">
                                @error('customer_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
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
                                                name="variation_id[]" data-choices data-choices-search-false>
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
                                        <input type="number" class="form-control @error('quantity.0') is-invalid @enderror"
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
                                <input type="date" class="form-control" name="timestart" id="exampleInputdate" value="{{ old('timestart') }}">
                                @error('timestart')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-5 ">
                                <label for="exampleInputdate" class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control" name="timeend" id="exampleInputdate" value="{{ old('timeend') }}">
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
        let selectedProducts = new Set();

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateAvailableProducts();
            document.querySelectorAll('select[name="variation_id[]"]').forEach(filterOptions);
        });

        function updateAvailableProducts() {
            selectedProducts.clear();
            document.querySelectorAll('select[name="variation_id[]"]').forEach(select => {
                if (select.value != '0') {
                    selectedProducts.add(select.value);
                }
            });
        }

        function filterOptions(select) {
            Array.from(select.options).forEach(option => {
                if (option.value != '0' && selectedProducts.has(option.value) && option.value != select.value) {
                    option.disabled = true;
                    option.style.display = 'none';
                } else {
                    option.disabled = false;
                    option.style.display = 'block';
                }
            });
        }

        document.addEventListener('change', function(e) {
            if (e.target.matches('select[name="variation_id[]"]')) {
                updateAvailableProducts();
                document.querySelectorAll('select[name="variation_id[]"]').forEach(filterOptions);
            }
        });

        function addProduct() {
            let id = 'product_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
            <div class="row" id="${id}_item">
    <div class="col-12 mt-4">
        <label class="form-label">Sản phẩm bên B mua</label>
        <select class="form-select" name="variation_id[]" data-choices data-choices-search-false>
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
        <input type="number"
            class="form-control @error('quantity.0') is-invalid @enderror"
            name="quantity[]" placeholder="Nhập số lượng">
        @error('quantity.0')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mt-4">
        <label class="form-label">Giá sản phẩm</label>
        <input type="number"
            class="form-control @error('price') is-invalid @enderror"
            name="price[]" placeholder="Nhập giá sản phẩm">
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mt-4">
        <button type="button" class="btn btn-danger" onclick="removeProduct('${id}_item')">
            <i class="ri-delete-bin-line"></i> Xóa
        </button>
    </div>
</div>

        `;
            document.getElementById('product_list').insertAdjacentHTML('beforeend', html);
            updateAvailableProducts();
            document.querySelectorAll('select[name="variation_id[]"]').forEach(filterOptions);
        }

        function removeProduct(id) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                document.getElementById(id).remove();
                updateAvailableProducts();
                document.querySelectorAll('select[name="variation_id[]"]').forEach(filterOptions);
            }
        }
    </script>
@endsection
