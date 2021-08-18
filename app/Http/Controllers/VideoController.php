<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;


class VideoController extends Controller
{
    

    public function show(Video $video) {

        //Check if the request expects a JSon
        if(request()->wantsJson()) {
            return $video;
        }
        //else
        return view('videos/show', compact('video'));
    }

}
