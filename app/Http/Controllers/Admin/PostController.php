<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subscriver;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewPostNotiry;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AuthorPostApproved;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::latest()->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'thumbnail' => 'mimes:jpeg,png,jpg',
            'category' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

           // get form image
           $image = $request->file('thumbnail');
        
           $slug = Str::slug($request->title);
   
       if (isset($image))
       {
           $imagename =$slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(1600,1066)->save('public/storage/post/'.$imagename);
       } else {
           $imagename = "default.png";
       }
   
         $post = new Post();
             $post->user_id =Auth::id();
              $post->title = $request->title;
              $post->slug = $slug;
              $post->thumbnail = $imagename;
              $post->body =$request->body;
              if(isset($request->status)){
                $post->status=true;
              }else{
                $post->status=false;
              }
              $post->is_approved = true;
              $post->save();
             $post->categories()->attach($request->category);
             $post->tags()->attach($request->tags);
              $subscrivers=Subscriver::all();
              foreach($subscrivers as $subscriver){
                Notification::route('mail',$subscriver->email)->notify(new NewPostNotiry($post));
              }
              Toastr::success('Post Successfully Saved :)' ,'Success');
              return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('admin.post.edit',compact('categories','tags','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' => 'required',
            'thumbnail' => 'mimes:jpeg,png,jpg',
            'category' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

           // get form image
           $image = $request->file('thumbnail');
        
           $slug = Str::slug($request->title);
        
       if (isset($image))
       {
        $deletedData='public/storage/post/'.$post->thumbnail;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
        $imagename =$slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1600,1066)->save('public/storage/post/'.$imagename);
       } else {
           $imagename = "default.png";
       }
   
   
             $post->user_id =Auth::id();
              $post->title = $request->title;
              $post->slug = $slug;
              $post->thumbnail = $imagename;
              $post->body =$request->body;
              if(isset($request->status)){
                $post->status=true;
              }else{
                $post->status=false;
              }
              $post->is_approved = true;
              $post->update();
             $post->categories()->sync($request->category);
             $post->tags()->sync($request->tags);

              Toastr::success('Post Successfully Updated :)' ,'Success');
              return redirect()->route('post.index');
    }
    public function panding()
    {
        $posts=Post::where('is_approved',false)->get();
        return view('admin.post.panding',compact('posts'));
    }
    public function approved($id)
    {
       $post=Post::find($id);
       if($post->is_approved==false){
        $post->is_approved=true;
        $post->save();
        $post->user->notify(new AuthorPostApproved($post));
        $subscrivers=Subscriver::all();
        foreach($subscrivers as $subscriver){
          Notification::route('mail',$subscriver->email)->notify(new NewPostNotiry($post));
        }
        Toastr::success('Post Approved Successfully :)' ,'Success');
       }else{
        Toastr::info('Post Allready is Approved  :)' ,'Info');
       }
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $post= Category::find($id);
        $deletedData='public/storage/post/'.$post->thumbnail;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted :)' ,'Success');
           return redirect()->route('post.index');
    }
}
