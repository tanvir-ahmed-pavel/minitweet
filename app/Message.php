<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Message extends Model
{

    protected $fillable = [
        'content', 'title', 'img',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

}
