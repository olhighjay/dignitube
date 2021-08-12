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
            <subscribe-button :channel="{{ $channel }}" :initial-subscriptions="{{ $channel->subscriptions }}" inline-template>
              <button @click="toggleSubscription"  class="btn btn-danger" type="button">
               <span></span> @{{ owner ? '' : subscribed ? 'Unsubscribe' : 'Subscribe'}} @{{count }} @{{owner ? 'Subscribers': ''}}
              </button>
            </subscribe-button>
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


@endsection