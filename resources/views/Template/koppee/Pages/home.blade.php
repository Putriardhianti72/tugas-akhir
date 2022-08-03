@extends('Template.koppee.Layouts.main')

@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('assets/koppee/img/bg-landing.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <h2 class="text-primary font-weight-medium m-0">Propolis</h2>
                    <h1 class="display-1 text-white m-0">PROFLAVO</h1>
                    <h2 class="text-white m-0">NANO PROPOLIS</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('assets/koppee/img/bg-landing.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <h2 class="text-primary font-weight-medium m-0">Propolis</h2>
                    <h1 class="display-1 text-white m-0">PROFLAVO</h1>
                    <h2 class="text-white m-0">* Membantu Menjaga Imun Anda *</h2>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">About</h4>
            <h1 class="display-4">Proflavo Nano Propolis</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 py-0 py-lg-5">
                <h1 class="mb-3">Tentang Proflavo</h1>
                <h5 class="mb-3">Cairan Suplemen dari Lebah Madu Tropis Pilihan</h5>
                <p>Sejak 300 SM, propolis telah digunakan sebagai makanan dan sebagai obat yang bermanfaat untuk kesehatan secara keseluruhan. Proflavo diolah menggunakan technology terbaru yaitu Nano sehingga dalam satu tetes Proflavo setara dengan dua tetes propolis biasa. Proflavo merupakan propolis yang tidak mengandung alcohol sehingga halal untuk dikonsumsi.</p>
                <a href="" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Learn More</a>
            </div>
            <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="{{ asset('assets/koppee/img/1.png') }}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-4 py-0 py-lg-5">
                <h1 class="mb-3">Our Price</h1>
                <p>Harga dan manfaat produk kami yang berbanding lurus</p>
                <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Propolis dengan nano teknologi</h5>
                <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Membantu menjaga imun Anda</h5><br>
                <h5 class="mb-3"> Rp. {{ $product['harga'] ?? '' }}</h5>
                <a href="" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Learn More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->




<!-- Offer Start -->
<div class="offer container-fluid my-5 py-5 text-center position-relative overlay-top overlay-bottom">
    <div class="container py-5">
        <h1 class="display-3 text-primary mt-3">50% OFF</h1>
        <h1 class="text-white mb-3">Sunday Special Offer</h1>
        <h4 class="text-white font-weight-normal mb-4 pb-3">Only for Sunday from 1st Jan to 30th Jan 2045</h4>
        <div class="form-inline justify-content-center mb-4">
            <div class="form-group">
                <div class="">
                    <button class="btn btn-primary font-weight-bold px-4" type="button" data-action="add-to-cart" data-code-product="{{ $product['codeProduct'] ?? '' }}">Beli Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->


<!-- Menu Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Services</h4>
            <h1 class="display-4">Manfaat Proflavo Nano Propolis</h1>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h1 class="mb-5">Manfaat</h1>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">1</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Sebagai stimulator sistem kekebalan tubuh (imuno stimulator)</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">2</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Sebagai antijamur, antibakteri, dan antivirus</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">3</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Antioksidan, melawan radikal bebas</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">4</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Antitumor, menekan pertumbuhan sel tak terkendali</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">5</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Membantu proses regenerasi sel hati</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <h1 class="mb-5"></h1>
              <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">1</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Sebagai stimulator sistem kekebalan tubuh (imuno stimulator)</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">2</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Sebagai antijamur, antibakteri, dan antivirus</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">3</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Antioksidan, melawan radikal bebas</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">4</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Antitumor, menekan pertumbuhan sel tak terkendali</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        {{-- <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset('assets/koppee/img/menu-1.jpg') }}" alt=""> --}}
                        <h5 class="menu-price">5</h5>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4>Membantu proses regenerasi sel hati</h4>
                        {{-- <p class="m-0">Sit lorem ipsum et diam elitr est dolor sed duo guberg sea et et lorem dolor</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Menu End -->


<!-- Reservation Start -->
<div class="container-fluid my-5">
    <div class="container">
        <div class="reservation position-relative overlay-top overlay-bottom">
            <div class="row align-items-center">
                <div class="col-lg-6 my-5 my-lg-0">
                    <div class="p-5">
                        <div class="mb-4">
                            <h1 class="display-3 text-primary">30% OFF</h1>
                            <h1 class="text-white">For Online Reservation</h1>
                        </div>
                        <p class="text-white">Lorem justo clita erat lorem labore ea, justo dolor lorem ipsum ut sed eos,
                            ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea</p>
                        <ul class="list-inline text-white m-0">
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Lorem ipsum dolor sit amet</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                        <h1 class="text-white mb-4 mt-5">Book Your Table</h1>
                        <form class="mb-5">
                            <div class="form-group">
                                <input type="text" class="form-control bg-transparent border-primary p-4" placeholder="Name"
                                    required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control bg-transparent border-primary p-4" placeholder="Email"
                                    required="required" />
                            </div>
                            <div class="form-group">
                                <div class="date" id="date" data-target-input="nearest">
                                    <input type="text" class="form-control bg-transparent border-primary p-4 datetimepicker-input" placeholder="Date" data-target="#date" data-toggle="datetimepicker"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="time" id="time" data-target-input="nearest">
                                    <input type="text" class="form-control bg-transparent border-primary p-4 datetimepicker-input" placeholder="Time" data-target="#time" data-toggle="datetimepicker"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select bg-transparent border-primary px-4" style="height: 49px;">
                                    <option selected>Person</option>
                                    <option value="1">Person 1</option>
                                    <option value="2">Person 2</option>
                                    <option value="3">Person 3</option>
                                    <option value="3">Person 4</option>
                                </select>
                            </div>

                            <div>
                                <button class="btn btn-primary btn-block font-weight-bold py-3" type="submit">Book Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reservation End -->


<!-- Testimonial Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimonial</h4>
            <h1 class="display-4">Our Customer Say</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            <div class="testimonial-item">
                <div class="d-flex align-items-center mb-3">
                    <img class="img-fluid" src="{{ asset('assets/koppee/img/testimonial-1.jpg') }}" alt="">
                    <div class="ml-3">
                        <h4>Mariska</h4>
                        <i>Jogja</i>
                    </div>
                </div>
                <p class="m-0">Saya mau berbagi pengalaman saya pak. Anak saya kena amandel saya kasih proflavo 3 tetes dilarutkan dalam air sepertinya tidak begitu ngefek… besoknya saya teteskan langsung ke amandelnya katanya panas terus langsung adem dan berangsur membaik. Alhamdulillah.</p>
            </div>
            <div class="testimonial-item">
                <div class="d-flex align-items-center mb-3">
                    <img class="img-fluid" src="{{ asset('assets/koppee/img/testimonial-2.jpg') }}" alt="">
                    <div class="ml-3">
                        <h4>Suwarno</h4>
                        <i>Karanganyar</i>
                    </div>
                </div>
                <p class="m-0">Saya sebelumnya pegel kaki, ngantuk tidak bisa dihindari. Lalu saya dikenalkan Proflavo dan mulai mengonsumsinya. Setelah minum Proflavo alhamdulillah sampai sekarang tidak ada keluhan dan rasa pegel di kaki sudah tidak ada..</p>
            </div>
            <div class="testimonial-item">
                <div class="d-flex align-items-center mb-3">
                    <img class="img-fluid" src="{{ asset('assets/koppee/img/testimonial-3.jpg') }}" alt="">
                    <div class="ml-3">
                        <h4>Mbah Magi</h4>
                        <i>Semarang</i>
                    </div>
                </div>
                <p class="m-0">Sebelumnya saya setelah bangun tidur kepala pusing ngliyeng dan kaki sering kesemutan. Alhamdulillah setelah 3 hari konsumsi Proflavo ngliyeng dan kesemutan kaki saya sudah hilang. Sekarang rutin konsumsi Proflavo Propolis</p>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
@endsection


@push('js')
<script type="text/javascript">
  $(function () {
    $(document).on('click', '[data-action="add-to-cart"]', function (e) {
      e.preventDefault();

      var $this = $(this);
      var data = {
        codeProduct: $this.data('code-product'),
        domain: '{{ env('KOPPEE_DOMAIN') }}',
        qty: 1,
        _token: '{{ csrf_token() }}'
      }

      $.ajax({
        url: '{{ route('template.carts.store', $domain) }}',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
          if (res.status === 'success') {
            window.location.href = '{{ route('template.carts.index', $domain) }}'
          }
        },
        error: function (err) {
          console.log(err)
        }
      });
    });
  });
</script>
@endpush
