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
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
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
                <div class="row">
                  <div class="col-12">
                    <div class="product-chat">
                      <figure class="figure d-flex">
                        <div class="product-img">
                          @if ($products->discount == true)
                            <div class="discount-image">
                              <img
                                src="{{ url('/images/ic_discount_empty.svg') }}"
                                class="align-items-end img-fluid"
                                alt=""
                              />
                              <div class="discount-badge">{{ $products->discount_amount }}%</div>
                            </div>
                          @endif
                        </div>
                      </figure>
                    </div>
                  </div>
                </div>
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div class="col-md-6 product_data">
				<div class="d-flex name-store">
				<div class="flex-shrink-0">
					<img src="{{ url('/images/ic_store.svg') }}" class="img-fluid" alt="" />
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
          @if ($products->stock == 'Habis')
              <span class="badge bg-danger">Habis</span>
          @endif
				</div>
				<div class="price mt-2">Rp. {{ number_format($products->price) }}</div>
            	<form action="{{ route('detail-add', $products->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="row mt-4">
					<div class="col-2">
						<div class="quantity">
							<input type="number" name="quantity" class="form-control" min="1" value="1">
						</div>
					</div>
					<div class="col-2">
						<div class="product-chat">
							<img src="{{ asset('images/ic_chat.svg') }}" class="img-fluid" alt="" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-lg-6">
						<div class="d-grid gap-2 add-to-cart">
							@auth
								@if (Auth::user()->id == $products->users_id)
									@if (Auth::user()->roles == 'ADMIN')
										<a href="{{ route('dashboard-admin') }}" class="btn btn-add-to-cart mt-5" type="submit">
											Dashboard
										</a> 
									@else
										<a href="{{ route('dashboard-seller') }}" class="btn btn-add-to-cart mt-5" type="submit">
											Dashboard
										</a> 
									@endif
								@else
									@if ($products->stock == 'Habis')
                      <button class="btn btn-add-to-cart disabled" type="button">
                        Stock Habis
                      </button>
                  @else
                      <button class="btn btn-add-to-cart" type="submit">
                        Masuk Keranjang
                      </button>
                  @endif
								@endif
							@endauth
							@guest
								<a href="{{ route('login') }}" class="btn btn-add-to-cart">
									Masuk Keranjang
								</a>
							@endguest
						</div>
					</div>
				</div>
            </form>
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
                    src="{{ asset('images/reviews1.jpg') }}"
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
                    src="{{ asset('images/reviews2.jpg') }}"
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

{{-- @push('after-script')
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
@endpush --}}
