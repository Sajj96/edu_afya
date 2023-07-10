<?php

namespace App\Http\Controllers;

use App\Models\DoctorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        try {
            $this->validate($request, [
                'name'      => 'required|string',
                'image_url' => 'required|string',
                'status'    => 'required|string'
            ]);

            $category = new DoctorCategory;
            $category->name = $request->name;
            $category->status = $request->status;
            $category->image_url = $request->image_url;
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
            'image_url' => 'required|string',
            'status'    => 'required|string'
        ]);

        try {

            $category = DoctorCategory::find($id);
            $category->name = $request->name;
            $category->status = $request->status;
            $category->image_url = $request->image_url;
            $category->update();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to create the doctor category');
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
