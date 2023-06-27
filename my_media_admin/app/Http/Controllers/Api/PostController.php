<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function getAllPost(){
        $post = Post::get();
        return response()->json([
            'post' => $post
        ]);
    }
    public function postSearch(Request $request){
        $post = Post::where('title','like', '%'. $request->key. '%')->get();
        return response()->json([
            'searchValue' => $post
        ]);
    }

    public function postDetails(Request $request){
        $post = Post::where('post_id', $request->postId)->first();
        return response()->json([
            'post' => $post
        ]);
    }
}
