<?php

namespace App;

use App\Traits\Friendable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'avatar'
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

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function completed()
    {
        return $this->complete_setup;
    }
    public function social()
    {
        return $this->hasOne(Social::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function hasSkill($sid)
    {
        return in_array($sid, $this->skills->pluck('id')->toArray());
    }
    public function university()
    {
        return $this->belongsTo(University::class);
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
    public function deleteImage()
    {
        unlink('storage/' . $this->avatar);
    }

    public function getAvatarAttribute($avatar)
    {
        return asset(Storage::url($avatar));
    }
}
