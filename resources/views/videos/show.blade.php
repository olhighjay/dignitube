@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @if($video->editable())
                <form action="{{ route('videos.update', $video->id) }}" method="POST">
                  @csrf
                  @method('PUT')
              @endif
                  <div class="card-header">{{ $video->title }}</div>

                  <div class="card-body">
                  <video id="video" class="video-js vjs-big-play-centered vjs-theme-city" controls preload="auto" width="640"  height="264" >
                    <source src='{{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}' type="application/x-mpegURL" data-setup="{}"  />
                  </video>

                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <br>
                      @if($video->editable())
                        <input class="form-control" type="text" name="title"  value="{{ $video->title}}" >
                        <br>
                      @else
                        <h4 class="mt-3">
                          {{$video->title}}
                        </h4>
                      @endif
                      {{$video->views}} {{Str::plural('view', $video->views)}}
                    </div>
                    <div>
                      <i class="far fa-thumbs-up"></i>1.2k &nbsp;
                      <i class="far fa-thumbs-down"></i> 72                
                    </div>
                  </div>

                  <hr>

                  <div>
                    @if($video->editable())
                      <textarea name="description" cols="3" rows="3" class="form-control">{{ $video->description}}</textarea>
                      <div class="text-right mt-3">
                        <button class="btn btn-info btn-sm" type="submit">Update Video Details</button>
                      </div>
                    @else
                    {{$video->description}}
                    @endif
                  </div>

                  <div class="d-flex justify-content-between align-items-center mt-5">
                    <div class="media">
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSF9WuoaNBpIoPF4qXEBWtNOrns4NMYNT_hPA&usqp=CAU" width="50" height="50" alt="" class="rounded circle mr-3">
                      <div class="media-body ml-2">
                        <h5 class="mt-0 mb-0">{{$video->channel->name}}</h5>
                        <span class="small">Published on {{$video->created_at->toFormattedDateString()}}</span>
                      </div>
                    </div>
                    <subscribe-button :channel="{{ $video->channel }}" :initial-subscriptions="{{ $video->channel->subscriptions }}" />
                  </div>

                </div>
              @if($video->editable())
                </form>
              @endif
            </div>
        </div>
    </div>
</div>

@endsection


@section('styles')
  <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
  <!-- City -->
  <link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet" />

  <style>
    .vjs-big-play-centered {
      width: 100%;
    }
  </style>

@endsection


@section('scripts')
  <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>

  <script>
    window.CURRENT_VIDEO = '{{ $video->id}}'
  </script>

  <script src="{{ asset('js/player.js') }}"></script>

@endsection



