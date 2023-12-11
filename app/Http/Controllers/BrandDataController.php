<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\Datatables;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\EditBrandRequest;
use Illuminate\Support\Facades\File;

class BrandDataController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.Route('brand.edit',$row->id).'" class="edit btn btn-success btn-sm">Edit</a>
                        <button type="button"  data-action="' . route('brand.delete', $row->id) . '"
                        class="deletetherow btn btn-danger add-btn "  data-id="'.$row->id.'" >Delete</button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('brand.index');
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(StoreBrandRequest $request)
    {
        $file_name = UploadImage($request,'Brands',$request->photo);
        Brand::create([
            'photo'=>$file_name,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        return redirect()->route('brand.index')->with('error','Brand Added Successfully');
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
            $file_name = UploadImage($request,'Brands',$request->photo);
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

    public function delete($id){
        $brand = Brand::findorFail($id);
            $existingImage = $brand->photo;
            if ($existingImage && file_exists(public_path("Attachments/Brands/$existingImage"))) {
                File::delete(public_path("Attachments/Brands/$existingImage"));
            }
        $brand->destroy($id);
        return response()->json([],200);
    }
}
