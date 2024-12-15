@extends('admin.layouts.master')

@section('title')
    Danh sách nhân sự
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách nhân sự</h4>
                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('employees.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm nhân sự</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="myTable"
                        class="text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Chức vụ</th>
                                <th data-ordering="false">Họ Tên</th>
                                <th data-ordering="false">Số điện thoại</th>
                                <th data-ordering="false">Mô tả</th>
                                <th data-ordering="false">Hoạt động</th>
                                <th data-ordering="false">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->roleEmployee->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->number_phone }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <div class="col-lg-6 form-check form-switch form-switch ms-3 mt-3">

                                            @if ($item->is_active == 1)
                                                <input onchange="changeStatus('employees', {{ $item->id }},0)"
                                                    class="form-check-input" type="checkbox" name="is_active" value="1"
                                                    id="is_active" checked>
                                            @else
                                                <input onchange="changeStatus('employees', {{ $item->id }},1)"
                                                    class="form-check-input" type="checkbox" name="is_active" value="0"
                                                    id="is_active">
                                            @endif
                                        </div>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="dropdown d-inline-block">

                                            <a href="{{ route('employees.edit', $item->id) }}"
                                                class="dropdown-item edit-item-btn"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                Thông tin chi tiết</a>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection





@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-item-btn').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    var formId = this.getAttribute('data-form-id');
                    var form = document.getElementById(formId);

                    if (confirm('Bạn có muốn ẩn nó không !')) {
                        form.submit();
                    }
                });

            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.opacity = '0';
                    setTimeout(function() {
                        successAlert.style.display = 'none';
                    }, 600);
                }, 5000);
            }
        });
    </script>
@endsection
