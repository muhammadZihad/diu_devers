<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Friendship extends Model
{
    protected $fillable = ['req_by', 'req_to', 'status',];

    public function getAvatarAttribute($avatar)
    {
        return asset(Storage::url($avatar));
    }
}
