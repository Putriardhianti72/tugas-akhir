@extends('Layouts.admin.main')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Produk</h4>
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
                        <a href="{{ route('admin.products.index') }}">Produk</a>
                    </li>
                     <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Data Produk</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah data produk</div>
                        </div>
                        <div class="card-body">
                    <form action="{{ $product->exists ? route('admin.products.update', ['product' => $product->id]) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @if ($product->exists)
                            @method('PATCH')
                        @endif

                        @csrf
                        <div class="form-group form-group-default">
                            <label class="font-weight-bold">Nama Produk</label>
                            <input id="product_name" name="product_name" @error('product_name') is-invalid @enderror" type="text" class="form-control" value="{{ old('product_name', $product->product_name)  }}">
                        </div>
                        @error('product_name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                            @enderror
                        <br>
{{--                        <div class="form-group form-group-default">--}}
{{--                            <label class="font-weight-bold">Kategori</label>--}}
{{--                            <input id="category_id" name="category_id" @error('category_id') is-invalid @enderror" type="text" class="form-control" >--}}
{{--                        </div>--}}
{{--                        @error('category_id')--}}
{{--                        <div class="alert alert-danger mt-2">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                        @enderror--}}
{{--                        {{ $categories }}--}}

                        <div class="form-group form-group-default">
                            <label>Kategori db</label>
                            <select class="form-control" id="category_id" name="category_id">
                               @foreach($categories as $id => $category)
                                <option value="{{ $id }}" {{ old('category_id', $product->category_id) == $id ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <br>
                        <div class="form-group form-group-default">
                            <label class="font-weight-bold">Deskripsi</label>
                            <textarea id="desc" name="desc" @error('desc') is-invalid @enderror" type="textarea" class="form-control" rows="4">{{ old('desc', $product->desc) }}</textarea>
                        </div>
                        @error('desc')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                        <br>

                        <div class="form-group form-group-default">
                            <label class="font-weight-bold">Harga</label>
                            <input id="price" name="price" @error('price') is-invalid @enderror" type="textarea" class="form-control" value="{{ old('price', $product->price) }}">
                        </div>
                        @error('price')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                        <br>

                        <div class="form-group">
                            <label class="font-weight-bold">Gambar</label>
                            @if($product->exists)
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" class="form-control @error('pict') is-invalid @enderror" name="pict">
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ $product->pict_url }}" target="_blank">
                                            <img src="{{ $product->pict_url }}" class="img-fluid rounded" style="max-width: 246px">
                                        </a>
                                    </div>
                                </div>
                            @else
                                <input type="file" class="form-control @error('pict') is-invalid @enderror" name="pict">
                            @endif

                            <!-- error message untuk title -->
                            @error('pict')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <br>
                        <br>

                        <div class="d-flex justify-content-end align-items-center">
                          <a href="{{ route('admin.products.index') }}" class="btn btn-link btn-md btn-warning- mr-2">BATAL</a>
                          <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>--}}
{{--<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>--}}

    <!--   Core JS Files   -->

