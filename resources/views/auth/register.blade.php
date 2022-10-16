@extends('layouts.frontend.app')

@section('title','Login')

@section('content')

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Sign in</h4>
                        <p class="">Login Hare Click Now.</p>
                        <a href="{{route('login')}}">
                            <img src="{{asset('assets/frontend/assets/images/login.jpg')}}" alt="Login"width="100%">
                        </a>
                    </div>
<!-- Sign-in -->

    <!-- create a new account -->
    <div class="col-md-6 col-sm-6 create-new-account">
        <h4 class="checkout-subtitle">Create a new account</h4>
        <p class="text title-tag-line">Create your new account.</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                <input type="email" class="form-control unicase-form-control text-input{{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail2"  name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
              </div>
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                <input type="text" class="form-control unicase-form-control text-input{{ $errors->has('name') ? ' is-invalid' : '' }}" id="exampleInputEmail1"name="name" value="{{ old('name') }}" required autofocus >
                @if ($errors->has('name'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
            </div>
      
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                <input type="password" class="form-control unicase-form-control text-input{{ $errors->has('password') ? ' is-invalid' : '' }}" id="exampleInputEmail1"name="password" required >
                
            @if ($errors->has('password'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
            </div>
             <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                <input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="password_confirmation" required>
            </div>
              <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
        </form>
        
        
    </div>	
<!-- create a new account -->		
        </div><!-- /.row -->
    </div><!-- /.sigin-in-->
 </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection

