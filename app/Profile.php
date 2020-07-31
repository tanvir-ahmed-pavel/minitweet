<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'description', 'title', 'profile_img',
    ];

    public function user (){
        $this->belongsTo('App\User');
    }
}
