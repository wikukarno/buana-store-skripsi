@extends('layouts.detail')

@section('title')
    Detail Produk
@endsection

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
          <li class="breadcrumb-item active my-auto" aria-current="page">
            Detail Produk
          </li>
        </ol>
      </div>
    </nav>

    <!-- Gallery -->
    <section class="section-gallery">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-5">
            <div
              id="carouselExampleIndicators"
              class="carousel slide"
              data-bs-ride="carousel"
            >
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide 1"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="1"
                  aria-label="Slide 2"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="2"
                  aria-label="Slide 3"
                ></button>
              </div>
              <div class="carousel-inner rounded" style="max-height: 340px; background-size: cover">
                @foreach ($products->galleries as $key => $gallery)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img
                            src="{{ Storage::url($gallery->photo) }}"
                            class="d-block w-100"
                            alt="galeri"
                        />
                    </div>
                @endforeach
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div class="col-md-6 product_data">
            <div class="d-flex name-store">
              <div class="flex-shrink-0">
                <img src="{{ url('/frontend/images/ic_store.svg') }}" class="img-fluid" alt="" />
              </div>
              <div class="flex-grow-1 ms-3 py-1">
                <p>{{ $products->user->name_store }}</p>
              </div>
            </div>
            <div class="rating-product mb-1">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="name-product">
              <h5>{{ $products->name_product }}</h5>
            </div>
            <div class="price">Rp. {{ number_format($products->price) }}</div>
            <div class="product-chat mt-3">
              <img src="{{ url('/frontend/images/ic_chat.svg') }}" class="img-fluid" alt="" />
            </div>
            {{-- <form action="{{ route('detail-add', $products->id) }}" method="POST" enctype="multipart/form-data"> --}}
              {{-- @csrf --}}
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="d-grid gap-2 add-to-cart">
                  <button class="btn btn-buy-now" type="button">
                    Beli Sekarang
                  </button>
                  <button class="btn btn-add-to-cart" type="button">
                    Masuk Keranjang
                  </button>
                </div>
              </div>
            </div>
            {{-- </form> --}}
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-6">
            <div class="description-product">
              <h3>Deskripsi Barang</h3>
              <div class="description">
                <p>{!! $products->description !!}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h3>Ulasan Barang</h3>
            <div class="reviews">
              <div class="d-flex align-items-center customer-reviews">
                <div class="flex-shrink-0">
                  <img
                    src="{{ url('/frontend/images/reviews_1.svg') }}"
                    class="img-fluid"
                    alt="..."
                  />
                </div>
                <div class="flex-grow-1 ms-3">
                  <h5 class="pt-5">Anna Sukkirata</h5>
                  <p>
                    Color is great with the minimalist concept. Even I thought
                    it was made by Cactus industry. I do really satisfied with
                    this.
                  </p>
                </div>
              </div>
              <div class="d-flex align-items-center customer-reviews">
                <div class="flex-shrink-0">
                  <img
                    src="{{ url('/frontend/images/reviews_2.svg') }}"
                    class="img-fluid"
                    alt="..."
                  />
                </div>
                <div class="flex-grow-1 ms-3">
                  <h5 class="pt-5">Wiku Karno</h5>
                  <p>
                    I thought it was not good for living room. I really happy to
                    decided buy this product last week now feels like homey.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Gallery -->
@endsection

@push('after-script')
    <script>
      $(document).ready(function () {
        $('.btn-add-to-cart').click(function (e) { 
          e.preventDefault();
          
          var product_id = $(this).closest('.product_data').find('.prod_id').val();
          var quantity = $(this).closest('.product_data').find('.qty-input').val();

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
            method: "POST",
            url: "/details/{id}",
            data: {
              'products_id': product_id,
              'quantity': quantity
            },
            dataType: "dataType",
            success: function (response) {
              alert(response.status);
            }
          });
        });
        $('#increment').click(function (e) { 
        e.preventDefault();

        var inc_value = $('.qty-input').val();
        var value = parseInt(inc_value, 10);
        // isNaN = Not a Number
        value = isNaN(value) ? 0 : value;

          if (value < 100) {
            value++;
            $('.qty-input').val(value);
          }
        });

        $('#decrement').click(function (e) { 
        e.preventDefault();

        var inc_value = $('.qty-input').val();
        var value = parseInt(inc_value, 10);
        // isNaN = Not a Number
        value = isNaN(value) ? 0 : value;

          if (value > 1) {
            value--;
            $('.qty-input').val(value);
          }
        });
      });
    </script>
@endpush