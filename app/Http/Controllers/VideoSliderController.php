<?php

namespace App\Http\Controllers;

use App\Models\VideoSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Image;

class VideoSliderController extends Controller
{
    public function index()
    {
        $banners = VideoSlider::get();
        return view('pages.videos.sliders.index', compact('banners'));
    }

    public function create(Request $request)
    {
        if($request->method() == "GET") {
            return view('pages.videos.sliders.add');
        }

        try {
            $this->validate($request, [
                'title'    => 'required|string',
                'video_id' => 'required|string',
                'image'    => 'required'
            ]);

            $path = storage_path('/app/public/video_sliders/');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = $request->image->getClientOriginalName();
                $extension = $image->extension();
                $img = Image::make($image->getRealPath());
                $img->resize(720, 528);

                $generated = uniqid() . "_" . time() . date("Ymd") . "_IMG";

                if ($extension == "png") {
                    $fileName = $generated . ".png";
                } else if ($extension == "jpg") {
                    $fileName = $generated . ".jpg";
                } else if ($extension == "jpeg") {
                    $fileName = $generated . ".jpeg";
                } else {
                    return redirect()->back()->with('error', "Invalid file type only png, jpeg and jpg files are allowed.");
                }

                $img->save(storage_path('/app/public/video_sliders/' . $fileName), 90, 'jpg');
                $fileLink = url('storage/video_sliders/' . $fileName);
            }

            $slider = new VideoSlider;
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->image_url = $fileLink;
            $slider->video_link = $request->video_id;
            $slider->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to create the banner');
        }

        DB::commit();
        Log::info("Banner added");
        return redirect('/banners')->withSuccess('Banner created successfully');
    }

    public function delete(Request $request)
    {
        try {
            $slider = VideoSlider::find($request->banner_id);
            Log::info($slider);
            if ($slider->delete()) {
                return redirect()->route('banner')->with('success', 'Banner deleted successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('banner')->with('error', 'Banner was not deleted');
        }
    }
}
