<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllAuthorController extends Controller
{
    public function index()
    {
       $authors=User::authors()->withCount('posts')->withCount('comments')->withCount('favorite_posts')->get();
        return view('admin.allauthor.index',compact('authors'));
    }
    public function destroy($delete)
    {
        User::findOrFail($delete)->delete();
        Toastr::success('Author Deleted Successfully :)' ,'Success');
        return redirect()->back();
    }
}
