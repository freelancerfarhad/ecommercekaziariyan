<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function profiles($username)
    {
       $author=User::where('username',$username)->first();
      $posts=$author->posts()->approved()->publisted()->get();
      return view('profile',compact('posts','author'));
    }
}
