<div class="col-md-4 mb-5 d-none d-sm-block">
    <div class="pb-5 pl-4 mb-4 ">
        <div class="position-fixed">
            <div class="d-flex align-items-center">
                <div>
                    <a class="text-decoration-none"
                       href="{{ url('/profile/'.Auth::user()->profile->user_id)}}">
                        <div class="overflow-hidden d-flex justify-content-center align-items-center position-relative"
                             style="height: 50px; width: 50px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                            <img src="/storage/{{Auth::user()->profile->profile_img ?? "profile_imgs/default-avatar.png"}}"
                                 alt="img"
                                 style="height: 100%; width: auto;">
                            <div class="d-flex justify-content-center align-items-center position-absolute"
                                 style="height: 48px; width: 48px; border: 2px solid #ffffff; border-radius: 50%;">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="ml-3">
                    <div class="p-0 m-0">
                        <a class="text-decoration-none lead text-dark" style="font-size: 20px;"
                           href="{{ url('/profile/'.Auth::user()->profile->user_id)}}">{{ Auth::user()->user_name}}
                        </a>
                    </div>

                    {{--                                  Auth  name--}}

                    <div class="p-0 text-muted">
                        <a class="text-decoration-none lead text-dark" style="font-size: 14px;"
                           href="{{ url('/profile/'.Auth::user()->profile->user_id)}}">
                            {{ Auth::user()->name}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--                Scrollable Section--}}

    <div class="position-fixed">
        <h5 class="ml-5 ">Suggestions:</h5>
        <div class="overflow-auto scrollbar scrollbar-secondary thin"
             style="max-height: 350px; max-width: 500px; background-color: transparent;">
            @if(count($suggestions)>0)
                @foreach($suggestions as $user)
                    <table class="table m-0">
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
                                            <a class="text-decoration-none text-muted" style="font-size: 14px;"
                                               href="{{ url('/profile/'.$user->profile->user_id)}}">
                                                {{ $user->name}}
                                            </a>
                                        </div>
                                    </div>
                                    <follow user-id="{{$user->id}}"
                                            follows="{{Auth::user()->following->contains($user->profile)}}"></follow>
                                </div>
                            </td>
                        </tr>
                    </table>
                @endforeach
            @else
                <h5 class="pt-4 border-top">No suggestions for now.</h5>
            @endif

        </div>
        <footer class="blog-footer text-center position-fixed" style="padding: 20px; margin-left: 4%; margin-top: 360px;">
            <p class="text-muted">Blog template built for ©{{config('app.name', 'Pinstagram')}}<br> By Pavel Ahmed® 🐸🐸</p>
        </footer>
    </div>

</div>
