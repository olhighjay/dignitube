<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Channel;
use App\Models\Vote;
use App\Models\Video;

class VotesController extends Controller
{
    
    public function vote(Video $video, $type) {

        return auth()->user()->toggleVote($video, $type);
        
    }
}
