<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Comment;

class CommentController extends Controller
{


    public function index(Video $video) {
        return $video->comments()->paginate(5);
    }


    public function show(Comment $comment) {
        return $comment->replies()->paginate(5);
    }




}
