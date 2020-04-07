<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    //
    // public $with = ['user'];
    protected $fillable = ['content', 'link', 'img', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
    public function getAvatarAttribute($avatar)
    {
        return asset(Storage::url($avatar));
    }
}
