@extends('layouts.app')

@section('content')

    <div style="padding-left: 7%; padding-right: 7%;">
        <div class="row pt-2 pb-5">

{{--            Profile img--}}

            <div class="col-md-3">
                <div class="float-right mr-5 shadow overflow-hidden d-flex justify-content-center align-items-center"
                     style="height: 170px; width: 170px; border: 3px solid #ffffff; border-radius: 50%;">
                    <img src="/storage/{{$user->profile->profile_img ?? "profile_imgs/default-avatar.png"}}" alt="img"
                         style="height: 100%; width: auto;">
                </div>
            </div>

{{--            Profile Info--}}

            <div class="col-md-5 pt-0">
                <div class="ml-1">
                    <div class="d-flex justify-content-between">

                        {{--            follow--}}

                        <div class="d-flex align-items-baseline pb-3">
                            <div>
                                <div class="h1" style="font-weight: 100;">{{ $user->user_name }}</div>
                                <div class="h5 text-muted" style="font-weight: 100;">{{ $user->name }}</div>
                            </div>
                            @if(Auth::user() && Auth::user()->id == $user->profile->user_id)
                                <a class="btn btn-sm btn-outline-secondary pl-2 pr-2 ml-4 mb-1 p-0"
                                   href="{{ route("profile.edit", Auth::user()->id)}}">
                                     <small>Edit Profile</small> <i class="fas fa-cogs"></i>
                                </a>
                            @else
                                <follow user-id="{{$user->id}}" follows="{{$follows}}"></follow>
                            @endif
                        </div>

                    </div>

{{--                    Count Section--}}

                    <div class="d-flex">

{{--                        Post count--}}

                        <div class="pr-5">
                            <strong>{{$user->messages->count()}}</strong> posts
                        </div>

{{--                        follower--}}

                        <div class="pr-5">
                            <a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal" data-target="#followerModal{{$user->profile->id}}">
                                <strong>{{$user->profile->followers->count()}}</strong> followers
                            </a>
                            {{--                        Follower Modal--}}

                            <div class="modal fade" id="followerModal{{$user->profile->id}}" tabindex="-1" aria-labelledby="followerModal{{$user->profile->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header pb-0">
                                            <h4>Follower:</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body scrollbar scrollbar-secondary">
                                            @foreach($user->profile->followers as $follower)
                                                <table class="table table-sm table-borderless border-bottom m-0">
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div>
                                                                    <a class="text-decoration-none"
                                                                       href="{{ url('/profile/'.$follower->profile->user_id)}}">
                                                                        <div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                                                             style="height: 35px; width: 35px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                                                                            <img src="/storage/{{$follower->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
                                                                                 alt="img"
                                                                                 style="height: 100%; width: auto;">
                                                                            <div class="d-flex justify-content-center align-items-center position-absolute"
                                                                                 style="height: 33px; width: 33px; border: 2px solid #ffffff; border-radius: 50%;">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="ml-3">
                                                                    <div class="p-0 m-0">
                                                                        <a class="text-decoration-none lead text-dark" style="font-size: 18px;"
                                                                           href="{{ url('/profile/'.$follower->profile->user_id)}}">
                                                                            {{ $follower->user_name}}
                                                                        </a>
                                                                    </div>

                                                                    {{--                                    name--}}

                                                                    <div class="p-0 text-muted">
                                                                        <a class="text-decoration-none text-muted" style="font-size: 14px;"
                                                                           href="{{ url('/profile/'.$follower->profile->user_id)}}">
                                                                            {{ $follower->name}}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                @if(Auth::user()->id !== $follower->id)
                                                                    <follow user-id="{{$follower->id}}" follows="{{Auth::user()->following->contains($follower->profile)}}"></follow>
                                                                @else
                                                                    <div class="btn btn-sm btn-success ml-4">It's you</div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

{{--                        Following Count--}}

                        <div>
                        <a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal" data-target="#followModal{{$user->profile->id}}">
                            <strong>{{$user->following->count()}}</strong> following
                        </a>

                        {{--                        Following Modal--}}

                        <div class="modal fade" id="followModal{{$user->profile->id}}" tabindex="-1" aria-labelledby="followModal{{$user->profile->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header pb-0">
                                        <h4>Following:</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body scrollbar scrollbar-secondary">
                                        @foreach($users as $following)
                                            <table class="table table-sm table-borderless border-bottom m-0">
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <a class="text-decoration-none"
                                                                   href="{{ url('/profile/'.$following->profile->user_id)}}">
                                                                    <div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                                                         style="height: 35px; width: 35px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                                                                        <img src="/storage/{{$following->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
                                                                             alt="img"
                                                                             style="height: 100%; width: auto;">
                                                                        <div class="d-flex justify-content-center align-items-center position-absolute"
                                                                             style="height: 33px; width: 33px; border: 2px solid #ffffff; border-radius: 50%;">
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="p-0 m-0">
                                                                    <a class="text-decoration-none lead text-dark" style="font-size: 18px;"
                                                                       href="{{ url('/profile/'.$following->profile->user_id)}}">
                                                                        {{ $following->user_name}}
                                                                    </a>
                                                                </div>

                                                                {{--                                    name--}}

                                                                <div class="p-0 text-muted">
                                                                    <a class="text-decoration-none text-muted" style="font-size: 14px;"
                                                                       href="{{ url('/profile/'.$following->profile->user_id)}}">
                                                                        {{ $following->name}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            @if(Auth::user()->id !== $following->id)
                                                            <follow user-id="{{$following->id}}" follows="{{Auth::user()->following->contains($following->profile)}}"></follow>
                                                                @else
                                                                <div class="btn btn-sm btn-success ml-4">It's you</div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>

{{--                    Profile info section--}}

                    <div class="pt-4 font-weight-bold">{{$user->profile->title ?? "Hi! I'm a default Title" }}</div>
                    <div>{{$user->profile->description ?? "Hi! I'm a default Description" }}</div>
                    <div><a href="https://www.{{$user->profile->url}}">{{$user->profile->url}}</a></div>
                </div>
            </div>

            @include('profiles.include.profileRight')

        </div>

{{--        Create post--}}

        @include('profiles.include.createPost')

{{--        Post Section--}}

        @include('profiles.include.profilePost')

        <div class="row">
            <div class="col-md-12">{{$posts->links()}}</div>
        </div>

    </div>

@endsection
