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
                            <div class="card-title">Edit data bank</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group form-group-default">
                                    <label>Nama Bank</label>
                                    <input id="bank_name" name="bank_name" @error('bank_name') is-invalid @enderror" type="text" class="form-control" value="{{ old('bank_name', $bank->bank_name) }}" placeholder="Masukkan Nama Bank">
                                </div>
                                @error('bank_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group form-group-default">
                                    <label>Nama Pemilik Rekening</label>
                                    <input id="acc_owner" name="acc_owner" @error('acc_owner') is-invalid @enderror" type="text" class="form-control" value="{{ old('acc_owner', $bank->acc_owner) }}" placeholder="Masukkan Nama Pemilik Rekening">
                                </div>
                                @error('acc_owner')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group form-group-default">
                                    <label>Nomor Rekening</label>
                                    <input id="acc_number" name="acc_number" @error('acc_number') is-invalid @enderror" type="text" class="form-control" value="{{ old('acc_number', $bank->acc_number) }}" placeholder="Masukkan Nomor Rekening">
                                </div>
                                @error('acc_number')
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
