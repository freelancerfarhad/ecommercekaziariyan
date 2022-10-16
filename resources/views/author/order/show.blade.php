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
      <a href="{{route('order.index')}}"class="btn btn-danger waves-effect">&#8592 Back</a>

        <div class="row clearfix" style="margin-top:10px;">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4>Shipping Details</h4>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <tbody>
                                <tr>
                                    <td>Shipping Name</td>
                                    <td><b>{{$order->user->name}}</b></td>
                                </tr>
                                <tr>
                                    <td>Shipping Phone</td>
                                    <td><b>{{$order->phone}}</b></td>
                                </tr>
                                <tr>
                                    <td>Shipping Email</td>
                                    <td><b>{{$order->email}}</b></td>
                                </tr>
                                <tr>
                                    <td>Division</td>
                                    <td><b>{{$order->division->ship_division_name}}</b></td>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td><b>{{$order->district->district_name}}</b></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><b>
                                        {{$order->state->street_name}}
                                    </b></td>
                                </tr>
                                <tr>
                                    <td>Post Code</td>
                                    <td><b>{{$order->post_code}}</b></td>
                                </tr>
                                <tr>
                                    <td>Order Date</td>
                                    <td><b>{{$order->order_date}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                 <div class="header">
                   <h4> Order Details <span style="color:rgb(219, 109, 5)">Invoice : {{$order->invoice_no}}</span><h4>
                 </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <tbody>
                                <tr>
                                    <td>Shipping Name</td>
                                    <td><b>{{$order->user->name}}</b></td>
                                </tr>
                                <tr>
                                    <td>Shipping Phone</td>
                                    <td><b>{{$order->phone}}</b></td>
                                </tr>
                                <tr>
                                    <td>Payment Type</td>
                                    <td><b>{{$order->payment_method}}</b></td>
                                </tr>
                                <tr>
                                    <td>Tranx ID</td>
                                    <td><b>{{$order->transaction_id}}</b></td>
                                </tr>
                                <tr>
                                    <td>Invoice</td>
                                    <td><b>{{$order->invoice_no}}</b></td>
                                </tr>
                                <tr>
                                    <td>Order Total</td>
                                    <td><b>{{$order->amount}}</b></td>
                                </tr>
                                <tr>
                                    <td>Order</td>
                                    <td><b><span class="badge bg-blue">
                                        {{$order->status}}</span>
                                    </b></td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix" style="margin-top:10px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
               
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Product Name</td>
                                    <td>Product Code</td>
                                    <td>Color</td>
                                    <td>Size</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                </tr>
                            </thead>
                            <tbody>
                        
              @foreach($orderitem as $item)
                <tr>
                       {{-- <td class="col-md-1">
                         <label for=""><img src="{{ asset($item->product->product_thambnail) }}" height="50px;" width="50px;"> </label>
                       </td> --}}
       
                       {{-- <td class="col-md-3">
                         <label for=""> {{ $item->product->product_name_en }}</label>
                       </td> --}}
       
       
                        {{-- <td class="col-md-3">
                         <label for=""> {{ $item->product->product_code }}</label>
                       </td> --}}
       
                       <td class="col-md-2">
                         <label for=""> {{ $item->color }}</label>
                       </td>
       
                       <td class="col-md-2">
                         <label for=""> {{ $item->size }}</label>
                       </td>
       
                        <td class="col-md-2">
                         <label for=""> {{ $item->qty }}</label>
                       </td>
       
                 <td class="col-md-2">
                         <label for=""> ${{ $item->price }}  ( $ {{ $item->price * $item->qty}} ) </label>
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
    



@endsection
