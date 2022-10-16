<?php
namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::latest()->get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
             $brands=Brand::latest()->get();
             $category=Category::latest()->get();
             return view('admin.product.create',compact('brands','category'));
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
            'brand_id'           => 'required',
            'category_id'        => 'required',
            'subcategory_id'     => 'required',
            'sub_subcategory_id' => 'required',
            'product_name_en'    => 'required',
            'product_name_bn'    => 'required',
            'product_code'       => 'required',
            'product_qty'        => 'required',
            'product_tags_en'    => 'required',
            'product_tags_bn'    => 'required',
            'product_size_en'    => '',
            'product_size_bn'    => '',
            'product_color_en'   => '',
            'product_color_bn'   => '',
            'selling_price'      => 'required',
            'discount_price'     => '',
            'short_desc_en'      => 'required',
            'short_desc_bn'      => 'required',
            'long_desc_en'       => 'required',
            'long_desc_bn'       => 'required',
            'hot_deals'          => '',
            'featured'           => '',
            'special_offer'      => '',
            'special_deals'      => '',
            'status'             => '',
            'product_thumbnail'  => 'required|mimes:jpeg,png,jpg'
        ]);
        // product slug
        $slug_en = Str::slug($request->product_name_en);
        $slug_bn = Str::slug($request->product_name_bn);
        // get form image 
        $image = $request->file('product_thumbnail');

        if (isset($image))
        {
            $imagename =$slug_bn.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $imagename =$slug_en.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           Image::make($image)->resize(917,1000)->save('public/storage/product/'.$imagename);
        } else {
            $imagename = "default.png";
        }
        // product insert and save
        $product                     = new Product();
        $product->brand_id           = $request->brand_id;
        $product->category_id        = $request->category_id;
        $product->subcategory_id     = $request->subcategory_id;
        $product->sub_subcategory_id = $request->sub_subcategory_id;
        $product->product_name_en    = $request->product_name_en;
        $product->product_name_bn    = $request->product_name_bn;
        $product->product_code       = $request->product_code;
        $product->product_qty        = $request->product_qty;
        $product->product_tags_en    = $request->product_tags_en;
        $product->product_tags_bn    = $request->product_tags_bn;
        $product->product_size_en    = $request->product_size_en;
        $product->product_size_bn    = $request->product_size_bn;
        $product->product_color_en   = $request->product_color_en;
        $product->product_color_bn   = $request->product_color_bn;
        $product->selling_price      = $request->selling_price;
        $product->discount_price     = $request->discount_price;
        $product->short_desc_en      = $request->short_desc_en;
        $product->short_desc_bn      = $request->short_desc_bn;
        $product->long_desc_en       = $request->long_desc_en;
        $product->long_desc_bn       = $request->long_desc_bn;
        $product->hot_deals          = $request->hot_deals;
        $product->featured           = $request->featured;
        $product->special_offer      = $request->special_offer;
        $product->special_deals      = $request->special_deals;
        $product->status             = $request->status;
        $product->product_slug_en    = $slug_en;
        $product->product_slug_bn    = $slug_bn;
        $product->product_thumbnail  = $imagename;
        $product->save();

        // Multiple Image Upload Start
        $images = $request->file('photo_name');
        foreach($images as $img){
            $gen_name =hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('public/storage/product/multiple_img/'.$gen_name);
        
            $multiimage = new MultiImage();
            $multiimage->product_id=$product->id;
            $multiimage->photo_name=$gen_name;
            $multiimage->save();
        }


        // Multiple Image Upload End

        Toastr::success('Product Successfully Saved :)' ,'Success');
        return redirect()->route('product.index');

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
        $brands=Brand::latest()->get();
        $multiimages=MultiImage::where('product_id',$id)->get();
        $category=Category::latest()->get();
        $subcategory=SubCategory::latest()->get();
        $subsubcategory=SubSubCategory::latest()->get();
        $products=Product::find($id);
        return view('admin.product.edit',compact('brands','category','subcategory','subsubcategory','multiimages','products'));
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
           // product slug
           $slug_en = Str::slug($request->product_name_en);
           $slug_bn = Str::slug($request->product_name_bn);
      
         // product insert and save
         $product=Product::find($id);
     
        
         $product->brand_id           = $request->brand_id;
         $product->category_id        = $request->category_id;
         $product->subcategory_id     = $request->subcategory_id;
         $product->sub_subcategory_id = $request->sub_subcategory_id;
         $product->product_name_en    = $request->product_name_en;
         $product->product_name_bn    = $request->product_name_bn;
         $product->product_code       = $request->product_code;
         $product->product_qty        = $request->product_qty;
         $product->product_tags_en    = $request->product_tags_en;
         $product->product_tags_bn    = $request->product_tags_bn;
         $product->product_size_en    = $request->product_size_en;
         $product->product_size_bn    = $request->product_size_bn;
         $product->product_color_en   = $request->product_color_en;
         $product->product_color_bn   = $request->product_color_bn;
         $product->selling_price      = $request->selling_price;
         $product->discount_price     = $request->discount_price;
         $product->short_desc_en      = $request->short_desc_en;
         $product->short_desc_bn      = $request->short_desc_bn;
         $product->long_desc_en       = $request->long_desc_en;
         $product->long_desc_bn       = $request->long_desc_bn;
         $product->hot_deals          = $request->hot_deals;
         $product->featured           = $request->featured;
         $product->special_offer      = $request->special_offer;
         $product->special_deals      = $request->special_deals;
         $product->status             = $request->status;
         $product->product_slug_en    = $slug_en;
         $product->product_slug_bn    = $slug_bn;
         $product->save();

         Toastr::success('Product Successfully Updated :)' ,'Success');
         return redirect()->route('product.index');
    }
