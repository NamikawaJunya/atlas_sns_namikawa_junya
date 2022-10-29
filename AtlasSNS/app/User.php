<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//フォロー
public function follow(Int $user_id)
{
    return $this->follows()->attach($user_id); //attachの意味は〜をつけるという意味。
}
//フォロー解除
public function unfollow(Int $user_id)
{
    return $this->follows()->detach($user_id); //detachの意味は〜を切り離すという意味
}
//フォローしているか
public function isfollowing($user_id)
{
    return(boolean) $this->follows()->where('followed_id',$user_id)->first(['id']); //booleanはプール値
}
}