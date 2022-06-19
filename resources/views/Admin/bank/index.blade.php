@extends('Layouts.admin.main')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data bank</h4>
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
                                <h4 class="card-title">Data Bank</h4>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#exampleModal">
                                    Tambah Data Bank
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Input data bank</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{route('admin.banks.store')}}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group form-floating-label">
                                                    <input id="bank_name" name="bank_name" type="text" class="form-control input-solid" required="">
                                                    <label for="inputFloatingLabel2" class="placeholder">Nama Bank</label>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group form-floating-label">
                                                    <input id="acc_owner" name="acc_owner" type="text" class="form-control input-solid" required="">
                                                    <label for="inputFloatingLabel2" class="placeholder">Nama Pemilik</label>
                                                </div>
                                            </div><div class="modal-body">
                                                <div class="form-group form-floating-label">
                                                    <input id="acc_number" name="acc_number" type="text" class="form-control input-solid" required="">
                                                    <label for="inputFloatingLabel2" class="placeholder">Nomor Rekening</label>
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
                                        <th>Nama Bank</th>
                                        <th>Nama Pemilik Rekening</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($databanks as $databank)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$databank->bank_name}}</td>
                                            <td>{{$databank->acc_owner}}</td>
                                            <td>
                                                <div class="form-button-action">


                                                    <a href="{{ route('admin.banks.edit', $databank->id) }}" button type="button"  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg"  data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <!-- Button trigger modal -->
                                                    {{--                                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit{{$category->id}}">--}}
                                                    {{--                                                      Launch demo modal--}}
                                                    {{--                                                  </button>--}}
                                                    {{--                                                      <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">EDIT</a>--}}

                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('admin.banks.destroy', $databank['id'])}}" method="post">
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
