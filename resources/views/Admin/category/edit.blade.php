@extends('Layouts.admin.main')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Kategori</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Setting Katalog</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}">Kategori</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Data Kategori</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit data kategori</div>
                        </div>
                        <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group form-group-default">
                            <label>Nama kategori</label>
                            <input id="category_name" name="category_name" @error('category_name') is-invalid @enderror" type="text" class="form-control" value="{{ old('category_name', $category->category_name) }}" placeholder="Masukkan nama kategori">
                        </div>
                        @error('category_name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
{{--                        <div class="form-group">--}}
{{--                            <label class="font-weight-bold">nama kategori</label>--}}
{{--                            <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name"  placeholder="Masukkan Judul Post">--}}

{{--                            <!-- error message untuk title -->--}}
{{--                            @error('category_name')--}}
{{--                            <div class="alert alert-danger mt-2">--}}
{{--                                {{ $message }}--}}
{{--                            </div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    @endsection

