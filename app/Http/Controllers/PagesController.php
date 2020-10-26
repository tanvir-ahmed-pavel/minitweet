<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home () {

        if (Auth::user()){
            return redirect(url('/post'));
        } else{
            return view("home");
        }

    }

    public function about () {
        return view("about");
    }

}
