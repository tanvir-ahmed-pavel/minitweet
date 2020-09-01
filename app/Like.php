<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'created', 'message_id'
    ];
    public function message(){
        return $this->belongsTo("App\Message");
    }

    public function user(){
        return $this->belongsTo("App\User");
    }


}
