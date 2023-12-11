<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function Index()
    {
        return view('admin.admin_login');
    }

    public function Login(Request $request)
    {
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email'=>$check['email'], 'password'=>$check['password']]))
        {
            return redirect()->route('admin.dashboard')->with('error','Admin Login Successfully');
        }
        else
        {
            return back()->with('error','Email Or Password Not Valid');
        }
    }

    public function Dashboard()
    {
        return view('admin.admin_index');
    }

    public function Logout()
    {
        Auth::guard('admin')->Logout();
        return redirect()->route('login_form')->with('error','Admin Logout Successfully');
    }

    public function Register()
    {
        return view('admin.admin_register');
    }

    public function RegisterCreate(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:admins|max:255',
            'name' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ]);
        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'phone'=>$request->phone,
            'created_at'>Carbon::now(),
        ]);

        Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.dashboard')->with('error','Admin Created Successfully');
    }

    public function AllAdmins()
    {
        $admins = Admin::all();
        return view('admin.admins', compact('admins'));
    }
    public function Edit($id)
    {
        $admin = Admin::findorFail($id);
        return view('admin.edit',compact('admin'));
    }
    public function Update(Request $request,$id)
    {
        $admin = Admin::findorFail($id);
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);
        return redirect()->route('all_admins')->with('error','Data Updated Successfully');
    }

    public function Delete($id)
    {
        Admin::destroy($id);
        return redirect()->route('all_admins')->with('error','Data Deleted Successfully');
    }
}
