<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function ShowPosts()
    {   $posts = Post::get();

        return view('posts.posts',[
            'posts'=>$posts
        ]);
    }


    public function Create(Request $req)
    {
        $req->validate([
            'body'=>'required'
        ]);


        auth()->user()->posts()->create([
            'body'=>$req->body
        ]);

        return redirect()->route('posts');
    }

    public function Destroy(Post $post)
    {
        $this->authorize('delete',$post);

        $post->delete();

        return back();
    }

    public function ShowProfile(Post $post)
    {
        $name = $post->user->name;

        $id = $post->user->id;

        $likes = $post->user->receivedLikes()->get();

        $posts = $post->where('user_id','=',$id)->get();

        return view('posts.profile',[
            'name'=>$name,
            'posts'=>$posts,
            'likes'=>$likes
        ]);
    }
}
