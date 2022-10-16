<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'title' => '',
            'description' => '',
            'slider_img' => 'required|mimes:jpeg,png,jpg'
        ]);
        // get form image
        $image = $request->file('slider_img');
        if (isset($image))
        {
            $imagename =hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           Image::make($image)->resize(870,370)->save('storage/slider/'.$imagename);
        } else {
            $imagename = "default.png";
        }
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->slider_img = $imagename;
        $slider->save();
        Toastr::success('Slider Successfully Saved :)' ,'Success');
        return redirect()->route('slider.index');
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
        $slider=Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
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
            'title' => '',
            'description' => '',
            'slider_img' => 'required|mimes:jpeg,png,jpg'
        ]);
        // get form image
        $image = $request->file('slider_img');

        $slider=Slider::find($id);
    if (isset($image))
    {
        $deletedData='public/storage/slider/'.$slider->slider_img;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
        $imagename =hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('storage/slider/'.$imagename);

    } else {
        $imagename = "default.png";
    }
           $slider->title = $request->title;
           $slider->description = $request->description;
           $slider->slider_img = $imagename;
           $slider->update();
           Toastr::success('Slider Successfully Updated :)' ,'Success');
           return redirect()->route('slider.index');
    }


    /**
     * 
     * status Active
     */
    public function sliderstatusActive(Request $request,$id)
    {
        
        $slider=Slider::find($id)->update(['status'=> 1]);
        Toastr::success('Status Updated Active :)' ,'Success');
        return redirect()->back();

    }
        /**
     * 
     * status InActive
     */
    public function sliderstatusInactive(Request $request,$id)
    {
        
        $slider=Slider::find($id)->update(['status'=> 0]);
        Toastr::success('Status Updated Inactive :)' ,'Success');
        return redirect()->back();

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider= Slider::find($id);
        $deletedData='storage/slider/'.$slider->slider_img;
        if(File::exists($deletedData)){
           File::delete($deletedData);
        }
    
        $slider->delete();
        Toastr::success('Slider Successfully Deleted :)' ,'Success');
           return redirect()->route('slider.index');
    }
}
