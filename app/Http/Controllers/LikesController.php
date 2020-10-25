<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notifications\newLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $likes = Message::findOrFail($id)->likes->contains(Auth::user()->id);
//        $likes = Message::findOrFail($id)->get();
//        $likes = (Auth::user()) ? Message::findOrFail($id)->likedBy->contains(Auth::user()->id) : false;

        return $likes;

    }

    public function store(Request $request, $post)
    {
        $user = Message::find($post)->user;

//        Notification

        if (!Auth::user()->likes->contains($post) && Auth::user()->id !== $user->id){
            $user->notify(new newLike(Auth::user(), $post));
        }
        return Auth::user()->likes()->toggle($post);

    }

}
