@extends('layouts.backend.app')
@section('title','Slider')
    
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
                           Slider ADDED
                            <small>With floating label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('slider.store')}}" method="post"enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control"name="title">
                                    <label class="form-label"for="title">Title</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="description" class="form-control"name="description">
                                    <label class="form-label"for="description">Desctiption</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="file" id="image"name="slider_img" id="brand_image"class="form-control">
                                   <img id="showImage"src="{{(!empty($sliders->slider_img))? url('storage/slider/'.$sliders->slider_img): url('storage/defaul.png')}}" alt="Image"width="50px"height="50px"style="    border-radius: 100px;">

                                </div>
                            </div>

                            <br>
                            <a href="{{route('slider.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Slider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
   
    </div>



@endsection
@push('js')
<script>
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
 </script>
@endpush