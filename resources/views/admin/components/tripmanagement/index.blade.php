@extends('admin.layouts.masternv')

@section('title')
    Danh sách chuyến xe
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách chuyến xe</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            {{-- Thêm form tìm kiếm --}}
                            <div class="search-container">
                                <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm..">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Tên xe</th>
                                    <th>Biển số xe</th>
                                    <th>Tên nhân viên</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trips as $trip)
                                    <tr>
                                        <td>{{ $trip->cargoCar->cargoCarType->name }}</td>
                                        <td>{{ $trip->cargoCar->license_plate }}</td>
                                        <td>{{ $trip->employee->name }}</td>
                                        <td>
                                            @if ($trip->status == 1)
                                            <span style="color: green" class=" badge-soft-success">Đang vận chuyển</span>
                                        @elseif($trip->status == 2)
                                            <span style="color: rgb(2, 80, 72)" class=" badge-soft-info">Hoàn thành</span>
                                        @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('orderconfirm.show', ['id' => $trip->id]) }}" class="btn btn-secondary">
                                                Chi tiết
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
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling search input
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('myTable');
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function() {
                const query = searchInput.value.toLowerCase();
                for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
                    const cells = rows[i].getElementsByTagName('td');
                    let rowText = '';
                    for (let j = 0; j < cells.length; j++) {
                        rowText += cells[j].textContent.toLowerCase();
                    }
                    if (rowText.includes(query)) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        /* Make the search input look nicer */
        .search-container input {
            border: 1px solid #ccc;
            padding: 8px 12px;
            font-size: 14px;
            width: 100%;
            border-radius: 4px;
        }

        /* Responsiveness for search input on small devices */
        @media (max-width: 576px) {
            .search-container {
                width: 100%;
                margin-bottom: 15px;
            }

            .search-container input {
                width: 100%;
            }
        }

        /* Table responsiveness */
        .table-responsive {
            -webkit-overflow-scrolling: touch;
            overflow-x: auto;
            margin-top: 10px;
        }

        /* Badge style improvements */
        .badge-soft-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-soft-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        /* Mobile optimization for table */
        @media (max-width: 576px) {
            .table th, .table td {
                padding: 8px;
            }

            .table-responsive {
                overflow-x: scroll;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
@endsection
