@extends("layouts.app")

@section('content')

    <h1 class="p-0">News Feed</h1>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-8 pb-5">
                <div class="card mb-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center ml-3 mt-3">
                        @if(!is_null($post->user->profile->profile_img))
                        <div>
                                <a class="text-decoration-none"
                                   href="{{ url('/profile/'.$post->user->profile->user_id)}}">
                                    <div class="float-right overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                         style="height: 40px; width: 40px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                                        <img src="/storage/{{$post->user->profile->profile_img}}" alt="img"
                                             style="height: 100%; width: auto;">
                                        <div class="d-flex justify-content-center align-items-center position-absolute"
                                             style="height: 38px; width: 38px; border: 2px solid #ffffff; border-radius: 50%;">
                                        </div>
                                    </div>
                                </a>
                        </div>

                        <div class="lead ml-2">
                            <a class="text-decoration-none"
                               href="{{ url('/profile/'.$post->user->profile->user_id)}}">{{ $post->user->user_name }}</a>
                        </div>
                        @else
                            <div class="lead ">
                                <a class="text-decoration-none lead"
                                   href="{{ url('/profile/'.$post->user->profile->user_id)}}">{{ $post->user->user_name }}</a>
                            </div>
                        @endif
                    </div>

                    <div class="dropdown mt-2 mr-3">
                        <a class="text-muted text-decoration-none" href="#" role="button"
                           id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg id="Capa_1" enable-background="new 0 0 515.555 515.555" height="14" viewBox="0 0 515.555 515.555" width="14" xmlns="http://www.w3.org/2000/svg"><path d="m303.347 18.875c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/><path d="m303.347 212.209c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/><path d="m303.347 405.541c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/></svg></a>
                        <div class="dropdown-menu dropdown-menu-right p-0 m-0" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route("post.show", [$post->id])}}">View</a>
                            @if(Auth::user() && Auth::user()->id == $post->user_id)
                                <a class="dropdown-item" href="{{route("post.edit", [$post->id])}}">Edit</a>
                                <div>
                                    <form action="{{route("post.destroy", $post->id)}}" method="POST">
                                        {{ csrf_field() }} {{method_field('DELETE')}}
                                        <button class="dropdown-item border-0" style="outline: none;">Delete!!</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    </div>

                    <small class="text-muted ml-3 mt-2">
                        @if ($post->created_at == $post->updated_at)
                            {{$post->created_at->diffForHumans()}}
                        @else
                            Edited: {{$post->updated_at->diffForHumans()}} <br>
                            {{$post->created_at->diffForHumans()}} <br>
                        @endif
                    </small>


                    <div class="card-body p-0 ml-3 mt-2">
                        <p class="card-text lead mb-1">{{substr($post->content, 0, 50)}}...</p>
                        <div class="d-flex justify-content-between align-items-center pb-2">
                        </div>
                    </div>
                    @if(!is_null($post->img))
                        <img class="card-img-bottom" src="/storage/{{$post->img}}" alt="Card image cap">
                    @endif
                </div>
            </div>
        @endforeach
        <div class="col-md-12">{{$posts->links()}}</div>

    </div>

@endsection
