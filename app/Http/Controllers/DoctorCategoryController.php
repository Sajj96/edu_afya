<?php

namespace App\Http\Controllers;

use App\Models\DoctorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Image;

class DoctorCategoryController extends Controller
{
    public function index()
    {
        $categories = DoctorCategory::lazy();
        return view('pages.doctors.category.index', compact('categories'));
    }

    public function add(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('pages.doctors.category.add');
        }

        $this->validate($request, [
            'name'      => 'required|string',
            'image'     => 'required',
            'image.*'   => 'mimes:png,jpg,gif,jpeg',
            'status'    => 'required|string'
        ]);

        try {

            $path = storage_path('/app/public/doctor_category/');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $fileLink = "";

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = $request->image->getClientOriginalName();
                $extension = $image->extension();
                $img = Image::make($image->getRealPath());
                $img->resize(160, 160);

                $generated = $request->name ."_". date("Ymd") . "_IMG";

                if ($extension == "png") {
                    $fileName = $generated . ".png";
                } else if ($extension == "jpg") {
                    $fileName = $generated . ".jpg";
                } else if ($extension == "jpeg") {
                    $fileName = $generated . ".jpeg";
                } else {
                    return redirect()->back()->with('error', "Invalid file type only png, jpeg and jpg files are allowed.");
                }

                $img->save(storage_path('/app/public/doctor_category/' . $fileName), 90, 'jpg');
                $fileLink = url('storage/doctor_category/' . $fileName);
            }

            $category = new DoctorCategory;
            $category->name = $request->name;
            $category->status = $request->status;
            $category->image_url = $fileLink;
            $category->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to create the doctor category');
        }

        DB::commit();
        Log::info("category added");
        return redirect('/doctor-categories')->withSuccess('Doctor category created successfully');
    }

    public function edit(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $category = DoctorCategory::find($id);
            return view('pages.doctors.category.edit', compact('category'));
        }

        $this->validate($request, [
            'name'      => 'required|string',
            'status'    => 'required|string'
        ]);

        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = $request->image->getClientOriginalName();
                $extension = $image->extension();
                $img = Image::make($image->getRealPath());
                $img->resize(160, 160);

                $generated = $request->name ."_". date("Ymd") . "_IMG";

                if ($extension == "png") {
                    $fileName = $generated . ".png";
                } else if ($extension == "jpg") {
                    $fileName = $generated . ".jpg";
                } else if ($extension == "jpeg") {
                    $fileName = $generated . ".jpeg";
                } else {
                    return redirect()->back()->with('error', "Invalid file type only png, jpeg and jpg files are allowed.");
                }

                $img->save('custom/doctor_category/' . $fileName, 90, 'jpg');
                $fileLink = url('custom/doctor_category/' . $fileName);
            }

            $category = DoctorCategory::find($id);
            $category->name = $request->name;
            $category->status = $request->status;
            $category->image_url = ($request->hasFile('image')) ? $fileLink : $category->image_url;
            $category->update();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to update the doctor category');
        }

        DB::commit();
        Log::info("category added");
        return redirect('/doctor-categories')->withSuccess('Doctor category updated successfully');
    }

    public function delete(Request $request)
    {
        try {
            $category = DoctorCategory::find($request->category_id);
            Log::info($category);
            if($category->delete()) {
                return redirect()->route('doctor.category')->with('success','Doctor Category deleted successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('doctor.category')->with('error','Doctor Category was not deleted');
        }
    }
}
