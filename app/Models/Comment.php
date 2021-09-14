<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    use HasFactory;


    // Load user and votes table related to each comment
    protected $with = ['user', 'votes'];

    // Adding repliesCount to the appends array makes it show it json format
    protected $appends = ['repliesCount'];

    public function video() {
        return $this->belongsTo(Video::class);
    } 


    public function user() {
        return $this->belongsTo(User::class);
    } 


    public function replies() {

        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }


    public function getRepliesCountAttribute() {
        return $this->replies->count();
    }


    public function votes() {
        return $this->morphMany(Vote::class, 'voteable');
    }



}
