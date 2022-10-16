<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function AddToCart(Request $request)
    {
        //

        if(Session::has('coupon')){
            Session::forget('coupon');
        }
            $product = Product::findOrFail($request->id);
    
            if ($product->discount_price == NULL) {
                Cart::add([
                    'id' => $request->id, 
                    'name' => $request->product_name, 
                    'qty' => $request->quantity, 
                    'price' => $product->selling_price,
                    'weight' => 1, 
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'color' => $request->color,
                        'size' => $request->size,
                    ],
                ]);
    
                return response()->json(['success' => 'Successfully Added on Your Cart']);
    
            }else{
    
                Cart::add([
                    'id' => $request->id, 
                    'name' => $request->product_name, 
                    'qty' => $request->quantity, 
                    'price' => $product->discount_price,
                    'weight' => 1, 
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'color' => $request->color,
                        'size' => $request->size,
                    ],
                ]);
                return response()->json(['success' => 'Successfully Added on Your Cart']);
            }
    
        } // end mehtod 


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AddMiniCart()
    {
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => $cartTotal,

    	));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 /// remove mini cart 
 public function RemoveMiniCart($rowId){
    Cart::remove($rowId);
    return response()->json(['success' => 'Product Remove from Cart']);

} // end mehtod 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function CouponApply(Request $request){
        $coupon=Cupon::where('cupon_name',$request->coupon_name)->where('cupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if($coupon){
            

            Session::put('coupon',[

                'cupon_name' => $coupon->cupon_name,
                'cupon_discount' => $coupon->cupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->cupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->cupon_discount/100),
            ]);

            return response()->json(array(
                'validity'=> true,
                'success' => 'Coupon Apply Successfully !'
            ));

        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    //coupon get field show data
    public function CouponCalculation(Request $request)
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'cupon_name' => session()->get('coupon')['cupon_name'],
                'cupon_discount' => session()->get('coupon')['cupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            
            return response()->json(array(
                'total' => Cart::total(),
            ));

        }



    } // end method 
 // Remove Coupon 
 public function CouponRemove(){
    Session::forget('coupon');
    return response()->json(['success' => 'Coupon Remove Successfully']);
}


 // Checkout Method 
 public function CheckoutCreate(){

    if (Auth::check()) {
        if (Cart::total() > 0) {

            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
            $divisions=ShipDivision::orderBy('ship_division_name','asc')->get();
            return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));

        }else{

        $notification = array(
        'message' => 'Shopping At list One Product',
        'alert-type' => 'error'
        );
         return redirect()->to('/')->with($notification);

        }

    }else{

         $notification = array(
        'message' => 'You Need to Login First',
        'alert-type' => 'error'
    );

    return redirect()->route('login')->with($notification);

    }

} // end method 





 
}
