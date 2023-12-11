<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminProfileController extends Controller
{
    public function Show($id)
    {
        $admin = Admin::findorFail($id);
        return view('admin.profile', compact('admin'));
    }
    public function Edit($id)
    {
        $admin = Admin::findorFail($id);
        return view('admin.profile_edit',compact('admin'));
    }
    public function Update(Request $request, $id)
    {
        $admin = Admin::findorFail($id);
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);
        return redirect()->route('adminProfile',$id)->with('error','Profile Updated Successful');
    }
}
