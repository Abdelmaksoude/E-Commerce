<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Support\Facades\File;

class SubCategoryService
{
    public function index()
    {
        $sub_category = SubCategory::all();
        return $sub_category;
    }

    public function create()
    {
        $categories = MainCategory::all();
        return $categories;
    }

    public function store(Request $request)
    {
        $sub_category = new SubCategory();
        $file_name = UploadImage($request,'SubCategory',$request->photo);
        $sub_category->photo = $file_name;
        $sub_category->fill([
            'en' => [
                'name' => $request->input('en.name'),
                'description' => $request->input('en.description'),
            ],
            'ar' => [
                'name' => $request->input('ar.name'),
                'description' => $request->input('ar.description'),
            ],
        ]);
        $sub_category->category_id = $request->category_id;
        $sub_category->save();
        return $sub_category;
    }

    public function edit($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $categories = MainCategory::all();
        return [
            'sub_category' => $sub_category,
            'categories' => $categories,
        ];
    }

    public function update(Request $request,$id)
    {
        $sub_category = SubCategory::findorFail($id);
        if ($request->hasFile('photo')) {
            // Delete the existing image if it exists
            $existingImage = $sub_category->photo;
            if ($existingImage && file_exists(public_path("Attachments/SubCategory/$existingImage"))) {
                File::delete(public_path("Attachments/SubCategory/$existingImage"));
            }
            // Save the new image
            $file_name = UploadImage($request,'SubCategory',$request->photo);
        }
        else
        {
            $file_name = $sub_category->photo;
        }
        $sub_category->photo = $file_name;
        $sub_category->fill([
            'en' => [
                'name' => $request->input('en.name'),
                'description' => $request->input('en.description'),
            ],
            'ar' => [
                'name' => $request->input('ar.name'),
                'description' => $request->input('ar.description'),
            ],
        ]);
        $sub_category->category_id = $request->category_id;
        $sub_category->update();
        return $sub_category;
    }

    public function delete($id)
    {
        $sub_category = SubCategory::findOrFail($id);
            $existingImage = $sub_category->photo;
            if ($existingImage && file_exists(public_path("Attachments/SubCategory/$existingImage"))) {
                File::delete(public_path("Attachments/SubCategory/$existingImage"));
            }
        $sub_category->delete();
        return $sub_category;
    }
}
