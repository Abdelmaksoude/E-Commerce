<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit The Blog</title>
</head>
<body>
    <form action="{{ route('admin_sliders.confirm_delete',$slider->id) }}" method="post">
        @csrf
        @method('POST')
        <button type="submit">Delete</button>
    </form>
    <button><a href="{{ route('admin_sliders.index') }}">Cancel</a></button>
</body>
</html>
