<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{asset('assets2/img/favion_icon.jpg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets2/img/favion_icon.jpg')}}" type="image/x-icon">
    <title>Ecommerace Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    @include('layout2.head')
</head>

<body>

    @include('layout2.main_header')


    @yield('content')

    @include('layout2.footer_script')


    @include('layout2.scripts')
</body>

</html>
