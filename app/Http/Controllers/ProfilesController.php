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
    public function index($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->messages()->get();

//        $posts = User::find($user_id)->messages()->orderBy("updated_at", "desc")->paginate(8);

        return view('profiles.profile', [
            "user" => $user,
            "post" => $posts
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
            "profile_img" => "required|image",
            "url" => "",
        ]);

        $img_path = $request->file("profile_img")->store("profile_imgs", "public");

        if (Auth::user()->id == $user->profile->user_id){
            Auth::user()->profile()->update([
                "title" => $data["title"],
                "description" => $data["description"],
                "profile_img" => $img_path,
            ]);
            return redirect("/profile/".$user->profile->user_id)->with("success", "Profile Updated");
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