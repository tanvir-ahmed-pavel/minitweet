@extends('layouts.app')

@section('content')
<div class="container" style="padding-left: 7%; padding-right: 7%;">
    <div class="row pt-2 pb-3">
        <div class="col-4">
            <div class="float-right mr-5 shadow overflow-hidden d-flex justify-content-center align-items-center"
                 style="height: 170px; width: 170px; border: 3px solid #ffffff; border-radius: 50%;">
                <img src="/storage/{{$user->profile->profile_img ?? "profile_imgs/default-avatar.png"}}" alt="img" style="height: 100%; width: auto;">
            </div>
        </div>
        <div class="col-8 pt-0">
            <div class="ml-1">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h1" style="font-weight: 100;">{{ $user->user_name }}</div>
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
    <form class="pt-4" action="{{route("profile.update", $user->profile->user_id)}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-1">

                <div class="row">
                    <h1>Edit Profile</h1>
                </div>
                <div class="row pt-2 pb-2">
                    <label for="profile_image" class="col-md-4 col-form-label">Profile Image</label>

                    <input type="file" class="form-control-file" id="profile_image" name="profile_img">

                    @if ($errors->has('profile_img'))
                        <strong>{{ $errors->first('profile_img') }}</strong>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>

                    <input id="title"
                           type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title"
                           value="{{ $user->profile->title ?? "Hi! I'm a default Title" }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>

                    <input id="description"
                           type="text"
                           class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                           name="description"
                           value="{{ $user->profile->description ?? "Hi! I'm a default Description" }}"
                           autocomplete="description" autofocus>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">URL</label>

                    <input id="url"
                           type="text"
                           class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}"
                           name="url"
                           value="{{ $user->profile->url ?? $user->profile->url }}"
                           autocomplete="url" autofocus>

                    @if ($errors->has('url'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
