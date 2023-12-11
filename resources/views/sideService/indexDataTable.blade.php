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

<a class="btn btn-success" href="javascript:void(0)" id="createNewService">Add</a><br><br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Image</th>
                <th width="105px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="serviceForm" name="serviceForm" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="service_id" id="service_id">
                        <div class="form-group">
                            Title Arabic: <br>
                            <input type="text" class="form-control" id="name" name="ar[title]" placeholder="Enter The Title" value="" required>
                        </div>
                        <div class="form-group">
                            Title English: <br>
                            <input type="text" class="form-control" id="name" name="en[title]" placeholder="Enter The Title" value="" required>
                        </div>
                        <div class="form-group">
                            Photo: <br>
                            <input type="file" class="form-control" id="photo" name="photo" placeholder="Choose Photo" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/layout.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function(){
        var table = $(".data-table").DataTable({
        serverSide:true,
        processing:true,
        ajax:"{{ route('side_service.index') }}",
            columns:[
                {data:'id',name:'id'},
                {data:'title',name:'title'},
                {data:'photo',name:'photo',render: function(data, type, full, meta) {
                        return '<img src="{{ asset("Attachments/SideService/") }}/' + data + '" alt="Photo" width="100" height="100" style="border-radius: 50%">';
                    }},
                {data:'action',name:'action'},
            ]
        });
        $("#createNewService").click(function(){
            $('#service_id').val('');
            $('#serviceForm').trigger("reset");
            $('#modalHeading').html("Add Service");
            $('#ajaxModal').modal('show');
        });
        $("#saveBtn").click(function(e) {
        e.preventDefault();
        $(this).html('Save');
        $.ajax({
            data: $("#serviceForm").serialize(), // Fixed the syntax error
            url: "{{ route('side_service.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
                $("#serviceForm").trigger("reset"); // Fixed the syntax error
                $("#ajaxModal").modal('hide'); // Fixed the syntax error
                table.draw();
            },
            error: function(data) {
                console.log('Error:', data);
                $("#saveBtn").html('Save');
            }
        });
    });
    });
</script>
@endsection
