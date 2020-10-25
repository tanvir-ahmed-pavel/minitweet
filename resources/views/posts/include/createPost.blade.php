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
                                <textarea style="font-size: 25px;" rows="2" class="form-control border-0" name="content"
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