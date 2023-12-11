<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function create()
    {
        return view('site_setting.create');
    }
    public function store(Request $request)
    {
        $file_name = UploadImage($request->photo,'SiteSetting');
        SiteSetting::create([
            'photo'=>$file_name,
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'link_twitter'=>$request->link_twitter,
            'link_instgram'=>$request->link_instgram,
            'link_facebook'=>$request->link_facebook,
            'link_linkedin'=>$request->link_linkedin,
        ]);
        return redirect()->route('siteSettings.edit');
    }
    public function edit()
    {
        $data = SiteSetting::first();
        return view('site_setting.edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $site = SiteSetting::findorFail($id);
        if ($request->hasFile('photo')) {
            // Delete the existing image if it exists
            $existingImage = $site->photo;
            if ($existingImage && file_exists(public_path("Attachments/SiteSetting/$existingImage"))) {
                File::delete(public_path("Attachments/SiteSetting/$existingImage"));
            }

            // Save the new image
            $file_name = UploadImage($request->file('photo'), 'SiteSetting');
            $site->photo = $file_name;
        }

        $site->name = $request->name;
        $site->address = $request->address;
        $site->phone = $request->phone;
        $site->email = $request->email;
        $site->link_twitter = $request->link_twitter;
        $site->link_instgram = $request->link_instgram;
        $site->link_facebook = $request->link_facebook;
        $site->link_linkedin = $request->link_linkedin;

        $site->update();
        return redirect()->back();
    }
}
