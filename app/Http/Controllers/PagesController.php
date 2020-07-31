<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home () {
       return view("home");
    }

    public function about () {
        return view("about");
    }

}
