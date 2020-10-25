@foreach($posts as $post)

    <div class="col-md-8 pb-1">

        <div class="card mb-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center ml-3 mt-3">

                    {{--                            post user info--}}
                    <div>
                        <a class="text-decoration-none"
                           href="{{ url('/profile/'.$post->user->profile->user_id)}}">
                            <div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
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

                        {{--                                    post creation time--}}

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
                </div>

                {{--                        post option--}}

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

            {{--                    post content--}}


            @if(is_null($post->img))
                <div class="card-body p-0 ml-3 mr-3">
                    <div class="d-flex justify-content-between align-items-center pb-2">
                        <div class="lead pb-3 pt-3" style="font-size: 30px; letter-spacing: 1px;">
                            @if(strlen($post->content)>=100)
                                {!! nl2br(e(substr($post->content, 0, 100))) !!}
                                <a class="text-muted text-decoration-none"
                                   style="font-size: 20px; letter-spacing: normal;"
                                   href="{{route("post.show", [$post->id])}}">
                                    ....continue reading
                                </a>
                            @else
                                {!! nl2br(e($post->content)) !!}
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="card-body p-0 ml-3 mr-3">
                    <div class="d-flex justify-content-between align-items-center pt-2">
                        <div class="lead" style="font-size: 18px; letter-spacing: 1px;">
                            @if(strlen($post->content)>=100)
                                {!! nl2br(e(substr($post->content, 0, 100))) !!}
                                <a class="text-muted text-decoration-none"
                                   style="font-size: 14px; letter-spacing: normal;"
                                   href="{{route("post.show", [$post->id])}}">
                                    ....continue reading
                                </a>
                            @else
                                {!! nl2br(e($post->content)) !!}
                            @endif
                        </div>
                    </div>
                </div>
                <img class="card-img-bottom" src="/storage/{{$post->img}}" alt="Card image cap">
            @endif

            {{--                        like--}}

            <div class="card-footer pt-2 pb-2 mb-2 border-bottom">
                <like post-id="{{$post->id}}" likes="{{count($post->likes)}}"
                      comments="{{count($post->comments)}}" data-target="#likeModal{{$post->id}}"></like>
            </div>


            {{--                    comment section--}}

            <Comment csrf="{{csrf_token()}}" user-id="{{Auth::user()->id}}"
                     user-name="{{Auth::user()->user_name}}" post-id="{{$post->id}}"
                     user-img="{{Auth::user()->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
                     url="{{url()->current()}}"></Comment>

            <!-- All Modal -->

            <div class="modal fade" id="likeModal{{$post->id}}" tabindex="-1"
                 aria-labelledby="likeModal{{$post->id}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header pb-0">
                            <h4>People Who Liked This Post:</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body scrollbar scrollbar-secondary">
                            @foreach($post->likes as $user)
                                <table class="table table-sm table-borderless border-bottom m-0">
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <a class="text-decoration-none"
                                                       href="{{ url('/profile/'.$user->profile->user_id)}}">
                                                        <div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                                             style="height: 35px; width: 35px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                                                            <img src="/storage/{{$user->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
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
                                                        <a class="text-decoration-none lead text-dark"
                                                           style="font-size: 18px;"
                                                           href="{{ url('/profile/'.$user->profile->user_id)}}">
                                                            {{ $user->user_name}}
                                                        </a>
                                                    </div>

                                                    {{--                                    name--}}

                                                    <div class="p-0 text-muted">
                                                        <a class="text-decoration-none text-muted"
                                                           style="font-size: 14px;"
                                                           href="{{ url('/profile/'.$user->profile->user_id)}}">
                                                            {{ $user->name}}
                                                        </a>
                                                    </div>
                                                </div>
                                                @if($user->id !== Auth::user()->id)
                                                    <follow user-id="{{$user->id}}"
                                                            follows="{{Auth::user()->following->contains($user->profile)}}"></follow>
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


@endforeach