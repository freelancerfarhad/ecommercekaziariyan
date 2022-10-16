@extends('layouts.backend.app')

@section('title','Comment')
@push('css')
<link href="{{asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush
@section('content')
    
<div class="container-fluid">
    {{-- <div class="block-header">
        <h2>
            <a href="{{route('tag.create')}}"class="btn btn-primary">
                <i class="material-icons">add</i>
                <span>Add Tag</span>
            </a>
        </h2>
    </div> --}}
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                       All Comments
                       {{-- <span class="badge bg-blue">{{$posts->comments->count()}}</span> --}}
                    </h2>
                 
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th class="text-center">Comments Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th class="text-center">Comments Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </tfoot>
                            <tbody>
                            @foreach ($posts as $key=>$post)
                            @foreach ($post->comments as $comment)
                                
                         
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src='{{asset("public/storage/profile/".$comment->user->image) }}' width="64" height="64">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small>
                                            </h4>
                                            <p>{{Str::limit($comment->comment,'40') }}</p>
                                            {{-- <a target="_blank" href="{{ route('post.details',$comment->post->slug.'#comments') }}">Reply</a> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="media">
                                        <div class="media-right">
                                            {{-- {{ route('post.details',$comment->post->slug) }} --}}
                                            <a target="_blank" href="">
                                                <img class="media-object" src='{{asset("public/storage/post/".$comment->post->thumbnail) }}' width="60" height="60">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a target="_blank" href="">
                                                <h4 class="media-heading">{{Str::limit($comment->post->title,'40') }}</h4>
                                            </a>
                                            <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger waves-effect" onclick="deleteComment({{ $comment->id }})">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <form id="delete-form-{{ $comment->id }}" method="POST" action="{{ route('comments.destroy',$comment->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>


@endsection
@push('js')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        function deleteComment(id){
             
                    const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {
                      event.preventDefault();
                      document.getElementById('delete-form-'+id).submit();
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your Data  is safe :)',
                        'error'
                        )
                    }
                    })
        }
 </script>
@endpush