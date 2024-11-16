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
                            <img src="{{ asset('themes/admin/assets/images/users/avatar-1.jpg') }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
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
                                    <th scope="col">Xác nhận</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index)
                                    <tr>
                                        <td>{{ $index->order->slug }}</td>
                                        <td>{{ $index->order->customer_name }}</td>
                                        <td>{{ $index->order->number_phone }}</td>
                                        <td>{{ $index->order->address }}</td>
                                        {{-- <td>{{ $index->order->orderDetails->first()->variations->name }}</td> --}}
                                        {{-- @dd($index->order->orderDetails) --}}
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($index->order->orderDetails as $item)
                                                    <li class="mb-1">
                                                        {{ $item->variations ? $item->variations->name : '' }}
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </td>
                                        {{-- <td>{{ $index->order->orderDetails->first()->quantity }}</td> --}}
                                        <td>{{ $index->order->total_amount }}</td>
                                        <td>
                                            @if ($index->order->status_id != 4)
                                                <form action="{{ route('orderconfirm.update', ['id' => $index->order]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn xác nhận đơn hàng này?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success">Xác nhận</button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-success" disabled>Đã xác nhận</button>
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
@endsection
