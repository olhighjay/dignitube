<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Video;
use App\Jobs\Videos\ConverForStreaming;
use App\Jobs\Videos\CreateVideoThumbnail;


class UploadVideoController extends Controller
{
    public function index(Channel $channel){
        return view('channels.upload', [
            'channel' => $channel
        ]);
    }

    public function store(Channel $channel) {
        
        $video = $channel->videos()->create([
            'title' => request()->title,
            'path' => request()->video->store("channels/{$channel->id}")
        ]);


        $this->dispatch(new CreateVideoThumbnail($video));


        $this->dispatch(new ConverForStreaming($video));

        return $video;

    }


}
