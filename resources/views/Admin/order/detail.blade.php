@extends('Layouts.admin.main')
@push('css')
<style type="text/css">
.update-status {
  cursor: pointer;
  text-transform: capitalize;
}
.update-status:hover {
  text-decoration-style: dotted;
  text-decoration: underline;
}
</style>
@endpush
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Order Member</h4>
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
                        <a href="#">Penjualan</a>
                    </li>
                      <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}">Order Member</a>
                    </li>
                     </li>
                      <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Order Member Detail</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                              <div class="card-header d-flex align-items-center justify-content-between">
                                  <div class="card-title">Order Detail</div>
                                    <div class="text-right mr-3 pr-1">
                                      <span class="mr-4">Invoice No: {{ $order->invoice_no }}</span>

                                        <span class="ml-auto">Order Status:
                                          <span class="ml-2 update-status" tabindex="0" role="button" data-toggle="modal" data-target="#modal-update-order-status">
                                            <strong>
                                              {{ $order->status_text }}
                                            </strong>
                                            <i class="fa fa-edit ml-1"></i>
                                          </span>
                                        </span>
                                    </div>
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
                                            <div class="card-body">
                                              <h4 class="subtitle-page">Product List</h4>

                                              <table class="std table">
                                                  <thead>
                                                      <tr>
                                                          <th class="first_item" width="15%">Image</th>
                                                          <th class="item mywishlist_first">Product Name</th>
                                                          <th class="item mywishlist_second">Domain</th>
                                                          <th class="item mywishlist_first">Price</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      @foreach($order->products as $product)
                                                      <tr>
                                                          <td>
                                                              <a href="#">
                                                                  <img class="img-fluid" src="{{ $product->pict_url }}" alt="{{ $product->product_name }}">
                                                              </a>
                                                          </td>
                                                          <td class="bold align_center">
                                                              {{ $product->product_name }}
                                                          </td>
                                                          <td>{{ $product->domain }}</td>
                                                          <td>{{ format_currency($product->price) }}</td>
                                                      </tr>
                                                      @endforeach
                                                  </tbody>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="card shadow-none">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h4 class="subtitle-page">Payment Detail</h4>

                                                <span class="ml-auto">Payment Status:
                                                  <span class="ml-2 update-status" tabindex="0" role="button" data-toggle="modal" data-target="#modal-update-payment-status">
                                                    <strong>
                                                      {{ $order->payment->transaction_status }}
                                                    </strong>
                                                    <i class="fa fa-edit ml-1"></i>
                                                  </span>
                                                </span>
                                              </div>
                                            <div class="card-body">

                                            <div class="row my-4">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            Metode Pembayaran
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            {{ $order->payment->payment_type_text }}
                                                        </div>
                                                    </div>
                                                    @if($order->payment->bank)
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            Bank
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            {{ $order->payment->bank }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($order->payment->va_number)
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            No. Rekening
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            {{ $order->payment->va_number }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            Jumlah Pembayaran
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            {{ format_currency($order->payment->total_price) }}
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

                                        </div>
                                    </div>
                                </div>
{{--
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                                </div> --}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="modal-update-order-status" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.orders.update', ['order' => $order->id]) }}" method="post">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Order Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select name="status" class="form-control">
              @foreach ($orderStatuses as $key => $value)
                <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $value }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>


    <div class="modal fade" id="modal-update-payment-status" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.orders.update.payment-status', ['order' => $order->id]) }}" method="post">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Status Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select name="transaction_status" class="form-control">
              @foreach ($paymentStatuses as $key => $value)
                <option value="{{ $key }}" {{ $order->payment->transaction_status == $key ? 'selected' : '' }}>{{ $value }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
