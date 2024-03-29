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
                            <div class="card-title">Edit data kategori</div>
                        </div>
                        <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
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

        <!--   Core JS Files   -->
        <script src="{{URL::asset('admin')}}/assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="{{URL::asset('admin')}}/assets/js/core/popper.min.js"></script>
        <script src="{{URL::asset('admin')}}/assets/js/core/bootstrap.min.js"></script>

        <!-- jQuery UI -->
        <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

        <!-- Atlantis JS -->
        <script src="{{URL::asset('admin')}}/assets/js/atlantis.min.js"></script>
</body>
</html>
