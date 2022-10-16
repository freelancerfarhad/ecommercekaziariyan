<?php

namespace App\Http\Controllers\Admin;

use App\Models\Street;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $division=ShipDivision::orderBy('ship_division_name','asc')->get();
        $district=ShipDistrict::orderBy('district_name','asc')->get();
        $streets=Street::with('district','division')->orderBy('id','desc')->get();
       
        return view('admin.street.index',compact('streets','district','division'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $division=ShipDivision::orderBy('ship_division_name')->get();
        return view('admin.street.create',compact('division'));
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
            'district_id' => 'required',
            'street_name' => 'required|unique:streets',
        ]);
   

            $state = new Street();
           $state->division_id =$request->division_id;
           $state->district_id =$request->district_id;
           $state->street_name =strtoupper($request->street_name);

           $state->save();
           Toastr::success('Area Successfully Saved' ,'Success');
           return redirect()->route('street.index');
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
        $division=ShipDivision::orderBy('ship_division_name')->get();
        $district=ShipDistrict::orderBy('district_name')->get();
        $state=Street::findOrFail($id);
        return view('admin.street.edit',compact('division','district','state'));
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
            'district_id' => '',
            'street_name' => '',
        ]);
   

            $state = Street::find($id);
           $state->division_id =$request->division_id;
           $state->district_id =$request->district_id;
           $state->street_name =strtoupper($request->street_name);

           $state->save();
           Toastr::success('Area Successfully Updated' ,'Success');
           return redirect()->route('street.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $state=Street::find($id);
        
        $state->delete();
        Toastr::success('State Successfully Deleted :)' ,'Success');
           return redirect()->route('street.index');
    }
    public function GetDistrict($id)
    {
        $subCat=ShipDistrict::where('division_id',$id)->get();
        return json_encode($subCat);
    }
}
