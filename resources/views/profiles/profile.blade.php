@extends('layouts.app')

@section('content')

    <div style="padding-left: 7%; padding-right: 7%;">
        <div class="row pt-2 pb-5">
            <div class="col-4">
                <div class="float-right mr-5 shadow overflow-hidden d-flex justify-content-center align-items-center"
                     style="height: 170px; width: 170px; border: 3px solid #ffffff; border-radius: 50%;">
                    <img src="/storage/{{$user->profile->profile_img ?? "profile_imgs/default-avatar.png"}}" alt="img"
                         style="height: 100%; width: auto;">
                </div>
            </div>
            <div class="col-8 pt-0">
                <div class="ml-1">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div class="d-flex align-items-center pb-3">
                            <div class="h1" style="font-weight: 100;">{{ $user->user_name }}</div>
                            @if(Auth::user() && Auth::user()->id == $user->profile->user_id)
                                <a class="btn btn-sm btn-outline-secondary pl-2 pr-2 ml-4 mb-1 p-0"
                                   href="{{ route("profile.edit", Auth::user()->id)}}">
                                    <small>Edit Profile</small>
                                </a>
                            @else
                                <follow user-id="{{$user->id}}" follows="{{$follows}}"></follow>
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
                        <div class="pr-5"><strong> {{$user->messages->count()}}</strong> posts</div>
                        <div class="pr-5"><strong>{{$user->profile->followers->count()}}</strong> followers</div>
                        <div class="pr-5"><strong>{{$user->following->count()}}</strong> following</div>
                    </div>
                    <div class="pt-4 font-weight-bold">{{$user->profile->title ?? "Hi! I'm a default Title" }}</div>
                    <div>{{$user->profile->description ?? "Hi! I'm a default Description" }}</div>
                    <div><a href="https://www.{{$user->profile->url}}">{{$user->profile->url}}</a></div>
                </div>
            </div>
        </div>

        @if(Auth::user()->profile->id == $user->profile->id)
            <div class="row">
                <div class="col-md-8 pb-3">
                    <form action="{{action("PostsController@store")}}" method="POST" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="d-flex align-items-center mt-3 pb-2">
                                    <div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                         style="height: 40px; width: 40px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                                        <img src="/storage/{{Auth::user()->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
                                             alt="img"
                                             style="height: 100%; width: auto;">
                                        <div class="d-flex justify-content-center align-items-center position-absolute"
                                             style="height: 38px; width: 38px; border: 2px solid #ffffff; border-radius: 50%;">
                                        </div>
                                    </div>
                                    <div class="ml-2">
                                        <div class="p-0 m-0">
                                            <a class="text-decoration-none lead text-dark" style="font-size: 20px;"
                                               href="{{ url('/profile/'.Auth::user()->profile->user_id)}}">{{ Auth::user()->user_name }}</a>
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="form-group border-0">
                                <textarea rows="4" class="form-control border-0" name="content"
                                          placeholder="Whats on your mind....."></textarea>
                                    </div>
                                    @csrf
                                    <div class="d-flex justify-content-between">
                                        <div class="mb-3">

                                            <input type="file" name="img" id="img" class="form-control-file ">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Post
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pb-4">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="row pt-4">
            @foreach($posts as $post)
                <div class="col-md-8 pb-3">
                    <div class="card mb-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center ml-3 mt-3">
                                @if(!is_null($post->user->profile->profile_img ?? "profile_imgs/default-avatar.png"))
                                    <div>
                                        <a class="text-decoration-none"
                                           href="{{ url('/profile/'.$post->user->profile->user_id)}}">
                                            <div class="float-right overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                                 style="height: 40px; width: 40px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                                                <img src="/storage/{{$post->user->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
                                                     alt="img"
                                                     style="height: 100%; width: auto;">
                                                <div class="d-flex justify-content-center align-items-center position-absolute"
                                                     style="height: 38px; width: 38px; border: 2px solid #ffffff; border-radius: 50%;">
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="ml-3">
                                        <div class="p-0 m-0">
                                            <a class="text-decoration-none lead text-dark" style="font-size: 20px;"
                                               href="{{ url('/profile/'.$post->user->profile->user_id)}}">{{ $post->user->user_name }}</a>
                                        </div>
                                        <div class="p-0">
                                            <small class="text-muted ">
                                                @if ($post->created_at == $post->updated_at)
                                                    {{$post->created_at->diffForHumans()}}
                                                @else
                                                    Edited: {{$post->updated_at->diffForHumans()}} ||
                                                    Created: {{$post->created_at->diffForHumans()}}
                                                @endif
                                            </small>
                                        </div>


                                    </div>
                                @else
                                    <div class="lead ">
                                        <a class="text-decoration-none lead text-dark" style="font-size: 20px;"
                                           href="{{ url('/profile/'.$post->user->profile->user_id)}}">{{ $post->user->user_name }}</a>
                                    </div>
                                @endif
                            </div>

                            <div class="dropdown mt-2 mr-3">
                                <a class="text-muted text-decoration-none" href="#" role="button"
                                   id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg id="Capa_1" enable-background="new 0 0 515.555 515.555" height="14"
                                         viewBox="0 0 515.555 515.555" width="14" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m303.347 18.875c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/>
                                        <path d="m303.347 212.209c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/>
                                        <path d="m303.347 405.541c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-0 m-0"
                                     aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route("post.show", [$post->id])}}">View</a>
                                    @if(Auth::user() && Auth::user()->id == $post->user_id)
                                        <a class="dropdown-item" href="{{route("post.edit", [$post->id])}}">Edit</a>
                                        <div>
                                            <form action="{{route("post.destroy", $post->id)}}" method="POST">
                                                {{ csrf_field() }} {{method_field('DELETE')}}
                                                <button class="dropdown-item border-0" style="outline: none;">Delete!!
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="card-body p-0 ml-3 mt-2">
                            <p class="card-text lead mb-1">{{substr($post->content, 0, 50)}}...</p>
                            <div class="d-flex justify-content-between align-items-center pb-2">
                            </div>
                        </div>
                        @if(!is_null($post->img))
                            <img class="card-img-bottom" src="/storage/{{$post->img}}" alt="Card image cap">
                        @endif

                        <div class="card-footer pt-2 pb-2 mb-2 border-bottom">
                            <like post-id="{{$post->id}}" likes="{{count($post->likes)}}"
                                  comments="{{count($post->comments)}}"></like>
                        </div>

                        <Comment csrf="{{csrf_token()}}" user-id="{{Auth::user()->id}}"
                                 user-name="{{Auth::user()->user_name}}" post-id="{{$post->id}}"
                                 user-img="{{Auth::user()->profile->profile_img ?? "profile_imgs/default-avatar.png"}}" url="{{url()->current()}}" ></Comment>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

@endsection
