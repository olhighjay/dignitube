@extends('layouts.app')
@section('content')

 

  <div class="card">
    <div class="card">
      <div class="card-header d-flex justify-content-between ">
        
        {{$channel->name}}
        <a href="{{ route('channel.upload', $channel->id)}}">Upload Videos</a>
      </div>
    </div>
    <div class="card-body">
      @if ($channel->editable())
        <form id="update-channel-form" action="{{route('channels.update', $channel->id)}}" method="post" enctype="multipart/form-data">
          @csrf

          @method('PATCH')
      @endif

        <div class="form-group row justify-content-center">
          <div class="channel-avatar">
            @if($channel->image())
              <img src="{{ url($channel->image()) }}" alt="" class="image">
            @else
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSF9WuoaNBpIoPF4qXEBWtNOrns4NMYNT_hPA&usqp=CAU" alt="" class="image">
            @endif
            @if ($channel->editable())
              <div onclick="document.getElementById('image').click()" class="channel-avatar-overlay" >
                <span class="icon" title="User Profile">
                  <i class="fas fa-camera fa-2x"></i>
                </span>   
              </div>
            @endif
          </div>
        </div>

        <div class="form-group ">
          <h4 class="text-center">
            {{$channel->name}}
          </h4>
          <p class="text-center">
            {{$channel->description}}
          </p>

          <div class="text-center">
            <subscribe-button :channel="{{ $channel }}" :initial-subscriptions="{{ $channel->subscriptions }}" />
          </div>
        </div>

       @if ($channel->editable())
        <input onchange="document.getElementById('update-channel-form').submit()" class="d-none" id="image" type="file" name="image">

        <div class="form-group">
          <label for="name" class="form-control-label" >Name</label>
          <input id="name"  class="form-control" type="text" name="name" value="{{$channel->name}}">
        </div>
        <div class="form-group">
          <label for="description" class="form-control-label">Description</label>
          <textarea id="description" class="form-control" name="description" rows="3">{{$channel->description}}</textarea>
        </div>
        @if($errors->any())
          <ul class="list-group mb-5">
            @foreach ($errors->all() as $error)
                <li class="list-group text-danger">
                  {{$error}}
                </li>
            @endforeach
          </ul>
        @endif
        <button class="btn btn-info">Update Channel</button>
       @endif
        
      @if ($channel->editable()) 
        </form>
      @endif
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      videos
    </div>
    <div class="card-body">
      <h5 class="card-title">Title</h5>
      <table class="table">
        <thead>
          <th>Image</th>
          <th>Title</th>
          <th>Views</th>
          <th>Status</th>
          <th></th>
        </thead>

        <tbody>
          @foreach ($videos as $video)
              <tr>
                <td>
                  <img width="40px" height="40px" src="{{ $video->thumbnail }}" alt="">
                </td>
                <td> {{ $video->title }}</td>
                <td> {{ $video->views }}</td>
                <td> {{ $video->percentage == 100 ? 'Live' : 'Processing' }}</td>
                <td>
                  @if ($video->percentage == 100)
                  <a href="{{ route('videos.show', $video->id) }}" class="btn btn-sm btn-info">
                    view
                  </a>
                  @endif
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>

      <div class="row justify-content-center">
        {{ $videos->links() }}
      </div>
    </div>
  </div>


@endsection