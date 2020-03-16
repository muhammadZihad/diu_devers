<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function friends()
    {
        return Auth::user()->friends();
    }
    public function friends_paginate()
    {
        return Auth::user()->friends_paginate();
    }
    public function add_friend($id)
    {
        $resp =  auth()->user()->add_friend($id);
        User::find($id)->notify(new \App\Notifications\NewFriendRequest(Auth::user()));
        return $resp;
    }
    public function unfriend($id)
    {
        return auth()->user()->unfriend($id);
    }
    public function accept_friend($id)
    {
        return auth()->user()->accept_friend($id);
    }
    public function cancel_request($id)
    {
        return auth()->user()->cancel_request($id);
    }
    public function friendship_status($id)
    {
        return auth()->user()->check_status($id);
    }
    public function friend_requests($id)
    {

        return response()->json(auth()->user()->friend_requests(), 200);
    }
}
