<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Message;
use Laravolt\Avatar\Facade as Avatar;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_name',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user){
            $fpath = 'storage/profile_imgs/'.$user->id.$user->user_name.'.png';
            $path = 'profile_imgs/'.$user->id.$user->user_name.'.png';
            Avatar::create($user->user_name)->save($fpath);
            $user->profile()->create([
                "profile_img" => $path,
            ]);
        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages(){
        return $this->hasMany('App\Message')->orderBy("updated_at", "desc");
    }
    public function profile(){
        return $this->hasOne("App\Profile");
    }

    public function following()
    {
        return $this->belongsToMany("App\Profile");
    }

    public function likes()
    {
        return $this->belongsToMany("App\Message");
    }

    public function comments()
    {
        return $this->hasMany("App\Comment");
    }

}
