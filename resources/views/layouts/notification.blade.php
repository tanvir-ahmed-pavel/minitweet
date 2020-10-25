<li class="nav-item dropdown mr-3">
    <a id="navbarDropdown" class="text-muted text-decoration-none" style="font-size: 17px" href="#"
       role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <i class="far fa-bell text-dark mt-1" style="font-size: 28px;"></i>
        @if(count(Auth::user()->unreadNotifications)>0)
            <small class="badge badge-danger">{{count(Auth::user()->unreadNotifications)}}</small>
        @endif
    </a>

    @if(count(Auth::user()->notifications) > 0)
        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
            <div class="scrollbar-secondary thin overflow-auto"
                 style="width: 350px; max-height:450px;">
                @foreach(Auth::user()->notifications as $notification)
                    @if($notification->read())
                        <div class="pb-2 pl-2 pr-2 pt-2">
                            <a href="{{url('/n/readSingle/'.$notification->id)}}"
                               class="text-decoration-none">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                             style="height: 40px; width: 40px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">
                                            <img src="/storage/{{\App\User::find($notification->data['id'])->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
                                                 alt="img"
                                                 style="height: 100%; width: auto;">
                                            <div class="d-flex justify-content-center align-items-center position-absolute"
                                                 style="height: 38px; width: 38px; border: 2px solid #ffffff; border-radius: 50%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pl-2 text-dark">
                                        <b>{{\App\User::find($notification->data['id'])->user_name}}</b> {{$notification->data['text']}}
                                        <br>
                                        <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="pb-2 pl-2 pr-2 pt-2"
                             style="background-color: #f5f5f5">
                            <a href="{{url('/n/readSingle/'.$notification->id)}}"
                               class="text-decoration-none">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                             style="height: 40px; width: 40px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">
                                            <img src="/storage/{{\App\User::find($notification->data['id'])->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
                                                 alt="img"
                                                 style="height: 100%; width: auto;">
                                            <div class="d-flex justify-content-center align-items-center position-absolute"
                                                 style="height: 38px; width: 38px; border: 2px solid #ffffff; border-radius: 50%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pl-2">
                                        <b>{{\App\User::find($notification->data['id'])->user_name}}</b> {{$notification->data['text']}}
                                        <br>
                                        <small class="text-muted">{{$notification->created_at->diffForHumans()}}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="border-top">
                <a class="text-decoration-none float-right text-info pr-2"
                   href="{{url('/n/readAll')}}">Mark all as read</a>
            </div>
        </div>
    @else
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <h5 class="pl-3 pr-3 pt-1 text-info">No Notification</h5>
        </div>
    @endif

</li>