<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AdminSubscribercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $subscrivers=Subscriver::latest()->get();
        return view('admin.subscriver',compact('subscrivers'));
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
        //
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
    public function destroy($subscriver)
    {
        $subscriver=Subscriver::findOrFail($subscriver)->delete();
        Toastr::success('Subscriptions Successfully Delete :)' ,'Success');
        return redirect()->back();
    }
}
