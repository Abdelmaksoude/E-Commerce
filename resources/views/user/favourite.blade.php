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

        <!-- Products Start -->
        <div class="container-fluid pt-5 pb-3">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Favourite Product For {{  \Auth::user()->name }}</span></h2>
            <div class="row px-xl-5">
                @if($allFavourite->count() == 0)
                    <h5 style="color: red;">No Fvourite Product</h5>
                @else
                @foreach ($allFavourite as $allFavourite)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1" id="product-{{ $allFavourite->id }}">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="max-height: 300px" src="{{asset('Attachments/Product/'.$allFavourite->Product->photo)}}" alt="">
                                <div class="product-action">
                                    <form class="addToCartForm" id="addToCartForm_{{ $allFavourite->Product->id }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" value="{{ $allFavourite->product_id }}" name="id" >
                                        <input type="text" value="{{ $allFavourite->Product->title }}" name="title">
                                        <input type="text" value="{{ $allFavourite->Product->final_value }}" name="price">
                                        <input type="text" value="{{ $allFavourite->Product->photo }}"  name="image">
                                        <input type="text" value="1" name="quantity">
                                        <button data-product-id="{{ $allFavourite->Product->id }}" class="btn btn-outline-dark btn-square addToCartBtn"><i class="fa fa-shopping-cart"></i></button>
                                    </form>
                                    <a data-id="{{ $allFavourite->id }}" class="delete-post btn btn-outline-dark btn-square"><i class="fa fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $allFavourite->Product->title }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $allFavourite->Product->final_value }}$</h5><h6 class="text-muted ml-2"><del>{{ $allFavourite->Product->price }}</del></h6>
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
                @endif
            </div>
        </div>
        <!-- Products End -->

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <script>
            $(document).ready(function () {
                $('.delete-post').on('click', function (e) {
                    e.preventDefault();
                    var postId = $(this).data('id');

                    // AJAX request
                    $.ajax({
                        url: '/DeleteFavourite/' + postId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {

                            if (data.success) {
                                $('#product-' + postId).remove();
                                toastr.success(data.message);
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
