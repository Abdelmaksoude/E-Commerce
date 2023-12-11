@extends('master2')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')

<!-- Shop Start -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                @if (Session::has('error'))
                    <script>
                        toastr.success("{{ Session::get('error') }}");
                    </script>
                @endif
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form method="GET" id="filterForm" action="{{ route('filter.products') }}">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-all" value="10000">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">5000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1" value="500">
                        <label class="custom-control-label" for="price-1">$0 - $500</label>
                        <span class="badge border font-weight-normal">500</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2" value="1000">
                        <label class="custom-control-label" for="price-2">$500 - $1000</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3" value="1500">
                        <label class="custom-control-label" for="price-3">$1000 - $1500</label>
                        <span class="badge border font-weight-normal">1500</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4" value="2000">
                        <label class="custom-control-label" for="price-4">$1500 - $2000</label>
                        <span class="badge border font-weight-normal">2000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5" value="2500">
                        <label class="custom-control-label" for="price-5">$2000 - $2500</label>
                        <span class="badge border font-weight-normal">2500</span>
                    </div>
                    <input type="hidden" id="selectedValue" name="value">
                    <button type="submit" class="btn btn-warning" style="width: 100%; border-radius: 10px; margin-top: 10px">Filter</button>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->

            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($allProducts as $allProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="max-height: 250px" src="{{asset('Attachments/Product/'.$allProduct->photo)}}" alt="">
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
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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
        $('#filterForm input[type="checkbox"]').change(function () {
            updateSelectedValue();
        });

        function updateSelectedValue() {
            // Get selected checkbox value
            var selectedValue = $('#filterForm input[type="checkbox"]:checked').val();
            // var selectedValue = $('#filterForm input[type="checkbox"]:checked').checked();

            // Update the hidden input value
            $('#selectedValue').val(selectedValue);
        }
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
