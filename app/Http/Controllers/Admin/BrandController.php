<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Support\Str;
// use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::latest()->get();
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'banner_name_en' => 'required|unique:brands',
            'banner_name_bn' => 'required|unique:brands',
            'brand_image' => 'required|mimes:jpeg,png,jpg'
        ]);
        // get form image
        $image = $request->file('brand_image');
        $slug_bn = Str::slug($request->banner_name_bn);
        $slug_en = Str::slug($request->banner_name_en);

    if (isset($image))
    {
//            make unique name for image

        $imagename =$slug_bn.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        $imagename =$slug_en.'-'.uniqid().'.'.$image->getClientOriginalExtension();
//            resize image for category and upload
       Image::make($image)->resize(300,300)->save('public/storage/brand/'.$imagename);

    } else {
        $imagename = "default.png";
    }

      $brand = new Brand();
           $brand->banner_name_en = $request->banner_name_en;
           $brand->banner_name_bn = $request->banner_name_bn;
           $brand->slug = $slug_en;
           $brand->bn_slug = $slug_bn;
           $brand->brand_image = $imagename;
           $brand->save();
           Toastr::success('Brand Successfully Saved :)' ,'Success');
           return redirect()->route('brand.index');
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
        $brand=Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
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
       
        $this->validate($request,[
            'banner_name_en' => 'required',
            'banner_name_bn' => 'required',
            'brand_image' => 'mimes:jpeg,png,jpg'
        ]);
        // get form image
        $image = $request->file('brand_image');
        
        $slug_en = Str::slug($request->banner_name_en);
        $slug_bn = Str::slug($request->banner_name_bn);
        $brand=Brand::find($id);
    if (isset($image))
    {
        $deletedData='public/storage/brand/'.$brand->brand_image;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
        $imagename =$slug_en.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        $imagename =$slug_bn.'-'.uniqid().'.'.$image->getClientOriginalExtension();
//            resize image for category and upload
        Image::make($image)->resize(300,300)->save('public/storage/brand/'.$imagename);

    } else {
        $imagename = "default.png";
    }


           $brand->banner_name_en = $request->banner_name_en;
           $brand->banner_name_bn = $request->banner_name_bn;
           $brand->slug = $slug_en;
           $brand->bn_slug = $slug_bn;
           $brand->brand_image = $imagename;
           $brand->update();
           Toastr::success('Brand Successfully Updated :)' ,'Success');
           return redirect()->route('brand.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand= Brand::find($id);
        $deletedData='public/storage/brand/'.$brand->brand_image;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
    
        $brand->delete();
        Toastr::success('Brand Successfully Deleted :)' ,'Success');
           return redirect()->route('brand.index');
 
    }
}
