<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts=Post::orderBy('updated_at','desc')->get();
        return view('home',['posts'=>$posts]);
    }

public function postCreatePost(Request $request)
{
    $this->validate($request,[
        'body'=>'required|max:1000'
    ]);

    $post= new Post();
    $post->body=$request['body'];
    $message='Ķļūda pievienojot anekdoti';
    if ($request->user()->posts()->save($post)){
        $message='Anekdote pievienota';
    };

    return redirect()->route('home')->with(['message'=>$message]);
}
    public function getDeletePost($post_id){

        $post=Post::where('id',$post_id)->first();
        if(Auth::user()!=$post->user){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('home')->with(['message'=>'Raksts veiksmīgi dzēsts!']);
    }
   public function postEditPost(Request $request)
   {
       $this->validate($request, [
           'body'=>'required'
       ]);
       $post=Post::find($request['postId']);
        $post->body=$request['body'];
        $post->update();
        return response()->json(['new_body'=>$post->body],200);
    }
}