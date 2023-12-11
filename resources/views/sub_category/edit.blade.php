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
        <form class="row g-3" action="{{ route('sub_category.update',$sub_category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <img src="{{ asset('Attachments/SubCategory/'.$sub_category->photo) }}" width="150px" height="150px" style="border-radius: 50%" >
                <label for="validationDefault01" class="form-label">Choose Image</label>
                <input type="file" class="form-control" id="validationDefault01" name="photo">
            </div>
            @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-4">
                <label for="validationDefault01" class="form-label">Title Arabic</label>
                <input type="text" class="form-control" id="validationDefault01" value="{{ $sub_category->{'name:ar'} }}" name="ar[name]" >
            </div>
            <div class="col-md-4">
                <label for="validationDefault01" class="form-label">Title English</label>
                <input type="text" class="form-control" id="validationDefault01" value="{{ $sub_category->name }}" name="en[name]" >
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Description Arabic</label>
                <input type="text"  class="form-control" id="validationDefault02" value="{{ $sub_category->{'description:ar'} }}" name="ar[description]" >
            </div>
            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Description English</label>
                <input type="text"  class="form-control" id="validationDefault02" value="{{ $sub_category->description }}" name="en[description]" >
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-md-3">
                <div class="form-group">
                    <label for="gender">Category : <span class="text-danger">*</span></label>
                    <select class="custom-select mr-sm-2" name="category_id">
                        <option selected value="{{ $sub_category->id }}">{{ $sub_category->Category->name }}</option>
                        @foreach($categories as $category)
                            <option  value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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

