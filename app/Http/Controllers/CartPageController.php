<?php
namespace App\Http\Controllers;
use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CartPage()
    {
        return view('frontend.cartpage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetCartProduct()
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Cartremove($id)
    {
        Cart::remove($id);
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
            return response()->json(['success' => 'Successfully Cart Removed']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 // Cart Increment 
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

//qty+coupon+grand total 
        if(Session::has('coupon')){
            $cupon_name=Session::get('coupon')['cupon_name'];
            $coupon=Cupon::where('cupon_name',$cupon_name)->first();
            Session::put('coupon',[

                'cupon_name' => $coupon->cupon_name,
                'cupon_discount' => $coupon->cupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->cupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->cupon_discount/100),
            ]);
        }
// end qty+coupon+grand total 
        return response()->json('increment');

    } 
    // end mehtod 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CartDecrement($rowId)
    {
            $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
//qty+coupon+grand total 
        if(Session::has('coupon')){
            $cupon_name=Session::get('coupon')['cupon_name'];
            $coupon=Cupon::where('cupon_name',$cupon_name)->first();
            Session::put('coupon',[

                'cupon_name' => $coupon->cupon_name,
                'cupon_discount' => $coupon->cupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->cupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->cupon_discount/100),
            ]);
        }
//end qty+coupon+grand total 
        return response()->json('increment');

    }
}
