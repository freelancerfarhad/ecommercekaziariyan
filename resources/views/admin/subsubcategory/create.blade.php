@extends('layouts.backend.app')
@section('title','Category')
    
@push('css')
        <!-- Bootstrap Select Css -->
        <link href="{{asset('public/assets/backend')}}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

@endpush
@section('content')
    

    <div class="container-fluid">
      

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Sub-Sub-CATEGORY ADDED
                            <small>Category Added label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('subsubcategory.store')}}" method="post">
                            @csrf
                            <div class="row">
                            <div class="col-md-6">
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="subcategory_id" id="subcategory_id"class="form-control">
                                            <option value=""selected=""disabled>Select Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="sub_subcategory_name_en" class="form-control"name="sub_subcategory_name_en">
                                    <label class="form-label"for="sub_subcategory_name_en">Sub-Sub-Category Name En</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="sub_subcategory_name_bn" class="form-control"name="sub_subcategory_name_bn">
                                    <label class="form-label"for="sub_subcategory_name_bn">Sub-Sub-Category Name Bn</label>
                                </div>
                            </div>

                            <br>
                            <a href="{{route('subsubcategory.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Sub-SubCategory Add</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
          $('select[name="category_id"]').on('change', function(){
              var category_id = $(this).val();
            //   alert(category_id);
              if(category_id) {
                  $.ajax({
                      url: "{{  url('/admin/subcategorys/ajax') }}/"+category_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                            });
                      },
                  });
              } else {
                  alert('danger');
              }
          });
      });
</script>


@endpush