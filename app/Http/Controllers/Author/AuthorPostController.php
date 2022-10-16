<?php

namespace App\Http\Controllers\Author;

use File;
use Image;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Order;
use App\Models\User;;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NewUser;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AuthorPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $poder=Auth::User()->posts()->latest()->get();
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('author.order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories=Category::all();
        // $tags=Tag::all();
        // return view('author.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     $this->validate($request,[
    //         'title' => 'required',
    //         'thumbnail' => 'mimes:jpeg,png,jpg',
    //         'category' => 'required',
    //         'tags' => 'required',
    //         'body' => 'required',
    //     ]);

    //        // get form image
    //        $image = $request->file('thumbnail');
        
    //        $slug = Str::slug($request->title);
   
    //    if (isset($image))
    //    {
    //        $imagename =$slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    //       Image::make($image)->resize(1600,1066)->save('public/storage/post/'.$imagename);
    //    } else {
    //        $imagename = "default.png";
    //    }
   
    //      $post = new Post();
    //          $post->user_id =Auth::id();
    //           $post->title = $request->title;
    //           $post->slug = $slug;
    //           $post->thumbnail = $imagename;
    //           $post->body =$request->body;
    //           if(isset($request->status)){
    //             $post->status=true;
    //           }else{
    //             $post->status=false;
    //           }
    //           $post->is_approved = false;
    //           $post->save();
    //          $post->categories()->attach($request->category);
    //          $post->tags()->attach($request->tags);
    //           $users=User::where('role_id',1)->get();
    //           Notification::send($users,new NewUser($post));
    //           Toastr::success('Post Successfully Saved :)' ,'Success');
    //           return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
       $order = Order::with('user','division','district','state')->where('id',$order)->where('user_id',Auth::id())->first();
          $orderitem = OrderItem::with('product')->where('order_id',$order)->orderBy('id','DESC')->get();
        return view('author.order.show',compact('order','orderitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // if($post->user_id!=Auth::id()){
        //     return redirect()->back();
        // }
        // $categories=Category::all();
        // $tags=Tag::all();
        // return view('author.post.edit',compact('categories','tags','post'));
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
    //     if($post->user_id!=Auth::id()){
    //         return redirect()->back();
    //     }
    //     $this->validate($request,[
    //         'title' => 'required',
    //         'thumbnail' => 'mimes:jpeg,png,jpg',
    //         'category' => 'required',
    //         'tags' => 'required',
    //         'body' => 'required',
    //     ]);

    //        // get form image
    //        $image = $request->file('thumbnail');
        
    //        $slug = Str::slug($request->title);
        
    //    if (isset($image))
    //    {
    //     $deletedData='public/storage/post/'.$post->thumbnail;
    //     if(File::exists($deletedData)){
    //        File::delete($deletedData);
    //     }
    //     $imagename =$slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    //     Image::make($image)->resize(1600,1066)->save('public/storage/post/'.$imagename);
    //    } else {
    //        $imagename = "default.png";
    //    }
   
   
    //          $post->user_id =Auth::id();
    //           $post->title = $request->title;
    //           $post->slug = $slug;
    //           $post->thumbnail = $imagename;
    //           $post->body =$request->body;
    //           if(isset($request->status)){
    //             $post->status=true;
    //           }else{
    //             $post->status=false;
    //           }
    //           $post->is_approved = false;
    //           $post->update();
    //          $post->categories()->sync($request->category);
    //          $post->tags()->sync($request->tags);

    //           Toastr::success('Post Successfully Updated :)' ,'Success');
    //           return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // if($post->user_id!=Auth::id()){
        //     return redirect()->back();
        // }
        // $deletedData='public/storage/post/'.$post->thumbnail;
        // if(File::exists($deletedData)){
        //    File::delete($deletedData);
        // }
        // $post->categories()->detach();
        // $post->tags()->detach();
        // $post->delete();
        // Toastr::success('Post Successfully Deleted :)' ,'Success');
        //    return redirect()->route('posts.index');
    }
}
