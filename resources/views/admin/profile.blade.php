@extends('master')
@section('css')
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
@endsection
@section('content')
<div class="navbar-top">
    <div class="title">
        <h1>Profile</h1>
    </div>


</div>
<!-- End -->

<!-- Sidenav -->
<div class="sidenav">
    <div class="profile">
        <img src="https://imdezcode.files.wordpress.com/2020/02/imdezcode-logo.png" alt="" width="100" height="100">

        <div class="name">
            ImDezCode
        </div>
        <div class="job">
            Web Developer
        </div>
    </div>

    <div class="sidenav-url">
        <div class="url">
            <a href="#profile" class="active">Profile</a>
            <hr align="center">
        </div>
        <div class="url">
            <a href="{{ route('adminProfileEdit',Auth::guard('admin')->user()->id) }}">Edit Profile</a>
            <hr align="center">
        </div>
    </div>
</div>
<!-- End -->

<!-- Main -->
<div class="main">
    <h2>IDENTITY</h2>
    <div class="card">
        <div class="card-body">
            <i class="fa fa-pen fa-xs edit"></i>
            <table>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $admin->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $admin->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{ $admin->phone }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- End -->
@endsection
@section('js')

@endsection
