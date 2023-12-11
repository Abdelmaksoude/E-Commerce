<?php

namespace App\Http\Controllers;

use App\Models\SideService;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use Validator;

class SideServiceNewController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(SideService::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('sideService.theIndex');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = array(
            'photo'         =>  'required|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $service = new SideService();
        $file_name = UploadImage($request->photo,'SideService');
        $service->fill([
            'en' => [
                'title' => $request->input('en.title'),
            ],
            'ar' => [
                'title' => $request->input('ar.title'),
            ],
        ]);
        $service->photo = $file_name;
        $service->save();

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = SideService::findOrFail($id);
            return response()->json(['data' => $data]);
            $locale = app()->getLocale();
            if ($locale == 'ar' && isset($data->locale['ar']['title'])) {
                $title = $data->locale['ar']['title'];
            } elseif ($locale == 'en' && isset($data->locale['en']['title'])) {
                $title = $data->locale['en']['title'];
            } else {
                // Default to English title if locale not found or title not set
                $title = $data->title['en'];
            }
            return response()->json(['data' => $data, 'title' => $title]);
        }
    }

    public function update(Request $request)
    {
        $service = SideService::findOrFail($request->hidden_id);

        // If a new image is provided, delete the old image and upload the new one
        if ($request->hasFile('photo')) {
            // Delete the old image
            $oldImage = $service->photo;
            if ($oldImage && file_exists(public_path('Attachments/SideService/' . $oldImage))) {
                unlink(public_path('Attachments/SideService/' . $oldImage));
            }

            // Upload and save the new image
            $image = $request->file('photo');
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Attachments/SideService'), $image_name);
            $service->photo = $image_name;
        }

        // Update other fields
        $service->fill([
            'en' => [
                'title' => $request->input('en.title'),
            ],
            'ar' => [
                'title' => $request->input('ar.title'),
            ],
        ]);

        $service->update();

        return response()->json(['success' => 'Data is successfully updated']);
    }


    public function destroy($id)
    {
        $data = SideService::findOrFail($id);
        $existingImage = $data->photo;
        if ($existingImage && file_exists(public_path("Attachments/SideService/$existingImage"))) {
            File::delete(public_path("Attachments/SideService/$existingImage"));
        }
        $data->delete();
    }
}
