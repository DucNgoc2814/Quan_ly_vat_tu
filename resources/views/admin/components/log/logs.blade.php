@extends('admin.layouts.master')

@section('title')
    Danh sách Log
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách Log</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Log</a></li>
                        <li class="breadcrumb-item active">Danh sách Log</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" >
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã nhân viên</th>
                                <th>Tên nhân viên</th>
                                <th>Chức vụ</th>
                                <th>Hành động</th>
                                <th>Model</th>
                                <th>Mô tả</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logLines as $index => $line)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $line[0] ?? '' }}</td>
                                    <td>{{ $line[1] ?? '' }}</td>
                                    <td>{{ $line[2] ?? '' }}</td>
                                    <td>{{ $line[3] ?? '' }}</td>
                                    <td>{{ $line[4] ?? '' }}</td>
                                    <td>{{ $line[5] ?? '' }}</td>
                                    <td>{{ $line[6] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Phân trang -->
                </div>
            </div>
        </div>
    </div>
@endsection
