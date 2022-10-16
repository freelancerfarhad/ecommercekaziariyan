<?php

namespace App\Http\Controllers;


use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostIndexController extends Controller
{
    public function index()
    {
       $posts = Post::latest()->approved()->publisted()->paginate(6);
        return view('allposts',compact('posts'));
    }
    public function details($slug)
    {
        $post=Post::where('slug',$slug)->approved()->publisted()->first();
        $blogkey='blog_'.$post->id;
        if(!Session::has($blogkey)){
            $post->increment('view_count');
            Session::put($blogkey,1);
        }
        // $randompost=Post::all()->random(3);
        $randompost=Post::approved()->publisted()->take(3)->inRandomOrder()->get();
  
        return view('post',compact('post','randompost'));
    }
    public function CategoryByPost($slug)
    {
        $category=Category::where('slug',$slug)->first();
        $posts=$category->posts()->approved()->publisted()->get();
        return view('category',compact('category','posts'));
    }
    public function TagsByPost($slug)
    {
        $tags=Tag::where('slug',$slug)->first();
        $posts=$tags->posts()->approved()->publisted()->get();
        return view('tagpost',compact('tags','posts'));
    }
}
