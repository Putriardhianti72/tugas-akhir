@extends('Layouts.admin.main')

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style type="text/css">
#add-row_filter {
  display: flex;
  align-items: flex-start;
}
#form-recap-date-filter {
  flex: 1;
  margin-right: 1rem;
}

#form-recap-date-filter .form-control {
  width: 100%;
  padding: 4px;
  margin-left: 0;
}
</style>
@endpush

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Rekap Penjualan</h4>
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
                        <a href="#">Rekap Penjualan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Rekap Penjualan</h4>
                            <!-- Button trigger modal -->
                            {{--                            <a type="button" href="{{ route('admin.retail-orders.create') }}"  class="btn btn-primary btn-round ml-auto" data-toggle="modal">--}}
                            {{--                                Tambah Data Order--}}
                            {{--                            </a>--}}
                            <form id="form-recap-date-filter" action="{{ route('admin.sales-recap.index') }}">
                              <div class="form-group p-0">
                                <input type="text" name="date" value="{{ $from->format('m/d/Y') }} - {{ $to->format('m/d/Y') }}" class="form-control" />
                                <div class="input-group-append" style="display: none;">
                                  <button class="btn btn-outline-secondary" type="submit">Filter</button>
                                </div>
                              </div>
                            </form>
                            <a href="{{ route('admin.sales-recap.export', ['date' => $from->format('m/d/Y') . ' - ' . $to->format('m/d/Y')]) }}" class="btn btn-primary btn-round ml-auto">Export</a>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="row justify-content-end">
                            <div class="col-3">
                              <div class="card">
                                <div class="card-body pb-2">
                                  <h6 class="card-subtitle text-muted">Total Order</h6>
                                  <h5 class="card-title mb-0">{{ $totalOrder }}</h5>
                                </div>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="card">
                                <div class="card-body pb-2">
                                  <h6 class="card-subtitle text-muted">Total Penjualan</h6>
                                  <h5 class="card-title mb-0">{{ format_currency($totalSales) }}</h5>
                                </div>
                              </div>
                            </div>
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
                                        <th>Tanggal</th>
                                        <th>Total Order</th>
                                        <th>Total Penjualan</th>
                                        {{-- <th style="width: 10%">Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($orders as $i => $order)
                                      <tr>
                                          <td>{{++$i}}</td>
                                          <td>{{$order->date}}</td>
                                          <td>
                                            {{ $order->total_order }}
                                          </td>
                                          <td>
                                              {{ format_currency($order->total_sales) }}
                                          </td>
                                          {{-- <td>
                                              <div class="form-button-action">
                                                  <a href="{{ route('admin.retail-orders.show', $order->id) }}" button type="button"  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg"  data-original-title="View detail">
                                                      <i class="fa fa-eye"></i>
                                                  </a>
                                              </div>
                                          </td> --}}
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script >
    $(document).ready(function() {
        // Add Row
        $('#add-row')
          .on('init.dt', function () {
            $('#form-recap-date-filter').prependTo('#add-row_filter');

            $('input[name="date"]').daterangepicker({
              opens: 'left',
              maxDate: new Date(),
              ranges: {
                 'Today': [moment(), moment()],
                 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                 'This Month': [moment().startOf('month'), moment().endOf('month')],
                 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              }

            }, function(start, end, label) {
              console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
              setTimeout(function () {
                $('#form-recap-date-filter').submit();
              }, 500);
            });
          })
          .DataTable({
              "pageLength": 3
          });
    });
</script>
@endpush
