<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::lazy();
        return view('pages.category.index', compact('categories'));
    }

    public function add(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('pages.category.add');
        }

        try {
            $this->validate($request, [
                'name'      => 'required|string',
                'image_url' => 'required|string',
                'status'    => 'required|string'
            ]);

            $category = new Category;
            $category->name = $request->name;
            $category->status = $request->status;
            $category->image_url = $request->image_url;
            $category->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to create the video category');
        }

        DB::commit();
        Log::info("category added");
        return redirect('/categories')->withSuccess('Video category created successfully');
    }

    public function delete(Request $request)
    {
        try {
            $category = Category::find($request->category_id);
            Log::info($category);
            if($category->delete()) {
                return redirect()->route('category')->with('success','Video Category deleted successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('category')->with('error','Video Category was not deleted');
        }
    }
}
