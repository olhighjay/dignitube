@extends('layouts.app')
@section('content')

 

  <div class="card">
    <div class="card-body">
      {{-- <h5 class="card-title">Title</h5>
      <p class="card-text">Content</p> --}}
      @if ($channel->editable())
        <form id="update-channel-form" action="{{route('channels.update', $channel->id)}}" method="post" enctype="multipart/form-data">
          @csrf

          @method('PATCH')
      @endif

        <div class="form-group row justify-content-center">
          <div class="channel-avatar">
            <img src="{{ url($channel->image()) }}" alt="" class="image">
            {{-- <img src="https://i.pinimg.com/564x/73/16/f5/7316f550de9ca0045e3d8d98a5bb5e44.jpg" alt="" class="image"> --}}
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
            <subscribe-button :subscriptions="{{ $channel->subscriptions }}" inline-template>
              <button @click="toggleSubscription"  class="btn btn-danger" type="button">
                Unsubscribe 7k    
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