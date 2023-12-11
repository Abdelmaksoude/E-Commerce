<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\EditBrandRequest;


class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::all();
        return view('brand.index', compact('brands'));
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $file_name = UploadImage($request,'Brands',$request->photo);
        Brand::create([
            'photo'=>$file_name,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        return redirect()->route('brand.index')->with('error','Brand Added Successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $brand = Brand::findorFail($id);
        return view('brand.edit', compact('brand'));
    }

    public function update(EditBrandRequest $request, $id)
    {
        $brand = Brand::findorFail($id);
        if ($request->hasFile('photo')) {
            // Delete the existing image if it exists
            $existingImage = $brand->photo;
            if ($existingImage && file_exists(public_path("Attachments/Brands/$existingImage"))) {
                File::delete(public_path("Attachments/Brands/$existingImage"));
            }
            // Save the new image
            $file_name = UploadImage('Brands',$request->photo);
        }
        else
        {
            $file_name = $brand->photo;
        }
        $brand->update([
            'photo'=>$file_name,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        return redirect()->route('brand.index')->with('error','Brand Updated Successfully');
    }

    public function destroy($id)
    {
        $brand = Brand::findorFail($id);
            $existingImage = $brand->photo;
            if ($existingImage && file_exists(public_path("Attachments/Brands/$existingImage"))) {
                File::delete(public_path("Attachments/Brands/$existingImage"));
            }
        $brand->destroy($id);
        return response()->json([],200);
        // return redirect()->route('brand.index')->with('deleted','Brand Deleted Successfully');
    }

}
