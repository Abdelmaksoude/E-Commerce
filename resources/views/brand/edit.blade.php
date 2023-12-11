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
        <form class="row g-3" action="{{ route('brand.update',$brand->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <img src="{{ asset('Attachments/Brands/'.$brand->photo) }}" width="150px" height="150px" style="border-radius: 50%" >
                <label for="validationDefault01" class="form-label">Choose Image</label>
                <input type="file" class="form-control" id="validationDefault01" name="photo">
            </div>
            <div class="col-md-4">
                <label for="validationDefault01" class="form-label">Title</label>
                <input type="text" value="{{ $brand->title }}" class="form-control" id="validationDefault01" name="title" >
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Description</label>
                <input type="text" value="{{ $brand->description }}" class="form-control" id="validationDefault02" name="description" >
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
@endsection

