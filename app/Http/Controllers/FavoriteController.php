<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($post)
    {
        $user=Auth::user();
        $isfavorite=$user->favorite_posts()->where('post_id',$post)->count();

        if($isfavorite == 0){
            $user->favorite_posts()->attach($post);
            Toastr::success('Favourite add Successfully Saved :)' ,'Success');
            return redirect()->back();
        }else{
            $user->favorite_posts()->detach($post);
            Toastr::success('Favourite remove Successfully Saved :)' ,'Success');
            return redirect()->back();
        }
    }
}
