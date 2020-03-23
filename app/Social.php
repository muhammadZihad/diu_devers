<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    //
    protected $fillable = [
        'fb', 'l_i', 's_o', 'git'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);;
    }
}
