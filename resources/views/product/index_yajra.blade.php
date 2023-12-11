@extends('master')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
<!-- Sweet Alert css-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Bootstrap Css -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection
@section('content')

<button style="padding: 5px; color: white; background: black; border-radius: 5px; margin-bottom: 10px" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">Add New Product</button>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Sales Count</th>
                <th>Rate</th>
                <th>price</th>
                <th>Discount</th>
                <th>Final Price </th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Brand</th>
                <th width="105px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- This is where the form content will be displayed -->
                </div>
                <!-- ... (other modal elements) ... -->
            </div>
        </div>
    </div>

{{-- <script src="{{ asset('assets/js/layout.js') }}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/layout.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [
                {
                    data: 'photo',
                    name: 'photo',
                    render: function(data, type, full, meta) {
                        return '<img src="{{ asset("Attachments/Product/") }}/' + data + '" alt="Photo" width="100" height="100" style="border-radius: 50%">';
                    }
                },
                {data: 'id', name: 'id'},
                {
                    data: 'title',
                    name: 'title',
                },
                {
                    data: 'description',
                    name: 'description',
                },
                {
                    data: 'sales_count',
                    name: 'sales_count',
                },
                {
                    data: 'rate',
                    name: 'rate',
                },
                {
                    data: 'price',
                    name: 'price',
                },
                {
                    data: 'discount',
                    name: 'discount',
                    render: function (data, type, full, meta) {
                        if (full.discount_percent != 0) {
                            return full.discount_percent + '%';
                        } else if (full.discount_value != 0) {
                            return full.discount_value + ' LE';
                        } else {
                            return '<span style="color: rgb(0, 51, 255); font-style: italic">No Discount</span>';
                        }
                        },
                },
                {
                    data: 'final_value',
                    name: 'final_value',
                },
                {
                    data: 'category_id',
                    name: 'category_id',
                },
                {
                    data: 'sub_category_id',
                    name: 'sub_category_id',
                },
                {
                    data: 'brand_id',
                    name: 'brand_id',
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(document).on('click', '.edit', function() {
            var productId = $(this).data('id');
            console.log(productId);
            var url = "{{ route('products.edit',":productId") }}";
            console.log(url);
            url = url.replace(":productId",productId)
            $.ajax({
                url:url ,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('#showModal .modal-body').html(response.html);
                },
                error: function () {
                    alert('Failed to load edit form.');
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var productId = $(this).data('id');
            console.log(productId);
            var url = "{{ route('products.delete',":productId") }}";
            console.log(url);
            url = url.replace(":productId",productId)
            $.ajax({
                url:url ,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    $('#showModal .modal-body').html(response.html);
                },
                error: function () {
                    alert('Failed to load delete form.');
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {
    $('#create-btn').click(function () {
        $.ajax({
            url: "{{ route('products.create') }}",
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('#showModal .modal-body').html(response.html);
            },
            error: function () {
                alert('Failed to load create form.');
            }
        });
    });
});


</script>
<script>
    $(document).on('submit', '#createForm', function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === 'success') {
                console.log('okkkkkkkkk');
                // $('#showModal').modal('toggle');
                $("#showModal").trigger("reset"); // Fixed the syntax error
                $("#createForm").modal('hide'); // Fixed the syntax error
                $('.data-table').DataTable().ajax.reload();


                // document.getElementById('showModal').modal('hide');

                // elementToHide.style.display = 'none';
            } else {
                // Handle other status types (e.g., validation errors)
                console.log(response);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
</script>

@endsection


