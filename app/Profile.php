<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{

    protected $fillable = [
        'description', 'title', 'profile_img',
    ];

    public function user()
    {
        return $this->belongsTo("App\Message");
    }

    public function followers()
    {
        return $this->belongsToMany("App\User");
    }

}
