<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Support\Facades\Hash;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminprofile=User::find(8);
        return view('admin.profile.setting',compact('adminprofile'));
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
        $data=User::find(8);
        $data->name=$request->name;
        // $data->email=$request->email;
        $data->about=$request->about;

        if($request->file('image')){
            $file=$request->file('image');
            $filename=date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('storage/profile'),$filename);
            $data['image']=$filename;
        }
        $data->save();

       Toastr::success('Profile Successfully Updated :)' ,'Success');
              return redirect()->back();
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
    public function edit()
    {
        // $profiles=User::find(1);
        // return view('admin.profile.update',compact('profiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $data=User::find(8);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->about=$request->about;

        if($request->file('image')){
            $file=$request->file('image');
            $filename=date('YmdHi').$file->getClientOriginalExtension();
            $file->move(public_path('profile'),$filename);
            $data['image']=$filename;
        }
        $data->save();

       Toastr::success('Profile Successfully Updated :)' ,'Success');
              return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminchangepassword(Request $request)
    {
        $validatedData = $request->validate([
            'oldassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hasPassword=User::find(8)->password;
        if(Hash::check($request->oldassword,$hasPassword)){
            $admin=User::find(8);
            $admin->password = Hash::make($request->passdword);
            $admin->save();
            Auth::logout();
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
