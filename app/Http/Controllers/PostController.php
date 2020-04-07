<?php

namespace App\Http\Controllers;

use App\Likes;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        return auth()->user()->f_post();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:250',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image->store('post');
        }
        $id = Auth::id();
        $post = Post::create([
            'content' => $request->content,
            'user_id' => $id,
            'link' => $request->link ?: 'null',
            'img' => $image ?: 'null'
        ]);
        return $post;
    }




    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function likeme($id, $type)
    {
        $like = new Likes;
        $like->post_id = $id;
        $like->user_id = auth()->user()->id;
        $like->type = $type;
        $like->save();
        // return response()->json(200, 'Like Done');
    }
    public function unlikeme($id)
    {
        $like = Likes::find($id);
        $like->delete();
        return 'Done';
    }
}
