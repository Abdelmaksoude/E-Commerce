@extends('master')
@section('css')

@endsection
@section('content')
<div class="card" style="width: 18rem;">
    <img src="{{ asset('Attachments/Product/'.$detail->photo) }}" class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text">{{ $detail->title }}</p>
        <p class="card-text">{{ $detail->description }}</p>
    </div>
    </div>
    {{-- <form method="post" action="{{ route('product_attachments.store',$detail->id) }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photo" required>
        <button type="submit">Save</button>
    </form> --}}

    {{-- <form method="post" action="{{ route('product_attachments.store', $detail->id) }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photos[]" multiple required>
        <button type="submit">Save</button>
    </form> --}}
    <br><br>
    @foreach ($product_attachments as $product_attachment)
        <img style="width: 300px; height: 300px; margin-left: 10px" src="{{ asset('Attachments/ProductAttachments/'.$product_attachment->photo) }}" class="card-img-top" alt="...">
    @endforeach
@endsection
@section('js')

@endsection







