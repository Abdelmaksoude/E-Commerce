<?php

namespace App\Http\Controllers;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(SubCategoryService $subcategoryservice)
    {
        $subCategories = $subcategoryservice->index();
        return view('sub_category.index', ['subCategories' => $subCategories]);
    }

    public function create(SubCategoryService $subcategoryservice)
    {
        $categories = $subcategoryservice->create();
        return view('sub_category.create', ['categories' => $categories]);
    }

    public function store(Request $request,SubCategoryService $subcategoryservice)
    {
        $subCategory = $subcategoryservice->store($request);
        return redirect()->route('sub_category.index')->with('subCategory', $subCategory);
    }

    public function edit($id,SubCategoryService $subcategoryservice)
    {
        $data = $subcategoryservice->edit($id);
        return view('sub_category.edit', $data);
    }

    public function update(Request $request,$id,SubCategoryService $subcategoryservice)
    {
        $subCategory = $subcategoryservice->update($request,$id);
        return redirect()->route('sub_category.index')->with('subCategory', $subCategory);
    }

    public function delete($id,SubCategoryService $subcategoryservice)
    {
        $subCategory = $subcategoryservice->delete($id);
        return redirect()->route('sub_category.index');
    }
}
