@extends('admin.layouts.master')

@section('title')
    Danh sách loại biến thể
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách loại biến thể</h4>
                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('valueVariations.create') }}" class="btn btn-success">
                            <i class="ri-add-line align-bottom me-1"></i>Thêm loại biến thể
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên loại biến thể</th>
                                <th>Giá trị biến thể</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attribute as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($item->attributeValues as $value)
                                                <span
                                                    class="badge bg-primary d-flex align-items-center justify-content-center">{{ $value->value }}</span>
                                            @endforeach
                                            <button class="btn btn-sm btn-success add-value" data-bs-toggle="modal"
                                                data-bs-target="#addValueModal" data-id="{{ $item->id }}">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('valueVariations.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="ri-pencil-line"> Sửa</i>
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
    <div class="modal fade" id="addValueModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm giá trị biến thể</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="valueName" placeholder="Nhập giá trị">
                    @error('valueName')
                    @enderror
                    <input type="hidden" id="attributeId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveValue">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).on('click', '.add-value', function() {
            let attributeId = $(this).data('id'); // Lấy giá trị data-id từ nút Add Value
            $('#attributeId').val(attributeId); // Gán vào input hidden
            console.log('Gán Attribute ID:', attributeId); // Kiểm tra giá trị
        });

        $('#saveValue').click(function() {
            $.ajax({
                url: '/loai-bien-the/them-moi-gia-tri',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    attribute_id: $('#attributeId').val(),
                    value: $('#valueName').val()
                },
                success: function(response) {
                    if (response.success) {
                        $('#addValueModal').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.value) {
                            $('#valueName').addClass('is-invalid');
                            $('#valueName').after('<div class="invalid-feedback">' + errors.value[0] +
                                '</div>');
                        }
                    }
                }
            });
        });
    </script>
@endpush
