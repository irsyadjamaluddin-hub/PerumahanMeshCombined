<!DOCTYPE html>
<html>
<title>MESH</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
  background-color: grey;
  min-height: 100%;
  background-position: center;
  background-size: cover;
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
<body>

    <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
		<div class="w3-display-middle">
			<h1 class="w3-container w3-animate-top">MOE E-SERVICE HUB</h1>
			<hr class="w3-border-grey" style="margin:auto;width:40%">
			<p class="w3-large w3-center">M E S H</p>

			<!-- Login and Reg -->
			@if (Route::has('login'))
				<p class="w3-large w3-center">
					@auth
						<a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
					@else
						<a href="{{ route('login') }}">LOGIN</a>&nbsp;&nbsp;&nbsp;&nbsp;
						
						@if (Route::has('register'))
							<a href="{{ route('register') }}">REGISTER</a></p>
						@endif
					@endauth
			@endif
			<!-- End of Login and Reg -->
			
		</div>  
    </div>

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