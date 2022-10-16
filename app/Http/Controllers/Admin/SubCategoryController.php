<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories=SubCategory::latest()->get();
        return view('admin.subcategory.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::orderBy('category_name_en')->get();
        return view('admin.subcategory.create',compact('category'));
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
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_bn' => 'required',
        ]);
        // get form image
        
        $slug_en = Str::slug($request->subcategory_name_en);
        $slug_bn = Str::slug($request->subcategory_name_bn);



      $subcategory = new SubCategory();
           $subcategory->category_id = $request->category_id;
           $subcategory->subcategory_name_en = $request->subcategory_name_en;
           $subcategory->subcategory_name_bn = $request->subcategory_name_bn;
           $subcategory->en__slug = $slug_en;
           $subcategory->bn_slug = $slug_bn;
           $subcategory->save();
           Toastr::success('Sub-Category Successfully Saved :)' ,'Success');
           return redirect()->route('subcategory.index');
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
        $category=Category::orderBy('category_name_en')->get();
        $subcategory=SubCategory::find($id);
        return view('admin.subcategory.edit',compact('subcategory','category'));
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
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_bn' => 'required',
        ]);
  
                 // get form image
        
        $slug_en = Str::slug($request->subcategory_name_en);
        $slug_bn = Str::slug($request->subcategory_name_bn);
   
        $subcategory=SubCategory::find($id);
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_name_en = $request->subcategory_name_en;
        $subcategory->subcategory_name_bn = $request->subcategory_name_bn;
        $subcategory->en__slug = $slug_en;
        $subcategory->bn_slug = $slug_bn;
  
           $subcategory->update();
           Toastr::success('Sub Category Successfully Updated :)' ,'Success');
           return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory= SubCategory::find($id);
      
        $subcategory->delete();
        Toastr::success('Sub Category Successfully Deleted :)' ,'Success');
           return redirect()->route('subcategory.index');
    }
    /****
     * 
     * 
     * category to subcategory auto suggest
     * 
     */
    public function GetSubCategory($category_id)
    {
        $subCat=SubCategory::where('category_id',$category_id)->get();
        return json_encode($subCat);
    }
}
