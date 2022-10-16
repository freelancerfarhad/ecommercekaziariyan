<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function Search(Request $request)
    {
        $query=$request->input('query');
       $posts=Post::where('title','LIKE',"%$query%")->approved()->publisted()->get();
       return view('searchs',compact('posts','query'));
    }
}
