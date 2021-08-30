<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request\Videos\UpdateVideoRequest;
use App\Models\Video;


class VideoController extends Controller
{
    

    public function show(Video $video) {

        //Check if the request expects a JSon
        if(request()->wantsJson()) {
            return $video;
        }
        //else

        dd($video->comments->first()->replies);
        return view('videos/show', compact('video'));
    }


    public function updateViews(Video $video) {

        $video->increment('views');

        return response()->json([]);
    }


    public function update(UpdateVideoRequest $request, Video $video) {
        $video->update($request->only(['title', 'description']));

        return redirect()->back();
    }

}
