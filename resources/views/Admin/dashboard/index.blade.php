@extends('Layouts.admin.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Dashboard</h4>
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
                        <a href="#">Dashboard</a>
                    </li>
                </ul>
            </div>
            <div class="row mt--2">
              <div class="col-md-6">
                <div class="card full-height">
                  <div class="card-body">
                    <div class="card-title">Statistik Order Member</div>
                    <div class="card-category">Daily information about statistics in system</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                      <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-1"></div>
                        <h6 class="fw-bold mt-3 mb-0">Paid</h6>
                      </div>
                       <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-2"></div>
                        <h6 class="fw-bold mt-3 mb-0">Processing</h6>
                      </div>
                      <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-3"></div>
                        <h6 class="fw-bold mt-3 mb-0">Complete</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card full-height">
                  <div class="card-body">
                    <div class="card-title">Statistik Order Retail Customer</div>
                    <div class="card-category">Daily information about statistics in system</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                      <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-4"></div>
                        <h6 class="fw-bold mt-3 mb-0">Paid</h6>
                      </div>
                       <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-5"></div>
                        <h6 class="fw-bold mt-3 mb-0">Delivery</h6>
                      </div>
                      <div class="px-2 pb-2 pb-md-0 text-center">
                        <div id="circles-6"></div>
                        <h6 class="fw-bold mt-3 mb-0">Complete</h6>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
{{--                            <h4 class="card-title">Button Original</h4>--}}

                        </div>
                        <div class="card-body">



                          <div class="row">
                            <div class="col-12">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Nama Produk</th>
                                  <th scope="col">Kode</th>
                                  <th scope="col">Total Penjualan</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($totalProductSales as $product)
                                <tr>
                                  <td scope="row">{{ $product->product_name }}</td>
                                  <td>{{ $product->code }}</td>
                                  <td>{{ $product->total_qty }}</td>
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
    </div>
@endsection
@push('js')
<script src="{{URL::asset('admin')}}/assets/js/plugin/chart-circle/circles.min.js"></script>
<script>
      Circles.create({
      id:'circles-1',
      radius:45,
      value:{{ ($totalOrderPaid ?: '0') * 10 }},
      maxValue:100,
      width:7,
      text: '{{ $totalOrderPaid ?: '0' }}',
      colors:['#f1f1f1', '#3355dd'],
      duration:400,
      wrpClass:'circles-wrp',
      textClass:'circles-text',
      styleWrapper:true,
      styleText:true
    })

    Circles.create({
      id:'circles-2',
      radius:45,
      value:{{ ($totalOrderProcessing ?: '0') * 10 }},
      maxValue:100,
      width:7,
      text: '{{ $totalOrderProcessing ?: '0' }}',
      colors:['#f1f1f1', '#FF9E27'],
      duration:400,
      wrpClass:'circles-wrp',
      textClass:'circles-text',
      styleWrapper:true,
      styleText:true
    })

    Circles.create({
      id:'circles-3',
      radius:45,
      value:{{ ($totalOrderComplete ?: '0') * 10 }},
      maxValue:100,
      width:7,
      text: '{{ $totalOrderComplete ?: '0' }}',
      colors:['#f1f1f1', '#2BB930'],
      duration:400,
      wrpClass:'circles-wrp',
      textClass:'circles-text',
      styleWrapper:true,
      styleText:true
    })

    Circles.create({
      id:'circles-4',
      radius:45,
      value:{{ ($totalRetailOrderPaid ?: '0') * 10 }},
      maxValue:100,
      width:7,
      text: '{{ $totalRetailOrderPaid ?: '0' }}',
      colors:['#f1f1f1', '#3355dd'],
      duration:400,
      wrpClass:'circles-wrp',
      textClass:'circles-text',
      styleWrapper:true,
      styleText:true
    })

    Circles.create({
      id:'circles-5',
      radius:45,
      value:{{ ($totalRetailOrderDelivery ?: '0') * 10 }},
      maxValue:100,
      width:7,
      text: '{{ $totalRetailOrderDelivery ?: '0' }}',
      colors:['#f1f1f1', '#FF9E27'],
      duration:400,
      wrpClass:'circles-wrp',
      textClass:'circles-text',
      styleWrapper:true,
      styleText:true
    })

    Circles.create({
      id:'circles-6',
      radius:45,
      value:{{ ($totalRetailOrderComplete ?: '0') * 10 }},
      maxValue:100,
      width:7,
      text: '{{ $totalRetailOrderComplete ?: '0' }}',
      colors:['#f1f1f1', '#2BB930'],
      duration:400,
      wrpClass:'circles-wrp',
      textClass:'circles-text',
      styleWrapper:true,
      styleText:true
    })
</script>
@endpush
