@extends('layouts.app')
@section('content')
  

<div class="container-fluid">
  <div class="row justify-content-center" id="bootstrap-overrides" >  
    <channel-uploads :channel="{{ $channel}}" inline-template>
      <div class="col-md-8" >
        <div class="card p-3 d-flex justify-content-center align-items-center" v-if="!selected">
          <img onclick="document.getElementById('video-files').click()" src="https://img.icons8.com/fluency/96/000000/youtube-play.png"/>
          <p class="text-center">upload Videos</p>
          <input type="file" multiple ref="videos" id="video-files" class="d-none" @change="upload">
        </div>
        <div class="card p-3" v-else >
          <div class="my-4" v-for="video in videos">
            <div class="progress mb-3">
              <div class="progress-bar progress-bar-stripped progress-bar-animated " role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" :style="{ width: `${progress[video.name]}%` }">
                {{-- <span class="sr-only">70% Complete</span> --}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center" style="height: 180px; color:white; font-size:18px; background-color: #222a30">
                  Loading thumbnail ... 
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="text-center">
                @{{video.name}} <br>
                @{{progress[video.name]}}%
              </div>
            </div>
          </div>
        </div>
      </div>
    </channel-uploads>
  </div>
</div>


@endsection