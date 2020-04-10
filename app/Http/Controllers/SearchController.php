<?php

namespace App\Http\Controllers;

use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index($key)
    {
        $res = User::where('complete_setup', 1)->where('name', 'regexp', $key . '[a-zA-Z]*')->paginate(5);
        return $res->toArray();
    }
    public function index2()
    {
        return view('sr.search');
    }
    public function search(Request $request)
    {
        $request->validate([
            'key'=>'required|string'
        ]);
        
        return view('sr.search')
            ->with('result', User::where('complete_setup', 1)->where('name','regexp',$request->key.'[a-zA-Z]*')->get())
            ->with('skills', $this->skills());
    }
    public function search2($sid)
    {
        return view('sr.search')
            ->with('result', Skill::find($sid)->users()->orderBy('name','asc')->get())
            ->with('skills', $this->skills())
            ->with('sid', $sid);
    }
    public function view()
    {
        return view('sr.search')->with('skills', $this->skills());
    }

    public function skills()
    {
        $skills = DB::table('skill_user')
            ->select(DB::raw('count(skill_id) as repetition, skill_id'))
            ->groupBy('skill_id')
            ->orderBy('repetition', 'desc')
            ->take(10)->get();
        $ids = $skills->pluck('skill_id');
        return Skill::find($ids);
    }
}
