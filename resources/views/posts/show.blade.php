@extends("layouts.app")

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1>{{$post->title}}</h1>
            <p class="lead ">{{$post->content}}</p>
        </div>
        <div class="d-flex justify-content-end align-items-center">
            @if(Auth::user() && Auth::user()->id == $post->user_id)
                <small class="text-muted">Published By: You</small>
            @else
                <small class="text-muted">Published By: {{$post->user->name}}</small>
            @endif
        </div>
        <div class="d-flex justify-content-end align-items-center">

            @if ($post->created_at == $post->updated_at)
                <small class="text-muted">Created: {{$post->created_at->diffForHumans()}}</small>
            @else
                <small class="text-muted">Created: {{$post->created_at->diffForHumans()}} || Edited: {{$post->updated_at->diffForHumans()}}</small>
            @endif
        </div>
        @if(Auth::user() && Auth::user()->id == $post->user_id)
            <div class="btn-group float-right pt-3">
                <form action="{{route("post.destroy", $post->id)}}" method="POST">
                    {{ csrf_field() }} {{method_field('DELETE')}}
                    <button class="btn btn-sm btn-danger">Delete!!</button>
                    <a class="btn btn-sm btn-secondary text-decoration-none" href="{{route("post.edit", $post->id)}}">Edit</a>
                </form>
            </div>
        @endif

    </section>
    @if(!Auth::guest())
            <a class="p-2 text-decoration-none shadow btn btn-lg btn-primary" style="padding: 15px; z-index: 1000; position: fixed; bottom: 45px; right: 25px;" href="/post/create">Creat Post</a>
        @else
            <a class="p-2 text-decoration-none shadow btn btn-lg btn-primary" style="padding: 15px; z-index: 1000; position: fixed; bottom: 45px; right: 25px;" href="{{ route('login') }}">Creat Post</a>
    @endif
@endsection
