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

    <form method="POST" action="{{ route('importOrder.store') }}">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="payment_id ">PTTT</label>
                            <select class="form-select @error('payment_id') is-invalid @enderror" id="payment_id"
                                name="payment_id" data-choices data-choices-search-false>
                                <option value="">Chọn Tên</option>
                                @foreach ($payments as $pay)
                                    <option value="{{ $pay->id }}">{{ $pay->name }}</option>
                                @endforeach
                            </select>
                            @error('payment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="supplier_id ">Tên nhà cung cấp</label>
                            <select class="form-select @error('supplier_id') is-invalid @enderror" id="supplier_id"
                                name="supplier_id" data-choices data-choices-search-false>
                                <option value="">Chọn Tên</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- end --}}
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
                                            @foreach ($variants as $variant)
                                                <option value="{{ $variant->id }}" data-stock="{{ $variant->stock }}">
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
                                        <input type="number"
                                            class="form-control @error('product_price') is-invalid @enderror"
                                            id="product-price-input" placeholder="Nhập giá sản phẩm" name="product_price[]">
                                        @error('product_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                 @foreach ($variants as $variant)
                    <option value="{{ $variant->id }}" data-stock="{{ $variant->stock }}">
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
            <input type="number" class="form-control @error('product_price') is-invalid @enderror" name="product_price[]"  placeholder="Nhập giá sản phẩm">
            @error('product_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label" for="product-quantity-input">Số lượng sản phẩm</label>
                    <input type="number" class="form-control  @error('product_quantity') is-invalid @enderror" name="product_quantity[]" placeholder="Nhập số lượng" min="1">
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
            const stock = selectedOption.getAttribute('data-stock');

            const stockInput = selectElement.closest('.col-md-12').querySelector('input[name="stock"]');

            if (stockInput) {
                stockInput.value = stock;
            }
            calculateTotal();
        }

        // Hàm để thêm sự kiện lắng nghe cho input
        function addInputListeners() {
            // Thêm sự kiện lắng nghe cho tất cả các input số lượng
            document.querySelectorAll('[name="product_quantity[]"]').forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            // Thêm sự kiện lắng nghe cho tất cả các input giá
            document.querySelectorAll('[name="product_price[]"]').forEach(input => {
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
            addInputListeners(); // Lắng nghe các sự kiện cho input
            calculateTotal(); // Tính tổng ngay khi trang tải
        });
    </script>
@endsection
