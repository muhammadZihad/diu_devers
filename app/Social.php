<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        $this->belongsToMany(User::class)->withPivot('link');
    }
}
