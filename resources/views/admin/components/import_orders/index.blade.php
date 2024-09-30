@extends('admin.layouts.master')

@section('title')
    Danh sách đơn hàng nhập
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách đơn nhập</h4>
                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('importOrder.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm đơn nhập</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Mã đơn hàng</th>
                                <th data-ordering="false">Tên nhà phân phối</th>
                                <th data-ordering="false">Tổng tiền</th>
                                <th data-ordering="false">Tiền đã trả</th>
                                <th data-ordering="false">Phương thức thanh toán</th>
                                <th data-ordering="false">Ngày đặt hàng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td>{{ number_format($item->total_amount) }}</td>
                                    <td>{{ number_format($item->paid_amount) }}</td>
                                    <td>{{ $item->payment->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="text-center">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('importOrder.indexImportDetail', ['slug' => $item->slug]) }}"
                                                        class="dropdown-item"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>Chi
                                                        Tiết Đơn Hàng</a>
                                                </li>
                                                <li><a href="{{ route('importOrder.edit', ['slug' => $item->slug]) }}"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Cập nhật</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    {{-- {{ $contract_types->links('pagination::bootstrap-5') }} --}}
                </div>
            </div>
        </div><!--end col-->
    </div>
@endsection

@section('scripts')
    <script>
        // Kiểm tra nếu có thông báo thành công từ controller
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: "{!! session('success') !!}",
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endsection
