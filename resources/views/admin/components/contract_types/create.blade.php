@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $title }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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

                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <form class="search-box ms-2" method="GET" action="">
                                    <input type="text" class="form-control " id="searchProductList" name="search"
                                        placeholder="Tìm kiếm">
                                    <i class="ri-search-line search-icon"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('contractType.store') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-lg-8">
                                <label class="form-label">Tên loại hợp đồng</label>
                                <input type="text" name="name" placeholder="Nhập tên loại hợp đồng"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-8">
                                <label class="form-label">Mô Tả</label>
                                <textarea type="text" name="description " placeholder="Nhập mô tả"
                                    class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>



                        </div>
                        <div class="mt-3">
                            <button class = "btn btn-success text ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!--end col-->
    </div>
@endsection


