<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $cupons=Cupon::orderBy('id','asc')->get();

        return view('admin.cupon.index',compact('cupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cupon.create');
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
            'cupon_name' => 'required|unique:cupons',
            'cupon_discount' => 'required',
            'cupon_validity' => 'required',
        ]);
   

      $cupon = new Cupon();
           $cupon->cupon_name =strtoupper($request->cupon_name);
           $cupon->cupon_discount = $request->cupon_discount;
           $cupon->cupon_validity = $request->cupon_validity;

           $cupon->save();
           Toastr::success('Coupons Successfully Saved' ,'Success');
           return redirect()->route('cupons.index');
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
        $coupon=Cupon::findOrFail($id);
        return view('admin.cupon.edit',compact('coupon'));
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
            'cupon_name' => '',
            'cupon_discount' => '',
            'cupon_validity' => 'required',
        ]);
  
   
        $cupon=Cupon::find($id);

        $cupon->cupon_name =strtoupper($request->cupon_name);
        $cupon->cupon_discount = $request->cupon_discount;
        $cupon->cupon_validity = $request->cupon_validity;
         $cupon->update();
        Toastr::success('Coupon Successfully Updated !' ,'Success');
        return redirect()->route('cupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cupon=Cupon::find($id);
      
        $cupon->delete();
        Toastr::success('Coupon Successfully Deleted !' ,'Success');
           return redirect()->route('cupons.index');
 
    }
}
