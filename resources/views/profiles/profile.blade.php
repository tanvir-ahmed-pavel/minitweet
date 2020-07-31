
@extends('layouts.app')

@section('content')

        <div class="row pt-2">
            <div class="col-4">
                <div class="float-right mr-5 shadow overflow-hidden d-flex justify-content-center align-items-center" style="height: 170px; width: 170px; border: 3px solid #ffffff; border-radius: 50%;">
                    @if(!is_null($user->profile->profile_img))
                    <img src="/storage/{{$user->profile->profile_img}}" alt="img" style="height: 100%; width: auto;" >
                        @else
                        <div class="text-center">
                            @if(Auth::user() && Auth::user()->id == $user->profile->user_id)
                                <a class="text-decoration-none" href="{{ route("profile.edit", Auth::user()->id)}}">Upload your profile image!</a>
                            @else
                                No Image!
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-8 pt-2">
                <div class="ml-1">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h1" style="font-weight: 100;">{{ $user->user_name }}</div>
                        @if(Auth::user() && Auth::user()->id == $user->profile->user_id)
                            <small class="ml-sm-4 mb-2"><a class="btn btn-sm btn-outline-secondary pl-sm-3 pr-sm-3" href="{{ route("profile.edit", Auth::user()->id)}}"> Edit Profile </a></small>
                            @else
                            <small class="ml-sm-4 mb-2"><a class="btn btn-sm btn-primary pl-3 pr-3" href="#"> Follow </a></small>
                        @endif
{{--                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>--}}
                    </div>

{{--                    @can('update', $user->profile)--}}
{{--                        <a href="/p/create">Add New Post</a>--}}
{{--                    @endcan--}}

                </div>

{{--                @can('update', $user->profile)--}}
{{--                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>--}}
{{--                @endcan--}}

                <div class="d-flex">
                    <div class="pr-5"><strong></strong> posts</div>
                    <div class="pr-5"><strong></strong> followers</div>
                    <div class="pr-5"><strong></strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold">{{$user->profile->title ?? "Hi! I'm a default Title" }}</div>
                <div>{{$user->profile->description ?? "Hi! I'm a default Description" }}</div>
                <div><a href="#">{{$user->profile->url}}</a></div>
            </div>
            </div>
        </div>

        <div class="row pt-5">
            @foreach($post as $message)
                <div class="col-md-4 pb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{$message->title}}</h5>
                            <p class="card-text">{{substr($message->content, 0, 50)}}...</p>

                            @if ($message->created_at == $message->updated_at)
                                <small class="text-muted">
                                    Created: {{$message->created_at->diffForHumans()}}</small>
                            @else
                                <small class="text-muted">Created: {{$message->created_at->diffForHumans()}} ||
                                    Edited: {{$message->updated_at->diffForHumans()}}</small>
                            @endif
                            
                        </div>
                        @if(!is_null($message->img))
                            <img class="card-img-bottom" src="/storage/{{$message->img}}" alt="Card image cap">
{{--                            @else--}}
{{--                            <div class="p-lg-5 d-flex justify-content-center align-content-center">--}}
{{--                                {{"No Preview Available!"}}--}}
{{--                            </div>--}}
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

@endsection
