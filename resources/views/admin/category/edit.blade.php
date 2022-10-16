@extends('layouts.backend.app')
@section('title','category')
    
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
                           CATAGORY EDIT
                            <small>Category Edit label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('category.update',$category->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="category_name_en" class="form-control"name="category_name_en"value="{{$category->category_name_en}}">
                                    <label class="form-label"for="name">Category Name En</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="category_name_bn" class="form-control"name="category_name_bn"value="{{$category->category_name_bn}}">
                                    <label class="form-label"for="category_name_bn">Category Name Bn</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="category_icon" class="form-control"name="category_icon"value="{{$category->category_icon}}">
                                    <label class="form-label"for="category_icon">Category Icon </label>
                                    <p>example: <b style="color:royalblue">&lt;i class="<i style="background:yellowgreen">fa-duotone fa-handshake</i>" /i&gt;</b></p>
                                </div>
                            </div>

                            <br>
                            <a href="{{route('category.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Category</button>
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