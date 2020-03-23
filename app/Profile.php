<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = ['about', 'dob', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
