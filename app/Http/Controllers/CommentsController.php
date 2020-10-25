<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Message;
use App\Notifications\newComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index($id)
    {

        $commentsCount = Message::findOrFail($id)->comments()->count();
        $comments = Message::findOrFail($id)->comments()->orderBy('created_at', 'desc')->latest()->take(2)->get();
        $user = [];
        foreach ($comments as $comment) {
            $user[] = $comment->user->profile;
        }
        $comments->merge($user);

        return response()->json(array(
            'comments' => $comments,
            'commentsCount' => $commentsCount,
        ));

//        $likes = Message::findOrFail($id)->likes()->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, $post)
    {
        $data = $this->validate($request, [
            "comment" => "required",
        ]);
        Message::find($post)->comments()->create([
            'comment' => $data['comment'],
            'user_id' => Auth::user()->id,
        ]);

//        Notification

        $user = Message::find($post)->user;
        if (Auth::user()->id !== $user->id) {
            $user->notify(new newComment(Auth::user(), $post));
        }

        return response()->json("cmnt created");

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $commentsCount = Message::findOrFail($id)->comments()->count();
        $comments = Message::findOrFail($id)->comments()->orderBy('created_at', 'desc')->latest()->get();
        $user = [];
        foreach ($comments as $comment) {
            $user[] = $comment->user->profile;
        }
        $comments->merge($user);

        return response()->json(array(
            'comments' => $comments,
            'commentsCount' => $commentsCount,
        ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (Auth::user()->id == $comment->user_id) {
            $comment->delete();
            return response()->json([
                'msg' => 'Deleted'
            ]);
        } else {
            return response()->json([
                'msg' => 'U cant delete dis!!'
            ]);
        }
    }
}
