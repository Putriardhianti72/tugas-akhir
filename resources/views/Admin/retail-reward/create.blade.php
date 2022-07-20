@extends('Layouts.admin.main')
{{ dd('asd') }}
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="page-header">
                <h4 class="page-title">Reward</h4>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah data reward</div>
                        </div>
                        <div class="card-body">
                    <form action="{{ route('admin.rewards.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group form-group-default">
                            <label class="font-weight-bold">Nama Produk</label>
                            <input id="code" name="code" @error('code') is-invalid @enderror" type="text" class="form-control" value="{{ old('code')  }}">
                        </div>
                        @error('code')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                            @enderror
                        <br>
                        {{-- <div class="form-group form-group-default">
                            <label>Kategori db</label>
                            <select class="form-control" id="category_id" name="category_id">
                               @foreach($categories as $id => $category)
                                <option value="{{ $id }}">
                                    {{ old('category_id') == $id ? 'selected' : '' }}
                                    {{ $category }}
                                </option>
                                @endforeach
                            </select>
                        </div> --}}

                        <br>
                        <div class="form-group form-group-default">
                            <label class="font-weight-bold">Reward</label>
                            <input id="reward" name="reward" @error('reward') is-invalid @enderror" type="number" class="form-control" value="{{ old('reward') }}">
                        </div>
                        @error('reward')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror

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
