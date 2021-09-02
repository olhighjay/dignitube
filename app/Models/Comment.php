<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    use HasFactory;


    // Load user table related to each comment
    protected $with = ['user'];

    public function video() {
        return $this->belongsTo(Video::class);
    } 


    public function user() {
        return $this->belongsTo(User::class);
    } 


    public function replies() {

        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }



}
