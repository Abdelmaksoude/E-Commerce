@extends('master')

@section('css')

@endsection
@section('content')
<div class="live-preview">
    <form class="row g-3" action="{{ route('siteSettings.update',$data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-4">
            <img src="{{ asset('Attachments/SiteSetting/'.$data->photo) }}" width="120px" height="120px" style="border-radius: 50%" >
            <label for="validationDefault01" class="form-label">Choose Site Logo</label>
            <input type="file" class="form-control" id="validationDefault01" name="photo">
        </div>
        @error('photo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Name</label>
            <input type="text" class="form-control" id="validationDefault01" name="name" value="{{ $data->name }}">
        </div>
        <div class="col-md-4">
            <label for="validationDefault01" class="form-label">Email</label>
            <input type="text" class="form-control" id="validationDefault01" name="email"  value="{{ $data->email }}">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Address</label>
            <input type="text"  class="form-control" id="validationDefault02" name="address"  value="{{ $data->address }}">
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Phone</label>
            <input type="text"  class="form-control" id="validationDefault02" name="phone"  value="{{ $data->phone }}">
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Link Twitter</label>
            <input type="text"  class="form-control" id="validationDefault02" name="link_twitter"  value="{{ $data->link_twitter }}">
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Link FaceBook</label>
            <input type="text"  class="form-control" id="validationDefault02" name="link_facebook"  value="{{ $data->link_facebook }}">
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Link Instgram</label>
            <input type="text"  class="form-control" id="validationDefault02" name="link_instgram"  value="{{ $data->link_instgram }}">
        </div>
        <div class="col-md-4">
            <label for="validationDefault02" class="form-label">Link LinkedIn</label>
            <input type="text"  class="form-control" id="validationDefault02" name="link_linkedin"  value="{{ $data->link_linkedin }}">
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Edit</button>
        </div>
    </form>
</div>
@endsection
@section('js')

@endsection
