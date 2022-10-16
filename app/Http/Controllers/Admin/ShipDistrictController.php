<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ShipDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division=ShipDivision::orderBy('ship_division_name','asc')->get();
        $districts=ShipDistrict::with('division')->orderBy('id','asc')->get();

        return view('admin.district.index',compact('division','districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $division=ShipDivision::orderBy('ship_division_name','asc')->get();
        return view('admin.district.create',compact('division'));
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
            'division_id' => 'required',
            'district_name' => 'required|unique:ship_districts',
        ]);
   

            $district = new ShipDistrict();
           $district->division_id =strtoupper($request->division_id);
           $district->district_name =strtoupper($request->district_name);

           $district->save();
           Toastr::success('District Successfully Saved' ,'Success');
           return redirect()->route('district.index');
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
        $division=ShipDivision::orderBy('ship_division_name','asc')->get();
        $district=ShipDistrict::find($id);
        return view('admin.district.edit',compact('district','division'));
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
            'division_id' => '',
            'district_name' => '',
        ]);
        $district=ShipDistrict::find($id);
        $district->division_id = $request->division_id;
        $district->district_name = strtoupper($request->district_name);
         $district->update();
           Toastr::success('District Successfully Updated :)' ,'Success');
           return redirect()->route('district.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district= ShipDistrict::find($id);
      
        $district->delete();
        Toastr::success('District Successfully Deleted :)' ,'Success');
           return redirect()->route('district.index');
    }
}
