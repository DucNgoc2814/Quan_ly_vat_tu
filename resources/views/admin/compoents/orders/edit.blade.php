@extends('admin.layouts.master')

@section('title')
    Cập nhật đơn hàng
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật đơn hàng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                        <li class="breadcrumb-item active">Cập nhật đơn hàng</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="POST" action="{{ route('quan-ly-don-hang.cap-nhat-don-hang', ['slug' => $order->slug]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="customer_id ">Tên người đặt</label>
                            <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id"
                                name="customer_id" data-choices data-choices-search-false>
                                @foreach ($customers as $id => $name)
                                    <option @selected($order->customer_id == $id) value="{{ $id }}">{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="customer_name">Tên người nhận</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                id="customer_name" value="{{ $order->customer_name }}" placeholder="Nhập tên người nhận "
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
                                id="number_phone" value="{{ $order->number_phone }}"
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
                                value="{{ $order->email }}" placeholder="Nhập email người nhận" name="email">
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
                                value="{{ $order->address }}" placeholder="Nhập địa chỉ giao hàng" name="address">
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
                                @foreach ($payments as $id => $name)
                                    <option @selected($order->payment_id == $id) value="{{ $id }}">{{ $name }}
                                    </option>
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
                    {{-- <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="status_id">Trạng thái giao hàng</label>
                            <select class="form-select" id="status_id" name="status_id" data-choices
                                data-choices-search-false>
                                @foreach ($status as $id => $description)
                                    @if ($order->status_id == 1 && in_array($id, [1, 2, 5]))
                                        <option @selected($order->status_id == $id) value="{{ $id }}">
                                            {{ $description }}
                                        </option>
                                    @elseif ($order->status_id == 2 && in_array($id, [2, 3, 5]))
                                        <option @selected($order->status_id == $id) value="{{ $id }}">
                                            {{ $description }}
                                        </option>
                                    @elseif ($order->status_id == 3 && in_array($id, [3, 4]))
                                        <option @selected($order->status_id == $id) value="{{ $id }}">
                                            {{ $description }}
                                        </option>
                                    @elseif ($order->status_id == 4 && $id == 4)
                                        <option @selected($order->status_id == $id) value="{{ $id }}">
                                            {{ $description }}
                                        </option>
                                    @elseif ($order->status_id == 5 && $id == 5)
                                        <option @selected($order->status_id == $id) value="{{ $id }}">
                                            {{ $description }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label" for="status_id">Trạng thái giao hàng</label>
                            @if ($order->status_id == 1)
                                <form action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                    method="POST" class="d-inline status-update-form">
                                    @csrf
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn btn-sm btn-warning">Xác nhận</button>
                                </form>
                                <form action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                    method="POST" class="d-inline status-update-form">
                                    @csrf
                                    <input type="hidden" name="status" value="5">
                                    <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
                                </form>
                            @elseif ($order->status_id == 2)
                                <form action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                    method="POST" class="d-inline status-update-form">
                                    @csrf
                                    <input type="hidden" name="status" value="3">
                                    <button type="submit" class="btn btn-sm btn-secondary">Xử lý</button>
                                </form>
                                <form action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                    method="POST" class="d-inline status-update-form">
                                    @csrf
                                    <input type="hidden" name="status" value="5">
                                    <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
                                </form>
                            @elseif ($order->status_id == 3)
                                <form action="{{ route('quan-ly-don-hang.cap-nhat-trang-thai', $order->slug) }}"
                                    method="POST" class="d-inline status-update-form">
                                    @csrf
                                    <input type="hidden" name="status" value="4">
                                    <button type="submit" class="btn btn-sm btn-info">Đang giao hàng</button>
                                </form>
                            @elseif ($order->status_id == 4)
                                <button type="button" class="btn btn-sm btn-success" disabled>Giao hàng thành
                                    công</button>
                            @elseif ($order->status_id == 5)
                                <button type="button" class="btn btn-sm btn-danger" disabled>Hủy</button>
                            @endif
                        </div>
                    </div> --}}
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
                                @if ($order->orderDetails && count($order->orderDetails) > 0)
                                    @foreach ($order->orderDetails as $detail)
                                        <div class="col-md-12" id="product_{{ $detail->id }}_item">
                                            <div class="mb-2">
                                                <div class="mb-2">
                                                    <label class="form-label" for="product-variant-input">Sản phẩm</label>
                                                    <select class="form-select @error('variation_id') is-invalid @enderror"
                                                        id="product-variant-input" name="variation_id[]" data-choices
                                                        data-choices-search-false onchange="updatePrice(this)">
                                                        <option value="">Chọn Sản Phẩm</option>
                                                        @foreach ($variation as $variant)
                                                            <option value="{{ $variant->id }}"
                                                                data-price="{{ $variant->price_export }}"
                                                                data-stock="{{ $variant->stock }}"
                                                                {{ $detail->variation_id == $variant->id ? 'selected' : '' }}>
                                                                {{-- {{ $variant->product->name }} - --}}
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
                                                <div class="mb-2">
                                                    <label class="form-label" for="product-price-input">Giá sản
                                                        phẩm</label>
                                                    <input type="number" class="form-control" id="product-price-input"
                                                        name="product_price[]" value="{{ $detail->price }}" readonly>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <label
                                                                class="form-label @error('product_quantity') is-invalid @enderror"
                                                                for="product-quantity-input">Số
                                                                lượng sản
                                                                phẩm</label>
                                                            <input type="number"
                                                                class="form-control @error('product_quantity') is-invalid @enderror"
                                                                id="product-quantity-input" name="product_quantity[]"
                                                                value="{{ $detail->quantity }}">
                                                            @error('product_quantity')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <label class="form-label" for="product-stock-input">Số lượng
                                                                sản
                                                                phẩm có trong kho</label>
                                                            <input type="number" class="form-control"
                                                                id="product-stock-input" name="stock" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="removeProduct('product_{{ $detail->id }}_item','{{ $detail->id }}')">
                                                        <span class="bx bx-trash"></span> Xóa sản phẩm
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12" id="product_default_item">
                                        <div class="mb-2">
                                            <div class="mb-2">
                                                <label class="form-label" for="product-variant-input">Sản phẩm</label>
                                                <select class="form-select @error('variation_id') is-invalid @enderror"
                                                    id="product-variant-input" name="product_variant[]" data-choices
                                                    data-choices-search-false onchange="updatePrice(this)">
                                                    <option value="">Chọn Sản Phẩm</option>
                                                    @foreach ($variation as $variant)
                                                        <option @selected($detail->variation_id == $id) value="{{ $variant->id }}"
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
                                                <label class="form-label" for="product-price-input">Giá sản
                                                    phẩm</label>
                                                <input type="number" class="form-control" id="product-price-input"
                                                    name="product_price[]" readonly>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-2">
                                                        <label class="form-label" for="product-quantity-input">Số lượng
                                                            sản
                                                            phẩm</label>
                                                        <input type="number"
                                                            class="form-control @error('product_quantity') is-invalid @enderror"
                                                            id="product-quantity-input" name="product_quantity[]"
                                                            value="{{ $detail->quantity }}">
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
                                                        <input type="number" class="form-control"
                                                            id="product-stock-input" name="stock"
                                                            value="{{ $detail->variation->stock ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeProduct('product_{{ $detail->id }}_item','{{ $detail->id }}')">
                                                    <span class="bx bx-trash"></span> Xóa sản phẩm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                        value="{{ $order->total_amount }}" readonly name="total_amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label" for="paid_amount">Số tiền đã trả</label>
                                    <input type="text"
                                        class="form-control form-control-lg @error('paid_amount') is-invalid @enderror"
                                        id="paid_amount" value="{{ $order->paid_amount }}"
                                        placeholder="Nhập số tiền đã trả" name="paid_amount">
                                    @error('paid_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Cập nhật</button>
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
                            <label class="form-label" for="product-quantity-input">Số lượng
                                sản
                                phẩm</label>
                            <input type="number"
                                class="form-control @error('product_quantity') is-invalid @enderror"
                                id="product-quantity-input" name="product_quantity[]"
                                value="{{ $detail->quantity }}">
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
                            <input type="number" class="form-control"
                                id="product-stock-input" name="stock" value="{{ $detail->variation->stock ?? '' }}" readonly>
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

            for (let i = 0; i < quantities.length; i++) {
                total += (parseFloat(quantities[i].value) || 0) * (parseFloat(prices[i].value) || 0);
            }

            document.getElementById('total_amount').value = total.toFixed(2);
        }

        function updateStockForExistingProducts() {
            document.querySelectorAll('[name="variation_id[]"]').forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                const stock = selectedOption.getAttribute('data-stock');
                const stockInput = select.closest('.col-md-12').querySelector('input[name="stock"]');
                if (stockInput) {
                    stockInput.value = stock;
                }
            });
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
            updateStockForExistingProducts();
        });


        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.status-update-form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (confirm('Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng?')) {
                        this.submit();
                    }
                });
            });
        });
    </script>
@endsection
