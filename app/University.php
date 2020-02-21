<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    //

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
