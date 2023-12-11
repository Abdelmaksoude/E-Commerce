<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\ProductAttachment;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\Datatables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#showModal" class="edit btn btn-primary btn-sm editproduct">Edit</button>
                    <a href="'.Route('products.show',$row->id).'" data-original-title="Show" class="show btn btn-warning btn-sm showproduct">Show Product</a>
                    <button data-id="'.$row->id.'" id="deleteProduct" data-bs-toggle="modal" data-bs-target="#showModal" class="delete btn btn-danger btn-sm deleteproduct">Delete</button>
                    ';

                    // $actionBtn = '<a href="'.Route('brand.edit',$row->id).'" class="edit btn btn-success btn-sm">Edit</a>
                    //     <button type="button"  data-action="' . route('brand.delete', $row->id) . '"
                    //     class="deletetherow btn btn-danger add-btn "  data-id="'.$row->id.'" >Delete</button>
                    // ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('product.index_yajra');
    }

    // public function index()
    // {
    //     $products = Product::all();
    //     return view('product.index' ,compact('products'));
    // }

    public function create()
    {
        $all_brand = Brand::all();
        $all_category = MainCategory::all();
        $all_sub_category = SubCategory::all();
        // return view('product.create',compact('all_brand','all_category','all_sub_category'));
        $html = view('product.create_form', compact('all_brand', 'all_category', 'all_sub_category'))->render();
        return response()->json(['html' => $html]);
    }

    public function store(Request $request)
    {
        $product = new Product();
        $file_name = UploadImage($request->photo,'Product/');
        $product->photo = $file_name;
        $product->fill([
            'en' => [
                'title' => $request->input('en.title'),
                'description' => $request->input('en.description'),
            ],
            'ar' => [
                'title' => $request->input('ar.title'),
                'description' => $request->input('ar.description'),
            ],
        ]);
        $product->rate = $request->rate;
        $product->price = $request->price;
        $product->discount_percent = $request->discount_percent;
        $product->discount_value = $request->discount_value;
        if($request->discount_value && $request->discount_value != 0)
        {
            $product->final_value = $request->price - $request->discount_value;
        }
        elseif($request->discount_percent && $request->discount_percent != 0)
        {
            $product->final_value = $request->price - ($request->discount_percent/100) * $request->price;
        }
        else
        {
            $product->final_value = $request->price;
        }
        $product->category_id = $request->Category;
        $product->sub_category_id = $request->subCategory;
        $product->brand_id = $request->brand_id;
        $product->save();
        // save the attatchments from this product
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $product_attach = new ProductAttachment();
                $product_attach->product_id = $product->id;

                $file_name = UploadImage($photo, 'ProductAttachments');
                $product_attach->photo = $file_name;

                $product_attach->save();
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Product added successfully']);
    }
    public function edit($id)
    {
        $product = Product::findorFail($id);
        $all_brand = Brand::all();
        $all_category = MainCategory::all();
        $all_sub_category = SubCategory::all();
        $all_attach_for_this_product = ProductAttachment::where('product_id',$id)->get();
        // return view('product.edit',compact('product','all_brand','all_category','all_sub_category','all_attach_for_this_product'));
        $html = view('product.edit_form', compact('product','all_brand','all_category','all_sub_category','all_attach_for_this_product'))->render();
        return response()->json(['html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Update the product details
        if ($request->hasFile('photo')) {
            // Delete the existing image if it exists
            $existingImage = $product->photo;
            if ($existingImage && file_exists(public_path("Attachments/Product/$existingImage"))) {
                File::delete(public_path("Attachments/Product/$existingImage"));
            }

            // Save the new image
            $file_name = UploadImage($request->file('photo'), 'Product');
            $product->photo = $file_name;
        }


        $product->fill([
            'en' => [
                'title' => $request->input('en.title'),
                'description' => $request->input('en.description'),
            ],
            'ar' => [
                'title' => $request->input('ar.title'),
                'description' => $request->input('ar.description'),
            ],
        ]);

        $product->rate = $request->rate;
        $product->price = $request->price;
        $product->discount_percent = $request->discount_percent;
        $product->discount_value = $request->discount_value;

        if ($request->discount_percent && $request->discount_percent != 0) {
            $product->final_value = $request->price - ($request->discount_percent / 100) * $request->price;
        } elseif ($request->discount_value && $request->discount_value != 0) {
            $product->final_value = $request->price - $request->discount_value;
        } else {
            $product->final_value = $request->price;
        }

        $product->category_id = $request->Category;
        $product->sub_category_id = $request->subCategory;
        $product->brand_id = $request->brand_id;
        $product->update();

        // Update product attachments
        $product_attachments = ProductAttachment::where('product_id', $id)->get();

        if ($request->hasFile('photos')) {
            // Delete old images for each product attachment
            foreach ($product_attachments as $product_attach) {
                $existingImage = $product_attach->photo;
                if ($existingImage && file_exists(public_path("Attachments/ProductAttachments/$existingImage"))) {
                    File::delete(public_path("Attachments/ProductAttachments/$existingImage"));
                }
                $product_attach->delete();
            }

            // Save the new images
            foreach ($request->file('photos') as $photo) {
                $new_attachment = new ProductAttachment();
                $new_attachment->product_id = $product->id;
                $file_name = UploadImage($photo, 'ProductAttachments');
                $new_attachment->photo = $file_name;
                $new_attachment->save();
            }
        }

        return redirect()->route('products.index');
    }

    public function delete($id)
    {
        $product = Product::findorFail($id);
        $product_attachments = ProductAttachment::where('product_id',$id)->get();
        $html = view('product.delete_form',compact('product','product_attachments'))->render();
        return response()->json(['html' => $html]);
    }
    public function destroy($id)
    {
        $product_attachments = ProductAttachment::where('product_id',$id)->get();
        foreach ($product_attachments as $product_attach) {
            $existingImage = $product_attach->photo;
            if ($existingImage && file_exists(public_path("Attachments/ProductAttachments/$existingImage"))) {
                File::delete(public_path("Attachments/ProductAttachments/$existingImage"));
            }
            $product_attach->delete();
        }
        $product = Product::findorFail($id);
        $existingImage = $product->photo;
        if ($existingImage && file_exists(public_path("Attachments/Product/$existingImage"))) {
            File::delete(public_path("Attachments/Product/$existingImage"));
        }
        $product->delete();
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $detail = Product::findorFail($id);
        $product_attachments = ProductAttachment::where('product_id',$id)->get();
        return view('product.details',compact('detail','product_attachments'));
    }

    // public function save_attachment(Request $request,$id)
    // {
    //     $product_attach = new ProductAttachment();
    //     $product_attach->product_id = $id;
    //     $file_name = UploadImage($request,'ProductAttachments',$request->photo);
    //     $product_attach->photo = $file_name;
    //     $product_attach->save();
    //     return redirect()->route('products.index');
    // }

    public function save_attachment(Request $request, $id)
    {
        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $product_attach = new ProductAttachment();
                $product_attach->product_id = $id;

                $file_name = UploadImage($photo, 'ProductAttachments');
                $product_attach->photo = $file_name;

                $product_attach->save();
            }

            return redirect()->back()->with('success', 'Images uploaded successfully.');
        }

        return redirect()->back()->with('error', 'No images selected for upload.');
    }


    public function get_sub_gategory($id)
    {
        // $sub_category = DB::table("sub_categories")->where("category_id", $id)->pluck("photo", "id");
        // return json_encode($sub_category);
        $subCategories = SubCategory::where("category_id", $id)->get();

        $result = $subCategories->pluck('name', 'id');

        return json_encode($result);
    }

    public function orders()
    {
        $orders = Order::all();
        return view('product.orders',compact('orders'));
    }
}
