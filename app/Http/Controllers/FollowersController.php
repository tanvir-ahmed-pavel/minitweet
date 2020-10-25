<?php

namespace App\Http\Controllers;

use App\Notifications\newFollower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        if (!Auth::user()->following->contains($user->profile)){
            $user->notify(new newFollower(Auth::user()));
        }
        return Auth::user()->following()->toggle($user->profile);
    }
}
