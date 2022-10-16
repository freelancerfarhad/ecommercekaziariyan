<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CartPageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\ShippDivision;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\PostIndexController;
use App\Http\Controllers\SubscriverContrller;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\StreetController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AllAuthorController;
use App\Http\Controllers\Author\DashboardController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Author\AuthorPostController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\ShipDistrictController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Author\AuthorCommentController;
use App\Http\Controllers\Author\AuthorSettingController;
use App\Http\Controllers\Admin\AdminSubscribercontroller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
//frontend home page setup
Route::get('/',[HomeController::class, 'index'])->name('home');

//frontend language page url
Route::get('/language/bangla', [LanguageController::class, 'Bangla'])->name('bangla.language');

Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

//frontend product details page url or route
Route::get('/product/details/{id}/{slug}',[HomeController::class, 'ProductDetails'])->name('productdetails');

//frontend tag wise product page url or route
Route::get('/product/tag/{tag}',[HomeController::class, 'tagswiseproduct'])->name('tagswiseproduct');

//frontend subcategroy wise product page url or route
Route::get('/category/product/{subcat_id}/{slug}',[HomeController::class, 'subcategorywiseproduct'])->name('subcategorywiseproduct');

//frontend subcategroy wise product page url or route
Route::get('/subcategory/product/{sub_subcat_id}/{slug}',[HomeController::class, 'subsubcategorywiseproduct'])->name('subsubcategorywiseproduct');

// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [HomeController::class, 'ProductViewAjax']);

//cart view
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart'])->name('cart.store');

//mini cart view
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart'])->name('mini.cart');

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart'])->name('miniCartRemove');

// Wishlist add  with Ajax 
Route::post('/add-wist-list/{product_id}', [WishlistController::class, 'AddWisthlist'])->name('addwishlist');




// middleware group wishlist and Cart
Route::group(['prefix'=>'user','middleware'=>['user','auth'],'namespace'=>'User'],function(){

// Wishlist show
Route::get('/wishlist/show', [WishlistController::class, 'WidhlistShow'])->name('widhlist.show');

// Wishlist   with Ajax 
Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct'])->name('wishlist');

// Wishlist   with Ajax remove
Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);
Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');

});
// cart show
Route::get('user/carts', [CartPageController::class, 'CartPage'])->name('cart.show');

// cart   with Ajax 
Route::get('user/get-cart-product', [CartPageController::class, 'GetCartProduct']);

// cart   with Ajax 
Route::get('user/cart-remove/{id}', [CartPageController::class, 'Cartremove']);

// cart Increment   with Ajax 
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);

// cart Decrement   with Ajax 
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);





//frontend socialite package facebook
Route::get('login/facebook',[SocialLoginController::class, 'facebookRedirect'])->name('facebookRedirect');
Route::get('login/facebook/callback',[SocialLoginController::class, 'loginWithFacebook']);

//frontend socialite package google
Route::get('login/google',[SocialLoginController::class, 'googleRedirect']);

Route::get('login/google/callback',[SocialLoginController::class, 'loginWithGoogle']);

//__backend group_route_by_admin__/
Route::group(['prefix'=>'admin','middleware'=>['admin','auth']],function(){

    Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
    Route::get('setting',[AdminSettingController::class,'index'])->name('admin.setting');
    Route::put('profile_update',[AdminSettingController::class,'store'])->name('profile.store');
    Route::post('change-password',[AdminSettingController::class,'adminchangepassword'])->name('change.password');
    Route::resource('brand', BrandController::class);
    Route::resource('category', CategoryController::class);
    Route::get('category/active/{id}',[CategoryController::class,'catstatusActive'])->name('catstatusActive');
     Route::get('category/inacrive/{id}',[CategoryController::class,'catstatusInactive'])->name('catstatusInactive');
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('subsubcategory', SubSubCategoryController::class);
    Route::get('/subcategorys/ajax/{category_id}',[SubCategoryController::class,'GetSubCategory']);
     Route::resource('product', ProductController::class);
     Route::get('/subsubcategorys/ajax/{subcategory_id}',[SubSubCategoryController::class,'GetSubSubCategory']);
     Route::put('product/thumb/{id}',[ProductController::class,'MainThumbnailCahange'])->name('productimage');
     Route::put('product/multiple/{id}',[ProductController::class,'MultipleImgCahange'])->name('productimagemultiple');
     Route::get('product/multiple/delete/{id}',[ProductController::class,'MultipleImgCahangeDeleted'])->name('multipleimgdeletebysingle');
     Route::get('product/active/{id}',[ProductController::class,'statusActive'])->name('statusActive');
     Route::get('product/inacrive/{id}',[ProductController::class,'statusInactive'])->name('statusInactive');
     Route::resource('slider', SliderController::class);
     Route::get('slider/active/{id}',[SliderController::class,'sliderstatusActive'])->name('sliderstatusActive');
     Route::get('slider/inacrive/{id}',[SliderController::class,'sliderstatusInactive'])->name('sliderstatusInactive');
      Route::resource('cupons', CuponController::class);
      Route::resource('division', ShippDivision::class);
      Route::resource('district', ShipDistrictController::class);
      Route::resource('street', StreetController::class);
      Route::get('/street/ajax/{id}',[StreetController::class,'GetDistrict']);

});
//__backend group_route_by_author__/

Route::group(['prefix'=>'author','middleware'=>['author','auth']],function(){

    
    Route::get('/dashboard',[DashboardController::class,'index'])->name('author.dashboard');
    Route::get('/setting',[AuthorSettingController::class,'index'])->name('author.setting');
    Route::put('/profile_update',[AuthorSettingController::class,'update'])->name('profile.update');
    Route::resource('/order', AuthorPostController::class);
    // Route::get('/comment',[AuthorCommentController::class,'index'])->name('comments.index');
    // Route::delete('/comment/{delete}',[AuthorCommentController::class,'destroy'])->name('comments.destroy');


});


// Frontend Coupon Option

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
 // Checkout Routes 

 Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
 Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
 Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);
 Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('Checkout.Store');