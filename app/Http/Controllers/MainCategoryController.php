<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use Illuminate\Support\Facades\File;

class MainCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MainCategory::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.Route('edit_category',$row->id).'" class="edit btn btn-success btn-sm">Edit</a>
                        <button type="button"  data-action="' . route('delete_category', $row->id) . '"
                        class="deletetherow btn btn-danger add-btn "  data-id="'.$row->id.'" >Delete</button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Category.index');
    }
    public function create()
    {
        return view('Category.create');
    }
    public function store(Request $request)
    {
        $category = new MainCategory();
        $file_name = UploadImage($request,'Category',$request->photo);
        $category->photo = $file_name;
        $category->fill([
            'en' => [
                'name' => $request->input('en.name'),
                'description' => $request->input('en.description'),
            ],
            'ar' => [
                'name' => $request->input('ar.name'),
                'description' => $request->input('ar.description'),
            ],
        ]);
        $category->save();
        return redirect()->route('index_category');
    }
    public function edit($id)
    {
        $category = MainCategory::findorFail($id);
        return view('Category.edit',compact('category'));
    }
    public function update(Request $request,$id)
    {
        $category = MainCategory::findorFail($id);
        if ($request->hasFile('photo')) {
            // Delete the existing image if it exists
            $existingImage = $category->photo;
            if ($existingImage && file_exists(public_path("Attachments/Category/$existingImage"))) {
                File::delete(public_path("Attachments/Category/$existingImage"));
            }
            // Save the new image
            $file_name = UploadImage($request->photo, 'Category');
        }
        else
        {
            $file_name = $category->photo;
        }
        $category->photo = $file_name;
        $category->fill([
            'en' => [
                'name' => $request->input('en.name'),
                'description' => $request->input('en.description'),
            ],
            'ar' => [
                'name' => $request->input('ar.name'),
                'description' => $request->input('ar.description'),
            ],
        ]);
        $category->update();
        return redirect()->route('index_category');
    }
}
