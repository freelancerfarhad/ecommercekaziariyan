@extends('layouts.backend.app')
@section('title','Post')
    
@push('css')
<link href="{{asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<style>
    ul.dropdown-menu.inner li {
    margin-left: 33px;
  
}
</style>
@endpush
@section('content')
    

    <div class="container-fluid">
      
        <form action="{{route('posts.store')}}" method="post"enctype="multipart/form-data">
            @csrf
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header"style="background:green;">
                        <h4 style="color:white;">
                           Post / Create
                           
                        </h4>
                    
                    </div>
                    <div class="body">
                        
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control"name="title">
                                    <label class="form-label"for="name">Title</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="">Futures Image </label>
                                    <input type="file" id="image" class="form-control"name="thumbnail">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                 
                                    <input type="checkbox" name="status" value="1"id="publish"class="filled-in">
                                    <label for="publish">Publish</label>

                                    
                                </div>
                            </div>
                            
                       
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           CATEGORY And Tags
                        </h2>
                    
                    </div>
                    <div class="body">
                        {{-- {{$error->has('tags') ? 'focused error':''}} --}}
                            <div class="form-group">
                                <div class="form-line">
                                    <label class=""for="category">Select Category</label>
                                    <select name="category[]" id="category"class="form-control show-tick"data-live-search="true"multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}"> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label class=""for="tags">Select Tags</label>
                                    <select name="tags[]" id="tags"class="form-control show-tick"data-live-search="true"multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}"> {{ $tag->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <br>
                            <a href="{{route('posts.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect"> Publish</button>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Body
                        
                        </h2>
                    
                    </div>
                    <div class="body">
                       
                     <textarea name="body" id="tinymce"></textarea>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    



@endsection
@push('js')
       <!-- Multi Select Plugin Js -->
       <script src="{{asset('public/assets/backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script> 
       <!-- TinyMCE -->
    <script src="{{asset('public/assets/backend/plugins/tinymce/tinymce.js')}}"></script>
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
    tinyMCE.baseURL = "{{asset('public/assets/backend/plugins/tinymce')}}";
    });
 </script>
@endpush