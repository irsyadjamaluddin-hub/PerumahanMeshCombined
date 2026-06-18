<!DOCTYPE html>
<html lang="en">

<head>
<title>MESH</title>

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">
  <link href="/assets/img/backdrop.png" rel="bgimg">
  
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendors/aos/aos.css" rel="stylesheet">
  <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendors/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendors/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
  
  <!-- Template Main CSS File -->
  <!-- <link href="assets/css/styles.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/style.css" rel="stylesheet"> -->

  <!-- Pop Up -->
  <!-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" /> -->
  <link href="assets/css/tailwind.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<style>
/* body,h1,h2 {font-family: "Nunito", sans-serif} */
body, html {height: 100%}
main {
  width: 100%;
  height: 100vh;
  overflow: hidden;
  position: relative;
  background: url("assets/img/1085283.jpg") top center;
  background-color: rgba(2, 5, 161, 0.70);
  background-blend-mode: soft-light;
  background-size: cover;
  transition: 0.3s;
	text-align: center;

}

footer {
	text-align: center;
	padding: 3px;
	color: grey;
	bottom: 0;
	position: fixed;
	width: 100%;
	/* height: 10%; */
}
    
.myDIV:hover + .hide {
  display: block;
  color: red;
}
</style>

<body>

<main>
<section class="min-vh-100 d-flex flex-column align-items-center justify-content-center">
<div class="container">
<div class="row justify-content-center">

			<div class="d-flex justify-content-center" style="margin-bottom: 15px;">
        <a class="logo d-flex align-items-center w-auto">
          <img src="assets/img/moe-logo-latest-white.png" alt="" style="width: 320px;">
        </a>
      </div><!-- End Logo -->

			<h1 style="font-weight:600; color: white;">MOE EMPLOYEE & SERVICES HUB</h1>
			<hr class="w3-border-grey" style="margin:10px;width:20%"></hr>
			<h2 style="font-weight:600; color: white;">M E S H</h2>
			<p class="w3-large w3-center mt-3">
					<a class="btn btn-outline-light rounded-pill" style="font-weight:700; font-size: 18px;" href="{{ route('login') }}">LOGIN</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="btn btn-outline-light rounded-pill" style="font-weight:700; font-size: 18px;" href="{{ route('registerform') }}">REGISTER</a>
			</p>
<!-- 			<hr class="w3-border-grey" style="margin:10px;width:20%"></hr>
			<p class="w3-large w3-center">
					<a style="font-size: 14px; color:white;">Pautan Panduan Video:</a>
					<br>
					<a style="font-size: 13px; color:white;" href="{{ asset('../video/mesh.mp4') }}">Tatacara Mengemaskini Ujian ART</a>
					<br>
					<a style="font-size: 13px; color:white;" href="{{ asset('../video/mesh1.mp4') }}">Panduan bagi Fokal ART Jabatan</a>
			</p> -->
</div>
</div>
</section>
</main>

<footer id="footer">
    <div class="container">
      <div class="copyright">
        <span style="font-size: 13px; color:white" title="Developed by: Saidatul Ekma (MESH Lead Developer), Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer), Lyanna Karim (MESH Layout & Design)">
		Ministry of Education &copy; 2021 All Rights Reserved</span>
		<br>
		<a style="font-size: 13px; color:white" href="/terms">
			<span style="color:white" title="Terms&Condition">Terms & Condition</span>
		</a>
      </div>
    </div>
</footer>

</body>

</html>