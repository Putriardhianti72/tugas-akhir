@extends('Layouts.admin.main')

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
                    <a href="{{ route('admin.retail-rewards.index') }}">Reward</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit Data Reward</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ $retailReward->exists ? route('admin.retail-rewards.update', ['retail_reward' => $retailReward->id]) : route('admin.retail-rewards.store') }}" method="POST" enctype="multipart/form-data">
                    @if ($retailReward->exists)
                        @method('PATCH')
                    @endif

                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit data reward</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-group-default">
                                <label class="font-weight-bold">Kode Produk</label>
                                <input id="code" name="code" type="text" autocomplete="off" autofocus class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $retailReward->code)  }}">
                            </div>
                            @error('code')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                                @enderror
                            <br>

                            <div class="form-group form-group-default">
                                <label class="font-weight-bold">Reward</label>
                                <textarea id="reward" name="reward" @error('reward') is-invalid @enderror" type="number" class="form-control">{{ old('reward', $retailReward->reward) }}</textarea>
                            </div>
                            @error('reward')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                            <br>
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
