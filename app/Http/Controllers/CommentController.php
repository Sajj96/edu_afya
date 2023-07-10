<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function add(Request $request)
    {

        try {
            $this->validate($request, [
                'name'      => 'required|string',
                'phone'     => 'required|string',
                'user_id'   => 'required|integer',
                'video_id'  => 'required|integer',
                'comment'   => 'required|string'
            ]);

            $comment = new Comment;
            $comment->user_name = $request->name;
            $comment->user_phone = $request->phone;
            $comment->user_id = $request->user_id;
            $comment->video_id = $request->video_id;
            $comment->comment = $request->comment;
            $comment->status = 0;
            $comment->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('video.details', $request->video_id)->withError('Failed to add comment');
        }

        DB::commit();
        Log::info("comment added");
        return redirect()->route('video.details', $request->video_id)->withSuccess('Comment added successfully');
    }

    public function reply(Request $request)
    {

        try {
            $this->validate($request, [
                'video_id'          => 'required|integer',
                'comment'           => 'required|string',
                'parent_comment_id' => 'required|integer'
            ]);

            $user = Auth::user();

            $comment = new Comment;
            $comment->user_name = $user->name;
            $comment->user_phone = $user->phonenumber;
            $comment->user_id = $user->id;
            $comment->video_id = $request->video_id;
            $comment->comment = $request->comment;
            $comment->parent_comment_id = $request->parent_comment_id;
            $comment->status = 0;
            $comment->save();
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return redirect()->route('video.details', $request->video_id)->withError('Failed to add reply');
        }

        DB::commit();
        Log::info("reply added");
        return redirect()->route('video.details', $request->video_id)->withSuccess('Reply added successfully');
    }

    public function delete(Request $request)
    {
        try {
            $comment = Comment::where('id',$request->comment_id)->where('video_id', $request->video_id)->first();
            Log::info($comment);
            if($comment->delete()) {
                return redirect()->route('video.details', $request->video_id)->with('success','Video comment deleted successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('video.details', $request->video_id)->with('error','Video comment was not deleted');
        }
    }
}
