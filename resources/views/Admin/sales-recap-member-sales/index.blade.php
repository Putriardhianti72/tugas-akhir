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
                <h4 class="page-title">Penjualan Member</h4>
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
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Penjualan Member</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Penjualan Member</h4>
                            <form id="form-recap-date-filter" action="{{ route('admin.sales-recap-member-sales.index') }}">
                              <div class="form-group p-0">
                                @if($from && $to)
                                <input type="text" name="date" value="{{ $from->format('m/d/Y') }} - {{ $to->format('m/d/Y') }}" class="form-control" autocomplete="off" />
                                @else
                                <input type="text" name="date" class="form-control" autocomplete="off" />
                                @endif
                                <div class="input-group-append" style="display: none;">
                                  <button class="btn btn-outline-secondary" type="submit">Filter</button>
                                </div>
                              </div>
                            </form>
                            @if($from && $to)
                            <a href="{{ route('admin.sales-recap-member-sales.export', ['date' => $from->format('m/d/Y') . ' - ' . $to->format('m/d/Y')]) }}" class="btn btn-primary btn-round ml-auto">Export</a>
                            @else
                            <a href="{{ route('admin.sales-recap-member-sales.export') }}" class="btn btn-primary btn-round ml-auto">Export</a>
                            @endif
                          </div>
                        </div>
                        {{-- <div class="card-body">
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
                                  <h5 class="card-title mb-0">{{ $totalSales }}</h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                        <!-- list -->
                        <div class="card-body">
                            <!-- Tabel -->
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Member</th>
                                        <th>Total Order</th>
                                        <th>Total Penjualan</th>
                                        {{-- <th style="width: 10%">Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($orderMembers as $i => $member)
                                      <tr>
                                          <td>{{++$i}}</td>
                                          <td>
                                            <div>{{$member->nama}}</div>
                                            <div>
                                              <small>{{$member->email}}</small>
                                              <small class="ml-2">{{$member->hp}}</small>
                                            </div>
                                          </td>
                                          <td>
                                            {{ $member->orderData ? $member->orderData->total_order : '' }}
                                          </td>
                                          <td>
                                              {{ $member->orderData ? format_currency($member->orderData->total_sales) : '' }}
                                          </td>
                                         {{--  <td>
                                              <div class="form-button-action">
                                                  <a href="{{ route('admin.sales-recap-member-sales.show', $member->user_hash) }}" button type="button"  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg"  data-original-title="View detail">
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
              autoUpdateInput: false,
              ranges: {
                 'Today': [moment(), moment()],
                 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                 'This Month': [moment().startOf('month'), moment().endOf('month')],
                 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              }

            }, function(start, end, label) {
              $('#form-recap-date-filter [name="date"]').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
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
