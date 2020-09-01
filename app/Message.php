<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\User;

class Message extends Model
{

    protected $fillable = [
        'content', 'title', 'img',
    ];

    public function user(){
        return $this->belongsTo("App\User");
    }
    public function likes(){
        return $this->hasMany("App\Like");
    }
    public function comments(){
        return $this->hasMany("App\Comment");
    }

}
