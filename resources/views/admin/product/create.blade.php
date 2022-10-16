@extends('layouts.backend.app')
@section('title','Category')
    
@push('css')
<link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<style>
    ul.dropdown-menu.inner li {
    margin-left: 33px;
  
}
</style>
    <!-- Bootstrap Tagsinput Css -->
    <link href="{{asset('assets/backend')}}/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
@endpush
@section('content')
    

 <div class="container-fluid">
      
   <form action="{{route('product.store')}}" method="post"enctype="multipart/form-data">
            @csrf
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header"style="background:green;">
                        <h4 style="color:white;">
                           Product / Create
                           
                        </h4>
                    
                    </div>
          
                    <div class="body">
                        <!------ Product name input row ------>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="product_name_en" class="form-control"name="product_name_en"placeholder="Product Name En"value="{{old('product_name_en')}}">
                                        {{-- <label class="form-label"for="product_name_en">Product Name En</label> --}}
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="product_code" class="form-control"name="product_code"placeholder="Product Code"value="{{old('product_code')}}">
                                        {{-- <label class="form-label"for="product_code">Product Code</label> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="product_name_bn" class="form-control"name="product_name_bn"placeholder="Product Name Bn"value="{{old('product_name_bn')}}">
                                        {{-- <label class="form-label"for="product_name_bn">Product Name Bn</label> --}}
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="product_qty" class="form-control"name="product_qty"placeholder="Product Quantity"value="{{old('product_qty')}}">
                                        {{-- <label class="form-label"for="product_qty">Product Quantity</label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!------ Product selling price and discount price input row ------>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="selling_price" class="form-control"name="selling_price"placeholder="Selling Price"value="{{old('selling_price')}}">
                                        {{-- <label class="form-label"for="selling_price">Selling Price </label> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="discount_price" class="form-control"name="discount_price"placeholder="Discount Price"value="{{old('discount_price')}}">
                                        {{-- <label class="form-label"for="discount_price">Discount Price</label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!------ Product tags input row ------>
                        <div class="row">
                            <div class="col-md-6">
                               <div class="form-group demo-tagsinput-area">
                                        <div class="form-line focused">
                                            <div class="bootstrap-tagsinput">  
                                                   {{-- <input type="text" placeholder="" size="1"> --}}
                                                </div>
                                                   <input type="text" class="form-control" data-role="tagsinput" value="" style="display: none;" placeholder=""name="product_tags_en">
                                                   <label class="form-label"for="product_tags_en">Product Tags En</label>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-6">
                            
                             <div class="form-group demo-tagsinput-area">
                                        <div class="form-line focused">
                                            <div class="bootstrap-tagsinput">  
                                                   {{-- <input type="text" placeholder="" size="1"> --}}
                                                </div>
                                                   <input type="text" class="form-control" data-role="tagsinput" value="" style="display: none;" placeholder=""name="product_tags_bn">
                                                   <label class="form-label"for="product_tags_bn">Product Tags Bn</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                         <!------ Product size input row ------>
                        <div class="row">
                            <div class="col-md-6">
                               <div class="form-group demo-tagsinput-area">
                                        <div class="form-line focused">
                                            <div class="bootstrap-tagsinput">  
                                                   {{-- <input type="text" placeholder="" size="1"> --}}
                                                </div><input type="text" class="form-control" data-role="tagsinput" value="M, L, XL" style="display: none;" placeholder=""name="product_size_en">
                                                   <label class="form-label"for="product_size_en">Product Size En</label>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-6">
                            
                             <div class="form-group demo-tagsinput-area">
                                        <div class="form-line focused">
                                            <div class="bootstrap-tagsinput">  
                                                   {{-- <input type="text" placeholder="" size="1"> --}}
                                                </div><input type="text" class="form-control" data-role="tagsinput" value="M, L, XL" style="display: none;" placeholder=""name="product_size_bn">
                                                   <label class="form-label"for="product_size_bn">Product Size Bn</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                           <!------ Product color input row ------>
                           <div class="row">
                            <div class="col-md-6">
                               <div class="form-group demo-tagsinput-area">
                                        <div class="form-line focused">
                                            <div class="bootstrap-tagsinput">  
                                                   {{-- <input type="text" placeholder="" size="1"> --}}
                                                </div><input type="text" class="form-control" data-role="tagsinput" value="Red, Green, Blue, Black" style="display: none;" placeholder=""name="product_color_en">
                                                   <label class="form-label"for="product_color_en">Product Color En</label>
                                        </div>
                                    </div>
                                    <input type="checkbox" name="status" value="1"id="status"class="filled-in">
                                    <label for="status">Publish</label>
                            </div>
                            <div class="col-md-6">
                            
                             <div class="form-group demo-tagsinput-area">
                                        <div class="form-line focused">
                                            <div class="bootstrap-tagsinput">  
                                                   {{-- <input type="text" placeholder="" size="1"> --}}
                                                </div><input type="text" class="form-control" data-role="tagsinput" value="লাল, সবুজ, নীল, কালো" style="display: none;" placeholder=""name="product_color_bn">
                                                   <label class="form-label"for="product_color_bn">Product Color Bn</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                 <!------ Product brand and category row ------>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           BRAND And CATEGORY
                        </h2>
                    
                    </div>
                    <div class="body">
                        {{-- {{$error->has('tags') ? 'focused error':''}} --}}
                            <div class="form-group">
                                <div class="form-line">
                                    <label class=""for="brand_id">BRAND SELECT</label>
                                    <select name="brand_id" id="brand_id"class="form-control show-tick"data-live-search="true">
                                        <option value=""selected disabled>SELECT BRAND</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}"> {{ $brand->banner_name_en }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label class=""for="category_id">CATEGORY SELECT</label>
                                    <select name="category_id" id="category_id"class="form-control show-tick"data-live-search="true">
                                        <option value=""selected disabled>SELECT Category</option>
                                        @foreach ($category as $category)
                                            <option value="{{$category->id}}"> {{ $category->category_name_en }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label class=""for="subcategory_id">SUB-CATEGORY</label>
                                    <select name="subcategory_id" id="subcategory_id"class="form-control show-tick"data-live-search="true">
                                        <option value=""selected disabled>SELECT Sub_category</option>
                                        {{-- @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}"> {{ $tag->name }} </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label class=""for="sub_subcategory_id">SUB-SUB-CATEGORY</label>
                                    <select name="sub_subcategory_id" id="sub_subcategory_id"class="form-control show-tick"data-live-search="true">
                                        <option value=""selected disabled>SELECT Sub-Sub-Category</option>
                                        {{-- @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}"> {{ $tag->name }} </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                                    

                            <div class="form-group">
                                <div class="form-line">
                                 
                                    <input type="checkbox" name="hot_deals" value="1"id="hot_deals"class="filled-in">
                                    <label for="hot_deals">Hot Deals</label>

                                    <input type="checkbox" name="featured" value="1"id="featured"class="filled-in">
                                    <label for="featured">Featured</label>
                                    
                                    <input type="checkbox" name="special_offer" value="1"id="special_offer"class="filled-in">
                                    <label for="special_offer">Special Offer</label>

                                    {{-- <input type="checkbox" name="special_offer" value="1"id="special_offer"class="filled-in">
                                    <label for="Special Offer">special_offer</label> --}}

                                    <input type="checkbox" name="special_deals" value="1"id="special_deals"class="filled-in">
                                    <label for="special_deals">Special Deals</label>
                                    
                                </div>
                            </div>
                            
                            <br>
                            <a href="{{route('product.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect"> Publish</button>
                       
                    </div>
                </div>
            </div>
        </div>
             <!------ Product image input row ------>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                <div class="card">
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="">Main Thumbnail </label>
                                <input type="file" id="product_thumbnail" class="form-control"name="product_thumbnail"onChange="mainThamUrl(this)">
                                <img src=""id="mainThmb" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                <div class="card">
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="">Multiple Image Upload </label>
                                <input type="file" id="multiImg" class="form-control"name="photo_name[]"multiple="">
                               <div class="row"id="preview_img"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                <div class="card">
                    <div class="header">
                        <h2>
                           Short Desctiption English
                        
                        </h2>
                    
                    </div>
                    <div class="body">
                       
                     <textarea name="short_desc_en" id=""class="form-control"placeholder="write your short description"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                <div class="card">
                    <div class="header">
                        <h2>
                           Short Desctiption Bangla
                        
                        </h2>
                    
                    </div>
                    <div class="body">
                       
                     <textarea name="short_desc_bn" id=""class="form-control"placeholder="write your short description"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Long Descrition English
                        
                        </h2>
                    
                    </div>
                    <div class="body">
                       
                     <textarea name="long_desc_en" id="tinymces"></textarea>
                    </div>
                </div>
            </div>
          
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Long Descrition Bangla
                            
                            </h2>
                        
                        </div>
                        <div class="body">
                           
                         <textarea name="long_desc_bn" id="tinymcess"></textarea>
                        </div>
                    </div>
                </div>
        </div>
  </form>
</div>
    



@endsection
@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
       <!-- Multi Select Plugin Js -->
       <script src="{{asset('assets/backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script> 
       <!-- TinyMCE -->
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

 <script type="text/javascript">
        $(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = "{{asset('assets/backend/plugins/tinymce')}}";
    });
 </script>
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
                        $('select[name="sub_subcategory_id"]').html('');
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

  //   subcategory and sub sub category;


          $('select[name="subcategory_id"]').on('change', function(){
              var subcategory_id = $(this).val();
            //   alert(category_id);
              if(subcategory_id) {
                  $.ajax({
                      url: "{{  url('/admin/subsubcategorys/ajax') }}/"+subcategory_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         var d =$('select[name="sub_subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="sub_subcategory_id"]').append('<option value="'+ value.id +'">' + value.sub_subcategory_name_en + '</option>');
                            });
                      },
                  });
              } else {
                  alert('danger');
              }
          });




      });
</script>
<script>
    ClassicEditor
            .create( document.querySelector( '#tinymces' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
<script>
    ClassicEditor
            .create( document.querySelector( '#tinymcess' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
<script>
    // Mail Thumbnail Image onload function javascript
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader=new FileReader();
            reader.onload=function(e){
                $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
    </script>
@endpush