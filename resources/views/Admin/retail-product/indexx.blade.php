@extends('Layouts.admin.main')
@section('content')
    <div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Produk</h4>
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
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Produk</h4>
                            <!-- Button trigger modal -->
{{--                            <a type="button" href="{{ route('products.create') }}"  class="btn btn-primary btn-round ml-auto" data-toggle="modal">--}}
{{--                                Tambah Data Produk--}}
{{--                            </a>--}}
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-round ml-auto">Tambah data produk</a>

                        </div>
                    </div>
                    <!-- list -->
                    <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul Template</th>
                                <th>Harga</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{ $product->pict_url  }}" class="rounded" style="width: 150px"></td>
                                    <td>{{ $product->product_name }}</td>
{{--                                    <td>{{ $product->product_name }}</td>--}}
                                    <td>{{ format_currency($product->price) }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('products.edit', $product->id) }}" button type="button"  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg"  data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
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
    <!--   Core JS Files   -->
    <script src="{{URL::asset('admin')}}/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="{{URL::asset('admin')}}/assets/js/core/popper.min.js"></script>
    <script src="{{URL::asset('admin')}}/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="{{URL::asset('admin')}}/assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Atlantis JS -->
    <script src="{{URL::asset('admin')}}/assets/js/atlantis.min.js"></script>

<script >
    $(document).ready(function() {
        // Add Row
        $('#add-row').DataTable({
            "pageLength": 3,
        });

    });
</script>
</body>
</html>
