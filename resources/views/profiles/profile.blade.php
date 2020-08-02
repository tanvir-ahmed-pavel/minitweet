@extends('layouts.app')

@section('content')

    <div class="row pt-2">
        <div class="col-4">
            <div class="float-right mr-5 shadow overflow-hidden d-flex justify-content-center align-items-center"
                 style="height: 170px; width: 170px; border: 3px solid #ffffff; border-radius: 50%;">
                @if(!is_null($user->profile->profile_img))
                    <img src="/storage/{{$user->profile->profile_img}}" alt="img" style="height: 100%; width: auto;">
                @else
                    <div class="text-center">
                        @if(Auth::user() && Auth::user()->id == $user->profile->user_id)
                            <a class="text-decoration-none" href="{{ route("profile.edit", Auth::user()->id)}}">Upload
                                your profile image!</a>
                        @else
                            No Image!
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="col-8 pt-0">
            <div class="ml-1">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h1" style="font-weight: 100;">{{ $user->user_name }}</div>
                        @if(Auth::user() && Auth::user()->id == $user->profile->user_id)
                            <a class="btn btn-sm btn-outline-secondary pl-2 pr-2 ml-4 mb-2 p-0"
                               href="{{ route("profile.edit", Auth::user()->id)}}">
                                <small>Edit Profile</small>
                            </a>
                        @else
                            <a class="btn btn-sm btn-primary pl-2 pr-2 ml-4 mb-2 p-0" href="#">
                                <small> Follow</small>
                            </a>
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
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="card-text m-0 p-0">{{substr($message->content, 0, 50)}}...</p>
                            <div class="dropdown">
                                <a class="text-muted text-decoration-none" href="#" role="button"
                                   id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg id="Capa_1" enable-background="new 0 0 515.555 515.555" height="11"
                                         viewBox="0 0 515.555 515.555" width="11" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m303.347 18.875c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/>
                                        <path d="m303.347 212.209c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/>
                                        <path d="m303.347 405.541c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-0 m-0"
                                     aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route("post.show", [$message->id])}}">View</a>
                                    @if(Auth::user() && Auth::user()->id == $message->user_id)
                                        <a class="dropdown-item" href="{{route("post.edit", [$message->id])}}">Edit</a>
                                        <div>
                                            <form action="{{route("post.destroy", $message->id)}}" method="POST">
                                                {{ csrf_field() }} {{method_field('DELETE')}}
                                                <button class="dropdown-item border-0" style="outline: none;">Delete!!
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($message->created_at == $message->updated_at)
                            <small class="text-muted m-0 p-0">
                                Created: {{$message->created_at->diffForHumans()}}</small>
                        @else
                            <small class="text-muted m-0 p-0">Created: {{$message->created_at->diffForHumans()}} ||
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
