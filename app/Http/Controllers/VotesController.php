<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Channel;
use App\Models\Vote;
use App\Models\Video;
use App\Models\Comment;

class VotesController extends Controller
{
    
    public function vote($entityId, $type) {

        $entity = $this->getEntity($entityId);
        return auth()->user()->toggleVote($entity, $type);
        
    }


    public function getEntity($entityId) {

        $video = Video::find($entityId);
        if($video) return $video;

        $comment = Comment::find($entityId);
        if($comment) return $comment;


        throw new ModeNotFoundException('Entity not found');

    }
}
