<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
//        $likes = Message::findOrFail($id)->likedBy->contains(Auth::user()->id);
//        $likes = Message::findOrFail($id)->get();
        $likes = (Auth::user()) ? Message::findOrFail($id)->likedBy->contains(Auth::user()->id) : false;

        return response()->json(['name' => 'Abigail',]);

    }

    public function store(Request $request, $id){

//        $a = Message::find($id)->likes->contains(Auth::user()->id);
        $a = Auth::user()->likes->contains($id);
//       $ok =  Auth::user()->likes()->create([

//           "message_id" => $id,
//       ]);
       dd($a);
    }

}
