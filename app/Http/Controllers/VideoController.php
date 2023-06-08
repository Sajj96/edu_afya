<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::lazy();
        return view('pages.videos.index', compact('videos'));
    }

    public function show(Request $request, $id)
    {
        $video = Video::find($id);
        $comments = Comment::with('replies')->where('video_id', $id)->where('parent_comment_id',null)->get();
        return view('pages.videos.view', compact('video','comments'));
    }

    public function add(Request $request)
    {
        if ($request->method() == 'GET') {
            $categories = Category::all();
            return view('pages.videos.add', compact('categories'));
        }

        try {
            $this->validate($request, [
                'name'      => 'required|string',
                'category'  => 'required|string',
                'tags'      => 'required|string',
                'status'    => 'required|string',
                'desc'      => 'required|string',
                'video'     => 'required|string'
            ]);

            $video = new Video;
            $video->name = $request->name;
            $video->category = $request->category;
            $video->tags = $request->tags;
            $video->description = $request->desc;
            $video->status = $request->status;
            $video->image_url = $request->video;
            $video->video_link_id = $request->video_id;
            $video->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to create the video');
        }

        DB::commit();
        Log::info("Video added");
        return redirect('/videos')->withSuccess('Video created successfully');
    }

    public function edit(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $video = Video::find($id);
            $categories = Category::all();
            return view('pages.videos.edit', compact('video','categories'));
        }

        try {
            $this->validate($request, [
                'name'      => 'required|string',
                'category'  => 'required|string',
                'tags'      => 'required|string',
                'status'    => 'required|string',
                'desc'      => 'required|string',
                'video'     => 'required|string'
            ]);

            $video = Video::find($id);
            $video->name = $request->name;
            $video->category = $request->category;
            $video->tags = $request->tags;
            $video->description = $request->desc;
            $video->status = $request->status;
            $video->image_url = $request->video;
            $video->video_link_id = $request->video_id;
            $video->updated();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to update the video');
        }

        DB::commit();
        Log::info("Video updated");
        return redirect('/videos')->withSuccess('Video updated successfully');
    }

    public function delete(Request $request)
    {
        try {
            $video = Video::find($request->video_id);
            Log::info($video);
            if($video->delete()) {
                return redirect()->route('video')->with('success','Video deleted successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('video')->with('error','Video was not deleted');
        }
    }
}
