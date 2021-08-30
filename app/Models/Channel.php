<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class Channel extends Model implements HasMedia
{
    use HasFactory;

    use HasMediaTrait;


    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function image()
    {
        if($this->media->first()) {

            $image_url = $this->media->first()->getFullUrl('thumb');
            // Remove the first '/' in the double '//' that starts the url
            return ltrim($image_url, $image_url[0]);
            // return $this->media->first()->getFullUrl('thumb');
        }
        return null;
    }


    public function editable()
    {
        if(!auth()->check()) return false;

        return $this->user_id == auth()->user()->id;
    }


    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(100)->height(500);
    }


    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    public function videos() {
        return $this->hasMany(Video::class);
    }

    
}
