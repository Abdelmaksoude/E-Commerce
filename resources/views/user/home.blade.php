@extends('master2')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @if (Session::has('error'))
            <script>
                toastr.success("{{ Session::get('error') }}");
            </script>
        @endif
        <!-- Carousel Start -->
        <div class="container-fluid mb-3">
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#header-carousel" data-slide-to="1"></li>
                            <li data-target="#header-carousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">

                            @foreach ($all_sliders as $index => $all_slider)
                                <div class="carousel-item position-relative {{ $index === 0 ? 'active' : '' }}" style="height: 430px;">
                                    <img class="position-absolute w-100 h-100" src="{{ asset('Attachments/Sliders/'.$all_slider->photo) }}" style="object-fit: cover;">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{ $all_slider->title }}</h1>
                                            <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{ $all_slider->description }}</p>
                                            <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{ route('shop') }}">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="carousel-item position-relative active" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{asset('assets2/img/carousel-1.jpg')}}" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Men Fashion</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item position-relative" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{asset('assets2/img/carousel-2.jpg')}}" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Women Fashion</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item position-relative" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="{{asset('assets2/img/carousel-3.jpg')}}" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Kids Fashion</h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product-offer mb-30" style="height: 200px;">
                        <img class="img-fluid" src="{{asset('assets2/img/offer-1.jpg')}}" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Save 20%</h6>
                            <h3 class="text-white mb-3">Special Offer</h3>
                            <a href="" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                    <div class="product-offer mb-30" style="height: 200px;">
                        <img class="img-fluid" src="{{asset('assets2/img/offer-2.jpg')}}" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Save 20%</h6>
                            <h3 class="text-white mb-3">Special Offer</h3>
                            <a href="" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Featured Start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5 pb-3">
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                        <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                        <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                        <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featured End -->


        <!-- Categories Start -->
        <div class="container-fluid pt-5">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
            <div class="row px-xl-5 pb-3">
                @foreach ($all_category as $all_category)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <a class="text-decoration-none" href="{{ route('producthavesamecategory',$all_category->id) }}">
                            <div class="cat-item d-flex align-items-center mb-4">
                                <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                    <img class="img-fluid" src="{{asset('Attachments/Category/'.$all_category->photo)}}" alt="">
                                </div>
                                <div class="flex-fill pl-3">
                                    <h6>{{ $all_category->name }}</h6>
                                    <small class="text-body">{{ App\Models\Product::where('category_id',$all_category->id)->count() }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Categories End -->


        <!-- Products Start -->
        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
            <div class="row px-xl-5">

                @foreach ($allProducts as $allProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="max-height: 300px" src="{{asset('Attachments/Product/'.$allProduct->photo)}}" alt="">
                                <div class="product-action">
                                    <form class="addToCartForm" id="addToCartForm_{{ $allProduct->id }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $allProduct->id }}" name="id" >
                                        <input type="hidden" value="{{ $allProduct->title }}" name="title">
                                        <input type="hidden" value="{{ $allProduct->final_value }}" name="price">
                                        <input type="hidden" value="{{ $allProduct->photo }}"  name="image">
                                        <input type="hidden" value="1" name="quantity">
                                        <button data-product-id="{{ $allProduct->id }}" class="btn btn-outline-dark btn-square addToCartBtn"><i class="fa fa-shopping-cart"></i></button>
                                    </form>
                                    @auth
                                        @if (App\Models\FavouriteProduct::where('product_id', $allProduct->id)->where('user_id', Auth::user()->id)->exists())
                                            <a class="delete-favourite btn btn-outline-dark btn-square addFavourite" data-id="{{ $allProduct->id }}"><i class="fa fa-heart"></i></a>
                                        @else
                                            <a class="add-favourite btn btn-outline-dark btn-square addFavourite" data-id="{{ $allProduct->id }}"><i class="far fa-heart"></i></a>
                                        @endif
                                    @endauth
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="{{ route('details',$allProduct->id) }}">{{ $allProduct->title }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $allProduct->final_value }}$</h5><h6 class="text-muted ml-2"><del>{{ $allProduct->price }}</del></h6>
                                </div>
                                @php
                                    $total = App\Models\Review::where('product_id', $allProduct->id)->sum('rate');
                                    $reviewCount = App\Models\Review::where('product_id', $allProduct->id)->count();
                                    $totalreviewcount = ($reviewCount > 0) ? ($total / $reviewCount) : 0;
                                @endphp
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    @if ($totalreviewcount > 0 && $totalreviewcount <= 1.49)
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    @elseif ($totalreviewcount >= 1.5 && $totalreviewcount <= 2.49)
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    @elseif ($totalreviewcount >= 2.5 && $totalreviewcount <= 3.49)
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    @elseif ($totalreviewcount >= 3.5 && $totalreviewcount <= 4.49)
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="far fa-star"></i>
                                    @elseif ($totalreviewcount == 0)
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    @else
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                        <i class="fa fa-star text-primary mr-1"></i>
                                    @endif
                                    <small>({{ $reviewCount }})</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Products End -->


        <!-- Offer Start -->
        <div class="container-fluid pt-5 pb-3">
            <div class="row px-xl-5">
                <div class="col-md-6">
                    <div class="product-offer mb-30" style="height: 300px;">
                        <img class="img-fluid" src="{{asset('assets2/img/offer-1.jpg')}}" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Save 20%</h6>
                            <h3 class="text-white mb-3">Special Offer</h3>
                            <a href="" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-offer mb-30" style="height: 300px;">
                        <img class="img-fluid" src="{{asset('assets2/img/offer-2.jpg')}}" alt="">
                        <div class="offer-text">
                            <h6 class="text-white text-uppercase">Save 20%</h6>
                            <h3 class="text-white mb-3">Special Offer</h3>
                            <a href="" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offer End -->


        <!-- Products Start -->
        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
            <div class="row px-xl-5">
                @foreach ($allProducts as $product)
                    @if ($product->price != $product->final_value)
                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('Attachments/Product/'.$product->photo)}}" alt="">
                                    <div class="product-action">
                                        <form class="addToCartForm" id="addToCartForm_{{ $allProduct->id }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{ $allProduct->id }}" name="id" >
                                            <input type="hidden" value="{{ $allProduct->title }}" name="title">
                                            <input type="hidden" value="{{ $allProduct->final_value }}" name="price">
                                            <input type="hidden" value="{{ $allProduct->photo }}"  name="image">
                                            <input type="hidden" value="1" name="quantity">
                                            <button data-product-id="{{ $allProduct->id }}" class="btn btn-outline-dark btn-square addToCartBtn"><i class="fa fa-shopping-cart"></i></button>
                                        </form>
                                        @auth
                                            @if (App\Models\FavouriteProduct::where('product_id', $allProduct->id)->where('user_id', Auth::user()->id)->exists())
                                                <a class="delete-favourite btn btn-outline-dark btn-square addFavourite" data-id="{{ $allProduct->id }}"><i class="fa fa-heart"></i></a>
                                            @else
                                                <a class="add-favourite btn btn-outline-dark btn-square addFavourite" data-id="{{ $allProduct->id }}"><i class="far fa-heart"></i></a>
                                            @endif
                                        @endauth
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="{{ route('details',$product->id) }}">{{ $product->title }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${{ $product->final_value }}</h5><h6 class="text-muted ml-2"><del>${{ $product->price }}</del></h6>
                                    </div>
                                    @php
                                        $total = App\Models\Review::where('product_id', $product->id)->sum('rate');
                                        $reviewCount = App\Models\Review::where('product_id', $product->id)->count();
                                        $totalreviewcount = ($reviewCount > 0) ? ($total / $reviewCount) : 0;
                                    @endphp
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        @if ($totalreviewcount > 0 && $totalreviewcount <= 1.49)
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        @elseif ($totalreviewcount >= 1.5 && $totalreviewcount <= 2.49)
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        @elseif ($totalreviewcount >= 2.5 && $totalreviewcount <= 3.49)
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        @elseif ($totalreviewcount >= 3.5 && $totalreviewcount <= 4.49)
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="far fa-star"></i>
                                        @elseif ($totalreviewcount == 0)
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        @else
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                            <i class="fa fa-star text-primary mr-1"></i>
                                        @endif
                                        <small>({{ $reviewCount }})</small>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- Products End -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
        <script>
            $(document).ready(function () {
                $('.add-favourite').on('click', function (e) {
                    e.preventDefault();
                    var productId = $(this).data('id');
                    var isAdding = $(this).hasClass('add-favourite');

                    // AJAX request
                    $.ajax({
                        url: '/Favourite/' + productId,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.success) {
                                toastr.success(data.message);
                                if (isAdding) {
                                    // $('.add-favourite[data-id="' + productId + '"]').removeClass('add-favourite').addClass('delete-favourite');
                                    $('.add-favourite[data-id="' + productId + '"] i').removeClass('far').addClass('fa');
                                    $('.theFavourite').reload();
                                }
                                // else {
                                //     // $('.delete-favourite[data-id="' + productId + '"]').removeClass('delete-favourite').addClass('add-favourite');
                                //     $('.add-favourite[data-id="' + productId + '"] i').removeClass('fa').addClass('far');
                                // }
                            }

                        },
                        error: function (data) {
                            console.error('Error:', data);
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('.delete-favourite').on('click', function (e) {
                    e.preventDefault();
                    var productId = $(this).data('id');
                    var isDeleting = $(this).hasClass('delete-favourite');

                    // AJAX request
                    $.ajax({
                        url: '/deleteFavouritefromhomepage/' + productId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.success) {
                                toastr.success(data.message);
                                if (isDeleting) {
                                    // $('.delete-favourite[data-id="' + productId + '"]').removeClass('delete-favourite').addClass('add-favourite');
                                    $('.delete-favourite[data-id="' + productId + '"] i').removeClass('fa').addClass('far');
                                }
                                // else {
                                //     $('.add-favourite[data-id="' + productId + '"]').removeClass('add-favourite').addClass('delete-favourite');
                                //     $('.delete-favourite[data-id="' + productId + '"] i').removeClass('far').addClass('fa');
                                // }
                            }

                        },
                        error: function (data) {
                            console.error('Error:', data);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $('.addToCartBtn').click(function (e) {
                    e.preventDefault();
                    // console.log($('input[name="id"]').val());
                    // var productId = $(this).data('product-id');
                    // console.log($('input[name="id"]', '#addToCartForm_' + productId).val());
                    var productId = $(this).data('product-id');
                    var form = $('#addToCartForm_' + productId);
                    console.log($('input[name="id"]', form).val());
                    $.ajax({
                        data: form.serialize(),
                        url: "{{ route('cart.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (response) {
                            console.log('Success:', response);
                            toastr.success(response.message);// You can update the UI or show a notification
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        @endsection
        @section('js')

        @endsection