/**
 * Main Thumbnail Change
 * 
 * 
 */
public function MainThumbnailCahange(Request $request, $id)
{
    $product=Product::find($id);
         // get form image 
         $image = $request->file('product_thumbnail');
    if (isset($image))
    {
        $deletedData='public/storage/product/'.$product->product_thumbnail;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
        $imagename =hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
//            resize image for category and upload
        Image::make($image)->resize(917,1000)->save('public/storage/product/'.$imagename);

    } else {
        $imagename = "default.png";
    }

    $product->product_thumbnail  = $imagename;
    $product->save();
    Toastr::success('Product Successfully Updated :)' ,'Success');
    return redirect()->back();
}
    /**
     * Multiple Image Update and change
     */
public function MultipleImgCahange(Request $request)
{
   

         $image = $request->photo_name;
        //  $image = $request->file('photo_name');
         foreach($image as $id =>$img){
            $multiples=MultiImage::find($id);
                $deletedData='public/storage/product/multiple_img/'.$multiples->photo_name;
                if(File::exists($deletedData)){
                   File::delete($deletedData);
                }
            $imagenamemul =hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('public/storage/product/multiple_img/'.$imagenamemul);
                // $url='public/storage/product/multiple_img/'.$imagenamemul;

            MultiImage::where('id',$id)->update([
                'photo_name' => $imagenamemul,
               
            ]);

         }



    Toastr::success('Multi Image Successfully Updated :)' ,'Success');
    return redirect()->back();
}
/**
 * 
 * Multi Img Single Deleted
 */
    public function MultipleImgCahangeDeleted(Request $request,$id)
    {
        $oldimg=MultiImage::find($id);
        $deletedData='public/storage/product/multiple_img/'.$oldimg->photo_name;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
        $oldimg->delete();

        Toastr::success('Multiple Image Successfully Deleted :)' ,'Success');
        return redirect()->back();

    }

    /**
     * 
     * status Active
     */
    public function statusActive(Request $request,$id)
    {
        
        $product=Product::find($id)->update(['status'=> 1]);
        Toastr::success('Status Updated Active :)' ,'Success');
        return redirect()->back();

    }
        /**
     * 
     * status InActive
     */
    public function statusInactive(Request $request,$id)
    {
        
        $product=Product::find($id)->update(['status'=> 0]);
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
        $productDeleted=Product::findOrFail($id);
        $deletedData='public/storage/product/'.$productDeleted->product_thumbnail;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
        $productDeleted->delete();

        // multiple image deleted
        $multImg=MultiImage::where('product_id',$id)->get();
        foreach($multImg as $oldimg){
            $deletedDatamulti='public/storage/product/multiple_img/'.$oldimg->photo_name;
            if(File::exists($deletedDatamulti)){
               File::delete($deletedDatamulti);
            }
            $multImg=MultiImage::where('product_id',$id)->delete();
        }

        Toastr::success('Product Deleted Successfully :)' ,'Success');
        return redirect()->back();

    }
}
