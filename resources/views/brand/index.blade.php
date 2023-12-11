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
@endsection
@section('content')

<button style="padding: 5px; color: white; background: black; border-radius: 5px; margin-bottom: 10px" ><a style="text-decoration: none; color: white" href="{{ route('brand.create') }}">Add New Brand</a></button>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th width="105px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

<script src="{{ asset('assets/js/layout.js') }}"></script>
{{-- <script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('brand.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                {
                    data: 'photo',
                    name: 'photo',
                    render: function(data, type, full, meta) {
                        return '<img src="{{ asset("Attachments/Brands/") }}/' + data + '" alt="Photo" width="100" height="100" style="border-radius: 50%">';
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Handle delete button click event
        $(document).on('click', '.delete', function() {
            var rowData = table.row($(this).closest('tr')).data();
            var id = rowData.id;

            swal({
                title: "Delete?",
                text: "Are you sure you want to delete this item?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('brand.delete', ['id' => ':id']) }}".replace(':id', id),
                        data: { _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            // Reload the DataTable after successful deletion
                            table.ajax.reload();
                        },
                        error: function (xhr) {
                            // Handle errors here
                            swal("Error", "An error occurred while deleting the item.", "error");
                        }
                    });
                }
            });
        });
    });
</script> --}}






{{--
<script type="text/javascript">
    $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('brand.index') }}",
        columns: [
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
                data: 'photo',
                name: 'photo',
                render: function(data, type, full, meta) {
                    return '<img src="{{ asset("Attachments/Brands/") }}/' + data + '" alt="Photo" width="100" height="100" style="border-radius: 50%">';
                }
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    });

    $(document).ready(function() {
    $(document).on('click', '.edit', function() {
        var rowData = $(this).closest('tr').data('json');
        $('#editModal').modal('show');
        // Populate the form fields with the rowData
        $('#editModal #title').val(rowData.title);
        $('#editModal #description').val(rowData.description);
        // ...
    });

    // Delete button click event
    $(document).on('click', '.delete', function() {
        // Get the row data associated with the clicked "Delete" button
        var rowData = $(this).closest('tr').data('json');

        // Perform the desired actions with the rowData
        // For example, you can show a confirmation dialog and send an AJAX request to delete the data

        // Example: Show a confirmation dialog and send an AJAX request
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: '/delete', // Replace with your delete route or URL
                method: 'POST',
                data: {id: rowData.id}, // Pass the ID of the item to delete
                success: function(response) {

                },
                error: function(xhr) {

                }
            });
        }
    });
});
</script> --}}





<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('brand.index') }}",
            columns: [
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
                    data: 'photo',
                    name: 'photo',
                    render: function(data, type, full, meta) {
                        return '<img src="{{ asset("Attachments/Brands/") }}/' + data + '" alt="Photo" width="100" height="100" style="border-radius: 50%">';
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(document).on('click', '.edit', function() {
            var rowData = $(this).closest('tr').data('json');
            $('#editModal').modal('show');
            $('#editModal #title').val(rowData.title);
            $('#editModal #description').val(rowData.description);
        });

    //     $(document).ready(function() {
    //     $('.deletetherow').click(function(event) {
    //         var form =  $(this).closest("form");
    //         var tr =  $(this).closest("tr");
    //         var name = $(this).data("name");
    //         event.preventDefault();
    //         swal({
    //             title: `Are you sure you want to delete this record?`,
    //             text: "If you delete this, it will be gone forever.",
    //             icon: "warning",
    //             buttons: true,
    //             dangerMode: true,
    //         })
    //         .then((willDelete) => {
    //             if (willDelete) {
    //                 $.ajax({
    //                     url: form.attr('action'),
    //                     type: form.attr('method'),
    //                     data: form.serialize(),
    //                     success: function(response) {
    //                         // Handle success response
    //                         console.log(response);
    //                         tr.remove();
    //                     },
    //                     error: function(xhr, status, error) {
    //                         // Handle error response
    //                         console.log(xhr.responseText);
    //                     }
    //                 });
    //             }
    //         });
    //         return false; // Prevent page refresh
    //     });
    // });


    $(document).ready(function() {
    $('.deletetherow').click(function(event) {
       // console.log()
        var action = $(this).attr("action");
        var tr = $(this).closest("tr");
        var id = $(this).data("id"); // Get the data-id attribute

        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: action ,
                    type: "DELETE",
                    data: {
                        id: id, // Send the id to the controller
                        _token: '{{ csrf_token() }}' // Add the CSRF token
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        tr.remove();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.log(xhr.responseText);
                    }
                });
            }
        });
        return false; // Prevent page refresh
    });
});


    });
</script>


@endsection









{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var tr =  $(this).closest("tr");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        success: function(response) {
                            // Handle success response
                            console.log(response);
                            tr.remove();
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
            return false; // Prevent page refresh
        });
    });
</script> --}}
