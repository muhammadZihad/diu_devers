<?php

namespace App\Traits;

use App\Friendship;
use App\User;

trait Friendable
{

    public function add_friend($req_to)
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

    public function accept_friend($req_by)
    {
        $frndshp = Friendship::where('req_by', $req_by)->where('req_to', $this->id)->first();

        if ($frndshp) {
            $frndshp->status = 1;
            $frndshp->save();
            return response()->json('ok', 200);
        }
        return response()->json('fail', 501);
    }

    public function friends()
    {
        $frnds1 = array();
        $frnds2 = array();

        // -------- This is for getting all friends together
        // $f1 = Friendship::where('status', 1)->where(function ($q) {
        //     $q->where('req_by', $this->id)->orWhere('req_to', $this->id);
        // })->get();

        $f1 = Friendship::where('status', 1)->where('req_to', $this->id)->get();
        foreach ($f1 as $ff) {
            array_push($frnds1, User::find($ff->req_by));
        }
        $f2 = Friendship::where('status', 1)->where('req_by', $this->id)->get();
        foreach ($f2 as $ff) {
            array_push($frnds2, User::find($ff->req_to));
        }
        return array_merge($frnds1, $frnds2);
    }

    public function friend_requests()
    {
        $frnds1 = array();

        $f1 = Friendship::where('status', 0)->where('req_to', $this->id)->get();
        foreach ($f1 as $ff) {
            array_push($frnds1, User::find($ff->req_by));
        }
        return $frnds1;
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
}
