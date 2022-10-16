@extends('layouts.backend.app')
@section('title','Logo')
    
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
      
        <form action="{{route('logo.update',$logos->id)}}" method="post"enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                    <label class="">Futures Image </label>
                                    <input type="file" id="image" class="form-control"name="logo">
                                    <img src='{{asset("public/storage/logo/".$logos->logo)}}' alt="logo"width="50"height="50">
                                </div>
                            </div>
                          
                            <br>
                            <a href="{{route('logo.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>


                       
                    </div>
                </div>
            </div>
          
             
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