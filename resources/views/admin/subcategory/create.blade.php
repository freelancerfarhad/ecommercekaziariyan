@extends('layouts.backend.app')
@section('title','Category')
    
@push('css')
        <!-- Bootstrap Select Css -->
        <link href="{{asset('assets/backend')}}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('content')
    

    <div class="container-fluid">
      

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Sub CATEGORY ADDED
                            <small>Category Added label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('subcategory.store')}}" method="post">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="category_id" id="category_id"class="form-control">
                                        <option value=""selected=""disabled>Select Category</option>
                                        @foreach ($category as $category)
                                        <option value="{{$category->id}}">{{$category->category_name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="subcategory_name_en" class="form-control"name="subcategory_name_en">
                                    <label class="form-label"for="subcategory_name_en">Sub Category Name En</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="subcategory_name_bn" class="form-control"name="subcategory_name_bn">
                                    <label class="form-label"for="subcategory_name_bn">Sub Category Name Bn</label>
                                </div>
                            </div>

                            <br>
                            <a href="{{route('subcategory.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SubCategory Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
   
    </div>



@endsection
@push('js')
    <!-- Multi Select Plugin Js -->
    <script src="{{asset('assets/backend')}}/plugins/multi-select/js/jquery.multi-select.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
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