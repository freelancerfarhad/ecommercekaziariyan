<?php

namespace App\Http\Controllers\Admin;

use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SocialController extends Controller
{
    public function index()
    {
        
        $socials=Social::all();
        return view('admin.socials.index',compact('socials'));
    }
    public function edit($id){
        $socials=Social::find($id);
        return view('admin.socials.edit',compact('socials'));
    }
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'youtube' => 'required'
        ]);
        $socials=Social::find($id);
      
        $socials->facebook=$request->facebook;
        $socials->twitter=$request->twitter;
        $socials->instagram=$request->instagram;
        $socials->youtube=$request->youtube;
        $socials->save();
        Toastr::success('Social Media Update Successfully','success');
        return redirect()->route('social.index');
    }
}
