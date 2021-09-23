<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;

class PostsController extends Controller
{
    public function show($slug)
    {
            //$post = DB::table('posts')->where('slug',$slug)->first();
            $post = Post::where('slug',$slug)->firstOrFail(); //igual que el anterior pero mas limpio

            //capturar error si no existe el post
            //if (!$post){
            //    abort(404);
           // } 

           return view('post',[
             'post' => $post
            ]);

    }
}
