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
                                  <th scope="col">Kode Produk</th>
                                  <th scope="col">Total Penjualan</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($productSales as $product)
                                <tr>
                                  <td scope="row">{{ $product['product_name'] }}</td>
                                  <td>{{ $product['code'] }}</td>
                                  <td>{{ $product['total_qty'] }}</td>
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
<script src="{{URL::asset('admin')}}/assets/js/plugin/chart.js/chart.min.js"></script>
<script src="{{URL::asset('admin')}}/assets/js/plugin/chart-circle/circles.min.js"></script>
<script>

var ctx = document.getElementById('statisticsChart').getContext('2d');
var statisticsChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    datasets: [ {
      label: "Pending",
      borderColor: '#f3545d',
      pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
      pointRadius: 0,
      backgroundColor: 'rgba(243, 84, 93, 0.4)',
      legendColor: '#f3545d',
      fill: true,
      borderWidth: 2,
      data: [154, 184, 175, 203, 210, 231, 240]
    }, {
      label: "Paid",
      borderColor: '#fdaf4b',
      pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
      pointRadius: 0,
      backgroundColor: 'rgba(253, 175, 75, 0.4)',
      legendColor: '#fdaf4b',
      fill: true,
      borderWidth: 2,
      data: [256, 230, 245, 287, 240, 250, 230]
    }, {
      label: "Processing",
      borderColor: '#177dff',
      pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
      pointRadius: 0,
      backgroundColor: 'rgba(23, 125, 255, 0.4)',
      legendColor: '#177dff',
      fill: true,
      borderWidth: 2,
      data: [542, 480, 430, 550, 530, 453, 380]
    }, {
      label: "Completed",
      borderColor: '#177dff',
      pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
      pointRadius: 0,
      backgroundColor: 'rgba(23, 125, 255, 0.4)',
      legendColor: '#177dff',
      fill: true,
      borderWidth: 2,
      data: [542, 480, 430, 550, 530, 453, 380]
    }, {
      label: "Cancelled",
      borderColor: '#177dff',
      pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
      pointRadius: 0,
      backgroundColor: 'rgba(23, 125, 255, 0.4)',
      legendColor: '#177dff',
      fill: true,
      borderWidth: 2,
      data: [542, 480, 430, 550, 530, 453, 380]
    }]
  },
  options : {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    tooltips: {
      bodySpacing: 4,
      mode:"nearest",
      intersect: 0,
      position:"nearest",
      xPadding:10,
      yPadding:10,
      caretPadding:10
    },
    layout:{
      padding:{left:5,right:5,top:15,bottom:15}
    },
    scales: {
      yAxes: [{
        ticks: {
          fontStyle: "500",
          beginAtZero: false,
          maxTicksLimit: 5,
          padding: 10
        },
        gridLines: {
          drawTicks: false,
          display: false
        }
      }],
      xAxes: [{
        gridLines: {
          zeroLineColor: "transparent"
        },
        ticks: {
          padding: 10,
          fontStyle: "500"
        }
      }]
    },
    legendCallback: function(chart) {
      var text = [];
      text.push('<ul class="' + chart.id + '-legend html-legend">');
      for (var i = 0; i < chart.data.datasets.length; i++) {
        text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>');
        if (chart.data.datasets[i].label) {
          text.push(chart.data.datasets[i].label);
        }
        text.push('</li>');
      }
      text.push('</ul>');
      return text.join('');
    }
  }
});

var myLegendContainer = document.getElementById("myChartLegend");

// generate HTML legend
myLegendContainer.innerHTML = statisticsChart.generateLegend();

// bind onClick event to all LI-tags of the legend
var legendItems = myLegendContainer.getElementsByTagName('li');
for (var i = 0; i < legendItems.length; i += 1) {
  legendItems[i].addEventListener("click", legendClickCallback, false);
}
</script>

<script>
      Circles.create({
      id:'circles-1',
      radius:45,
      value:100,
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
      value:100,
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
      value:100,
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
      value:100,
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
      value:100,
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
      value:100,
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
