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
                <form action="{{ $order->exists ? route('admin.retail-orders.update', ['retail_order' => $order->id]) : route('admin.retail-orders.store') }}" method="POST" enctype="multipart/form-data">
                    @if ($order->exists)
                        @method('PATCH')
                    @endif

                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah data produk</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-group-default">
                                <label class="font-weight-bold">Nama Order</label>
                                <input id="order_name" name="order_name" type="text" class="form-control @error('order_name') is-invalid @enderror" value="{{ old('order_name', $order->order_name)  }}">
                            </div>
                            @error('order_name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                                @enderror
                            <br>

                            <div class="form-group form-group-default">
                                <label class="font-weight-bold">Deskripsi</label>
                                <textarea id="desc" name="desc" @error('desc') is-invalid @enderror" type="text" class="form-control">{{ old('desc', $order->desc) }}</textarea>
                            </div>
                            @error('desc')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                            <br>

                            <div class="form-group form-group-default">
                                <label class="font-weight-bold">Harga</label>
                                <input id="price" name="price" @error('price') is-invalid @enderror" type="text" class="form-control" value="{{ old('price', $order->price) }}">
                            </div>
                            @error('price')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                            <br>

                            <div class="form-group form-group-default">
                                <label class="font-weight-bold">Stock</label>
                                <input id="stock" name="stock" @error('stock') is-invalid @enderror" type="number" class="form-control" value="{{ old('stock', $order->stock) }}">
                            </div>
                            @error('stock')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                            <br>

                            <div class="form-group">
                                <label class="font-weight-bold">Gambar</label>
                                @if($order->exists)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="file" class="form-control @error('pict') is-invalid @enderror" name="pict">
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ $order->pict_url }}" target="_blank">
                                                <img src="{{ $order->pict_url }}" class="img-fluid rounded" style="max-width: 246px">
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
