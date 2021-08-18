@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $video->title }}</div>

                <div class="card-body">
                  <video id="video" class="video-js vjs-big-play-centered vjs-theme-city" controls preload="auto" width="640"  height="264" >
                  <source src='{{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}' type="application/x-mpegURL" data-setup="{}"  />
                  {{-- <source src="MY_VIDEO.webm" type="video/webm" /> --}}
                    
                  </video>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
  <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
  <!-- City -->
  <link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet" />

@endsection

@section('scripts')
<script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>

<script>
  videojs('video')
</script>
@endsection



@endsection
