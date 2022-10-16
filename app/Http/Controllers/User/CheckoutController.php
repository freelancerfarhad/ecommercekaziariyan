<?php

namespace App\Http\Controllers\User;

use App\Models\Street;
use App\Models\ShipDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
   
  
     public function DistrictGetAjax($division_id){

    	$ship = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
    	return json_encode($ship);
  

    } // end method 


     public function StateGetAjax($district_id){

    	$ship = Street::where('district_id',$district_id)->orderBy('street_name','ASC')->get();
    	return json_encode($ship);

    } // end method 
    public function CheckoutStore(Request $request)
    {
        // dd($request->all());
        $data = array();
        $data['shippping_name'] = $request->shippping_name;
        $data['shippping_email'] = $request->shippping_email;
        $data['shippping_phone'] = $request->shippping_phone;
        $data['post_code'] = $request->post_code;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['street_id'] = $request->street_id;
        $data['notes'] = $request->note;
        $cartTotal=Cart::total();

        if($request->payment_method == 'stripe'){
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        }elseif($request->payment_method == 'card'){
            return view('frontend.payment.card',compact('data'));
        }elseif($request->payment_method == 'cash'){
            return view('frontend.payment.cash',compact('data'));
        }else{
            return "Sorry Payment method not apply";
        }
    } // end method

}
