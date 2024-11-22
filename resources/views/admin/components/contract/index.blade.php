@extends('admin.layouts.master')

@section('title')
    Danh sách hợp đồng
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách hợp đồng</h4>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('contract.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm hợp đồng </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th data-ordering="false">Tên hợp đồng</th>
                                <th data-ordering="false">Bên B</th>
                                <th data-ordering="false">Số điện thoại bên B</th>
                                <th data-ordering="false">Email bên B</th>
                                <th data-ordering="false">Trạng thái</th>
                                <th data-ordering="false">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->contract_name }}</td>
                                    <td>{{ $data->customer_name }}</td>
                                    <td>{{ $data->customer_phone }}</td>
                                    <td>{{ $data->customer_email }}</td>
                                    <td>
                                        @if ($data->contract_status_id == 1)
                                            <form action="{{ route('contract.sendToManager', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Gửi giám đốc xác nhận
                                                </button>
                                            </form>
                                        @elseif ($data->contract_status_id == 2)
                                            <form action="{{ route('contract.sendToCustomer', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Gửi cho khách hàng
                                                </button>
                                            </form>
                                        @else
                                            {{ $data->contractStatus->name }}
                                        @endif
                                    </td>

                                    <td class="d-flex flex-column gap-2">
                                        @if ($data->contract_status_id == 1)
                                            <a href="#" class="btn btn-info btn-sm"
                                                onclick="showPdf({{ $data->id }})">
                                                <i class="ri-eye-fill align-bottom me-2"></i>Xem
                                            </a>
                                        @elseif ($data->contract_status_id == 3 || $data->contract_status_id == 7)
                                            <a href="#" class="btn btn-warning btn-sm"
                                                onclick="showWord({{ $data->id }})">
                                                <i class="ri-pencil-fill align-bottom me-2"></i>Thay đổi
                                            </a>
                                            <form action="{{ route('contract.sendToManagerPdf', $data->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm w-100">
                                                    <i class="ri-send-plane-fill align-bottom me-2"></i>Gửi giám đốc
                                                </button>
                                            </form>
                                        @elseif ($data->contract_status_id == 6)
                                            <a href="#" class="btn btn-info btn-sm"
                                                onclick="showPdf({{ $data->id }})">
                                                <i class="ri-eye-fill align-bottom me-2"></i>Xem
                                            </a>
                                            <form action="{{ route('contract.sendToManagerPdf', $data->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm w-100">
                                                    <i class="ri-send-plane-fill align-bottom me-2"></i>Gửi giám đốc
                                                </button>
                                            </form>
                                            <a href="{{ route('order.createordercontract', ['contract_id' => $data->id]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="ri-add-fill align-bottom me-2"></i>Tạo đơn hàng
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm"
                                                onclick="showPdf({{ $data->id }})">
                                                <i class="ri-eye-fill align-bottom me-2"></i>Xem
                                            </a>
                                            <form action="{{ route('contract.sendToManagerPdf', $data->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm w-100">
                                                    <i class="ri-send-plane-fill align-bottom me-2"></i>Gửi giám đốc
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>
    {{ $contracts->links() }}
@endsection

<div class="modal fade" id="pdfModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem hợp đồng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <embed id="pdfViewer" src="" type="application/pdf" width="100%" height="600px">
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        function showPdf(contractId) {
            const pdfUrl = `{{ url('/hop-dong/xem-hop-dong/') }}/${contractId}/pdf`;
            document.getElementById('pdfViewer').src = pdfUrl;
            new bootstrap.Modal(document.getElementById('pdfModal')).show();
        }
    </script>
@endpush


{{-- <div class="modal fade" id="wordModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem và chỉnh sửa hợp đồng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <iframe id="wordViewer" width="100%" height="600px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function showWord(contractId) {
            fetch(`{{ route('contract.showWord', '') }}/${contractId}`)
                .then(response => response.json())
                .then(data => {
                    const viewerUrl =
                        `https://view.officeapps.live.com/op/embed.aspx?src=${encodeURIComponent(data.url)}`;
                    document.getElementById('wordViewer').src = viewerUrl;
                    new bootstrap.Modal(document.getElementById('wordModal')).show();
                });
        }
    </script>
@endpush --}}
