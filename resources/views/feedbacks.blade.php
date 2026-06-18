<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pusat Perkidmatan Setempat - Feedback</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor-feedback/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor-feedback/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor-feedback/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor-feedback/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor-feedback/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor-feedback/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style-feedback.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Eterna - v4.7.0
  * Template URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background: url(assets/img/slide/slide3.jpeg)">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Selamat Datang Ke <span><br>Pusat Perkhidmatan Setempat, Kementerian Pendidikan</span></h2>
                <h3 class="animate__animated animate__fadeInUp">Jika Ada Sebarang Aduan/Maklumbalas Sila Nyatakan Dibawah</h3>
                <!-- <a href="" class="btn-get-started animate__animated animate__fadeInUp"></a> -->
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background: url(assets/img/slide/slide-2.jpeg)">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated fanimate__adeInDown">Welcome To <span><br>Pusat Perkhidmatan Setempat, Kementerian Pendidikan</span></h2>
                <h3 class="animate__animated animate__fadeInUp">If There Are Any Complaints/Feedbacks Please State Below</h3>
                <!-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a> -->
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Section ======= -->
    <section id="featured" class="featured">
      <div class="container">

      @if(Session::has('success'))
      <div class="alert alert-success">
      {{Session::get('success')}}
      </div>
      @endif

      <form class="" method="post" action="{{ route('feedbacks.feedback.store') }}" enctype="multipart/form-data">
          @csrf

              <div class="row gy-4">

                <div class="col-lg-6">
                  <select class="form-select" name="jenis" aria-label="Default select example">
                    <option selected>Jenis</option>
                    <option value="Maklum Balas">Maklum Balas</option>
                    <option value="Aduan">Aduan</option>
                  </select>
                </div>

                <div class="col-lg-12">
                  <textarea class="form-control" placeholder="Catatan" name="catatan" style="height: 100px"></textarea>
                </div>

                <div class="col-lg-6">
                  <input type="text" placeholder="Nama (Jika Perlu)" name="nama" class="form-control">
                </div>

                <div class="col-lg-6">
                  <input type="text" placeholder="Contact No. (Jika Perlu)" name="contact" class="form-control">
                </div>

              </div>

            <br>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>

      </div>
    </section>
    <!-- End Featured Section -->

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor-feedback/purecounter/purecounter.js"></script>
  <script src="assets/vendor-feedback/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor-feedback/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor-feedback/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor-feedback/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor-feedback/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor-feedback/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main-feedback.js"></script>

</body>

</html>