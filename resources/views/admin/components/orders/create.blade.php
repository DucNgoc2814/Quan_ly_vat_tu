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
                                            <span class="dataCustom">{{ $customer->id }} - {{ $customer->name }} - {{ $customer->number_phone }}</span>
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
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="customer_name">Tên người nhận.</label>
                            <input type="text" class="form-control  @error('customer_name') is-invalid @enderror"
                                id="customer_name" value="{{ old('customer_name') }}" placeholder="Nhập tên người nhận "
                                name="customer_name">
                            {{-- {{ Auth::user()->name }} --}}
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
                        <div class="mb-2">
                            <label class="form-label" for="address">Địa chỉ giao hàng</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                value="{{ old('address') }}" placeholder="Nhập địa chỉ giao hàng" name="address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                </div>
                <!-- end card -->


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
@endsection
