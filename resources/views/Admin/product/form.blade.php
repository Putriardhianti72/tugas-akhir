@extends('Layouts.admin.main')

@push('css')
<style type="text/css">
#gambar > .row:first-child [data-pict="remove"] {
    /*display: none;*/
}
#gambar > .row {
    margin-bottom: 0.5rem;
}
</style>
@endpush

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Produk</h4>
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
                        <a href="#">Setting Katalog</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}">Produk</a>
                    </li>
                     <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Data Produk</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah data produk</div>
                        </div>
                        <div class="card-body">
                    <form action="{{ $product->exists ? route('admin.products.update', ['product' => $product->id]) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @if ($product->exists)
                            @method('PATCH')
                        @endif

                        @csrf
                        <div class="form-group form-group-default">
                            <label class="font-weight-bold">Nama Produk</label>
                            <input id="product_name" name="product_name" @error('product_name') is-invalid @enderror" type="text" class="form-control" value="{{ old('product_name', $product->product_name)  }}">
                        </div>
                        @error('product_name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                            @enderror
                        <br>
{{--                        <div class="form-group form-group-default">--}}
{{--                            <label class="font-weight-bold">Kategori</label>--}}
{{--                            <input id="category_id" name="category_id" @error('category_id') is-invalid @enderror" type="text" class="form-control" >--}}
{{--                        </div>--}}
{{--                        @error('category_id')--}}
{{--                        <div class="alert alert-danger mt-2">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                        @enderror--}}
{{--                        {{ $categories }}--}}

                        <div class="form-group form-group-default">
                            <label>Kategori db</label>
                            <select class="form-control" id="category_id" name="category_id">
                               @foreach($categories as $id => $category)
                                <option value="{{ $id }}" {{ old('category_id', $product->category_id) == $id ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <br>
                        <div class="form-group form-group-default">
                            <label class="font-weight-bold">Deskripsi</label>
                            <textarea id="desc" name="desc" @error('desc') is-invalid @enderror" type="textarea" class="form-control" rows="4">{{ old('desc', $product->desc) }}</textarea>
                        </div>
                        @error('desc')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                        <br>

                        <div class="form-group form-group-default">
                            <label class="font-weight-bold">Harga</label>
                            <input id="price" name="price" @error('price') is-invalid @enderror" type="textarea" class="form-control" value="{{ old('price', $product->price) }}">
                        </div>
                        @error('price')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                        <br>

                        {{-- <div class="form-group">
                            <label class="font-weight-bold">Gambar</label>
                            @if($product->exists)
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" class="form-control @error('pict') is-invalid @enderror" name="pict">
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ $product->pict_url }}" target="_blank">
                                            <img src="{{ $product->pict_url }}" class="img-fluid rounded" style="max-width: 246px">
                                        </a>
                                    </div>
                                </div>
                            @else
                                <input type="file" class="form-control @error('pict') is-invalid @enderror" name="pict">
                            @endif
                            @error('pict')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}



                        <div class="row">
                            <div class="col-12">
                                <label class="font-weight-bold">Gambar</label>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div id="gambar" class="col col-12">
                                        @if(isset($oldPict) && count($oldPict))
                                            @foreach($oldPict as $image)
                                            <div class="row">
                                                <div class="col col-md-9">
                                                  <div class="input-group">
                                                    <div class="custom-file">
                                                      <label class="custom-file-label">{{ $image['name'] }}</label>
                                                      <input type="file" name="pict[]" class="custom-file-input {{ is_numeric($image['value']) ? 'saved' : '' }}">
                                                      @if(is_numeric($image['value']))
                                                      <input type="hidden" name="pict[]" class="input-hidden" value="{{ $image['value'] }}">
                                                      @endif
                                                    </div>
                                                    <div class="input-group-append">
                                                      <button class="btn btn-outline-secondary btn-sm" data-pict="remove" type="button"><i class="fa fa-minus"></i></button>
                                                      <button class="btn btn-outline-secondary btn-sm" data-pict="add" type="button"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                  </div>
                                              </div>
                                                <div class="col col-md-2 img">
                                                    <img src="{{ $image['image'] }}" class="img-fluid">
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                            @foreach($product->images as $image)
                                            <div class="row">
                                                <div class="col col-md-9">
                                                  <div class="input-group">
                                                    <div class="custom-file">
                                                      <label class="custom-file-label">{{ $image->pict }}</label>
                                                      <input type="file" name="pict[]" class="custom-file-input saved">
                                                      <input type="hidden" name="pict[]" class="input-hidden" value="{{ $image->id }}">
                                                    </div>
                                                    <div class="input-group-append">
                                                      <button class="btn btn-outline-secondary btn-sm" data-pict="remove" type="button"><i class="fa fa-minus"></i></button>
                                                      <button class="btn btn-outline-secondary btn-sm" data-pict="add" type="button"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                  </div>
                                              </div>
                                                <div class="col col-md-2 img">
                                                    <img src="{{ $image->pict_url }}" class="img-fluid">
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif

                                        <div class="row">
                                            <div class="col col-md-9">
                                              <div class="input-group">
                                                <div class="custom-file">
                                                  <label class="custom-file-label">Pilih gambar</label>
                                                  <input type="file" name="pict[]" class="custom-file-input">
                                                </div>
                                                <div class="input-group-append">
                                                  <button class="btn btn-outline-secondary btn-sm" data-pict="remove" type="button"><i class="fa fa-minus"></i></button>
                                                  <button class="btn btn-outline-secondary btn-sm" data-pict="add" type="button"><i class="fa fa-plus"></i></button>
                                                </div>
                                              </div>
                                          </div>
                                            <div class="col col-md-2 img">
                                                {{-- <img src="" class="img-fluid"> --}}
                                            </div>
                                        </div>


                                        @error('pict')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>

                        <div class="d-flex justify-content-end align-items-center">
                          <a href="{{ route('admin.products.index') }}" class="btn btn-link btn-md btn-warning- mr-2">BATAL</a>
                          <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(function () {
    function toggleRemoveVisibility() {
        var display = '';

        if ($('#gambar > .row').length <= 1) {
            display = 'none';
        }

        $('#gambar > .row:first-child').find('[data-pict="remove"]').css('display', display);
    }

    toggleRemoveVisibility();

    $(document).on('click', '[data-pict="add"]', function () {
        var html = $(this).closest('.row').html();
        html = $('<div class="row">'+html+'</div>');
        html.find('.img').html('');
        html.find('.custom-file-input').attr('value', '').removeClass('saved');
        html.find('.custom-file-label').text('Pilih gambar');
        html.find('[data-pict="remove"]').css('display', '');
        $(html).insertAfter($(this).closest('.row'));
        toggleRemoveVisibility();
    });
    $(document).on('click', '[data-pict="remove"]', function () {
        $(this).closest('.row').remove();
        toggleRemoveVisibility();
    });
    $(document).on('change', '#gambar .custom-file-input', function (e) {
        var $this = $(this);
        var filename = 'Pilih gambar';
        var file = null;
        if (e && e.target && e.target.files && e.target.files[0]) {
            file = e.target.files[0];
            filename = file.name;
            if ($this.hasClass('saved')) {
                $this.closest('.row').find('.input-hidden').remove();
                $this.closest('.row').find('.saved').removeClass('saved');
            }

            var reader = new FileReader();
            reader.onload = function(evt) {
                $this.closest('.row').find('.img').html('<img src="'+evt.target.result+'" class="img-fluid">');
            };

            reader.readAsDataURL(file);
        }

        $(this).closest('.row').find('.custom-file-label').text(filename);
    })
});
</script>
@endpush
