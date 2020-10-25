<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top p-1 border-bottom">
    <div class="container" style="padding-left: 7%; padding-right: 7%;">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(Auth::user())
                    <a class="navbar-brand text-muted text-monospace" style="font-size: 25px"
                       href="{{ route("post.index") }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                @else
                    <a class="navbar-brand text-muted text-monospace" style="font-size: 25px"
                       href="{{ route("home") }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @if(Auth::user())
                    <li class="nav-item ">
                        <a class="mr-4 text-decoration-none" style="font-size: 20px;" href="{{url('/post')}}">
                            <svg height="25px" viewBox="0 1 511 511.999" xmlns="http://www.w3.org/2000/svg">
                                <path d="m498.699219 222.695312c-.015625-.011718-.027344-.027343-.039063-.039062l-208.855468-208.847656c-8.902344-8.90625-20.738282-13.808594-33.328126-13.808594-12.589843 0-24.425781 4.902344-33.332031 13.808594l-208.746093 208.742187c-.070313.070313-.144532.144531-.210938.214844-18.28125 18.386719-18.25 48.21875.089844 66.558594 8.378906 8.382812 19.441406 13.234375 31.273437 13.746093.484375.046876.96875.070313 1.457031.070313h8.320313v153.695313c0 30.417968 24.75 55.164062 55.167969 55.164062h81.710937c8.285157 0 15-6.71875 15-15v-120.5c0-13.878906 11.292969-25.167969 25.171875-25.167969h48.195313c13.878906 0 25.167969 11.289063 25.167969 25.167969v120.5c0 8.28125 6.714843 15 15 15h81.710937c30.421875 0 55.167969-24.746094 55.167969-55.164062v-153.695313h7.71875c12.585937 0 24.421875-4.902344 33.332031-13.8125 18.359375-18.367187 18.367187-48.253906.027344-66.632813zm-21.242188 45.421876c-3.238281 3.238281-7.542969 5.023437-12.117187 5.023437h-22.71875c-8.285156 0-15 6.714844-15 15v168.695313c0 13.875-11.289063 25.164062-25.167969 25.164062h-66.710937v-105.5c0-30.417969-24.746094-55.167969-55.167969-55.167969h-48.195313c-30.421875 0-55.171875 24.75-55.171875 55.167969v105.5h-66.710937c-13.875 0-25.167969-11.289062-25.167969-25.164062v-168.695313c0-8.285156-6.714844-15-15-15h-22.328125c-.234375-.015625-.464844-.027344-.703125-.03125-4.46875-.078125-8.660156-1.851563-11.800781-4.996094-6.679688-6.679687-6.679688-17.550781 0-24.234375.003906 0 .003906-.003906.007812-.007812l.011719-.011719 208.847656-208.839844c3.234375-3.238281 7.535157-5.019531 12.113281-5.019531 4.574219 0 8.875 1.78125 12.113282 5.019531l208.800781 208.796875c.03125.03125.066406.0625.097656.09375 6.644531 6.691406 6.632813 17.539063-.03125 24.207032zm0 0"/>
                            </svg>
                        </a>
                    </li>
                @endif
                <li class="nav-item ">
                    <a class="mr-4 text-decoration-none" style="font-size: 20px;" href="{{url('/about')}}">
                        <svg id="Layer_1" enable-background="new 0 0 512 512" height="25px" viewBox="0 0 512 512"
                             xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path d="m256 512c-68.38 0-132.667-26.628-181.02-74.98s-74.98-112.64-74.98-181.02 26.628-132.667 74.98-181.02 112.64-74.98 181.02-74.98 132.667 26.628 181.02 74.98 74.98 112.64 74.98 181.02-26.628 132.667-74.98 181.02-112.64 74.98-181.02 74.98zm0-480c-123.514 0-224 100.486-224 224s100.486 224 224 224 224-100.486 224-224-100.486-224-224-224z"/>
                                <path d="m256 368c-8.836 0-16-7.164-16-16 0-40.386 15.727-78.354 44.285-106.912 17.872-17.873 27.715-41.635 27.715-66.911 0-27.668-22.509-50.177-50.177-50.177h-3.646c-27.668 0-50.177 22.509-50.177 50.177v5.823c0 8.836-7.164 16-16 16s-16-7.164-16-16v-5.823c0-45.313 36.864-82.177 82.177-82.177h3.646c45.313 0 82.177 36.864 82.177 82.177 0 33.823-13.171 65.622-37.088 89.539-22.514 22.513-34.912 52.446-34.912 84.284 0 8.836-7.164 16-16 16z"/>
                                <path d="m256.02 432c-8.836 0-16.005-7.164-16.005-16s7.158-16 15.995-16h.01c8.836 0 16 7.164 16 16s-7.164 16-16 16z"/>
                            </g>
                        </svg>
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-secondary">{{ __('Sign In') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-sm btn-outline-secondary ml-2"
                               href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        </li>
                    @endif
                @else

{{--                    Notification--}}

                    @include("layouts.notification")

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="text-muted text-decoration-none" style="font-size: 17px" href="#"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(!is_null(Auth::user()->profile->profile_img))
                                <div class=" overflow-hidden d-flex justify-content-center align-items-center position-relative"
                                     style="height: 33px; width: 33px; border: 1.5px solid #000000; border-radius: 50%; background-color: rgba(255,255,0,0)">

                                    <img src="/storage/{{Auth::user()->profile->profile_img}}" alt="img"
                                         style="height: 100%; width: auto;">
                                    <div class="d-flex justify-content-center align-items-center position-absolute"
                                         style="height: 33px; width: 33px; border: 3px solid #ffffff; border-radius: 50%;">
                                    </div>
                                </div>
                            @else
                                <span class="caret">{{ Auth::user()->user_name }} </span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/profile/'.Auth::user()->id) }}"> Profile </a>
                            <a class="dropdown-item" href="{{ route("profile.edit", Auth::user()->id)}}"> Settings </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
