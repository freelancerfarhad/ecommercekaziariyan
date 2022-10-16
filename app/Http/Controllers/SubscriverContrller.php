<?php

namespace App\Http\Controllers;

use App\Models\Subscriver;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SubscriverContrller extends Controller
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
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:subscrivers'
        ]);
        $subscriver=new Subscriver();
        $subscriver->email=$request->email;
        $subscriver->save();
        Toastr::success('Subscriver Successfully Saved :)' ,'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscriver  $subscriver
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriver $subscriver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriver  $subscriver
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriver $subscriver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscriver  $subscriver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriver $subscriver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriver  $subscriver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriver $subscriver)
    {
        //
    }
}
