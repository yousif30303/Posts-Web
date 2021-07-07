<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $req,Post $post)
    {
        $post->likes()->create([
            'user_id'=> $req->user()->id
        ]);

        return redirect()->route('posts');
    }

    public function destroyLike(Request $req,Post $post)
    {
        $post->likes()->where('user_id','=',$req->user()->id)->delete();

        return redirect()->route('posts');
    }
}
