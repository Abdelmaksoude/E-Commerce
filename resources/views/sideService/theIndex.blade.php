@extends('master')
@section('css')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

    {{-- liks for the dropify --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <!-- Include jQuery -->
    <!-- Include Dropify JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


@endsection
@section('content')

<div class="container" style="display: inline-block">
    <br />
    <div align="right">
    <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create SideService</button>
    </div>
    <br />
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
        <thead>
            <tr>
                <th width="10%">Image</th>
                <th width="35%">Title</th>
                <th width="30%">Action</th>
            </tr>
        </thead>
    </table>
</div>
<br />
<br />
</div>


<div id="formModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Record</h4>
        </div>
        <div class="modal-body">
        <span id="form_result"></span>
        <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="control-label col-md-4" >Title Arabic : </label>
            <div class="col-md-8">
            <input type="text" name="ar[title]" id="title_ar" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Title English : </label>
            <div class="col-md-8">
            <input type="text" name="en[title]" id="title_en" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Select Photo : </label>
            <div class="col-md-8">
            <input type="file" name="photo" id="image" class="dropify"/>
            <span id="store_image"></span>
            </div>
        </div>
        <br />
        <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
        </div>
        </form>
        </div>
    </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
            <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>

<script>
    $(document).ready(function(){

    $('#user_table').DataTable({
    processing: true,
    serverSide: true,
    ajax:{
    url: "{{ route('side_service.index') }}",
    },
    columns:[
    {data:'photo',name:'photo',render: function(data, type, full, meta) {
        return '<img src="{{ asset("Attachments/SideService/") }}/' + data + '" alt="Photo" width="100" height="100" style="border-radius: 50%">';
    }},
    {
        data: 'title',
        name: 'title'
    },
    {
        data: 'action',
        name: 'action',
        orderable: false
    }
    ]
    });

    $('#create_record').click(function(){
    $('.modal-title').text("Add New Record");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#formModal').modal('show');
    });

    $('#sample_form').on('submit', function(event){
    event.preventDefault();
    if($('#action').val() == 'Add')
    {
    $.ajax({
        url:"{{ route('side_service.store') }}",
        method:"POST",

        contentType: false,
        data: new FormData(this),
        cache:false,
        processData: false,
        dataType:"json",
        success:function(data)
        {
        var html = '';
        if(data.errors)
        {
        html = '<div class="alert alert-danger">';
        for(var count = 0; count < data.errors.length; count++)
        {
        html += '<p>' + data.errors[count] + '</p>';
        }
        html += '</div>';
        }
        if(data.success)
        {
        html = '<div class="alert alert-success">' + data.success + '</div>';
        $('#sample_form')[0].reset();
        $('#user_table').DataTable().ajax.reload();
        }
        $('#form_result').html(html);
        }
    })
    }

    if($('#action').val() == "Edit")
    {
    $.ajax({
        url:"{{ route('side-service.update') }}",
        method:"POST",
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType:"json",
        success:function(data)
        {
        var html = '';
        if(data.errors)
        {
        html = '<div class="alert alert-danger">';
        for(var count = 0; count < data.errors.length; count++)
        {
        html += '<p>' + data.errors[count] + '</p>';
        }
        html += '</div>';
        }
        if(data.success)
        {
        html = '<div class="alert alert-success">' + data.success + '</div>';
        $('#sample_form')[0].reset();
        $('#store_image').html('');
        $('#user_table').DataTable().ajax.reload();
        }
        $('#form_result').html(html);
        }
    });
    }
    });

    $(document).on('click', '.edit', function(){
    var id = $(this).attr('id');
    $('#form_result').html('');
    $.ajax({
    url:"/side_service/"+id+"/edit",
    dataType:"json",
    success:function(html){
        $('#title_ar').val(html.data.title);
        $('#title_en').val(html.data.title);
        // Set the image in Dropify
        var dropify = $('.dropify').data('dropify');
            dropify.settings.defaultFile = "{{ URL::to('Attachments/') }}/SideService/" + html.data.photo;
            dropify.destroy();
            dropify.init();
        // $('#store_image').html("<img src={{ URL::to('Attachments/') }}/SideService/" + html.data.photo + " width='70' class='img-thumbnail' />");
        // $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.photo+"' />");
        $('#hidden_id').val(html.data.id);
        $('.modal-title').text("Edit New Record");
        $('#action_button').val("Edit");
        $('#action').val("Edit");
        $('#formModal').modal('show');
    }
    })
    });

    var user_id;

    $(document).on('click', '.delete', function(){
    user_id = $(this).attr('id');
    $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
    $.ajax({
    url:"side_service/destroy/"+user_id,
    beforeSend:function(){
        $('#ok_button').text('Deleting...');
    },
    success:function(data)
    {
        setTimeout(function(){
        $('#confirmModal').modal('hide');
        $('#user_table').DataTable().ajax.reload();
        }, 500);
    }
    })
    });

    });
</script>



@endsection
@section('js')
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
@endsection
