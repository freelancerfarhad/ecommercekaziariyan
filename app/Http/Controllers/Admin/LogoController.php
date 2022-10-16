<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\Logo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class LogoController extends Controller
{
    public function index()
    {
        $logos=Logo::all();
        return view('admin.logo.index',compact('logos'));
    }
    public function create()
    {
        # code...
    }
    public function edit($id){
        $logos=Logo::find($id);
        return view('admin.logo.change',compact('logos'));
    }
    
    public function update(Request $request,Logo $logo)
    {
        $this->validate($request,[
            'logo' => 'required|mimes:png'
        ]);
      
       $logos = $request->file('logo');
    
        // if (isset($logo))
        // {
        //     $deletedData='public/storage/logo/'.$user->logo;
        //     if(File::exists($deletedData)){
        //        File::delete($deletedData);
        //     }
        //     $img_gen=hexdec(uniqid()).'.'.$upimg->getClientOriginalExtension();
        //     Image::make($image)->resize(50,17)->save('public/storage/logo/'.$img_gen);

        // }
        // $user->logo=$img_gen;
        // $user->update();
        if($request->hasFile('logo')){
            if(File::exists("'public/storage/logo/$logo->logo")){
                File::delete("'public/storage/logo/$logo->logo");
            }

            $ext= $request->file('logo')->getClientOriginalExtension();
 
            $file_path='logos'.'.'.$ext;
 
            $request->file('logo')->move('public/storage/logo/',$file_path);
 
            $logo->update([
                'logo'=>$file_path
            ]);
 
         }
    
        Toastr::success('Profile Successfully Updated :)' ,'Success');
               return redirect()->route('logo.index');
         
    }
}
