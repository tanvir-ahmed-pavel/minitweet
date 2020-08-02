@extends("layouts.app")

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1>{{$post->title}}</h1>
            <p class="lead ">{{$post->content}}</p>
        </div>
        <div class="d-flex justify-content-end align-items-center">
            @if ($post->created_at == $post->updated_at)
                <small class="text-muted">Created: {{$post->created_at->diffForHumans()}}</small>
            @else
                <small class="text-muted">Created: {{$post->created_at->diffForHumans()}} || Edited: {{$post->updated_at->diffForHumans()}}</small>
            @endif
        </div>
        <div class="btn-group d-flex justify-content-between align-items-center pt-3">
            <div>
                <a class="btn btn-sm btn-secondary text-decoration-none" href="{{route("post.show", $post->id)}}">Back</a>
            </div>
            <div>
                <form action="{{route("post.destroy", $post->id)}}" method="POST">
                {{ csrf_field() }} {{method_field('DELETE')}}
                <button class="btn btn-sm btn-danger">Delete!!</button>
            </form>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Create post</h1>
                <form action="{{route("post.update", $post->id)}}" method="POST">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="5" class="form-control"  name="content" id="article-ckeditor">{{$post->content ?? ""}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Updated!
                        </button>
                    </div>
                    {{ csrf_field() }} {{method_field('PUT')}}
                </form>
            </div>
        </div>
    </div>
@endsection
