<?php

namespace App\Jobs\Videos;

use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Video;

class ConverForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Quality of video to show based on quality of user's internet connection
        $low = (new X264('aac'))->setKiloBitrate(100);
        $mid = (new X264('aac'))->setKiloBitrate(250);
        $high = (new X264('aac'))->setKiloBitrate(500);


        //Specify the disk we are taking the video from
        FFMpeg::fromDisk('local')
        // We open the file
        ->open($this->video->path)
        //We export for Http Live Streaming
        ->exportForHLS()
        // Updating the video uploading progress by percentage
        ->onProgress(function ($percentage) {
            $this->video->update([
                'percentage' => $percentage
            ]);
        })
        // We add the 3 different formats we want the video to be in
        ->addFormat($low)
        ->addFormat($mid)
        ->addFormat($high)
        ->save("public/videos/{$this->video->id}/{$this->video->id}.m3u8");

    }
}
