<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
