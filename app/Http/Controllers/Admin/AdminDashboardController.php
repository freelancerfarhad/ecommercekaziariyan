<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        $popular_post=Post::withCount('comments')
                ->withCount('comments')
                ->withCount('favorite_to_user')
                ->orderBy('view_count','desc')
                ->orderBy('comments_count')
                ->orderBy('favorite_to_user_count')
                ->take(5)->get();//top  view and comment and like count
      $TotalPandingPost=Post::where('is_approved',0)->count();//all panding post count
         $AllViewCount=Post::sum('view_count');//all post ar view count
          $author_count=User::where('role_id',2)->count();
             $new_author_today=User::where('role_id',2)
                                    ->whereDate('created_at',Carbon::today())->count();
                $active_author=User::where('role_id',2)
                                ->withCount('posts')
                                ->withCount('comments')
                                ->withCount('favorite_posts')
                                ->orderBy('posts_count','desc')
                                ->orderBy('comments_count','desc')
                                ->orderBy('favorite_posts_count','desc')->get();    
               $category_count=Category::all()->count();
               $tag_count=Tag::all()->count();                               

        return view('admin.dashboard',compact('posts','popular_post','TotalPandingPost','AllViewCount','author_count','new_author_today','active_author','category_count','tag_count'));
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
