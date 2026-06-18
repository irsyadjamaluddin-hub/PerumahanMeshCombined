<!DOCTYPE html>
<html>
<title>MESH</title>

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">
  <link href="/assets/img/backdrop.png" rel="bgimg">
  
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
	min-height: 100%;
	background-position: center center;
  	background-repeat: no-repeat;
  	background-size: cover;
  	background-image: url('assets/img/backdrop.png');
  	background-attachment: fixed;
}

footer {
	text-align: center;
	padding: 3px;
	/* background-color: grey; */
	color: grey;
	bottom: 0;
	position: fixed;
	width: 100%;
	height: 10%;
}
    
.myDIV:hover + .hide {
  display: block;
  color: red;
}
</style>
<body>

    <div class="bgimg w3-display-container w3-animate-opacity w3-text-black">
		<div class="w3-display-middle">
			<h1 class="w3-container w3-animate-top w3-center">MOE EMPLOYEE & SERVICES HUB</h1>
			<hr class="w3-border-grey" style="margin:auto;width:40%">
			<p class="w3-large w3-center">M E S H</p>
			

			
				<p class="w3-large w3-center">
					
						<a href="{{ route('login') }}">LOGIN</a>&nbsp;&nbsp;&nbsp;&nbsp;
						
						
							<a href="{{ route('register') }}">REGISTER</a></p>
					
			<!-- End of Login and Reg -->
			
		</div>  
    </div>

<footer>
		<div class="myDIV">
		<span style="color:grey" title="Developed by: Saidatul Ekma (MESH Lead Developer) Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer)">
		Ministry of Education &copy; 2021 All Rights Reserved</span>
		</a>

		<br>

		<a href="/terms">
			<span style="color:grey" title="Terms&Condition">
			Terms & Condition </span>
			</a>
	</div>
</footer>

</body>

</html>