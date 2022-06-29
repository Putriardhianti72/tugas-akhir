@extends('Layouts.admin.main')
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
          <div class="card">
            <div class="card-header">
              <div class="card-title">Detail Produk</div>
            </div>

            <div class="row mb-2">
              <div class="col-12">
                <div class="card shadow-none">
                  <div class="card-body">
                    <h4 class="subtitle-page">Product Detail</h4>

                    <div class="row my-4">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-12 col-md-4">
                            <b> Nama Produk </b>
                          </div>
                          <div class="col-12 col-md-8">
                            : {{ $product->product_name }}
                          </div>
                          <div class="col-12 col-md-4">
                            <b>Kategori Produk </b>
                          </div>
                          <div class="col-12 col-md-8">
                            : {{ $product->category_id }}
                          </div>
                          <div class="col-12 col-md-4">
                            <b>Deskripsi produk </b>
                          </div>
                          <div class="col-12 col-md-8">
                            : {{ $product->desc }}
                          </div>
                          <div class="col-12 col-md-4">
                            <b>Harga </b>
                          </div>
                          <div class="col-12 col-md-8">
                            : {{ $product->price }}
                          </div>
                          <div class="col-12 col-md-4">
                            <b>Tanggal Pembuatan </b>
                          </div>
                          <div class="col-12 col-md-8">
                            : {{ $product->created_at }}
                          </div>
                          <div class="col-12 col-md-4">
                            <b>Tanggal Update </b>
                          </div>
                          <div class="col-12 col-md-8">
                            : {{ $product->updated_at }}
                          </div>
                          <div class="col-12 col-md-4">
                            <b>Gambar </b>
                          </div>
                          <div class="col-12 col-md-8">
                            <img src="{{ $product->pict_url  }}" class="rounded" style="width: 300px">
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

