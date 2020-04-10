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
        $ids = auth()->user()->friends();
        array_push($ids, Auth::id());
        $posts = Post::whereIn('user_id', $ids)->orderBy('created_at', 'Desc')->with('user:id,name,avatar,slug')->paginate(5);
        return $posts;
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
            'avatar' => $image ?: 'null'
        ]);
        return redirect(route('home'));
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
        if ($like->save()) {
            return response()->json("success", 200);
        }
        return response()->json("error", 501);
    }
    public function unlikeme($id, $type)
    {
        $like = Likes::where('post_id', $id)->where('user_id', auth()->user()->id)->where('type', $type)->first();
        if ($like->delete()) {
            return response()->json("success", 200);
        }
        return response()->json("error", 501);
    }
}
