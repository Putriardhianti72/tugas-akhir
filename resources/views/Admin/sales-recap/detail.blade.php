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
                      <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="subtitle-page">Delivery Address</h4>

                        <span class="ml-auto">Tracking No:
                          <span class="ml-2 update-status" tabindex="0" role="button" data-toggle="modal" data-target="#modal-update-shipping">
                            <strong>
                              {{ $order->shipping->tracking_no ?: 'N/A' }}
                            </strong>
                            <i class="fa fa-edit ml-1"></i>
                          </span>
                        </span>
                      </div>

                      <div class="card-body">
                        @if($order->customer)
                        <div class="row">
                          <div class="col-7">
                            <h5 class="mb-0">{{ $order->customer->name }}</h5>
                            <small class="d-block mb-3">
                              {{ $order->customer->no_hp }}<br>
                              {{ $order->customer->email }}
                            </small>
                            <div>
                              {{ $order->customer->alamat }}
                            </div>
                            <div>
                              {{ $order->customer->subdistrict_name }},
                              {{ $order->customer->city_name }},
                              {{ $order->customer->province_name }}
                            </div>
                          </div>
                          <div class="col-5 text-right">
                            {{ $order->shipping->name }}
                            <br>
                            Berat: {{ $order->shipping->weight }} gram
                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-12">
                    <div class="card shadow-none">
                      <div class="card-header">
                        <h4 class="subtitle-page">Product Detail</h4>
                      </div>

                      <div class="card-body">
                        @if($order->product)
                        <div class="row cart-row">
                          <div class="col-12 col-md-6">
                            <h4 class="product-name"><strong>{{ $order->product->product_name }}</strong></h4><h4 class="truncate-text"><small>{{ $order->product->desc }}</small></h4>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="col-12 text-right">
                              <h6>{{ $order->product->price }} <span class="text-muted">x</span> {{ $order->product->qty }}</h6>
                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="col-12 text-right">
                              <h6>{{ $order->product->total_price }}</h6>
                            </div>
                          </div>
                        </div>
                        @endif
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
                        @if ($order->payment)
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
                                No Virtual Account
                              </div>
                              <div class="col-12 col-md-8">
                                {{ $order->payment->va_number }}
                              </div>
                            </div>
                            @endif
                            <div class="row">
                              <div class="col-12 col-md-4">
                                Order Total
                              </div>
                              <div class="col-12 col-md-8">
                                {{ $order->product->total_price }}
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-md-4">
                                Shipping Total
                              </div>
                              <div class="col-12 col-md-8">
                                {{ $order->shipping->price }}
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-md-4">
                                Grand Total
                              </div>
                              <div class="col-12 col-md-8">
                                {{ $order->total_price }}
                              </div>
                            </div>

                          </div>
                        </div>
                        @else
                        <div class="row my-4">
                          <div class="col-12 text-center">
                            <em class="text-muted">No data available</em>
                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-12">
                    <div class="card shadow-none">
                      <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="subtitle-page">Komisi</h4>

                        <span class="ml-auto">
                          @if($order->status == \App\Models\RetailOrder::STATUS_COMPLETED)
                          <span class="ml-2 update-status" tabindex="0" role="button" data-toggle="modal" data-target="#modal-update-commission">
                            <strong>
                              {{ $order->commission ?: 'N/A' }}
                            </strong>
                            <i class="fa fa-edit ml-1"></i>
                          </span>
                          @else
                          <span class="ml-2">
                            Order belum selesai
                          </span>
                          @endif
                        </span>
                      </div>

                    </div>
                  </div>
                </div>

                {{-- <div class="row mb-2">
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
                </div> --}}
                </div>
                {{-- <br>
                <br>
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


<div class="modal fade" id="modal-update-order-status" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.retail-orders.update', ['retail_order' => $order->id]) }}" method="post">
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


<div class="modal fade" id="modal-update-shipping" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.retail-orders.update.shipping', ['retail_order' => $order->id]) }}" method="post">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Pengiriman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="tracking_no" class="form-control" value="{{ $order->shipping->tracking_no }}" placeholder="Masukkan no resi">
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
    <form action="{{ route('admin.retail-orders.update.payment-status', ['retail_order' => $order->id]) }}" method="post">
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

<div class="modal fade" id="modal-update-commission" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.retail-orders.update.commission', ['retail_order' => $order->id]) }}" method="post">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Komisi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="number" class="form-control" value="{{ $order->commission }}" name="commission">
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

