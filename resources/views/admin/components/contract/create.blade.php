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
                                <label class="form-label">Tên hợp đồng</label>
                                <input type="text" name="contract_name" placeholder="Nhập tên hợp đồng"
                                    class="form-control">
                                @error('contract_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="form-label">Đại diện bên B</label>
                                <input type="text" name="customer_name" placeholder="Nhập tên hợp đồng"
                                    class="form-control">
                                @error('customer_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="form-label">Số điện thoại bên B</label>
                                <input type="text" name="customer_phone" placeholder="Nhập tên hợp đồng"
                                    class="form-control">
                                @error('customer_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="form-label">Email bên B</label>
                                <input type="text" name="customer_email" placeholder="Nhập tên hợp đồng"
                                    class="form-control">
                                @error('customer_email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sản phẩm bên B mua</h4>
                        <button type="button" class="ri-add-line align-bottom me-1 btn btn-primary"
                            onclick="addProduct()">Thêm sản phẩm</button>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="product_list">
                                <div class="col-md-12" id="product_default_item">
                                    <div class="mb-2">
                                        <label class="form-label" for="product-variant-input">Sản phẩm bên B
                                            mua</label>
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
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="mb-2">
                                                <label class="form-label" for="quantity-input">Số lượng sản
                                                    phẩm</label>
                                                <input type="number"
                                                    class="form-control  @error('quantity') is-invalid @enderror"
                                                    id="quantity-input" name="quantity[]" value="{{ old('quantity[]') }}"
                                                    placeholder="Nhập số lượng">
                                                @error('quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
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
                        <button class = "btn btn-success text">Thêm mới</button>
                    </div>
                </div>

            </form>

        </div><!--end col-->
    </div>
@endsection
@section('scripts')
    <script>
        function addProduct() {
            let id = 'product_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
            <div class="col-md-12" id="${id}_item">
                <hr class="mb-2">
                <div class="mb-2">
                                        <label class="form-label" for="product-variant-input">Sản phẩm bên B
                                            mua</label>
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
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="mb-2">
                                                <label class="form-label" for="quantity-input">Số lượng sản
                                                    phẩm</label>
                                                <input type="number"
                                                    class="form-control  @error('quantity') is-invalid @enderror"
                                                    id="quantity-input" name="quantity[]"
                                                    value="{{ old('quantity[]') }}" placeholder="Nhập số lượng">
                                                @error('quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
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
        }

        function removeProduct(id) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                document.getElementById(id).remove();
                calculateTotal();
            }
        }
    </script>
@endsection
