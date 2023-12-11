<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SideService;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\Datatables;

class SideServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SideService::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0) data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStudent">Edit</a>
                    <a href="javascript:void(0) data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStudent">Edit</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('sideService.indexDataTable');
    }

    public function store(Request $request)
    {
        return $request;
        $service = new SideService();
        $file_name = UploadImage($request,'SideService',$request->photo);
        $service->fill([
            'en' => [
                'title' => $request->input('en.title'),
            ],
            'ar' => [
                'title' => $request->input('ar.title'),
            ],
        ]);
        $service->id = $request->service_id;
        $service->photo = $file_name;
        $service->save();
        return response()->json(['success'=>'Student Added Successfully']);
    }



















    // public function index()
    // {
    //     $side_service = SideService::all();
    //     return view('sideService.index',compact('side_service'));
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required',
    //         'photo' => 'required',
    //     ]);

    //     $service = new SideService();
    //     $file_name = UploadImage($request,'SideService',$request->photo);
    //     $service->fill([
    //         'en' => [
    //             'title' => $request->input('en.title'),
    //         ],
    //         'ar' => [
    //             'title' => $request->input('ar.title'),
    //         ],
    //     ]);
    //     $service->photo = $file_name;
    //     $service->save();
    //     return redirect()->route('side_service.index')->with('error','the side service has been saved successful');
    // }

    // public function update(Request $request , $id)
    // {
    //     $service = SideService::findorFail($id);
    //     if ($request->hasFile('photo')) {
    //         // Delete the existing image if it exists
    //         $existingImage = $service->photo;
    //         if ($existingImage && file_exists(public_path("Attachments/SideService/$existingImage"))) {
    //             File::delete(public_path("Attachments/SideService/$existingImage"));
    //         }
    //         // Save the new image
    //         $file_name = UploadImage($request,'SideService',$request->photo);
    //     }
    //     else
    //     {
    //         $file_name = $service->photo;
    //     }
    //     $service->photo = $file_name;
    //     $service->fill([
    //         'en' => [
    //             'title' => $request->input('en.title'),
    //         ],
    //         'ar' => [
    //             'title' => $request->input('ar.title'),
    //         ],
    //     ]);
    //     $service->update();
    //     return redirect()->route('side_service.index')->with('error','the side service has been updated successful');
    // }

    // public function destroy($id)
    // {
    //     $service = SideService::findorFail($id);
    //         $existingImage = $service->photo;
    //         if ($existingImage && file_exists(public_path("Attachments/SideService/$existingImage"))) {
    //             File::delete(public_path("Attachments/SideService/$existingImage"));
    //         }
    //     $service->delete();
    //     return redirect()->route('side_service.index')->with('error','the side service has been deleted successful');
    // }
}
