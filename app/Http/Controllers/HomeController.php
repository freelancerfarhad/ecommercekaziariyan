<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Post;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories=Category::where('status',1)->orderBy('category_name_en','ASC')->get();
        $sliders=Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products=Product::where('status',1)->orderBy('id','DESC')->limit(6)->get();
        $featured=Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $hotdeals=Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $specialoffers=Product::where('special_offer',1)->orderBy('id','DESC')->limit(6)->get();
        $specialdeals=Product::where('special_deals',1)->orderBy('id','DESC')->limit(6)->get();

        $skip_category_0=Category::skip(0)->first();
        $skip_product_0=Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();

        $skip_category_1=Category::skip(1)->first();
        $skip_product_1=Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

        $skip_brand_1=Brand::skip(1)->first();
        $skip_product_brand_1=Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->get();
        // return $skip_category->id;
        // die();

        return view('frontend.welcome',compact('categories','sliders','products','featured','hotdeals','specialoffers','specialdeals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_1','skip_product_brand_1'));
    }

    // forntend pruduct details 
    public function ProductDetails($id,$slug)
    {
        $products=Product::findOrFail($id);

      //multiple color
        $color_en=$products->product_color_en;
        $product_color_en=explode(',',$color_en);

        $color_bn=$products->product_color_bn;
        $product_color_bn=explode(',',$color_bn);
      //multiple size
        $size_en=$products->product_size_en;
        $product_size_en=explode(',',$size_en);

        $size_bn=$products->product_size_bn;
        $product_size_bn=explode(',',$size_bn);
         $relatedProcat=$products->category_id;
         $relatedproduct=Product::where('category_id',$relatedProcat)->orderBy('id','DESC')->get();
        $multiImag=MultiImage::where('product_id',$id)->get();
        return view('frontend.product-details',compact('products','multiImag','product_color_en','product_color_bn','product_size_en','product_size_bn','relatedproduct'));
    }

    //frontend tag wise product
    public function tagswiseproduct($tag)
    {
       $tagwisepro=Product::where('status',1)->orWhere('product_tags_en',$tag)->orWhere('product_tags_bn',$tag)->orderBy('id','DESC')->paginate(3);
       $categories=Category::where('status',1)->orderBy('category_name_en','ASC')->get();
       return view('frontend.tag_view',compact('tagwisepro','categories'));
    }

       //frontend sub category wise product
       public function subcategorywiseproduct($subcat_id,$slug)
       {
          $products=Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(6);
          $categories=Category::where('status',1)->orderBy('category_name_en','ASC')->get();
          return view('frontend.subcategory_view',compact('products','categories'));
       }
          //frontend sub category wise product
          public function subsubcategorywiseproduct($sub_subcat_id,$slug)
          {
             $products=Product::where('status',1)->where('sub_subcategory_id',$sub_subcat_id)->orderBy('id','DESC')->paginate(6);
             $categories=Category::where('status',1)->orderBy('category_name_en','ASC')->get();
             return view('frontend.sub_scategory',compact('products','categories'));
          }

    /// Product View With Ajax
    public function ProductViewAjax($id){
		// $product = Product::findOrFail($id);
      $product = Product::with('category','brand')->findOrFail($id);
		$color = $product->product_color_en;
		$product_color = explode(',', $color);

      $size = $product->product_size_en;
		$product_size = explode(',', $size);


		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));

	} // end method 



}
