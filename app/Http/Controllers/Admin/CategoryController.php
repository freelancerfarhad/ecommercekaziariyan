<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories=Category::orderBy('id','asc')->get();
        $categories=Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'category_name_en' => 'required|unique:categories',
            'category_name_bn' => 'required|unique:categories',
            'category_icon' => 'required',
        ]);
        // get form image
        
        $slug_en = Str::slug($request->category_name_en);
        $slug_bn = Str::slug($request->category_name_bn);



      $category = new Category();
           $category->category_name_en = $request->category_name_en;
           $category->category_name_bn = $request->category_name_bn;
           $category->category_icon = $request->category_icon;
           $category->en_slug = $slug_en;
           $category->bn_slug = $slug_bn;
           $category->save();
           Toastr::success('Category Successfully Saved :)' ,'Success');
           return redirect()->route('category.index');
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
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
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
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_icon' => '',
        ]);
  
           // get form image
        
           $slug_en = Str::slug($request->category_name_en);
           $slug_bn = Str::slug($request->category_name_bn);
   
   
        $category=Category::find($id);

        $category->category_name_en = $request->category_name_en;
        $category->category_name_bn = $request->category_name_bn;
        $category->category_icon = $request->category_icon;
        $category->en_slug = $slug_en;
        $category->bn_slug = $slug_bn;
           $category->update();
           Toastr::success('Category Successfully Updated :)' ,'Success');
           return redirect()->route('category.index');

    }

        /**
     * 
     * status Active
     */
    public function catstatusActive(Request $request,$id)
    {
        $product=Category::find($id)->update(['status'=> 1]);
        Toastr::success('Status Updated Active :)' ,'Success');
        return redirect()->back();

    }
        /**
     * 
     * status InActive
     */
    public function catstatusInactive(Request $request,$id)
    {
        $product=Category::find($id)->update(['status'=> 0]);
        Toastr::success('Status Updated Inactive :)' ,'Success');
        return redirect()->back();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category= Category::find($id);
      
        $category->delete();
        Toastr::success('Category Successfully Deleted :)' ,'Success');
           return redirect()->route('category.index');
 
    }


}
