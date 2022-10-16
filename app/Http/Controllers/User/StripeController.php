<?php
namespace App\Http\Controllers\User;
use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Mail\OrderMail;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{

    public function StripeOrder(Request $request){

    	if (Session::has('coupon')) {
    		$total_amount = Session::get('coupon')['total_amount'];
    	}else{
    		$total_amount = round(Cart::total());
    	}
        Stripe::setApiKey('sk_test_51LsdLZDsBqdPno2c4Uo8ucfzpy9zZ7iTu3j0UzSxvkeC6E1YpK5hdDvHDmcS8Atam8KmHL64g3kjg437KtzkEh8W00NhFdUiLW');
    
        $token = $_POST['stripeToken'];
        $charge = Charge::create([
          'amount' => $total_amount*100,
          'currency' => 'usd',
          'description' => 'MFCoder Online Store',
          'source' => $token,
          'metadata' => ['order_id' => uniqid()],
        ]);
    
        // dd($charge);
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'steet_id' => $request->street_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->note,

            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,
     
            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),	 
        ]);
       
       // Start Send Email 
       $invoice = Order::findOrFail($order_id);
     	$data = [
     		'invoice_no' => $invoice->invoice_no,
     		'amount' => $total_amount,
     		'name' => $invoice->name,
     	    'email' => $invoice->email,
     	    'created_at' => $invoice->created_at,
     	];

     	Mail::to($request->email)->send(new OrderMail($data));

     // End Send Email 

    $carts = Cart::content();
    foreach ($carts as $cart) {
      OrderItem::insert([
        'order_id' => $order_id, 
        'product_id' => $cart->id,
        'color' => $cart->options->color,
        'size' => $cart->options->size,
        'qty' => $cart->qty,
        'price' => $cart->price,
        'created_at' => Carbon::now(),

      ]);
    }

    if (Session::has('coupon')) {
      Session::forget('coupon');
    }

    Cart::destroy();

    $notification = array(
     'message' => 'Your Order Place Successfully',
     'alert-type' => 'success'
   );

      
           return redirect()->route('author.dashboard')->with($notification);
    
        } // end method 
}
