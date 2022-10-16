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
                           COUPON ADDED
                            <small>COUPON Added label</small>
                        </h2>
                    
                    </div>
                    <div class="body">
                        <form action="{{route('cupons.store')}}" method="post">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="cupon_name" class="form-control"name="cupon_name">
                                    <label class="form-label"for="cupon_name">Coupon Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="cupon_discount" class="form-control"name="cupon_discount">
                                    <label class="form-label"for="cupon_discount">Coupon Discount (%)</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="date" id="cupon_validity" class="form-control"name="cupon_validity"placeholder="Coupon Validity Date"min="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                                    
                                   
                                </div>
                            </div>
                        
                            <br>
                            <a href="{{route('cupons.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Coupon Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
   
    </div>



@endsection
@push('js')
<script>
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
 </script>
@endpush