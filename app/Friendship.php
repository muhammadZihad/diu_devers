<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = ['req_by', 'req_to', 'status',];
}
