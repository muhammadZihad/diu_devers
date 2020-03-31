<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    // public $with = ['user'];
    protected $fillable = ['content', 'link', 'img'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
