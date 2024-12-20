@extends('admin.layouts.master')

@section('title')
    Thêm chuyến xe
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm chuyến xe</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('trips.index') }}">Quản lý chuyến xe</a></li>
                        <li class="breadcrumb-item active">Thêm mới đơn vận chuyển</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="card-header border-0 mb-4">
        <div class="row g-4">
            <div class="col-sm-auto">
                <a href="{{ route('trips.index') }}" class="btn btn-success" id="addproduct-btn"><i
                    class="ri-arrow-left-line align-bottom me-1"></i>Quay lại</a>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('trips.store') }}">
        @csrf
        <div class="row">
            <!-- Phần chọn tài xế -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Chọn người lái xe</h5>
                    </div>
                    <div class="card-body">
                        <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id"
                            name="employee_id" data-choices data-choices-search-false>
                            <option value="">Chọn Tên</option>
                            @foreach ($employes as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }} - {{ $employee->number_phone }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Phần chọn phương tiện -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Phương tiện vận chuyển</h5>
                    </div>
                    <div class="card-body">
                        <select class="form-select @error('cargo_car_id') is-invalid @enderror"
                            id="cargo_car_id" name="cargo_car_id" data-choices data-choices-search-false>
                            <option value="">Chọn phương tiện vận chuyển</option>
                            @foreach ($cargoCars as $cargoCar)
                                @if ($cargoCar->is_active == 0)
                                    <option value="{{ $cargoCar->id }}"
                                        {{ old('cargo_car_id') == $cargoCar->id ? 'selected' : '' }}>
                                        {{ $cargoCar->cargoCarType->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('cargo_car_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class=" mt-5">
                <div class="card-body p-4">
                    <div class="table-responsive table-card p-4">
                        <table id="pendingOrdersTable" class="table table-nowrap table-striped-columns mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Mã đơn</th>
                                    <th scope="col">Địa chỉ giao</th>
                                    <th scope="col">Số điện thoại người nhận</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingOrders as $order)
                                    @php
                                        $isSelected = old('order_id') && in_array($order->id, old('order_id'));
                                    @endphp
                                    <tr data-order-id="{{ $order->id }}" style="{{ $isSelected ? 'display: none;' : '' }}">
                                        <td>{{ $order->slug }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->number_phone }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td style="text-align: center">
                                            <button type="button" class="ri-add-line btn btn-primary"
                                                onclick="addOder(this)">Thêm vận chuyển</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @error('order_id')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="selected_orders" style="display: {{ old('order_id') ? 'block' : 'none' }};">
                            @if(old('order_id'))
                                <table class="table table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Mã đơn</th>
                                            <th scope="col">Địa chỉ giao</th>
                                            <th scope="col">Số điện thoại người nhận</th>
                                            <th scope="col">Tổng tiền</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendingOrders as $order)
                                            @if(old('order_id') && in_array($order->id, old('order_id')))
                                                <tr>
                                                    <td>{{ $order->slug }}</td>
                                                    <td>{{ $order->address }}</td>
                                                    <td>{{ $order->number_phone }}</td>
                                                    <td>{{ $order->total_amount }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="removeOrder(this, '{{ $order->slug }}')">Xóa</button>
                                                    </td>
                                                    <input type="hidden" name="order_id[]" value="{{ $order->id }}">
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="total_amount">Tổng giá trị chuyến xe</label>
                            <input type="text" class="form-control form-control-lg" id="total_amount"
                                value="" readonly name="total_amount">
                            @error('total_order_value')
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
        function addOder(button) {

            const row = button.closest('tr');
            const orderInfo = {
                id: row.dataset.orderId, // Thêm dòng này
                slug: row.cells[0].textContent,
                address: row.cells[1].textContent,
                phone: row.cells[2].textContent,
                total: row.cells[3].textContent
            };
            const selectedOrdersDiv = document.getElementById('selected_orders');

            if (!selectedOrdersDiv.querySelector('table')) {
                selectedOrdersDiv.innerHTML = `
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Địa chỉ giao</th>
                        <th scope="col">Số điện thoại người nhận</th>
                        <th scope="col">Tổng tiền</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            `;
            }

            // Thêm event listener này vào cuối phần script
            document.querySelector('form').addEventListener('submit', function(event) {
                if (document.querySelectorAll('#selected_orders tbody tr').length === 0) {
                    showOrderIdsError('Vui lòng chọn ít nhất một đơn hàng.');
                    event.preventDefault();
                }
            });
            //
            const tbody = selectedOrdersDiv.querySelector('tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td>${orderInfo.slug}</td>
            <td>${orderInfo.address}</td>
            <td>${orderInfo.phone}</td>
            <td>${orderInfo.total}</td>
            <td>
                <button type="button" class="btn btn-danger" onclick="removeOrder(this, '${orderInfo.slug}')">Xóa</button>
            </td>
            <input type="hidden" name="order_id[]" value="${orderInfo.id}">
            `;

            tbody.appendChild(newRow);
            selectedOrdersDiv.style.display = 'block';

            // Ẩn chỉ dòng này trong bảng gốc

            row.style.display = 'none';

            calculateTotal();

        }

        function removeOrder(button, slug) {
            const row = button.closest('tr');
            const orderInfo = {
                slug: row.cells[0].textContent,
                address: row.cells[1].textContent,
                phone: row.cells[2].textContent,
                total: row.cells[3].textContent
            };

            row.querySelector('input[name="order_id[]"]').remove();
            row.remove();

            const originalTable = document.querySelector('#pendingOrdersTable tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td>${orderInfo.slug}</td>
            <td>${orderInfo.address}</td>
            <td>${orderInfo.phone}</td>
            <td>${orderInfo.total}</td>
            <td style="text-align: center">
            <button type="button" class="ri-add-line btn btn-primary" onclick="addOder(this)">Thêm vận chuyển</button>
            </td>
            `;
            originalTable.appendChild(newRow);

            calculateTotal();

            const tbody = document.querySelector('#selected_orders tbody');
            if (tbody.children.length === 0) {
                document.getElementById('selected_orders').style.display = 'none';
            }
        }
        //
        document.querySelector('form').addEventListener('submit', function(event) {
            if (document.querySelectorAll('input[name="order_id[]"]').length === 0) {
                alert('Vui lòng chọn ít nhất một đơn hàng.');
                event.preventDefault();
            }
        });
        //tong tien trong form
        function calculateTotal() {
            let total = 0;
            const selectedOrders = document.querySelectorAll('#selected_orders tbody tr');
            selectedOrders.forEach(order => {
                const orderTotal = parseFloat(order.cells[3].textContent.replace(/[^\d.]/g, ''));
                if (!isNaN(orderTotal)) {
                    total += orderTotal;
                }
            });
            document.getElementById('total_amount').value = total.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Tính lại tổng tiền khi trang load lại sau validation fail
            if (document.querySelector('#selected_orders tbody tr')) {
                calculateTotal();
            }
        });
    </script>
@endsection
