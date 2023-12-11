<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\Datatables;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    // public function index()
    // {
    //     // $slider = Slider::all();
    //     // return $slider;
    //     // return view('slider.index_slider',compact('slider'));
    // }

    public function create()
    {
        return view('slider.create_slider');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // save the image in the folder
        $file_extension = $request->photo->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = 'Attachments/Sliders';
        $request->photo->move($path,$file_name);

        Slider::create([
            'photo'=>$file_name,
            'title'=>['en' => $request->title_en, 'ar' => $request->title],
            'description'=>['en' => $request->description_en, 'ar' => $request->description]
        ]);
        return redirect()->route('admin_sliders.index')->with('error','Slider Added Successfully');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.Route('admin_sliders.edit',$row->id).'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.Route('admin_sliders.delete',$row->id).'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
                // dd($ee);
        return view('slider.index_slider');
    }

    public function edit($id)
    {
        $slider = Slider::findorFail($id);
        return view('slider.edit_slider',compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findorFail($id);
        if ($request->hasFile('photo')) {
            // Delete the existing image if it exists
            $existingImage = $slider->photo;
            if ($existingImage && file_exists(public_path("Attachments/Sliders/$existingImage"))) {
                File::delete(public_path("Attachments/Sliders/$existingImage"));
            }
            // Save the new image
            $file_extension = $request->photo->getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $path = 'Attachments/Sliders';
            $request->photo->move($path, $file_name);
        }
        $slider->update([
            'photo'=>$file_name,
            'title'=>['en' => $request->title_en, 'ar' => $request->title],
            'description'=>['en' => $request->description_en, 'ar' => $request->description]
        ]);
        return redirect()->route('admin_sliders.index')->with('error','Slider Updated Successfully');
    }

    public function delete($id)
    {
        $slider = Slider::findorFail($id);
        return view('slider.delete_slider',compact('slider'));

    }
    public function confirmDelete($id)
    {
        $slider = Slider::findorFail($id);
            $existingImage = $slider->photo;
            if ($existingImage && file_exists(public_path("Attachments/Sliders/$existingImage"))) {
                File::delete(public_path("Attachments/Sliders/$existingImage"));
            }
        $slider->destroy($id);
        return redirect()->route('admin_sliders.index')->with('error','Slider Deleted Successfully');
    }
    // public function create()
    // {
    //     return view('slider.create_slider');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //     ]);

    //     // save the image in the folder
    //     $file_extension = $request->photo->getClientOriginalExtension();
    //     $file_name = time().'.'.$file_extension;
    //     $path = 'Attachments/Sliders';
    //     $request->photo->move($path,$file_name);

    //     Slider::create([
    //         'photo'=>$file_name,
    //         'title'=>['en' => $request->title_en, 'ar' => $request->title],
    //         'description'=>['en' => $request->description_en, 'ar' => $request->description]
    //     ]);
    //     return redirect()->route('admin_sliders.index')->with('error','Slider Added Successfully');
    // }

    // public function edit($id)
    // {
    //     $slider = Slider::findorFail($id);
    //     return view('slider.edit_slider',compact('slider'));
    // }

//     public function update(Request $request,$id)
//     {
//         $slider = Slider::findorFail($id);
//         if ($request->hasFile('photo')) {
//             // Delete the existing image if it exists
//             $existingImage = $slider->photo;
//             if ($existingImage && file_exists(public_path("Attachments/Sliders/$existingImage"))) {
//                 File::delete(public_path("Attachments/Sliders/$existingImage"));
//             }
//             // Save the new image
//             $file_extension = $request->photo->getClientOriginalExtension();
//             $file_name = time().'.'.$file_extension;
//             $path = 'Attachments/Sliders';
//             $request->photo->move($path, $file_name);
//         }
//         $slider->update([
//             'photo'=>$file_name,
//             'title'=>['en' => $request->title_en, 'ar' => $request->title],
//             'description'=>['en' => $request->description_en, 'ar' => $request->description]
//         ]);
//         return redirect()->route('admin_sliders.index')->with('error','Slider Updated Successfully');
//     }

//     public function destroy(Request $request , $id)
//     {
//         $slider = Slider::findorFail($id);
//             $existingImage = $slider->photo;
//             if ($existingImage && file_exists(public_path("Attachments/Sliders/$existingImage"))) {
//                 File::delete(public_path("Attachments/Sliders/$existingImage"));
//             }
//         $slider->destroy($id);
//         return redirect()->route('admin_sliders.index')->with('error','Slider Deleted Successfully');
//     }
}
