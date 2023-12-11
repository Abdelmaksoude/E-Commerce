@extends('master')
@section('css')
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="live-preview">
        <form class="row g-3" action="{{ route('adminProfileUpdate',$admin->id) }}" method="post">
            @csrf
            <div class="col-md-4">
                <label for="validationDefault01" class="form-label">Email</label>
                <input type="email" value="{{ $admin->email }}" class="form-control" id="validationDefault01" name="email" required>
            </div>
            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Name</label>
                <input type="text" value="{{ $admin->name }}" class="form-control" id="validationDefault02" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="validationDefault03" class="form-label">Phone</label>
                <input type="text" value="{{ $admin->phone }}" class="form-control" id="validationDefault03" name="phone" required>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
@endsection

