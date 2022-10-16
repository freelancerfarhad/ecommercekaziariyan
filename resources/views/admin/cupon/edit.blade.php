@extends('layouts.backend.app')
@section('title','Coupon')
    
@push('css')
    
@endpush
@section('content')
    

    <div class="container-fluid">
      

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Coupon EDIT
                            <small>Coupon Edit label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('cupons.update',$coupon->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="cupon_name" class="form-control"name="cupon_name"value="{{$coupon->cupon_name}}">
                                    <label class="form-label"for="cupon_name">Coupon Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="cupon_discount" class="form-control"name="cupon_discount"value="{{$coupon->cupon_discount}}">
                                    <label class="form-label"for="cupon_discount">Coupon Discount (%)</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="date" id="cupon_validity" class="form-control"name="cupon_validity"value="{{$coupon->cupon_validity}}"min="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                                    <label class="form-label"for="cupon_validity">Coupon Validity Date </label>
                              
                                </div>
                            </div>

                            <br>
                            <a href="{{route('cupons.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Coupon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
   
    </div>



@endsection
@push('js')
    
@endpush