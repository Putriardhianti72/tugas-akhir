@extends('Layouts.admin.main')

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="page-header">
                <h4 class="page-title">Order Retail</h4>
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
                        <a href="#">Tables</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Datatables</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Tambah data produk</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-group-default">
                                    <label class="font-weight-bold">Nama Produk</label>
                                    <input id="product_name" name="product_name" @error('product_name') is-invalid @enderror" type="text" class="form-control" value="{{ old('product_name')  }}">
                                </div>
                                @error('product_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                    @enderror
                                <br>

                                <div class="form-group form-group-default">
                                    <label class="font-weight-bold">Deskripsi</label>
                                    <input id="desc" name="desc" @error('desc') is-invalid @enderror" type="textarea" class="form-control" value="{{ old('desc') }}">
                                </div>
                                @error('desc')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                                <br>

                                <div class="form-group form-group-default">
                                    <label class="font-weight-bold">Harga</label>
                                    <input id="price" name="price" @error('price') is-invalid @enderror" type="textarea" class="form-control" value="{{ old('price') }}">
                                </div>
                                @error('price')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                                <br>

                                <div class="form-group">
                                    <label class="font-weight-bold">Gambar</label>
                                    <input type="file" class="form-control @error('pict') is-invalid @enderror" name="pict">

                                    <!-- error message untuk title -->
                                    @error('pict')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
