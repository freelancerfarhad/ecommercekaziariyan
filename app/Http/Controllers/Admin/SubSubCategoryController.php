<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_subcategories=SubSubCategory::latest()->get();
        return view('admin.subsubcategory.index',compact('sub_subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::orderBy('category_name_en')->get();
        return view('admin.subsubcategory.create',compact('category'));
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
            'subcategory_id' => 'required',
            'sub_subcategory_name_en' => 'required',
            'sub_subcategory_name_bn' => 'required',
        ]);
        // get form image
        
        $slug_en = Str::slug($request->sub_subcategory_name_en);
        $slug_bn = Str::slug($request->sub_subcategory_name_bn);



      $subsubcategory = new SubSubCategory();
           $subsubcategory->category_id = $request->category_id;
           $subsubcategory->subcategory_id = $request->subcategory_id;
           $subsubcategory->sub_subcategory_name_en = $request->sub_subcategory_name_en;
           $subsubcategory->sub_subcategory_name_bn = $request->sub_subcategory_name_bn;
           $subsubcategory->en__slug = $slug_en;
           $subsubcategory->bn_slug = $slug_bn;
           $subsubcategory->save();
           Toastr::success('Sub-Sub-Category Successfully Saved :)' ,'Success');
           return redirect()->route('subsubcategory.index');
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
        $subcategory=SubCategory::orderBy('subcategory_name_en')->get();
        $subsubcategory=SubSubCategory::find($id);
        return view('admin.subsubcategory.edit',compact('subcategory','category','subsubcategory'));
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
            'subcategory_id' => 'required',
            'sub_subcategory_name_en' => 'required',
            'sub_subcategory_name_bn' => 'required',
        ]);
  
                 // get form image
        
            $slug_en = Str::slug($request->sub_subcategory_name_en);
            $slug_bn = Str::slug($request->sub_subcategory_name_bn);
   
            $subsubcategory=SubSubCategory::find($id);
            $subsubcategory->category_id = $request->category_id;
            $subsubcategory->subcategory_id = $request->subcategory_id;
            $subsubcategory->sub_subcategory_name_en = $request->sub_subcategory_name_en;
            $subsubcategory->sub_subcategory_name_bn = $request->sub_subcategory_name_bn;
            $subsubcategory->en__slug = $slug_en;
            $subsubcategory->bn_slug = $slug_bn;
           $subsubcategory->update();
           Toastr::success('Sub Category Successfully Updated :)' ,'Success');
           return redirect()->route('subsubcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subsubCat=SubSubCategory::find($id);
        
        $subsubCat->delete();
        Toastr::success('Sub-Sub-Category Successfully Deleted :)' ,'Success');
           return redirect()->route('subsubcategory.index');
    }
    public function GetSubSubCategory($subcategory_id)
    {
        $subCat=SubSubCategory::where('subcategory_id',$subcategory_id)->get();
        return json_encode($subCat);
    }
}
