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
                    <a href="#">Penjualan</a>
                </li>
                  <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.retail-orders.index') }}">Order Retail</a>
                </li>
            </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Order Retail</h4>
                                <!-- Button trigger modal -->
                                {{--                            <a type="button" href="{{ route('admin.retail-orders.create') }}"  class="btn btn-primary btn-round ml-auto" data-toggle="modal">--}}
                                {{--                                Tambah Data Order--}}
                                {{--                            </a>--}}
                                <a href="{{ route('admin.retail-orders.create') }}" class="btn btn-primary btn-round ml-auto">Tambah data produk</a>

                            </div>
                        </div>
                        <!-- list -->
                        <div class="card-body">
                            <!-- Tabel -->
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Customer</th>
                                        <th>Produk</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$order->invoice_no}}</td>
                                            <td>
                                                @if($order->customer)
                                                {{$order->customer->name}}
                                                <div>
                                                    <small>{{$order->customer->email}} - {{$order->customer->no_hp}}</small>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $order->product->product_name ?? '' }}
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <!-- Button trigger modal -->
                                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                                       detail
                                                    </button> --}}


                                                    <a href="{{ route('admin.retail-orders.show', $order->id) }}" button type="button"  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg"  data-original-title="View detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <!-- Button trigger modal -->
                                                    {{--                                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit{{$order->id}}">--}}
                                                    {{--                                                      Launch demo modal--}}
                                                    {{--                                                  </button>--}}
                                                    {{--                                                      <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary">EDIT</a>--}}

                                                  {{--   <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('admin.retail-orders.destroy', $order['id'])}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form> --}}
                                                </div>
                                                {{--                                              <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('orders.destroy', $order->id) }}" method="POST">--}}
                                                {{--                                                  <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary">EDITtt</a>--}}
                                                {{--                                                  @csrf--}}
                                                {{--                                                  @method('DELETE')--}}
                                                {{--                                                  <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>--}}
                                                {{--                                              </form>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<!-- Datatables -->
<script src="{{URL::asset('admin')}}/assets/js/plugin/datatables/datatables.min.js"></script>

<script >
    $(document).ready(function() {
        // Add Row
        $('#add-row').DataTable({
            "pageLength": 3,
        });

    });
</script>
@endpush
