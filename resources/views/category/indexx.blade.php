@extends('Layouts.admin.main')
@section('content')
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Kategori</h4>
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
                                    <h4 class="card-title">Data Kategori</h4>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#exampleModal">
                                        Tambah Data Kategori
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Input data kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{route('categories.store')}}">
                                                @csrf
                                            <div class="modal-body">
                                                <div class="form-group form-floating-label">
                                                    <input id="category_name" name="category_name" type="text" class="form-control input-solid" required="">
                                                    <label for="inputFloatingLabel2" class="placeholder">Input nama kategori</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal edit-->
{{--                                @foreach($categories as $category)--}}
{{--                                <div class="modal fade" id="modalEdit{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                                    <div class="modal-dialog" role="document">--}}
{{--                                        <div class="modal-content">--}}
{{--                                            <div class="modal-header">--}}
{{--                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>--}}
{{--                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                    <span aria-hidden="true">&times;</span>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                                                            @foreach($categories as $category)--}}
{{--                                                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">--}}

{{--                                            <form method="POST" action="{{route('categories.edit', $category['id'])}}">--}}
{{--                                                @csrf--}}
{{--                                                <div class="modal-body">--}}
{{--                                                    <div class="form-group form-floating-label">--}}
{{--                                                        <input id="category_name" name="category_name" type="text" class="form-control input-solid" required="">--}}
{{--                                                        <label for="inputFloatingLabel2" class="placeholder">Input</label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <!-- list -->
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                  @foreach($categories as $category)
                                      <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$category->category_name}}</td>
                                          <td>
                                              <div class="form-button-action">


                                                  <a href="{{ route('categories.edit', $category->id) }}" button type="button"  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg"  data-original-title="Edit Task">
                                                      <i class="fa fa-edit"></i>
                                                  </a>
                                                  <!-- Button trigger modal -->
{{--                                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit{{$category->id}}">--}}
{{--                                                      Launch demo modal--}}
{{--                                                  </button>--}}
{{--                                                      <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">EDIT</a>--}}

                                                      <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('categories.destroy', $category['id'])}}" method="post">
                                                      @csrf
                                                      @method('DELETE')
                                                  <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                      <i class="fa fa-times"></i>
                                                  </button>
                                                  </form>
                                              </div>
{{--                                              <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('categories.destroy', $category->id) }}" method="POST">--}}
{{--                                                  <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">EDITtt</a>--}}
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
{{--<script scr="http://code.jquery.com/jquery-1.11.1.min.js"></script>--}}
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
