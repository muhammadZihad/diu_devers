<?php

namespace App\Traits;

use App\Friendship;
use App\Post;
use App\User;

trait Friendable
{

    public function add_friend($req_to)   //_________________ Add Friend Request
    {
        $frndshp = Friendship::create([
            'req_to' => $req_to,
            'req_by' => $this->id
        ]);

        if ($frndshp) {
            return response()->json('ok', 200);
        }
        return response()->json('fail', 501);
    }

    public function accept_friend($req_by)     //_________________ Accept Friend Request
    {
        $frndshp = Friendship::where('req_by', $req_by)->where('req_to', $this->id)->first();

        if ($frndshp) {
            $frndshp->status = 1;
            $frndshp->save();
            return response()->json('ok', 200);
        }
        return response()->json('fail', 501);
    }

    public function unfriend($id)     //_________________ Unfriend
    {
        $GLOBALS['id_for_check'] = $id;
        $frndshp =  Friendship::where('status', 1)->where(function ($q1) {
            $q1->where('req_by', $this->id)->where('req_to', $GLOBALS['id_for_check']);
        })->orWhere(function ($q) {
            $q->where('req_by', $GLOBALS['id_for_check'])->where('req_to', $this->id);
        })->first();

        if ($frndshp) {
            $frndshp->delete();
            return response()->json('ok', 200);
        }
        return response()->json('fail', 501);
    }

    public function cancel_request($id)
    {
        $GLOBALS['id_for_check'] = $id;
        $data = Friendship::where('status', 0)->where(function ($q1) {
            $q1->where('req_by', $this->id)->where('req_to', $GLOBALS['id_for_check']);
        })->orWhere(function ($q) {
            $q->where('req_by', $GLOBALS['id_for_check'])->where('req_to', $this->id);
        })->first();
        if ($data->delete()) {
            return response()->json('ok', 200);
        } else {
            return response()->json('fail', 501);
        }
    }

    public function friends()
    {
        $frnds = array();

        $f1 = Friendship::where('status', 1)->where(function ($q) {
            $q->where('req_to', $this->id)->orWhere('req_by', $this->id);
        })->get();
        $ids = array();
        foreach ($f1 as $ff) {
            $ff->req_by == $this->id ? array_push($ids, $ff->req_to) : array_push($ids, $ff->req_by);
        }
        return User::whereIn('id', $ids)->get();
    }
    public function friends_paginate()
    {
        $ids = array();
        $result = array();
        $f1 = Friendship::where('status', 1)->where(function ($q) {
            $q->where('req_to', $this->id)->orWhere('req_by', $this->id);
        })->paginate(1);
        foreach ($f1 as $ff) {
            if ($ff->req_by != $this->id) {
                array_push($ids, $ff->req_by);
            } else {
                array_push($ids, $ff->req_to);
            }
        }
        $result["data"] = User::whereIn('id', $ids)->get();
        $result["first"] = $f1->onFirstPage();
        $result["prev"] = $f1->previousPageUrl();
        $result["next"] = $f1->nextPageUrl();
        $result["more"] = $f1->hasMorePages();
        return $result;
    }

    public function friend_requests()
    {
        $result = array();
        $frnds = array();
        $link = array();
        $f1 = Friendship::where('status', 0)->where('req_to', $this->id)->paginate(1);
        // return $f1->nextPageUrl();
        foreach ($f1 as $ff) {
            array_push($frnds, User::find($ff->req_by));
        }
        $result["data"] = $frnds;
        $result["first"] = $f1->onFirstPage();
        $result["prev"] = $f1->previousPageUrl();
        $result["next"] = $f1->nextPageUrl();
        $result["more"] = $f1->hasMorePages();
        return $result;
    }

    public function friend_ids()
    {
        return collect($this->friends())->pluck('id')->toArray();
    }

    public function is_friend($user_id)
    {
        if (in_array($user_id, $this->friend_ids())) {
            return response()->json('true', 200);
        } else {
            return response()->json('false', 200);
        }
    }
    public function check_status($id)
    {
        $GLOBALS['id_for_check'] = $id;
        $data = Friendship::where(function ($q1) {
            $q1->where('req_by', $this->id)->where('req_to', $GLOBALS['id_for_check']);
        })->orWhere(function ($q) {
            $q->where('req_by', $GLOBALS['id_for_check'])->where('req_to', $this->id);
        })->first();
        if ($data) {
            if ($data->status == 1) {
                return 0;
            } elseif ($data->req_by == $this->id) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return -1;
        }
    }

    public function f_post()
    {
        $ids = array();
        $result = array();
        $f1 = Friendship::where('status', 1)->where(function ($q) {
            $q->where('req_to', $this->id)->orWhere('req_by', $this->id);
        })->get();
        foreach ($f1 as $ff) {
            $ff->req_by == $this->id ? array_push($ids, $ff->req_to) : array_push($ids, $ff->req_by);
        }
        $result = Post::whereIn('user_id', $ids)->orderBy('created_at', 'Desc')->with('user:id,name,avatar,slug')->paginate(5);
        return $result;
    }
}
