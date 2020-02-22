<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function socials()
    {
        return $this->belongsToMany(Social::class)->withPivot('link');
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user');
    }
    public function university()
    {
        return $this->hasOne(University::class);
    }

    public function interests()
    {
        return $this->belongsToMany(Skill::class, 'interest_user', 'user_id', 'skill_id');
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'following_user', 'user_id', 'following_id')->withTimestamps();
    }
}
