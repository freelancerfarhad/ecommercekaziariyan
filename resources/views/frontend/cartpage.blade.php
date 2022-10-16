@extends('layouts.frontend.app')

@section('title')
   Carts Show
@endsection
@section('styles')
    
@endsection

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{route('home')}}">Home</a></li>
				<li class='active'>My Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->


<div class="body-content">
	<div class="container">
		<div class="my-wishlist-page">
			<div class="row">
				<div class="col-md-12 my-wishlist">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="4" class="heading-title">My Carts</th>
				</tr>
				<tr>
					<th style="font-size: 15px !important;font-weight: 700;"class="cart-romove item">Image</th>
					<th style="font-size: 15px !important;font-weight: 700;" class="cart-product-name item">Name</th>
					<th style="font-size: 15px !important;font-weight: 700;" class="cart-edit item">Price</th>
					<th style="font-size: 15px !important;font-weight: 700;" class="cart-edit item">Color</th>
					<th style="font-size: 15px !important;font-weight: 700;" class="cart-edit item">Size</th>
					<th style="font-size: 15px !important;font-weight: 700;" class="cart-qty item">Quantity</th>
					<th style="font-size: 15px !important;font-weight: 700;" class="cart-sub-total item">Subtotal</th>
					<th style="font-size: 15px !important;font-weight: 700;" class="cart-total last-item">Remove</th>
				</tr>
			</thead>
            <tbody id="cartPage">



			</tbody>
		</table>
	</div>
</div>		

<div class="col-md-4 col-sm-12 estimate-ship-tax">
</div>
<div class="col-md-4 col-sm-12 estimate-ship-tax">
	@if (Session::has('coupon'))
		<p style="color:green">Already Coupon Applyed</p>
	@else
		

	<table class="table"id="couponField">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Discount Code</span>
					<p>Enter your coupon code if you have one..</p>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon.."id="coupon_name">
						</div>
						<div class="clearfix pull-right">
							<button type="submit" class="btn-upper btn btn-primary"onclick="applyCoupon()">APPLY COUPON</button>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
	@endif
</div><!-- /.estimate-ship-tax -->

<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table">
		<thead id="couponCalField">
		
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							{{-- <button type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</button> --}}
							<a href="{{ route('checkout') }}" type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div><!-- /.cart-shopping-total -->	
</div><!-- /.row -->
	



</div><!-- /.sigin-in-->
</div><!-- /.container -->
@include('layouts.frontend.partial.brand')

</div><!-- /.body-content -->
@endsection

@section('scripts')

@endsection
