<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    //
    protected $fillable = ['post_id', 'type'];
    protected $with = ['user'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
