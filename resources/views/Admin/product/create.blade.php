@extends('Layouts.admin.main')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Forms</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Forms</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Basic Form</a>
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
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
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
            0                   @foreach($categories as $id => $category)
                                <option value="{{ $id }}">
                                    {{ old('category_id') == $id ? 'selected' : '' }}
                                    {{ $category }}
                                </option>
                                @endforeach
                            </select>
                        </div>

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
<br>
<br>
                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>

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
    <script src="{{URL::asset('admin')}}/assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="{{URL::asset('admin')}}/assets/js/core/popper.min.js"></script>
        <script src="{{URL::asset('admin')}}/assets/js/core/bootstrap.min.js"></script>

        <!-- jQuery UI -->
        <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <!-- Datatables -->
        <script src="{{URL::asset('admin')}}/assets/js/plugin/datatables/datatables.min.js"></script>
        <!-- Atlantis JS -->
        <script src="{{URL::asset('admin')}}/assets/js/atlantis.min.js"></script>

</body>
</html>
