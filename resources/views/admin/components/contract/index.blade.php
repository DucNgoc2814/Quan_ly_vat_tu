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
                    <table id="myTable" class="fs-13 table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th data-ordering="false">Mã số hợp đồng</th>
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
                                    <td>{{ $data->contract_number }}</td>
                                    <td>{{ $data->customer_name }}</td>
                                    <td>{{ $data->customer_phone }}</td>
                                    <td>{{ $data->customer_email }}</td>
                                    <td>
                                        @if ($data->contract_status_id == 1)
                                            <form action="{{ route('contract.sendToManager', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Gửi giám đốc
                                                </button>
                                            </form>
                                        @elseif ($data->contract_status_id == 2)
                                            <form action="{{ route('contract.sendToCustomer', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Gửi khách hàng
                                                </button>
                                            </form>
                                        @else
                                            {{ $data->contractStatus->name }}
                                        @endif
                                    </td>

                                    <td class="d-flex flex-column gap-2">
                                        @if ($data->contract_status_id == 1)
                                            <a href="{{ route('contract.show', $data->id) }}" class="btn btn-info btn-sm">
                                                <i class="ri-eye-fill align-bottom me-2"></i>Xem
                                            </a>
                                        @elseif ($data->contract_status_id == 3 || $data->contract_status_id == 7)
                                            <a href="#" class="btn btn-primary btn-sm"
                                                onclick="showWord({{ $data->id }})">
                                                <i class="ri-eye-fill align-bottom me-2"></i>Xem chi tiết
                                            </a>
                                        @elseif ($data->contract_status_id == 6)
                                            <a href="#" class="btn btn-info btn-sm"
                                                onclick="showPdf({{ $data->id }})">
                                                <i class="ri-eye-fill align-bottom me-2"></i>Xem
                                            </a>
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
                <button type="button" class="btn btn-primary ms-2" id="showStatusBtn">Chi tiết trạng thái</button>
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



<div class="modal fade" id="statusHistoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lịch sử trạng thái hợp đồng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody id="statusHistoryContent">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let currentContractId;

        function showPdf(contractId) {
            currentContractId = contractId;
            const pdfUrl = `{{ url('/hop-dong/xem-hop-dong/') }}/${contractId}/pdf`;
            document.getElementById('pdfViewer').src = pdfUrl;
            new bootstrap.Modal(document.getElementById('pdfModal')).show();
        }

        document.getElementById('showStatusBtn').addEventListener('click', function() {
            showStatusHistory(currentContractId);
        });

        function showStatusHistory(contractId) {
            fetch(`/hop-dong/status-history/${contractId}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('statusHistoryContent');
                    tbody.innerHTML = '';
                    data.forEach(item => {
                        const row = `
                            <tr>
                                <td>${item.contract_status.name}</td>
                                <td>${new Date(item.created_at).toLocaleString('vi-VN')}</td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                    new bootstrap.Modal(document.getElementById('statusHistoryModal')).show();
                });
        }
    </script>
@endpush
