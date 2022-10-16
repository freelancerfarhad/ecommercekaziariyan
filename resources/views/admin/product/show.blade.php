@extends('layouts.backend.app')
@section('title','Post')
    
@push('css')
<link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<style>
    ul.dropdown-menu.inner li {
    margin-left: 33px;
  
}
</style>
@endpush
@section('content')
    

    <div class="container-fluid">
      <a href="{{route('post.index')}}"class="btn btn-danger waves-effect">&#8592 Back</a>
        @if ($post->is_approved==false)
        <button class="btn btn-success waves-effect pull-right"type="button"onclick="approvedpost({{$post->id}})">
            <i class="material-icons">done</i>
            <span>approve</span>
        </button>
        <form id="approval-form-{{$post->id}}" action="{{route('post.approved',$post->id)}}" method="post"style="display:none;">
            @csrf
            @method('PUT')
        </form>
        @else
        <button class="btn btn-success btn-sm pull-right"disabled>
            <i class="material-icons">done</i>
            <span>approved</span>
        </button>
        @endif
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix" style="margin-top:10px;">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4>
                            <h3>{{$post->title}}</h3>
                            <small>Posted by <strong>{{$post->user->name}} </strong> On <i>{{$post->created_at->format('M-d-Y')}}</i></small>
                           
                        </h4>
                    
                    </div>
                 
                    <div class="body">
                    
                           
                       <div class="post_body">
                        <p>{!! $post->body !!}</p>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                           CATEGORY
                        </h2>
                    
                    </div>
                    <div class="body">
                        @foreach ($post->categories as $category)
                            <span class="label bg-cyan">{{$category->name}}</span>
                        @endforeach
                       
                    </div>
                </div>

                <div class="card">
                    <div class="header bg-green">
                        <h2>
                           Tags
                        </h2>
                    
                    </div>
                    <div class="body">
                        @foreach ($post->tags as $tag)
                            <span class="label bg-green">{{$tag->name}}</span>
                        @endforeach
                       
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                           Tags
                        </h2>
                    
                    </div>
                    <div class="body">
                      
                            <img class="img-responsive thumbnail"src='{{asset("storage/post/$post->thumbnail")}}' alt="post_img">
                     
                       
                    </div>
                </div>
            </div>
        </div>


    </div>
    



@endsection
@push('js')
       <!-- Multi Select Plugin Js -->
       <script src="{{asset('assets/backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script> 
       <!-- TinyMCE -->
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
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
    function approvedpost(id){
             
             const swalWithBootstrapButtons = Swal.mixin({
             customClass: {
                 confirmButton: 'btn btn-success',
                 cancelButton: 'btn btn-danger'
             },
             buttonsStyling: false
             })

             swalWithBootstrapButtons.fire({
             title: 'Are you sure?',
             text: "You Went to Approved this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonText: 'Yes, approved it!',
             cancelButtonText: 'No, cancel!',
             reverseButtons: true
             }).then((result) => {
             if (result.isConfirmed) {
               event.preventDefault();
               document.getElementById('approval-form-'+id).submit();
             } else if (
                 /* Read more about handling dismissals below */
                 result.dismiss === Swal.DismissReason.cancel
             ) {
                 swalWithBootstrapButtons.fire(
                 'Cancelled',
                 'Your Post Unapproved :(sorry))',
                 'info'
                 )
             }
             })
 }
 </script>
@endpush