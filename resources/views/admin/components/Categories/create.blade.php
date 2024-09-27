@extends('admin.layouts.master')

@section('title')
    Thêm danh mục
@endsection

@section('content')
    {{-- <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm danh mục</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">danh mục</a></li>
                        <li class="breadcrumb-item active">Thêm danh mục</li>
                    </ol>
                </div>

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
                                <a href="{{ route('category.index') }}" class="btn btn-success" id="addproduct-btn">Danh
                                    sách danh mục </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label">Tên danh mục</label>
                                <input value="{{old('name')}}" type="text" name="name" placeholder="Nhập tên danh mục" class="form-control">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Mã Danh Mục</label>
                                <select name="" id="" class="form-select">
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">image</label>
                                <input value="{{old('image')}}" type="file" name="image" class="form-control">
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Mô tả</label>
                                <textarea type="text" name="description" placeholder="Nhập mô tả (không bắt buộc)" class="form-control" rows="3"></textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class = "btn btn-success text">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!--end col-->
    </div> --}}
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <a href="{{ route('category.index') }}" class="btn btn-success" id="addproduct-btn">Danh
                sách danh mục </a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="form-label">Tên danh mục</label>
                <input value="{{ old('name') }}" type="text" name="name" placeholder="Nhập tên danh mục" class="form-control">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="col-lg-12 mt-3">
                <label class="form-label">Mã Danh Mục</label>
                <select name="category_id" id="" class="form-select">
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="col-lg-12 mt-3">
                <label class="form-label">Image</label>
                <input value="{{ old('image') }}" type="file" name="image" class="form-control">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="col-lg-12 mt-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    
        <div class="mt-3">
            <button class="btn btn-success text">Thêm mới</button>
        </div>
    </form>
    
@endsection

@section('scripts-list')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
@endsection

@section('styles-list')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
