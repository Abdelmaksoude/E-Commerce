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

            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="cartTableBody">
                    @foreach ($cartItems as $item)
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">{{ $item->name }}</td>
                            <td class="align-middle">${{ $item->price }}</td>
                            <td class="justify-center mt-6 md:justify-end md:flex">
                                <div class="h-10 w-28">
                                <div class="relative flex flex-row w-full h-8">

                                    <form id="updatethecart">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id}}" >
                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                    class="w-6 text-center bg-gray-300" />
                                    <button type="submit" id="updatethecartbtn" class="px-2 pb-2 ml-2 btn btn btn-success bg-blue-500">update</button>
                                    </form>
                                </div>
                                </div>
                            </td>
                            <td class="hidden text-right md:table-cell" id="totalPriceCell">
                                <span class="text-sm font-medium lg:text-base total-price">
                                    ${{ $item->price * $item->quantity }}
                                </span>
                            </td>
                            <td class="hidden text-right md:table-cell">
                                <form id="removefromthecart">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="id">
                                <button id="removefromthecartbtn" class="px-4 py-2 btn btn btn-danger  bg-red-600">x</button>
                            </form>
                        </tr>
                    @endforeach

                </tbody>

            </table>
            <span style="margin-left: 50px; margin-top: 20px; color: blue; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;font-size: 20px"><span style="font-size: 25px;color: black">Total:</span> <span class="totalprice">${{ Cart::getTotal() }}</span></span>
                <div style="margin-top: 20px; margin-left: 50px" >
                    <form id="removeallcart">
                        @csrf
                        <button id="removeallcartbtn" style="border-radius: 10px;" class="btn btn-danger">Remove All Cart</button>
                    </form>
                </div>
                <a class="btn btn-warning" href="{{ route('checkout') }}" role="button" style="float: right; margin-top: -50px; margin-right: 50px; border-radius: 10px">Make Order</a>
                
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#updatethecartbtn').click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        data: $('#updatethecart').serialize(),
                        url: "{{ route('cart.update') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (response) {
                            console.log('Success:', response);
                            toastr.success(response.message);// You can update the UI or show a notification

                            $('.total-price').text('$' + response.updatedTotalPrice.toFixed(2));
                            $('.totalprice').text('$' + response.updatedTotalPrice.toFixed(2));
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#removefromthecartbtn').click(function (e) {
                    e.preventDefault();
                    var removeForm = $(this).closest('form');
                    $.ajax({
                        data: $('#removefromthecart').serialize(),
                        url: "{{ route('cart.remove') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (response) {
                            console.log('Success:', response);
                            toastr.success(response.message);// You can update the UI or show a notification

                            removeForm.closest('tr').remove();

                            $('.totalprice').text('$' + response.updatedTotalPrice.toFixed(2));
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#removeallcartbtn').click(function (e) {
                    e.preventDefault();
                    // var removeForm = $(this).closest('form');
                    console.log("deleted")
                    $.ajax({
                        data: $('#removeallcart').serialize(),
                        url: "{{ route('cart.clear') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (response) {
                            console.log('Success:', response);
                            toastr.success(response.message);
                            $('#cartTableBody').empty();

                            // Update the total price in the UI
                            $('.totalprice').text('$0.00');
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
