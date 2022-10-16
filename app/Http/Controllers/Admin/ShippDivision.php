<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ShippDivision extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division=ShipDivision::orderBy('id','asc')->get();

        return view('admin.division.index',compact('division'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.division.create');
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
            'ship_division_name' => 'required|unique:ship_divisions',
        ]);
   

      $division = new ShipDivision();
           $division->ship_division_name =strtoupper($request->ship_division_name);

           $division->save();
           Toastr::success('Division Successfully Saved' ,'Success');
           return redirect()->route('division.index');
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
        $division=ShipDivision::findOrFail($id);
        return view('admin.division.edit',compact('division'));
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
            'ship_division_name' => 'required',
        ]);
  
        $division=ShipDivision::find($id);
        $division->ship_division_name =strtoupper($request->ship_division_name);
         $division->update();
        Toastr::success('Division Successfully Updated !' ,'Success');
        return redirect()->route('division.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division=ShipDivision::find($id);
      
        $division->delete();
        Toastr::success('Coupon Successfully Deleted !' ,'Success');
           return redirect()->route('division.index');
 
    }
}
