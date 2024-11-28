@extends('admin.layouts.master')
@section('title')
    Thêm đơn hàng
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới đơn hàng có hợp đồng</h4>
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
                        <label class="form-label" for="contract_number">Mã hợp đồng</label>
                        <div class="position-relative">
                            <input type="text" name="contract_number" class="form-control"
                                value="{{ $contract->contract_number }}" readonly>
                        </div>
                    </div>
                </div>
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
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin bên B</h4>
                    </div>
                    <div class="card-body">
                        <label class="form-label" for="customer_name">Người đại diện</label>
                        <input class="form-control" type="text" name="customer_name"
                            value="{{ $contract->customer_name }}" readonly>
                    </div>
                    <div class="card-body">
                        <label class="form-label" for="number_phone">Số điện thoại</label>
                        <input class="form-control" type="text" name="number_phone"
                            value="{{ $contract->customer_phone }}" readonly>
                    </div>
                    <div class="card-body">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" type="text" name="email" value="{{ $contract->customer_email }}"
                            readonly>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sản phẩm mua</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="product_list">
                                @foreach ($contract->contractDetails as $detail)
                                    <div class="col-md-12 product-item">
                                        <div class="col-12">
                                            <label class="form-label" for="email">Tên sản phẩm</label>
                                            <input class="form-control" type="text" class="form-control"
                                                value="{{ $detail->variation->name }}" readonly>
                                                <input type="hidden" name="variation_id[]" value="{{ $detail->variation_id }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="email">Số lượng</label>
                                            <input class="form-control" type="number" name="product_quantity[]"
                                                value="{{ $detail->quantity }}" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="email">Giá sản phẩm</label>
                                            <input class="form-control" type="number" name="product_price[]"
                                                value="{{ $detail->price }}" readonly>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label class="form-label" for="total_amount">Tổng giá trị đơn hàng</label>
                                    <input type="text" class="form-control form-control-lg" id="total_amount"
                                        value="" readonly name="total_amount">
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
        function calculateOrderTotal() {
            let total = 0;
            const contractDetails = document.querySelectorAll('.product-item');

            contractDetails.forEach(item => {
                const quantity = parseFloat(item.querySelector('[name="product_quantity[]"]').value) || 0;
                const price = parseFloat(item.querySelector('[name="product_price[]"]').value) || 0;
                const itemTotal = quantity * price;
                total += itemTotal;
            });

            // Format số theo định dạng tiền VND
            const formattedTotal = total.toLocaleString('vi-VN');
            document.getElementById('total_amount').value = formattedTotal;
        }
        document.addEventListener('DOMContentLoaded', function() {
            calculateOrderTotal();
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
@endsection
