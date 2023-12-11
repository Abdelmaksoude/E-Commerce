<?php
use Illuminate\Http\Request;
// function UploadImage(Request $request,$folder,$thephoto)
// {
//     $file_extension = $thephoto->getClientOriginalExtension();
//     $file_name = time().'.'.$file_extension;
//     $path = 'Attachments/'.$folder;
//     // $request->photo->move($path, $file_name);
//     $thephoto->move($path, $file_name);
//     return $file_name;
// }

function UploadImage($photo, $folder)
{
    $file_extension = $photo->getClientOriginalExtension();
    $file_name = time() . '_' . rand(100, 999) . '.' . $file_extension;
    $path = 'Attachments/' . $folder;

    $photo->move($path, $file_name);
    return $file_name;
}
