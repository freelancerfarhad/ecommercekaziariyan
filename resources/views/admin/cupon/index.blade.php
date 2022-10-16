@extends('layouts.backend.app')

@section('title','Coupon')
@push('css')
<link href="{{asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    
<div class="container-fluid">
    <div class="block-header">
        <h2>
            <a href="{{route('cupons.create')}}"class="btn btn-primary">
                <i class="material-icons">add</i>
                <span>Coupon </span>
            </a>
        </h2>
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                       All Coupon
                       <span class="badge bg-blue">{{$cupons->count()}}</span>
                    </h2>
                 
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Coupon Name</th>
                                    <th>Coupon Discount</th>
                                    <th>Coupon Validity</th>
                                    <th>Create_time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Coupon Name</th>
                                    <th>Coupon Discount</th>
                                    <th>Coupon Validity</th>
                                    <th>Create_time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                       
                            @foreach ($cupons as $key=>$cupon)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$cupon->cupon_name}}</td>
                                <td>{{$cupon->cupon_discount}}%</td>
                                <td>{{ Carbon\Carbon::parse($cupon->cupon_validity)->format('D,d-F-Y')}}</td>
                                <td>{{$cupon->created_at->diffForHumans()}}</td>
                                <td>
                                    @if($cupon->cupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                    <span class="badge bg-green">Valid</span>
                                @else
                                <span class="badge bg-pink">Invalid</span>
                                @endif
                                </td>
                                <td>
                                    <a href="{{route('cupons.edit',$cupon->id)}}"class="btn btn-info  waves-effect">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button class="btn btn-danger waves-effect"type="button"onclick="deleteCupon({{$cupon->id}})">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <form id="delete-form-{{$cupon->id}}" action="{{route('cupons.destroy',$cupon->id)}}" method="post"style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @if ($cupon->status==1)
                                    <a href="{{route('catstatusInactive',$cupon->id)}}"class="btn btn-danger  waves-effect"title="Status Inactive">
                                        {{-- <i class="fa-solid fa-arrow-up"></i> --}}
                                        <i class="fa-solid fa-arrow-down"></i>
                                    </a>
                                    @else
                                    <a href="{{route('catstatusActive',$cupon->id)}}"class="btn btn-info  waves-effect"title="Status Active">
                                        <i class="fa-solid fa-arrow-up"></i>
                                        {{-- <i class="fa-solid fa-arrow-down"></i> --}}
                                    </a>
                                    @endif
                                </td>
                            </tr>
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
        function deleteCupon(id){
             
                    const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Are you sure to deleted Coupon ?',
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