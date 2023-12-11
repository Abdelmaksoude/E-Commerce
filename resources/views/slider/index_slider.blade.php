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
@endsection
@section('content')


{{-- <html>
<head>
    <title>Step-by-Step Tutorial: Implementing Yajra Datatables in Laravel 10 - CodeAndDeploy.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></scrip>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></scrip>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></scrip>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<body> --}}


<button style="padding: 5px; color: white; background: black; border-radius: 5px; margin-bottom: 10px" ><a style="text-decoration: none; color: white" href="{{ route('admin_sliders.create') }}">Add New Slider</a></button>
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


{{-- </body> --}}

{{-- <script type="text/javascript">
    $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin_sliders.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'photo', name: 'photo'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    });
</script> --}}
<script src="{{ asset('assets/js/layout.js') }}"></script>
<script type="text/javascript">
    $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin_sliders.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {
                data: 'title',
                name: 'title',
                render: function(data, type, full, meta) {
                    // Access the title value and do something with it
                    console.log(data);
                    return data.en; // Return the value if needed
                }
            },
            {
                data: 'description',
                name: 'description',
                render:function(data,type,full,meta){
                    console.log(data);
                    return data.en;
                }
            },
            {
                data: 'photo',
                name: 'photo',
                render: function(data, type, full, meta) {
                    return '<img src="{{ asset("Attachments/Sliders/") }}/' + data + '" alt="Photo" width="100" height="100" style="border-radius: 50%">';
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
                    // Handle the success response
                    // For example, you can show a success message and update the DataTables
                },
                error: function(xhr) {
                    // Handle the error response
                    // For example, you can show an error message
                }
            });
        }
    });
});
</script>
{{-- </html> --}}










{{-- <div class="container">

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
</div> --}}




{{-- <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Sliders</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> <a href="{{ route('admin_sliders.create') }}">Add</a></button>
                                <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control search" placeholder="Search...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="sort" data-sort="customer_name">#</th>
                                    <th class="sort" data-sort="customer_name">Title</th>
                                    <th class="sort" data-sort="email">Description</th>
                                    <th class="sort" data-sort="phone">Img</th>
                                    <th class="sort" data-sort="action">The Processing</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($slider as $slider)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                        </div>
                                    </th>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td class="customer_name">{{ $slider->title }}</td>
                                    <td class="email">{{ $slider->description }}</td>
                                    <td class="phone"><img src="{{ asset('Attachments/Sliders/'.$slider->photo) }}" width="50px" height="50px" style="border-radius: 50%"></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="edit">
                                                <button type="button" class="btn btn-secondary add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><a href="{{ route('admin_sliders.edit',$slider->id) }}" style="color: white">Edit</a></button>
                                                    <form action="{{ route('admin_sliders.destroy',$slider->id) }}" method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal">Delete</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="javascript:void(0);">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div> --}}
@endsection
{{-- @section('js')
<!-- Layout config Js -->
<script src="{{ asset('assets/js/layout.js') }}"></script>
<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('admin_sliders.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'title', name: 'title'},
              {data: 'description', name: 'description'},
              {data: 'photo', name: 'photo'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>

@endsection --}}










{{-- <!DOCTYPE html> --}}
{{-- <html>
<head>
    <title>Step-by-Step Tutorial: Implementing Yajra Datatables in Laravel 10 - CodeAndDeploy.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>

<div class="container">

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Content</th>
                <th width="105px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>

<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin_sliders.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'photo', name: 'photo'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

  });
</script>
</html> --}}


