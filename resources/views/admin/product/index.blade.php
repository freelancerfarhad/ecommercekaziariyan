@extends('layouts.backend.app')
@section('title','Product')
    

@push('css')
<link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


@endpush
@section('content')
    
<div class="container-fluid">
    <div class="block-header">
        <h2>
            <a href="{{route('product.create')}}"class="btn btn-primary">
                <i class="material-icons">add</i>
                <span>Product Add</span>
            </a>
        </h2>
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                       All Posts
                       {{-- <span class="badge bg-blue">{{$posts->count()}}</span> --}}
                    </h2>
                 
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Product Name En</th>
                                    <th>Product price</th>           
                                    <th>Quatity</th>           
                                    <th>Discount price</th>           
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Product Name En</th>
                                    <th>Product price</th>           
                                    <th>Quatity</th>           
                                    <th>Discount price</th>           
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($products as $key=>$product)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td> <img src='{{asset("storage/product/$product->product_thumbnail")}}' alt="Img"width="50"height="50">
                                        </td>
                                        <td>{{Str::limit($product->product_name_en,20)}}</td>
                                        <td>{{$product->selling_price}} $</td>
                                        <td>{{$product->product_qty}} Pic</td>
                                        <td>
                                            @if ($product->discount_price ==null)
                                            <span class="badge bg-pink">Not Diccount</span>
                                            @else
                                           @php
                                                $amount=$product->selling_price - $product->discount_price;
                                                $discountPrice=($amount/$product->selling_price) * 100;
                                           @endphp
                                            <span class="badge bg-green">{{round($discountPrice)}}%</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->status==true)
                                                <span class="badge bg-green">Active</span>
                                            @else
                                            <span class="badge bg-pink">Inactive</span>
                                            @endif
                                        </td>
                                      
                                        <td>
                                        
                                            <a href="{{route('product.show',$product->id)}}"class="btn btn-primary  waves-effect"title="Read Product">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{route('product.edit',$product->id)}}"class="btn btn-info  waves-effect"title="Edit Product">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button class="btn btn-danger waves-effect"type="button"onclick="deleteProduct({{$product->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{$product->id}}" action="{{route('product.destroy',$product->id)}}" method="post"style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @if ($product->status==1)
                                        <a href="{{route('statusInactive',$product->id)}}"class="btn btn-danger  waves-effect"title="Status Inactive">
                                            {{-- <i class="fa-solid fa-arrow-up"></i> --}}
                                            <i class="fa-solid fa-arrow-down"></i>
                                        </a>
                                        @else
                                        <a href="{{route('statusActive',$product->id)}}"class="btn btn-info  waves-effect"title="Status Active">
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
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        function deleteProduct(id){
             
                    const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Are you sure to Product deleted ?',
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