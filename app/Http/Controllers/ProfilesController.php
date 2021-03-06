<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {

//        Notification Delete
        $count = Auth::user()->readNotifications->count()-30;
        if ($count>0){
            $notifications = Auth::user()->readNotifications->sortBy('created_at')->take($count);
            foreach ($notifications as $notification){
                $notification->delete();
            }
        }

//        Suggestions

        $all_users= User::all();

        $suggestions=[];
        foreach ($all_users as $s_user){
            if(!Auth::user()->following->contains($s_user->profile->id) && Auth::user()->id !== $s_user->profile->user_id){
                $suggestions[]=$s_user;
            }
        }

//        post

        $posts = $user->messages()->paginate(6);

        $follows = (Auth::user()) ? Auth::user()->following->contains($user->profile) : false;
        $users=[];
        foreach ($user->following as $following){
            $users[]= User::find($following->user_id);
        }

//        $posts = User::find($user_id)->messages()->orderBy("updated_at", "desc")->paginate(8);

        return view('profiles.profile', [
            "user" => $user,
            "users" => $users,
            "posts" => $posts,
            "follows" => $follows,
            "suggestions" => $suggestions,
        ]);
    }

    public function edit( $id)
    {

        $user = User::findOrFail($id);

        if(Auth::user()->id == $user->profile->user_id) {
            return view('profiles.edit', [
                "user" => $user
            ]);
        } else {
            return redirect("/profile/".Auth::user()->profile->user_id)->with("error", "Unauthorized Page!!");
        }

    }


    public function update (Request $request, $id)
    {
        $user = User::findOrfail($id);
        $data = $this->validate($request, [
            "title" => "",
            "description" => "",
            "profile_img" => "image",
            "url" => "",
        ]);

        $img_path = $request->file("profile_img");

        if (Auth::user()->id == $user->profile->user_id){
            if (!is_null($img_path)) {
                $img_path = $request->file("profile_img")->store("profile_imgs", 'public');
                $user->profile()->update([
                    "title" => $data["title"],
                    "url" => $data["url"],
                    "description" => $data["description"],
                    "profile_img" => $img_path,
                ]);
            } else {
                $user->profile()->update([
                    "title" => $data["title"],
                    "url" => $data["url"],
                    "description" => $data["description"],
                ]);
            }
            return redirect("/profile/".$user->profile->user_id."/edit")->with("success", "Profile Updated");
        } else {
            return redirect("/profile/".$user->profile->user_id)->with("error", "Unauthorized Page!!");
        }

        // old reference

//        $profile = Profile::find($id);
//        $profile->title = $request->input("title");
//        $profile->description = $request->input("description");
//        if (Auth::user()->id == $profile->user_id){
//            $profile->save();
//            return redirect("/profile/".$profile->id)->with("success", "Profile Updated");
//        } else {
//            return redirect("/profile/".$profile->id)->with("error", "Unauthorized Page!!");
//        }

    }


}
