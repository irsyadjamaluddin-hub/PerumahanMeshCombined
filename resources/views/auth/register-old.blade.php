<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MESH - Registration</title>

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
  width: 100%;
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

footer a:link {
  color: grey;	
  background-color: transparent;
  text-decoration: none;
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

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Register</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{ route('register') }}">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Name (As stated in IC)"/>
								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
                            </div>
							<div class="form-group">
                                <label for="ic_no"><i class="zmdi zmdi-account-box-o"></i></label>
                                <input type="text" name="ic_no" id="ic_no" placeholder="IC Number"/>
								@error('ic_no')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email Address"/>
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
                            <div class="form-group">
                                <label for="password-confirm"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password-confirm" id="password-confirm" placeholder="Confirm Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
							<input type="submit" class="button" style="vertical-align:middle" {{ __('Login') }} value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset ('img/moeLogo.png') }}" alt="sing up image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link">I have an account. Login here!</a>
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
		<a style="color:red;" href="https://bn.linkedin.com/in/hafiz-hamidi-5b46771b2"> Hafiz Hamidi (Lead Developer); &nbsp;	
		<a style="color:red;" href="https://bn.linkedin.com/in/hafiz-hamidi-5b46771b2"> Nadzirah Hasim (Designer)
	</div>
</footer>

</body>
</html>