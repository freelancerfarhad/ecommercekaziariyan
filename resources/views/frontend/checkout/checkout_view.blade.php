@extends('layouts.frontend.app')

@section('title')
   Checkout
@endsection
@section('styles')
    
@endsection

@section('content')




<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb --> 




<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
	<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->

    <!-- panel-heading -->

		<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				<!-- guest-login -->			
				<div class="col-md-6 col-sm-6 already-registered-login">
					<h4 class="checkout-subtitle"><b>Shipping Address</b></h4>
				
	<form action="{{route('Checkout.Store')}}"class="register-form" role="form"method="POST">
		@csrf
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Shipping Name <span>*</span></label>
							<input type="text" name="shippping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Full Name" value="{{ Auth::user()->name }}" required="">
						  </div>  <!-- // end form group  -->
						  <div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
							<input type="email" name="shippping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email" value="{{ Auth::user()->email }}" required="">
						  </div>  <!-- // end form group  -->
						  <div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
							<input type="number" name="shippping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Phone" value="{{ Auth::user()->phone }}" required="">
						  </div>  <!-- // end form group  -->
					
					
						  <div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Post Code <span>*</span></label>
							<input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code" required="">
						  </div>  <!-- // end form group  -->
					
				</div>	
				<!-- guest-login -->

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
					<div class="form-group">
						<div class="form-line">
							<label class="info-title"for="division_id">Divistion SELECT <span style="color:red;">*</span></label>
							<select name="division_id" id="division_id"class="form-control show-tick"data-live-search="true">
								<option value=""selected disabled>SELECT Division</option>
								@foreach ($divisions as $division)
									<option value="{{$division->id}}"> {{ $division->ship_division_name }} </option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<label class="info-title"for="district_id">District <span style="color:red;">*</span></label>
							<select name="district_id" id="district_id"class="form-control show-tick"data-live-search="true">
								<option value=""selected disabled>SELECT District</option>
							
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<label class="info-title"for="street_id">State <span style="color:red;">*</span></label>
							<select name="street_id" id="street_id"class="form-control show-tick"data-live-search="true">
								<option value=""selected disabled>SELECT State</option>
							
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<label class="info-title"for="note">Note <span style="color:red;">*</span></label>
							<textarea name="note" id="" cols="42" rows="5"></textarea>
					</div>
					</div>
				
					
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
			<!-- panel-body  -->

			</div><!-- row -->
		</div>
		<!-- End checkout-step-01  -->




					</div><!-- /.checkout-steps -->
				</div>




				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
		<div class="checkout-progress-sidebar ">
			<div class="panel-group">
				<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">

					@foreach($carts as $item)
					<li> 
						<strong>Image: </strong>
						<img src="{{ asset('storage/product/'.$item->options->image) }}" style="height: 50px; width: 50px;">
					</li>

					<li> 
						<strong>Qty: </strong>
						 ( {{ $item->qty }} )

						 <strong>Color: </strong>
						 {{ $item->options->color }}

						 <strong>Size: </strong>
						 {{ $item->options->size }}
					</li>
                    @endforeach 
		<hr>
				<li>
				@if(Session::has('coupon'))

		<strong>SubTotal: </strong> ${{ $cartTotal }} <hr>

		<strong>Coupon Name : </strong> {{ session()->get('coupon')['cupon_name'] }}
		( {{ session()->get('coupon')['cupon_discount'] }} % )
		<hr>

		<strong>Coupon Discount : </strong> ${{ session()->get('coupon')['discount_amount'] }} 
		<hr>

		<strong>Grand Total : </strong> ${{ session()->get('coupon')['total_amount'] }} 
		<hr>


					@else

		<strong>SubTotal: </strong> ${{ $cartTotal }} <hr>

		<strong>Grand Total : </strong> ${{ $cartTotal }} <hr>


		 	@endif 

		 </li>



				</ul>		
			</div>
		</div>
		</div>
		</div> 
		<!-- checkout-progress-sidebar -->				</div>

		<div class="col-md-4">
			<!-- checkout-progress-sidebar -->
		<div class="checkout-progress-sidebar ">
		<div class="panel-group">
		<div class="panel panel-default">
		<div class="panel-heading">
		<h4 class="unicase-checkout-title">Select Payment Method</h4>
		</div>


				<div class="row">
				<div class="col-md-4">
				<label for="">Stripe</label> 		
				<input type="radio" name="payment_method" value="stripe">
				<img src="{{ asset('assets/frontend/assets/images/payments/4.png') }}">		    		
				</div> <!-- end col md 4 -->

				<div class="col-md-4">
					<label for="">Card</label> 		
				<input type="radio" name="payment_method" value="card">	
				<img src="{{ asset('assets/frontend/assets/images/payments/3.png') }}">    		
				</div> <!-- end col md 4 -->

				<div class="col-md-4">
					<label for="">Cash</label> 		
				<input type="radio" name="payment_method" value="cash">	
				<img src="{{ asset('assets/frontend/assets/images/payments/2.png') }}">  		
				</div> <!-- end col md 4 -->


				</div> <!-- // end row  -->
				<hr>
				<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>


				</div>
				</div>
				</div> 
				<!-- checkout-progress-sidebar --> </div>


	</form>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- === ===== BRANDS CAROUSEL ==== ======== -->

<!-- ===== == BRANDS CAROUSEL : END === === -->	
</div><!-- /.container -->
</div><!-- /.body-content -->


@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
	  $('select[name="division_id"]').on('change', function(){
		  var division_id = $(this).val();
		  if(division_id) {
			  $.ajax({
				  url: "{{  url('/district-get/ajax') }}/"+division_id,
				  type:"GET",
				  dataType:"json",
				  success:function(data) {
					var d =$('select[name="street_id"]').empty();
					 var d =$('select[name="district_id"]').empty();
						$.each(data, function(key, value){
							$('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
						});
				  },
			  });
		  } else {
			  alert('danger');
		  }
	  });//end district data


	  //state get data

	  $('select[name="district_id"]').on('change', function(){
		  var district_id = $(this).val();
		  if(district_id) {
			  $.ajax({
				  url: "{{  url('/state-get/ajax') }}/"+district_id,
				  type:"GET",
				  dataType:"json",
				  success:function(data) {
					 var d =$('select[name="street_id"]').empty();
						$.each(data, function(key, value){
							$('select[name="street_id"]').append('<option value="'+ value.id +'">' + value.street_name + '</option>');
						});
				  },
			  });
		  } else {
			  alert('danger');
		  }
	  });//end state get data
  });
</script>

@endsection