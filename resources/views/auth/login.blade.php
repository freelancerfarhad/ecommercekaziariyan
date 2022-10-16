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
                        <p class="">Hello, Welcome to your account.</p>
                       
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="social-sign-in outer-top-xs">
                                <a href="{{url('login/facebook')}}" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                                <a href="{{url('login/google')}}" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with google</a>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input{{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail1"name="email" value="{{ old('email') }}" required autofocus >
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input {{ $errors->has('password') ? ' is-invalid' : '' }}" id="exampleInputPassword1" name="password" required >
                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            </div>
                            <div class="radio outer-xs">
                                <label>
                                    <input type="radio" name="remember" {{ old('remember') ? 'checked' : '' }} id="optionsRadios2" value="option2">Remember me!
                                </label>
                                <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                        </form>					
                    </div>
<!-- Sign-in -->

    <!-- create a new account -->
            <div class="col-md-6 col-sm-6 create-new-account">
                <h4 class="checkout-subtitle">Create a new account</h4>
                <a href="{{route('register')}}">
                    <img src="{{asset('assets/frontend/assets/images/signup.jpg')}}" alt="Sign Up"width="100%">
                </a>

        
            </div>	
<!-- create a new account -->		
        </div><!-- /.row -->
    </div><!-- /.sigin-in-->
 </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection

