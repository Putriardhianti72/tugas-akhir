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
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="card-title">Order Detail</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ $order->exists ? route('admin.orders.update', ['order' => $order->id]) : route('admin.orders.store') }}" method="POST" enctype="multipart/form-data">
                                @if ($order->exists)
                                    @method('PATCH')
                                @endif

                                @csrf


                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="card shadow-none">
                                            <div class="card-header text-right">
                                                Invoice No. {{ $order->invoice_no }}

                                                <strong class="ml-4">
                                                    {{ $order->status_text }}
                                                </strong>
                                            </div>

                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="card shadow-none">
                                            <div class="card-body">
                                                <h4 class="subtitle-page">Payment Detail</h4>

                                            <div class="row my-4">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            Bank
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            {{ $order->payment->bank_name }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            Nama Pengirim
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            {{ $order->payment->acc_owner }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            No. Rekening
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            {{ $order->payment->acc_number }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            No. Rekening Tujuan
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            @if($order->payment->destinationBank)
                                                            {{ $order->payment->destinationBank->bank_name }} - {{ $order->payment->destinationBank->acc_number }} ({{ $order->payment->destinationBank->acc_owner }})
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            Jumlah Pembayaran
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            {{ $order->payment->total_price }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            Bukti Pembayaran
                                                        </div>
                                                        <div class="col-12">
                                                            <a href="{{ $order->payment->payment_proof_url }}" target="_blank">
                                                                <img src="{{ $order->payment->payment_proof_url }}" class="img-fluid" style="max-width: 300px;">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="card shadow-none">
                                            <div class="card-body">
                                                <h4 class="subtitle-page">Update Order Status</h4>

                                                <div class="row my-4">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <select name="status" class="form-control">
                                                                @foreach ($orderStatuses as $key => $value)
                                                                    <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>







                                </div>
                                <br>
                                <br>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                                </div>

                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

