<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Comment;

class CommentController extends Controller
{


    public function index(Video $video) {
        return $video->comments()->orderBy('created_at','desc')->paginate(5);
    }


    public function show(Comment $comment) {
        return $comment->replies()->paginate(5);
    }


    public function store (Request $request, Video $video) {
        return auth()->user()->comments()->create([
            'body' => $request->body,
            'video_id' => $video->id,
            'comment_id' => $request->comment_id
        ])->fresh();
    }




}
