@extends('admin.layouts.masternv')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                        <div class="col-sm-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card mt-n5">
                <div class="card-body p-3">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                            <img src="{{ asset('storage/' . (Session::get('employee')->image ?? 'themes/admin/assets/images/users/avatar-1.jpg')) }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                {{-- <input id="profile-img-file-input" type="file" class="profile-img-file-input"> --}}
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="text-center">NVC: <strong>{{ Session::get('employee')->name }}</strong></div>

                </div>
            </div>
            <!--end card-->

        </div>
        <!--end col-->

        <div class=" mt-5">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="table-responsive table-card p-4">
                        <table class="table table-nowrap table-striped-columns mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Tên người nhân</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Cần thu</th>
                                    <th scope="col">Xác nhận</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index)
                                    <tr>
                                        <td>{{ $index->order->slug }}</td>
                                        <td>{{ $index->order->customer_name }}</td>
                                        <td>{{ $index->order->number_phone }}</td>
                                        <td>{{ $index->order->province }}, <br>{{ $index->order->district }},
                                            <br>{{ $index->order->ward }}, <br>{{ $index->order->address }}
                                        </td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($index->order->orderDetails as $item)
                                                    <li class="mb-1">
                                                        {{ $item->variations ? $item->variations->name : '' }}
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </td>
                                        <td>{{ number_format($index->order->total_amount) }}</td>
                                        <td>{{ $index->order->contract_id != null ? 0 : number_format($index->order->total_amount - $index->order->paid_amount) }}
                                        </td>
                                        <td>
                                            @if ($index->order->status_id != 4)
                                                @php
                                                    $remainingAmount =
                                                        $index->order->contract_id != null
                                                            ? 0
                                                            : $index->order->total_amount - $index->order->paid_amount;
                                                @endphp

                                                @if ($remainingAmount > 0)
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#createPaymentModal">
                                                        Xác nhận
                                                    </button>
                                                @else
                                                    <form
                                                        action="{{ route('orderconfirm.update', ['id' => $index->order->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success">Xác nhận</button>
                                                    </form>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-info" disabled>Giao hàng thành
                                                    công</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary">Xuất hóa đơn</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="createPaymentModal" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tạo lịch sử chuyển tiền</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ route('payment.store', ['related_id' => $index->order->id, 'transaction_type' => 'sale']) }}"
                        id="paymentForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="payment_id">Phương thức thanh toán</label>
                            <select class="form-select" id="paymentId" name="payment_id">
                                <option value="">Chọn Phương Thức Thanh Toán</option>
                                @foreach ($payments as $id => $name)
                                    <option value="{{ $id }}" @if (old('payment_id') == $id) selected @endif>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" id="paymentError" style="display: none;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Số tiền</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                            <span class="invalid-feedback" id="amountError" style="display: none;"></span>
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                            <span class="invalid-feedback" id="noteError" style="display: none;"></span>
                        </div>
                        <div class="mb-3">
                            <label for="document" class="form-label">Chứng từ</label>
                            <input type="file" class="form-control" id="document" name="document"
                                accept=".pdf,.jpg,.jpeg,.png">
                            <span class="invalid-feedback" id="documentError" style="display: none;"></span>
                            <small class="text-muted">Chấp nhận file: PDF, JPG, JPEG, PNG</small>
                        </div>
                        <!-- Add hidden input for remaining amount -->
                        <input type="hidden" id="remainingAmount"
                            value="{{ $index->order->total_amount - $index->order->paid_amount }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" id="submitPayment">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('submitPayment').addEventListener('click', function(event) {
            event.preventDefault();

            // Lấy giá trị từ form
            const amount = parseFloat(document.getElementById('amount').value.trim()) || 0;
            const note = document.getElementById('note').value.trim();
            const paymentId = document.getElementById('paymentId').value.trim();
            const remainingAmount = parseFloat(document.getElementById('remainingAmount').value) || 0;
            let isValid = true;

            // Reset error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');

            // Validate amount
            if (!amount || amount <= 0) {
                document.getElementById('amountError').innerText = 'Vui lòng nhập số tiền hợp lệ';
                document.getElementById('amountError').style.display = 'block';
                isValid = false;
            } else if (amount > remainingAmount) {
                document.getElementById('amountError').innerText = 'Số tiền không được lớn hơn số tiền cần thu';
                document.getElementById('amountError').style.display = 'block';
                isValid = false;
            }

            // Validate note
            if (!note) {
                document.getElementById('noteError').innerText = 'Vui lòng nhập nội dung chuyển tiền';
                document.getElementById('noteError').style.display = 'block';
                isValid = false;
            }

            if (!paymentId) {
                document.getElementById('paymentError').innerText = 'Vui lòng chọn phương thức thanh toán';
                document.getElementById('paymentError').style.display = 'block';
                isValid = false;
            }

            if (isValid) {
                document.getElementById('paymentForm').submit();
            }
        });
    </script>
@endsection
