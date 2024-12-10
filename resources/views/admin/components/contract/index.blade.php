@extends('admin.layouts.master')

@section('title')
    Danh sách hợp đồng
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách hợp đồng</h4>
                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('contract.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm hợp đồng </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="fs-13 table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th data-ordering="false">Mã số hợp đồng</th>
                                <th data-ordering="false">Bên B</th>
                                <th data-ordering="false">Số điện thoại bên B</th>
                                <th data-ordering="false">Tổng tiền</th>
                                <th data-ordering="false">Tiền đã trả</th>
                                <th data-ordering="false">Phụ trách</th>
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
                                    <td
                                        class="{{ $data->total_amount == $data->paid_amount ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($data->total_amount) }}
                                    </td>
                                    <td
                                        class="{{ $data->total_amount == $data->paid_amount ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($data->paid_amount) }}
                                    </td>
                                    <td>{{ $data->employee->name }}</td>
                                    <td id="status-{{ $data->id }}" data-contract-id="{{ $data->id }}">
                                        @php
                                            $statusConfig = [
                                                1 => [
                                                    'type' => 'button',
                                                    'class' => 'btn-primary',
                                                    'route' => 'contract.sendToManager',
                                                    'text' => 'Gửi giám đốc',
                                                ],
                                                2 => [
                                                    'type' => 'button',
                                                    'class' => 'btn-success',
                                                    'route' => 'contract.sendToCustomer',
                                                    'text' => 'Gửi khách hàng',
                                                ],
                                                3 => ['type' => 'badge', 'class' => 'bg-danger', 'text' => 'Đã hủy'],
                                                4 => [
                                                    'type' => 'badge',
                                                    'class' => 'bg-warning',
                                                    'text' => 'Đang chờ xác nhận',
                                                ],
                                                5 => [
                                                    'type' => 'badge',
                                                    'class' => 'bg-info',
                                                    'text' => 'Chờ khách hàng xác nhận',
                                                ],
                                                6 => [
                                                    'type' => 'badge',
                                                    'class' => 'bg-primary',
                                                    'text' => 'Đang tiến hành',
                                                ],
                                                7 => [
                                                    'type' => 'badge',
                                                    'class' => 'bg-danger',
                                                    'text' => 'Khách hàng không đồng ý',
                                                ],
                                                8 => [
                                                    'type' => 'badge',
                                                    'class' => 'bg-success',
                                                    'text' => 'Hoàn thành',
                                                ],
                                                9 => ['type' => 'badge', 'class' => 'bg-danger', 'text' => 'Quá hạn'],
                                            ];

                                            $status = $statusConfig[$data->contract_status_id] ?? null;
                                        @endphp

                                        @if ($status)
                                            @if ($status['type'] === 'button')
                                                <form action="{{ route($status['route'], $data->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm {{ $status['class'] }}">
                                                        {{ $status['text'] }}
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge {{ $status['class'] }}">{{ $status['text'] }}</span>
                                            @endif
                                        @else
                                            {{ $data->contractStatus->name }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('contract.show', $data->id) }}" class="btn btn-info btn-sm">
                                            <i class="ri-eye-fill align-bottom me-2"></i>Xem
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xem PDF -->
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

    <!-- Modal lịch sử trạng thái -->
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
@endsection

@push('scripts')
    <script>
        let currentContractId;

        // Hàm hiển thị PDF
        function showPdf(contractId) {
            currentContractId = contractId;
            const pdfUrl = `{{ url('/hop-dong/xem-hop-dong/') }}/${contractId}/pdf`;
            document.getElementById('pdfViewer').src = pdfUrl;
            new bootstrap.Modal(document.getElementById('pdfModal')).show();
        }

        // Hàm hiển thị lịch sử trạng thái
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

        // Xử lý sự kiện click nút hiển thị trạng thái
        document.getElementById('showStatusBtn').addEventListener('click', function() {
            showStatusHistory(currentContractId);
        });

        // Lắng nghe sự kiện realtime cho hợp đồng mới
        window.Echo.channel('contract-created')
            .listen('NewContractCreated', (e) => {
                console.log('Received contract created event for ID:', e.id);
                const statusCellId = `status-${e.id}`;

                // Tạo HTML cho trạng thái
                let statusHtml = '';
                if (e.contract_status_id == 1) {
                    statusHtml = `
                <form action="/hop-dong/gui-xac-nhan/${e.id}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">
                        Gửi giám đốc
                    </button>
                </form>
            `;
                } else if (e.contract_status_id == 2) {
                    statusHtml = `
                <form action="/hop-dong/gui-xac-nhan-khach-hang/${e.id}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                        Gửi khách hàng
                    </button>
                </form>
            `;
                } else {
                    statusHtml = e.contract_status ? e.contract_status.name : '';
                }

                const newRow = `
            <tr>
                <td>${e.id || ''}</td>
                <td>${e.contract_number || ''}</td>
                <td>${e.customer_name || ''}</td>
                <td>${e.customer_phone || ''}</td>
                <td class="${e.total_amount == e.paid_amount ? 'text-success' : 'text-danger'}">
                    ${e.total_amount || 0}
                </td>
                <td class="${e.total_amount == e.paid_amount ? 'text-success' : 'text-danger'}">
                    ${e.paid_amount || 0}
                </td>
                <td>${e.employee_name || ''}</td>
                <td id="${statusCellId}" data-contract-id="${e.id}">${statusHtml}</td>
                <td>
                    <a href="/contract/${e.id}" class="btn btn-info btn-sm">
                        <i class="ri-eye-fill align-bottom me-2"></i>Xem
                    </a>
                </td>
            </tr>
        `;

                const tbody = document.querySelector('#myTable tbody');
                tbody.insertAdjacentHTML('afterbegin', newRow);
            });

        // Lắng nghe sự kiện cập nhật trạng thái
        window.Echo.channel('contract-status')
            .listen('ContractStatusUpdated', (e) => {
                console.log('Received contract updated event for ID:', e.id);
                const statusCell = document.getElementById(`status-${e.id}`);

                if (statusCell) {
                    let html = '';
                    if (e.contract_status_id == 1) {
                        html = `
                    <form action="/hop-dong/gui-xac-nhan/${e.id}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                            Gửi giám đốc
                        </button>
                    </form>
                `;
                    } else if (e.contract_status_id == 2) {
                        html = `
                    <form action="/hop-dong/gui-xac-nhan-khach-hang/${e.id}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">
                            Gửi khách hàng
                        </button>
                    </form>
                `;
                    } else {
                        html = e.contract_status ? e.contract_status.name : '';
                    }
                    statusCell.innerHTML = html;
                }
            });
    </script>
@endpush
