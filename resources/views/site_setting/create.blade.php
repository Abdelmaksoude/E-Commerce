@extends('master')

@section('css')

@endsection
@section('content')
<div class="live-preview">
    <form class="row g-3" action="{{ route('siteSettings.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Choose Site Logo</label>
            <input type="file" class="form-control" id="validationDefault01" name="photo" >
        </div>
        @error('photo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Name</label>
            <input type="text" class="form-control" id="validationDefault01" name="name" >
        </div>
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Email</label>
            <input type="text" class="form-control" id="validationDefault01" name="email" >
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Address</label>
            <input type="text"  class="form-control" id="validationDefault02" name="address" >
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Phone</label>
            <input type="text"  class="form-control" id="validationDefault02" name="phone" >
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Link Twitter</label>
            <input type="text"  class="form-control" id="validationDefault02" name="link_twitter" >
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Link FaceBook</label>
            <input type="text"  class="form-control" id="validationDefault02" name="link_facebook" >
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Link Instgram</label>
            <input type="text"  class="form-control" id="validationDefault02" name="link_instgram" >
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Link LinkedIn</label>
            <input type="text"  class="form-control" id="validationDefault02" name="link_linkedin" >
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</div>
@endsection
@section('js')

@endsection
