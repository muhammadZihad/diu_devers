<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Skill;
use App\Social;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function welcome()
    {
        $skill = Skill::all()->sortBy('name');
        return view('welcome.welcome')->with('skills', $skill);
    }

    public function welcome_store(Request $request)
    {
        $request->validate([
            'about' => 'required|max:350',
            'skills' => 'required',
            'l_i' => 'required',
            'git' => 'required'
        ]);
        $ids = [];
        $skills = Skill::all();
        $sids = $skills->pluck('id');
        $snames = $skills->pluck('name');

        foreach ($request->skills as $skill) {
            if ((int) $skill) {
                if (in_array((int) $skill, $sids->toArray())) {
                    array_push($ids, (int) $skill);
                }
            } else {
                $n_skill = Skill::create(['name' => $skill]);
                array_push($ids, $n_skill->id);
            }
        }
        $u = User::find(auth()->user()->id);
        $u->skills()->sync($ids);
        $p = new Profile;
        $p->about = $request->about;
        $u->profile()->save($p);
        $sc = new Social;
        $sc->fb = $request->fb;
        $sc->l_i = $request->l_i;
        $sc->git = $request->git;
        $u->social()->save($sc);

        $u->complete_setup = 1;
        $u->save();
        return redirect(route('home'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('profile.single')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('profile.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
