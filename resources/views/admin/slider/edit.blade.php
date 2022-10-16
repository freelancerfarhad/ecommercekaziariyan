@extends('layouts.backend.app')
@section('title','slider')
    
@push('css')
    
@endpush
@section('content')
    

    <div class="container-fluid">
      

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           SLIDER EDIT
                            <small>Tag Edit label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('slider.update',$slider->id)}}" method="post"enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control"name="title"value="{{$slider->title}}">
                                    <label class="form-label"for="title">Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="description" class="form-control"name="description"value="{{$slider->description}}">
                                    <label class="form-label"for="description">description</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="file" id="image"name="slider_img" id="slider_img"class="form-control">
                                   <img id="showImage"src="{{asset('storage/slider/'.$slider->slider_img)}}" alt="Image"width="300px"height="100px"style="">

                                </div>
                            </div>

                            <br>
                            <a href="{{route('slider.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Slider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
   
    </div>



@endsection
@push('js')
    
@endpush