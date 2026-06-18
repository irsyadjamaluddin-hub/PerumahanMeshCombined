<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		
    <title>MESH - Login</title>
	 
	{{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/> 

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset ('fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset ('css/style1.css') }}">
	
<style>

.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #74A2DD;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 8px;
  width: full;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

footer {
	text-align: center;
	padding: 3px;
	background-color: #F5F5F5;
	color: grey;
	bottom: 0;
	position:
	fixed;
	width: 100%;
	height: 5%;
}
.hide {
  display: none;
}
    
.myDIV:hover + .hide {
  display: block;
  color: red;
}
</style>
</head> 

<body>

<div class="main">

<!-- Sing in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
                <div class="signin-image">
               
                    <figure><img src="img/moeLogo.png" alt="moe logo"></figure>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="signup-image-link">Create an account here!</a>
                    @endif
                    
                    
                </div>

            <div class="signin-form">
                <h2 class="form-title">Log In</h2>

                @if(session()->has('verification_message'))
                    <div class="alert alert-success">
                        {{ session()->get('verification_message') }}
                    </div>
                @endif

                <form method="POST" class="register-form" id="login-form" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email"/>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                    </div>
                    <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                    </div>

                    <div class="form-group form-button">
                        <input type="submit" class="button" style="vertical-align:middle" {{ __('Login') }} value="Log in"/>
                    </div>
                    
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-grey-400 hover:text-grey-500 float-right mb-4">{{ __('Forgot Your Password?') }}</a>
                    @endif

                </form>
            </div>
            
        </div>
    </div>
</section>

</div>

<!-- JS -->
<script src="{{ asset ('vendor/vendor1/jquery/jquery.min.js') }}"></script>
<script src="{{ asset ('js/main.js') }}"></script>   

<footer>
	<div class="myDIV">
		<a href="https://bn.linkedin.com/in/hafiz-hamidi-5b46771b2">
		Ministry of Education &copy; 2021 All Rights Reserved
		</a>
	</div>
	<div class="hide">
		<a href="https://bn.linkedin.com/in/hafiz-hamidi-5b46771b2"> Hafiz Hamidi (Lead Developer); &nbsp;	
		<a href="https://bn.linkedin.com/in/hafiz-hamidi-5b46771b2"> Nadzirah Hasim (Designer)
	</div>
</footer>

</body>


</html>