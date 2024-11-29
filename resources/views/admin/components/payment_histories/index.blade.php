@extends('admin.layouts.master')


@section('title')
    Thu chi
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thu chi</h4>
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
                                <th>ID</th>
                                <th>Loại giao dịch</th>
                                <th>Mã giao dịch</th>
                                <th>Số tiền</th>
                                <th>Chứng từ</th>
                                <th>Nội dung</th>
                                <th>Ngày tạo</th>
                                <th>Thời gian xác nhận</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>
                                        @switch($payment->transaction_type)
                                            @case('purchase')
                                                <span class="badge bg-danger">Đơn mua hàng</span>
                                            @break

                                            @case('contract')
                                                <span class="badge bg-success">Hợp đồng</span>
                                            @break

                                            @case('sale')
                                                <span class="badge bg-primary">Đơn bán hàng</span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary">Khác</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $payment->related_id }}</td>
                                    <td>
                                        @if ($payment->transaction_type == 'purchase')
                                            <span
                                                class="text-danger fw-medium">-{{ number_format($payment->amount) }}đ</span>
                                        @else
                                            <span
                                                class="text-success fw-medium">{{ number_format($payment->amount) }}đ</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->document)
                                            @php
                                                $extension = pathinfo($payment->document, PATHINFO_EXTENSION);
                                                $documentUrl = url('storage/' . $payment->document);
                                            @endphp
                                            <button type="button" class="btn btn-sm btn-info"
                                                onclick="showDocument('{{ $documentUrl }}', '{{ $extension }}')"
                                                title="Xem chứng từ">
                                                <i class="ri-file-text-line"></i> Xem chứng từ
                                            </button>
                                        @else
                                            <span class="text-muted">Không có</span>
                                        @endif
                                    </td>
                                    <td>{{ $payment->note }}</td>
                                    <td>{{ $payment->created_at ? $payment->created_at->format('d/m/Y H:i:s') : 'N/A' }}
                                    </td>
                                    <td>{{ $payment->updated_at ? $payment->updated_at->format('d/m/Y H:i:s') : 'N/A' }}
                                    </td>
                                    <td>
                                        @if ($payment->status == 1)
                                            <span class="badge bg-success">Đã xác nhận</span>
                                        @else
                                            <span class="badge bg-warning">Chờ xác nhận</span>
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
    <!-- Modal xem chứng từ -->
    <div class="modal fade" id="documentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chứng từ thanh toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="documentImage" src="" alt="Chứng từ" style="max-width: 100%; height: auto;">
                    <iframe id="documentPdf" src="" style="width: 100%; height: 500px; display: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showDocument(url, fileType) {
            console.log('Loading document:', {
                url: url,
                fileType: fileType
            });

            const modal = new bootstrap.Modal(document.getElementById('documentModal'));
            const imageElement = document.getElementById('documentImage');
            const pdfElement = document.getElementById('documentPdf');

            // Reset display
            imageElement.style.display = 'none';
            pdfElement.style.display = 'none';

            // Kiểm tra loại file và hiển thị tương ứng
            if (['jpg', 'jpeg', 'png'].includes(fileType.toLowerCase())) {
                // Thêm event listener trước khi set src
                imageElement.onload = function() {
                    console.log('Image loaded successfully');
                };

                imageElement.onerror = function(e) {
                    console.error('Error loading image:', {
                        src: this.src,
                        error: e
                    });
                };

                imageElement.src = url;
                imageElement.style.display = 'block';
            } else if (fileType.toLowerCase() === 'pdf') {
                pdfElement.src = url;
                pdfElement.style.display = 'block';
            }

            modal.show();
        }
    </script>
@endpush
