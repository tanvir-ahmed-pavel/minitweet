<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notifications\newPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //        Notification Delete

        $count = Auth::user()->readNotifications->count()-30;
        if ($count>0){
        $notifications = Auth::user()->readNotifications->sortBy('created_at')->take($count);
        foreach ($notifications as $notification){
            $notification->delete();
        }
        }

//        Post

       $posts = Message::orderBy("updated_at", "desc")->paginate(6);

        $users= User::all();

        $suggestions=[];
        foreach ($users as $user){
            if(!Auth::user()->following->contains($user->profile->id) && Auth::user()->id !== $user->profile->user_id){
                $suggestions[]=$user;
            }
        }



        return view("posts.index", [
            "posts" => $posts,
            "suggestions" => $suggestions,
        ]);

//        Reference
//        $liked = (Auth::user()) ? Auth::user()->likes()->contains($user->profile) : false;
//        dd($likes);
//        $likes = $posts->getLiked;
//        dd($likes);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("posts.create_post");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "content" => "required_without_all:img",
            "img" => "required_without_all:content|image",
        ]);

        $img_path = $request->file("img");
        if (!is_null($img_path)) {
            $img_path = $request->file("img")->store("post_imgs", 'public');
            Auth::user()->messages()->create([
                "content" => $data['content'],
                "img" => $img_path,
            ]);
        } else {
            Auth::user()->messages()->create([
                "content" => $data['content'],
            ]);
        }

//        Notification

        $users = Auth::user()->profile->followers;
        $post = Message::latest()->first()->id;

        foreach ($users as $user){
            $user->notify(new newPost(Auth::user(), $post));
        }

        return redirect("/post")->with("success", "Post Created!!");


        //Create Post old method for reference

//        $post = new Message();
//        $post->title = $request->input('title');
//        $post->content = $request->input('content');
//        $post->img = $request->input('img');
//        $post->user_id = Auth::user()->id;
//        $post->save();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Message $post)
    {
//        $post = Message::findOrfail($id);
        return view("posts.show", [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Message::findOrFail($id);
        if (Auth::user()->id == $post->user_id) {
            return view("posts.edit", [
                "post" => $post
            ]);
        } else {
            return redirect("/post/" . $post->id)->with("error", "Unauthorized Page!!");
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $post = Message::find($id);

        // Update Post

        if (Auth::user()->id == $post->user_id) {
            $data = $this->validate($request, [
                "content" => "",
            ]);
            $post->update([
                "content" => $data['content'],
            ]);
            return redirect("/post")->with("success", "Post Updated!!");
        } else {
            return redirect("/post/" . $post->id)->with("error", "Unauthorized Page!!");
        }


//        $post->content = $request->input("content");
//        $post->img = $request->input('img');
//        if (Auth::user()->id == $post->user_id){
//            $post->save();
//            return redirect("/dashboard")->with("success", "Post Updated");
//        } else {
//            return redirect("/post/".$post->id)->with("error", "Unauthorized Page!!");
//        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Message::find($id);

        if (Auth::user()->id == $post->user_id) {
            $post->delete();
            return redirect("/post")->with("success", "Post Deleted!!");
        } else {
            return redirect("/post/" . $post->id)->with("error", "Unauthorized Page!!");
        }

    }
}
