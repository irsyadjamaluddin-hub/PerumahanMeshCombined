<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Aduan SSM Form</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

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
  <link href="assets/css/admin.css" rel="stylesheet">
 

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


  <style>
    p {
      font-size: 14px;
    }
    body {
      background: #4f77aa;
    }

  </style>

</head>

<body>

  
 <!-- Back Button - Only visible when user is logged in -->
       @auth  
        <div class="container" style="padding-top: 20px;">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <a href="https://mesh.moe.gov.bn/servicesdashboard" class="btn btn-primary" style="margin-bottom: 10px;">
                <i class="bi bi-arrow-left"></i> 
              </a>
            </div>
          </div>
        </div>
        @endauth

  <!-- Borang Table -->
  <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">

  <div class="col-12">
    <div class="card" style="padding-left: 20px; padding-right: 20px;">



      <div class="card-body">

        <div class="profile-overview pt-3">

        @if (count($errors) > 0)
          <div class="alert alert-danger">
              Upload Validation Error<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
            <br>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-info text-white"  type="button" data-toggle="modal" data-target="#rujukan">Status Rujukan</button>
            </div>

            <form method="get" action="{{ route('statusssmrequest') }}">
                <!-- Modal -->
                <div class="modal fade" id="rujukan" tabindex="-1" role="dialog" aria-labelledby="statusrujukan" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 25%;" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="statusrujukan">Sila isi nombor rujukan anda</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border-width: 0px; background-color:white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="input-group">
                                    <select class="input-group-text" id="prefixSelect" name="prefix">
                                        <option value="BC" title="Baki Cuti">BC</option>
                                        <option value="PKP" title="Pertukaran No Kad Pengenalan">PKP</option>
                                        <option value="AP" title="Approval/Berpindah Tempat Bertugas">AP</option>
                                        <option value="DC" title="Delete Cuti">DC</option>
                                        <option value="PE" title="Peranan">PE</option>
                                        <option value="PS" title="Reset Password">PS</option>
                                        <option value="LL" title="Others">LL</option>
                                    </select>
                                    <input type="number" name="rujukan" class="form-control" placeholder="Nombor Rujukan" id="formattedInput">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="submit-buttonstatus" type="submit" class="btn btn-primary">Hantar</button>

                                <script>
                                    var submitButton = document.getElementById('submit-buttonstatus');
                                    var form = document.getElementById('rujukan');

                                    form.addEventListener('submit', function(event) {
                                        if (submitButton.getAttribute('data-submitted') !== null) {
                                            event.preventDefault();
                                        } else {
                                            submitButton.disabled = true;
                                            submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                            submitButton.setAttribute('data-submitted', 'true');
                                        }
                                    });
                                </script>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff; background-color: #6c757d; border-color: #6c757d;">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
            <center><img src="{{ asset('img/newmoelogo.png') }}" class="d-block" style="height: 250px;" alt="MOE LOGO"></center>
            <br>
            @if(Session::has('success_message'))
                <div class="alert alert-success" style="box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);">
                    {!! Session::get('success_message') !!}
                </div>
            @elseif(Session::has('error_message'))
                <div class="alert alert-danger" style="box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);">
                    {!! Session::get('error_message') !!}
                </div>
            @endif
            <br>
            <header class="card-title" style="padding: 0px; font-size: 18px;">Borang Aduan SSM</header>

            <hr>

              <!-- ==================================================================================================== -->
                      <!-- Added by Amal 'Izzah (PB) -->
              <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 col-form-label">Kategori:</label>
                  <div class="col-sm-8">
                    <select name="category" id="categorySelect" class="form-control" required>
                      <option value="">Pilih Kategori</option>
                      <option value="bakicuti">Penyelarasan Baki Cuti</option>
                      <option value="pertukaranicno">Pertukaran No Kad Pengenalan</option>
                      <option value="Approval">Approval/Berpindah Tempat Bertugas</option>
                      <option value="Delete Cuti">Delete Cuti</option>
                      <option value="Peranan">Peranan</option>
                      <option value="Password">Reset Password</option>
                      <option value="others">Others</option>
                    </select>
                    {!! $errors->first('category', '<p class="help-block text-danger">:message</p>') !!}
                  </div>
                </div>
                <!-- ==================================================================================================== -->

                 <!-- form 1 : Baki Cuti -->
                  <form class="" id="storebakicuti" method="post" action="{{ route('ssmrequests.ssmrequest.storebakicuti') }}" enctype="multipart/form-data">
                    @csrf
                      <div id="bakicuti" style="display: none;">

                          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Penyelarasan Baki Cuti Form</h5>
          
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="bc_name" class="form-control" placeholder="Nama penuh">

                              {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                            <div class="col-sm-8">
                              <input type="text" name="bc_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                              {!! $errors->first('icno', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                            <div class="col-sm-8">
                            <select class="form-select" name="bc_jawatan" aria-label="Default select example" id="myselectjawatan" required>
                              <option selected hidden>Pilih Jawatan</option>
                              @foreach ($jawatanlist as $key => $value)
                              <option value="{{ $value }}">
                                  {{ $value }}
                              </option>
                              @endforeach
                          </select>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                              <input type="text" name="bc_email" class="form-control" placeholder="example@moe.gov.bn">

                              {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Nombor Tel</label>
                            <div class="col-sm-8">
                              <input type="text" name="bc_notel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                              {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Tempat Bertugas Sekarang</label>
                            <div class="col-sm-8">
                              <input type="text" name="bc_workplace" class="form-control" placeholder="">

                              {!! $errors->first('Tempat Betugas', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Tarikh Lantikan Sekarang</label>
                            <div class="col-sm-8">
                              <input type="date" name="bc_date" class="form-control" placeholder="">

                              {!! $errors->first('Tarikh Lantikan Sekarang', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Baki Cuti SSM</label>
                            <div class="col-sm-8">
                              <input type="text" name="bc_days" class="form-control" placeholder="Eg.20 hari">

                              {!! $errors->first('Baki Cuti SSM', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                       <div class="row mb-3">
						    <label for="inputText" class="col-sm-4 col-form-label">Baki Cuti (JPP/Unit Cuti)
						        <a href="#" class="info-icon-link"><i class="bi bi-info-circle ms-2"></i></a>
						    </label>
						    <div class="col-sm-8">
						        <input type="text" name="bc_daysjpp" class="form-control" placeholder="Eg.20 hari">
						        <div class="info-text" style="display: none; color: blue; font-size: small;">*JPP-Bagi Tenaga Pengajar / Unit Cuti-Bagi Bukan Tenaga Pengajar</div>
						        {!! $errors->first('Baki Cuti JPP', '<p class="help-block text-danger">:message</p>') !!}
						    </div>
						</div>

						<style>
							.info-icon-link {
								    color: blue;
								    text-decoration: none; /* remove underline */
								}

								.info-icon-link:hover {
								    text-decoration: underline; /* underline on hover */
								}
						</style>

						<script>
							    $(document).ready(function(){
							        $(".info-icon-link").click(function(e){
							            e.preventDefault();
							            $(this).closest('.row').find('.info-text').toggle();
							        });
							    });
							</script>





                      

                          <div id="file-input-container">
                                <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen</label>
                                <div class="col-sm-8" id="file-dropzone" class="dropzone">
                                  <span>Drag and drop files here or click to browse</span>
                                    <input name="bc_file[]" type="file" multiple />
                            </div>
                            </div>
                            </div>


                    

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                            <div class="col-sm-8">
                              <textarea type="text" name="bc_catatanuser" class="form-control" placeholder="catatan" ></textarea>

                              {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                           <!-- captcha question -->

                                                <!-- Add hidden input for the correct answer -->
                                                <input type="hidden" name="correctAnswer" value="{{ $correctAnswer }}">

<div class="row mb-3">
    <label for="inputtel" class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">{{ $captchaQuestion }}</i>
    </label>
    <div class="col-lg-8">
        <div class="captcha-numbers">
            @foreach ($numbers as $number)
                <button type="button" class="btn btn-outline-primary number-btn" data-number="{{ $number }}">
                    {{ $number }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="captcha" id="captcha">
        @if ($errors->has('captcha'))
            <span class="text-danger">{{$errors->first('captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-numbers {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .number-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .number-btn.active {
        background-color: blue;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numberButtons = document.querySelectorAll('.number-btn');
        const captchaInput = document.getElementById('captcha');

        numberButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                numberButtons.forEach(btn => btn.classList.remove('active'));

                // Add 'active' class to the clicked button
                this.classList.add('active');

                // Set the value of the clicked button to the hidden input
                captchaInput.value = this.dataset.number;
            });
        });
    });
</script>

<!-- end captcha -->

                          <div class="text-center">
                            <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                          </div>
                          <script>
                            var submitButton = document.getElementById('submit-button');
                            var form = document.getElementById('storebakicuti');
                          
                            form.addEventListener('submit', function(event) {
                                if (submitButton.getAttribute('data-submitted') !== null) {
                                    event.preventDefault();
                                } else {
                                    submitButton.disabled = true;
                                    submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                    submitButton.setAttribute('data-submitted', 'true');
                                }
                            });
                          </script>

                      </div>

                  </form>
                <!-- end form 1 -->

                <!-- form 2 : Cuti -->
                  <form class="" id="storepertukaranic" method="post" action="{{ route('ssmrequests.ssmrequest.storepertukaranic') }}" id="myDropzone"   class="dropzone" enctype="multipart/form-data">
                      @csrf

                      <div id="pertukaranicno" style="display: none;">

                          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Pertukaran No Kad Pengenalan Form</h5>

                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                  <input type="text" name="pi_name" class="form-control" placeholder="Nama penuh">

                                  {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                                </div>
                              </div>

                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">IC No. (Lama)</label>
                                <div class="col-sm-8">
                                  <input type="text" name="pi_icno_old" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                                  {!! $errors->first('IC Number Lama', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>

                              <style>
                                    #file-dropzone {
                                        border: 3px dashed #ccc;
                                        border-radius: 4px;
                                        padding: 10px;
                                        text-align: center;
                                        cursor: pointer;
                                        margin-bottom: 10px;
                                    }
                                </style>

                              
                              <div id="file-input-container">
                                  <div class="row mb-3">
                                  <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen IC No. (Lama)</label>
                                  <div class="col-sm-8" id="file-dropzone" class="dropzone">
                                    <span>Drag and drop files here or click to browse</span>
                                      <input name="pi_fileold[]" type="file" multiple />
                              </div>
                              </div>
                              </div>

                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">IC No. (Baru)</label>
                                <div class="col-sm-8">
                                  <input type="text" name="pi_icno_new" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                                  {!! $errors->first('IC Number Baru', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>

                              <style>
                                    #file-dropzone {
                                        border: 3px dashed #ccc;
                                        border-radius: 4px;
                                        padding: 10px;
                                        text-align: center;
                                        cursor: pointer;
                                        margin-bottom: 10px;
                                    }
                                </style>

                              
                              <div id="file-input-container">
                                  <div class="row mb-3">
                                  <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen IC No. (Baru)</label>
                                  <div class="col-sm-8" id="file-dropzone" class="dropzone">
                                    <span>Drag and drop files here or click to browse</span>
                                      <input name="pi_filenew[]" type="file" multiple />
                              </div>
                              </div>
                              </div>

                              <div class="row mb-3">
                              <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                              <div class="col-sm-8">
                              <select class="form-select" name="pi_jawatan" aria-label="Default select example" id="myselectjawatanp" required>
                                <option selected hidden>Jawatan</option>
                                @foreach ($jawatanlist as $key => $value)
                                <option value="{{ $value }}">
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                              </div>
                            </div>

                                  <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Tempat Bertugas</label>
                                <div class="col-sm-8">
                                  <input type="text" name="pi_workplace" class="form-control" placeholder="" >

                                  {!! $errors->first('Tempat Bertugas', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>

                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                  <input type="text" name="pi_email" class="form-control" placeholder="example@moe.gov.bn" >

                                  {!! $errors->first('Email', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>

                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                                <div class="col-sm-8">
                                  <input type="text" name="pi_notel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}" >

                                  {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>

                        
                        
                              <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                                <div class="col-sm-8">
                                  <textarea type="text" name="pi_catatanuser" class="form-control" placeholder="catatan" ></textarea>

                                  {!! $errors->first('Catatan', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                              </div>

                                <!-- captcha question -->

                          <input type="hidden" name="pi_correctAnswer" value="{{ $pi_correctAnswer }}">

<div class="row mb-3">
    <label for="inputtel" class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">{{ $pi_captchaQuestion }}</i>
    </label>
    <div class="col-lg-8">
        <div class="captcha-numbers">
            @foreach ($numbers as $pi_number)
                <button type="button" class="btn btn-outline-primary number-btn" data-number="{{ $pi_number }}">
                    {{ $pi_number }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="pi_captcha" id="pi_captcha">
        @if ($errors->has('pi_captcha'))
            <span class="text-danger">{{$errors->first('pi_captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-numbers {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .number-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .number-btn.active {
        background-color: blue;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numberButtons = document.querySelectorAll('.number-btn');
        const captchaInput = document.getElementById('pi_captcha');

        numberButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                numberButtons.forEach(btn => btn.classList.remove('active'));

                // Add 'active' class to the clicked button
                this.classList.add('active');

                // Set the value of the clicked button to the hidden input
                captchaInput.value = this.dataset.number;
            });
        });
    });
</script>


<!-- end captcha -->


                              <div class="text-center">
                                <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                              </div>
                              <script>
                                var submitButton = document.getElementById('submit-button');
                                var form = document.getElementById('storepertukaranic');
                              
                                form.addEventListener('submit', function(event) {
                                    if (submitButton.getAttribute('data-submitted') !== null) {
                                        event.preventDefault();
                                    } else {
                                        submitButton.disabled = true;
                                        submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                        submitButton.setAttribute('data-submitted', 'true');
                                    }
                                });
                              </script>
          
                                  
                                  </div>
                              </div>

                            
                        </div>

                  </form>

                  <!-- Include Dropzone.css in the head of your layout file -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

                    <!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

                    <!-- Your JavaScript code -->
                    <script>
                       Dropzone.options.fileDropzone = {
                            paramName: "pi_fileold", // The name that will be used to transfer the file
                            maxFilesize: 2, // MB
                            addRemoveLinks: true,
                            init: function () {
                                this.on("success", function (file, response) {
                                    // Handle the success response, if needed
                                    console.log(response);
                                });

                                this.on("removedfile", function (file) {
                                    // Handle the file removal, if needed
                                    console.log(file);
                                });
                            },
                        };

                        Dropzone.options.fileDropzone = {
                            paramName: "pi_filenew", // The name that will be used to transfer the file
                            maxFilesize: 2, // MB
                            addRemoveLinks: true,
                            init: function () {
                                this.on("success", function (file, response) {
                                    // Handle the success response, if needed
                                    console.log(response);
                                });

                                this.on("removedfile", function (file) {
                                    // Handle the file removal, if needed
                                    console.log(file);
                                });
                            },
                        };

                        Dropzone.options.fileDropzone = {
                            paramName: "bc_file", // The name that will be used to transfer the file
                            maxFilesize: 2, // MB
                            addRemoveLinks: true,
                            init: function () {
                                this.on("success", function (file, response) {
                                    // Handle the success response, if needed
                                    console.log(response);
                                });

                                this.on("removedfile", function (file) {
                                    // Handle the file removal, if needed
                                    console.log(file);
                                });
                            },
                        };
                    </script>

                  

              
                <!-- end form 2 -->

                <!-- Added by Amal 'Izzah (PB) -->
                <!-- form 3 : Approval -->
                  <form class="" id="storeapprovalopenform" method="post" action="{{ route('ssmrequests.ssmrequest.storeapprovalopenform') }}" enctype="multipart/form-data">
                    @csrf
                      <div id="approval" style="display: none;">

                          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Approval Form</h5>
          
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="ap_name" class="form-control" placeholder="Nama penuh">

                              {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                            <div class="col-sm-8">
                              <input type="text" name="ap_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                              {!! $errors->first('icno', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                            <div class="col-sm-8">
                              <select name="ap_jawatan" id="jawatan_ap"  style="width:100%">
                                <option selected disabled></option>
                                @foreach ($jawatanlist as $key => $value)
                                <option value="{{ $value }}">
                                    {{ $value }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <script>
                            $('#jawatan_ap').select2({
                                width: '100%',
                                placeholder: "Pilih Jawatan",
                                allowClear: true
                            });
                          </script>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                              <input type="text" name="ap_email" class="form-control" placeholder="example@moe.gov.bn">

                              {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Nombor Tel</label>
                            <div class="col-sm-8">
                              <input type="text" name="ap_notel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                              {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Tempat Bertugas Sekarang</label>
                            <div class="col-sm-8">
                              <input type="text" name="ap_workplace" class="form-control" placeholder="">

                              {!! $errors->first('Tempat Betugas', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Approver Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="ap_approvername" class="form-control" placeholder="Nama penuh">

                              {!! $errors->first('approver name', '<p class="help-block text-danger">:message</p>')!!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Approve IC No.</label>
                            <div class="col-sm-8">
                              <input type="text" name="ap_approvericno" class="form-control" placeholder="Eg. 01000000">

                              {!! $errors->first('approver_ic', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Catatan:</label>
                            <div class="col-sm-8">
                              <textarea type="text" name="ap_catatan" class="form-control" placeholder="catatan" ></textarea>

                              {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                          </div>

                            <!-- captcha question -->

                            <input type="hidden" name="ap_correctAnswer" value="{{ $ap_correctAnswer }}">

<div class="row mb-3">
    <label for="inputtel" class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">{{ $ap_captchaQuestion }}</i>
    </label>
    <div class="col-lg-8">
        <div class="captcha-numbers">
            @foreach ($numbers as $ap_number)
                <button type="button" class="btn btn-outline-primary number-btn" data-number="{{ $ap_number }}">
                    {{ $ap_number }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="ap_captcha" id="ap_captcha">
        @if ($errors->has('ap_captcha'))
            <span class="text-danger">{{$errors->first('ap_captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-numbers {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .number-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .number-btn.active {
        background-color: blue;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numberButtons = document.querySelectorAll('.number-btn');
        const captchaInput = document.getElementById('ap_captcha');

        numberButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                numberButtons.forEach(btn => btn.classList.remove('active'));

                // Add 'active' class to the clicked button
                this.classList.add('active');

                // Set the value of the clicked button to the hidden input
                captchaInput.value = this.dataset.number;
            });
        });
    });
</script>


<!-- end captcha -->

                          <div class="text-center">
                            <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                          </div>
                          <script>
                            var submitButton = document.getElementById('submit-button');
                            var form = document.getElementById('storeapprovalopenform');
                          
                            form.addEventListener('submit', function(event) {
                                if (submitButton.getAttribute('data-submitted') !== null) {
                                    event.preventDefault();
                                } else {
                                    submitButton.disabled = true;
                                    submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                    submitButton.setAttribute('data-submitted', 'true');
                                }
                            });
                          </script>

                      </div>

                  </form>
                <!-- end form 3 -->

                <!-- form 4 : Cuti -->
                  <form class="" id="storedcopenform" method="post" action="{{ route('ssmrequests.ssmrequest.storedcopenform') }}" id="myDropzone"   class="dropzone"  enctype="multipart/form-data">
                    @csrf

                      <div id="deletecuti" style="display: none;">

                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Delete Cuti Form</h5>

                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                              <div class="col-sm-8">
                                <input type="text" name="dc_name" class="form-control" placeholder="Nama penuh">

                                {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                              <div class="col-sm-8">
                                <input type="text" name="dc_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                                {!! $errors->first('IC Number', '<p class="help-block text-danger">:message</p>') !!}
                              </div>
                            </div>

                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                            <div class="col-sm-8">
                              <select name="dc_jawatan" id="jawatan_dc"  style="width:100%">
                                <option selected disabled></option>
                                @foreach ($jawatanlist as $key => $value)
                                <option value="{{ $value }}">
                                    {{ $value }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <script>
                            $('#jawatan_dc').select2({
                                width: '100%',
                                placeholder: "Pilih Jawatan",
                                allowClear: true
                            });
                          </script>

                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                              <div class="col-sm-8">
                                <input type="text" name="dc_email" class="form-control" placeholder="example@moe.gov.bn" >

                                {!! $errors->first('Email', '<p class="help-block text-danger">:message</p>') !!}
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                              <div class="col-sm-8">
                                <input type="text" name="dc_notel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}" >

                                {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                              </div>
                            </div>

                        

                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-4 col-form-label">Tarikh Cuti(Delete)</label>
                              <div class="col-sm-8">
                                <textarea type="text" name="dc_datedelete" class="form-control" placeholder="" ></textarea>

                                {!! $errors->first('Catatan', '<p class="help-block text-danger">:message</p>') !!}
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-4 col-form-label">Tarikh Aduan</label>
                              <div class="col-sm-8">
                                <input type="date" name="dc_dateaduan" class="form-control" placeholder="">

                                {!! $errors->first('Tarikh Aduan', '<p class="help-block text-danger">:message</p>') !!}
                              </div>
                            </div>
                      
                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                              <div class="col-sm-8">
                                <textarea type="text" name="dc_catatan" class="form-control" placeholder="catatan" ></textarea>

                                {!! $errors->first('Catatan', '<p class="help-block text-danger">:message</p>') !!}
                              </div>
                            </div>
          
                          

                            <style>
                                  #file-dropzone {
                                      border: 3px dashed #ccc;
                                      border-radius: 4px;
                                      padding: 10px;
                                      text-align: center;
                                      cursor: pointer;
                                      margin-bottom: 10px;
                                  }
                              </style>

                            
                            <div id="file-input-container">
                                <div class="row mb-3">
                                <label for="inputText" class="col-sm-4 label">Muat Naik Dokumen</label>
                                <div class="col-sm-8" id="file-dropzone" class="dropzone">
                                  <span>Drag and drop files here or click to browse</span>
                                    <input name="dc_file[]" type="file" multiple />
                                </div>

                                    
                                </div>
                            </div>

                                  <!-- captcha question -->

                          <input type="hidden" name="dc_correctAnswer" value="{{ $dc_correctAnswer }}">

<div class="row mb-3">
    <label for="inputtel" class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">{{ $dc_captchaQuestion }}</i>
    </label>
    <div class="col-lg-8">
        <div class="captcha-numbers">
            @foreach ($numbers as $dc_number)
                <button type="button" class="btn btn-outline-primary number-btn" data-number="{{ $dc_number }}">
                    {{ $dc_number }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="dc_captcha" id="dc_captcha">
        @if ($errors->has('dc_captcha'))
            <span class="text-danger">{{$errors->first('dc_captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-numbers {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .number-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .number-btn.active {
        background-color: blue;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numberButtons = document.querySelectorAll('.number-btn');
        const captchaInput = document.getElementById('dc_captcha');

        numberButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                numberButtons.forEach(btn => btn.classList.remove('active'));

                // Add 'active' class to the clicked button
                this.classList.add('active');

                // Set the value of the clicked button to the hidden input
                captchaInput.value = this.dataset.number;
            });
        });
    });
</script>


<!-- end captcha -->



                            <div class="text-center">
                              <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                            </div>
                            <script>
                              var submitButton = document.getElementById('submit-button');
                              var form = document.getElementById('storedcopenform');
                            
                              form.addEventListener('submit', function(event) {
                                  if (submitButton.getAttribute('data-submitted') !== null) {
                                      event.preventDefault();
                                  } else {
                                      submitButton.disabled = true;
                                      submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                      submitButton.setAttribute('data-submitted', 'true');
                                  }
                              });
                            </script>
                      </div>

                  </form>

                    <!-- Include Dropzone.css in the head of your layout file -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">

                    <!-- Include Dropzone.js at the bottom of your layout file, after jQuery or any other dependencies -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

                    <!-- Your JavaScript code -->
                    <script>
                          Dropzone.options.fileDropzone = {
                            paramName: "dc_file", // The name that will be used to transfer the file
                            maxFilesize: 2, // MB
                            addRemoveLinks: true,
                            init: function () {
                                this.on("success", function (file, response) {
                                    // Handle the success response, if needed
                                    console.log(response);
                                });

                                this.on("removedfile", function (file) {
                                    // Handle the file removal, if needed
                                    console.log(file);
                                });
                            },
                        };
                    </script>

                  
                <!-- end form 4 -->

               <!-- form 5 : Peranan -->
                  <form class="" id="storepeopenform" method="post" action="{{ route('ssmrequests.ssmrequest.storepeopenform') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="peranan" style="display: none;">
                              <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Peranan Form</h5>
                                <div id="peranan-justified">
                                  
                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="moreDataPe[0][pe_name]" class="form-control" placeholder="Nama penuh">

                                      {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="moreDataPe[0][pe_icno]" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">
                                      {!! $errors->first('ic', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>

                                  
                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                                    <div class="col-sm-8">
                                      <select name="moreDataPe[0][pe_jawatan]" id="jawatan_peranan" style="width:100%">
                                        <option selected disabled></option>
                                        @foreach ($jawatanlist as $key => $value)
                                        <option value="{{ $value }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <script>
                                    $('#jawatan_peranan').select2({
                                        width: '100%',
                                        placeholder: "Pilih Jawatan",
                                        allowClear: true
                                    });
                                  </script>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="moreDataPe[0][pe_email]" class="form-control" placeholder="example@moe.gov.bn">

                                      {!! $errors->first('Emai', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>


                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="moreDataPe[0][pe_notel]" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                                      {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label">Peranan:</label>
                                      <div class="col-sm-8">
                                        <select name="moreDataPe[0][pe_peranan]" id="categorySelect" class="form-control" >
                                          <option value="">Pilih Peranan</option>
                                          <option value="MSS">MSS</option>
                                          <option value="HR ROLE OM">HR ROLE OM</option>
                                          <option value="HR ROLE TM">HR ROLE TM</option>
                                          <option value="HR ROLE AM">HR ROLE AM</option>
                                        
                                        </select>
                                        {!! $errors->first('Peranan', '<p class="help-block text-danger">:message</p>') !!}
                                      </div>
                                    </div>

                                  

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                                    <div class="col-sm-8">
                                      <textarea type="text" name="moreDataPe[0][pe_catatan]" class="form-control" placeholder="catatan" ></textarea>

                                      {!! $errors->first('Catatan', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>  
                                </div>

                                <div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"id="dynamic-row" href="#">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>

                                           <!-- captcha question -->

                          <input type="hidden" name="peranan_correctAnswer" value="{{ $peranan_correctAnswer }}">

<div class="row mb-3">
    <label for="inputtel" class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">{{ $peranan_captchaQuestion }}</i>
    </label>
    <div class="col-lg-8">
        <div class="captcha-numbers">
            @foreach ($numbers as $peranan_number)
                <button type="button" class="btn btn-outline-primary number-btn" data-number="{{ $peranan_number }}">
                    {{ $peranan_number }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="peranan_captcha" id="peranan_captcha">
        @if ($errors->has('peranan_captcha'))
            <span class="text-danger">{{$errors->first('peranan_captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-numbers {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .number-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .number-btn.active {
        background-color: blue;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numberButtons = document.querySelectorAll('.number-btn');
        const captchaInput = document.getElementById('peranan_captcha');

        numberButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                numberButtons.forEach(btn => btn.classList.remove('active'));

                // Add 'active' class to the clicked button
                this.classList.add('active');

                // Set the value of the clicked button to the hidden input
                captchaInput.value = this.dataset.number;
            });
        });
    });
</script>


<!-- end captcha -->

                                  <div class="text-center">
                                    <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                                  </div>
                                  <script>
                                    var submitButton = document.getElementById('submit-button');
                                    var form = document.getElementById('storepeopenform');
                                  
                                    form.addEventListener('submit', function(event) {
                                        if (submitButton.getAttribute('data-submitted') !== null) {
                                            event.preventDefault();
                                        } else {
                                            submitButton.disabled = true;
                                            submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                            submitButton.setAttribute('data-submitted', 'true');
                                        }
                                    });
                                  </script>
                      </div>
                      
                  </form>

                  <script type="text/javascript">
                    $(document).ready(function () {
                      var i = 0;

                      $(document).on('click', '#dynamic-row', function () {
                        ++i;
                        $("#peranan-justified").append(
                          '<div id="section_' + i + '" class="peranan-section">' +
                          '<div class="row mb-3"><label class="col-lg-4 col-form-label"><b>Tambahan</label></b></div><br>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Name</label><div class="col-sm-8"><input type="text" name="moreDataPe[' + i + '][pe_name]" class="form-control" placeholder="Nama penuh"></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">IC No.</label><div class="col-sm-8"><input type="text" name="moreDataPe[' + i + '][pe_icno]" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}"></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Jawatan</label><div class="col-sm-8"><select name="moreDataPe[' + i + '][pe_jawatan]" id="jawatan_peranan_' + i + '" class="form-control" style="width:100%"><option selected disabled></option>@foreach ($jawatanlist as $key => $value)<option value="{{ $value }}">{{ $value }}</option>@endforeach</select></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Email</label><div class="col-sm-8"><input type="text" name="moreDataPe[' + i + '][pe_email]" class="form-control" placeholder="example@moe.gov.bn"></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label><div class="col-sm-8"><input type="text" name="moreDataPe[' + i + '][pe_notel]" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}"></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Peranan:</label><div class="col-sm-8"><select name="moreDataPe[' + i + '][pe_peranan]" id="categorySelect_' + i + '" class="form-control" ><option value="">Pilih Peranan</option><option value="MSS">MSS</option><option value="HR ROLE OM">HR ROLE OM</option><option value="HR ROLE TM">HR ROLE TM</option><option value="HR ROLE AM">HR ROLE AM</option></select></div></div>' +
                          '<div class="row mb-3"><label for="inputText" class="col-sm-4 col-form-label">Catatan</label><div class="col-sm-8"><textarea type="text" name="moreDataPe[' + i + '][pe_catatan]" class="form-control" placeholder="catatan" ></textarea></div></div>' +
                          '<div class="row mb-3 text-center"><div class="text-center mx-auto"><button class="btn btn-danger remove-element" data-id="section_' + i + '"><i class="bi bi-trash-fill"></i></button></div></div>' +
                          '</div>'
                        );

                        // Initialize select2 for the new element
                        $('#jawatan_peranan_' + i).select2({
                          width: '100%',
                          placeholder: "Pilih Jawatan",
                          allowClear: true
                        });
                      });

                      // Remove HTML on button click for dynamically added elements
                      $(document).on("click", ".remove-element", function () {
                        var elementId = $(this).data("id");
                        $("#" + elementId).remove();
                      });
                    });
                  </script>
                <!-- end form 5 -->

              <!-- form 6 : Password -->
                <form class="" id="storepsopenform" method="post" action="{{ route('ssmrequests.ssmrequest.storepsopenform') }}" enctype="multipart/form-data">
                  @csrf
                      <div id="password" style="display: none;">

                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;"> Reset Password Form</h5>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_name" class="form-control" placeholder="Nama penuh">

                                      {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}">

                                      {!! $errors->first('IC Number', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                                    <div class="col-sm-8">
                                      <select name="ps_jawatan" id="jawatan_ps"  style="width:100%">
                                        <option selected disabled></option>
                                        @foreach ($jawatanlist as $key => $value)
                                        <option value="{{ $value }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <script>
                                    $('#jawatan_ps').select2({
                                        width: '100%',
                                        placeholder: "Pilih Jawatan",
                                        allowClear: true
                                    });
                                  </script>

                                  <div class="row mb-3">
                                      <label for="inputText" class="col-sm-4 col-form-label">Tempat Bertugas Sekarang</label>
                                      <div class="col-sm-8">
                                        <input type="text" name="ps_workplace" class="form-control" placeholder="">

                                        {!! $errors->first('Tempat Bertugas Sekarang', '<p class="help-block text-danger">:message</p>') !!}
                                      </div>
                                    </div>


                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_email" class="form-control" placeholder="example@moe.gov.bn">

                                      {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>


                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_notel" class="form-control" placeholder="Eg. 8888888">

                                      {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>

                                  {{-- <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Password OTP</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="ps_otp" class="form-control" placeholder="Password OTP">

                                      {!! $errors->first('password otp', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div> --}}

                                  <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                                    <div class="col-sm-8">
                                      <textarea type="text" name="ps_catatan" class="form-control" placeholder="catatan" ></textarea>

                                      {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                                    </div>
                                  </div>  

                                   <!-- captcha question -->

                          <input type="hidden" name="rp_correctAnswer" value="{{ $rp_correctAnswer }}">

<div class="row mb-3">
    <label for="inputtel" class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">{{ $rp_captchaQuestion }}</i>
    </label>
    <div class="col-lg-8">
        <div class="captcha-numbers">
            @foreach ($numbers as $rp_number)
                <button type="button" class="btn btn-outline-primary number-btn" data-number="{{ $rp_number }}">
                    {{ $rp_number }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="rp_captcha" id="rp_captcha">
        @if ($errors->has('rp_captcha'))
            <span class="text-danger">{{$errors->first('rp_captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-numbers {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .number-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .number-btn.active {
        background-color: blue;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numberButtons = document.querySelectorAll('.number-btn');
        const captchaInput = document.getElementById('rp_captcha');

        numberButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                numberButtons.forEach(btn => btn.classList.remove('active'));

                // Add 'active' class to the clicked button
                this.classList.add('active');

                // Set the value of the clicked button to the hidden input
                captchaInput.value = this.dataset.number;
            });
        });
    });
</script>


<!-- end captcha -->

                                  <div class="text-center">
                                    <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                                  </div>
                                  <script>
                                    var submitButton = document.getElementById('submit-button');
                                    var form = document.getElementById('storepsopenform');
                                  
                                    form.addEventListener('submit', function(event) {
                                        if (submitButton.getAttribute('data-submitted') !== null) {
                                            event.preventDefault();
                                        } else {
                                            submitButton.disabled = true;
                                            submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                                            submitButton.setAttribute('data-submitted', 'true');
                                        }
                                    });
                                  </script>
                      </div>
                </form>
              <!-- end form 5 -->

              <!-- form 7: Lain-Lain -->
                <form class="" id="storeotopenform" method="post" action="{{ route('ssmrequests.ssmrequest.storeotopenform') }}" enctype="multipart/form-data">
                  @csrf
                  <div id="others" style="display: none;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Others Form</h5>
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-4 col-form-label">Name</label>
                      <div class="col-sm-8">
                        <input type="text" name="ot_name" class="form-control" placeholder="Nama penuh">

                        {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-4 col-form-label">IC No.</label>
                      <div class="col-sm-8">
                        <input type="text" name="ot_icno" class="form-control" placeholder="Eg. 01000000" pattern="[0-9]{8}" >

                        {!! $errors->first('icno', '<p class="help-block text-danger">:message</p>') !!}
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-4 col-form-label">Jawatan</label>
                      <div class="col-sm-8">
                        <select name="ot_jawatan" id="jawatan_others"  style="width:100%">
                          <option selected disabled></option>
                          @foreach ($jawatanlist as $key => $value)
                          <option value="{{ $value }}">
                              {{ $value }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <script>
                      $('#jawatan_others').select2({
                          width: '100%',
                          placeholder: "Pilih Jawatan",
                          allowClear: true
                      });
                    </script>


                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 col-form-label">Tempat Bertugas Sekarang</label>
                        <div class="col-sm-8">
                          <input type="text" name="ot_workplace" class="form-control" placeholder="">

                          {!! $errors->first('Tempat Bertugas', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                      </div>


                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-4 col-form-label">Email</label>
                      <div class="col-sm-8">
                        <input type="text" name="ot_email" class="form-control" placeholder="example@moe.gov.bn">

                        {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-4 col-form-label">Nombor Telefon</label>
                      <div class="col-sm-8">
                        <input type="text" name="ot_notel" class="form-control" placeholder="Eg. 8888888" pattern="[0-9]{7}">

                        {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                      <div class="col-sm-8">
                        <textarea type="text" name="ot_catatan" class="form-control" placeholder="catatan" ></textarea>

                        {!! $errors->first('catatan', '<p class="help-block text-danger">:message</p>') !!}
                      </div>
                    </div> 

                       <!-- captcha question -->

                       <input type="hidden" name="ot_correctAnswer" value="{{ $ot_correctAnswer }}">

<div class="row mb-3">
    <label for="inputtel" class="col-lg-4 col-form-label">
        Captcha:<br>
        <i style="color:blue;">{{ $ot_captchaQuestion }}</i>
    </label>
    <div class="col-lg-8">
        <div class="captcha-numbers">
            @foreach ($numbers as $ot_number)
                <button type="button" class="btn btn-outline-primary number-btn" data-number="{{ $ot_number }}">
                    {{ $ot_number }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="ot_captcha" id="ot_captcha">
        @if ($errors->has('ot_captcha'))
            <span class="text-danger">{{$errors->first('ot_captcha')}}</span>
        @endif
    </div>
</div>

<style>
    .captcha-numbers {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .number-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    .number-btn.active {
        background-color: blue;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numberButtons = document.querySelectorAll('.number-btn');
        const captchaInput = document.getElementById('ot_captcha');

        numberButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                numberButtons.forEach(btn => btn.classList.remove('active'));

                // Add 'active' class to the clicked button
                this.classList.add('active');

                // Set the value of the clicked button to the hidden input
                captchaInput.value = this.dataset.number;
            });

        });
    });
</script>


<!-- end captcha -->

                    <div class="text-center">
                      <button id="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                    </div>
                    <script>
                      var submitButton = document.getElementById('submit-button');
                      var form = document.getElementById('storeotopenform');
                    
                      form.addEventListener('submit', function(event) {
                          if (submitButton.getAttribute('data-submitted') !== null) {
                              event.preventDefault();
                          } else {
                              submitButton.disabled = true;
                              submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
                              submitButton.setAttribute('data-submitted', 'true');
                          }
                      });
                    </script>
     
                  </div> 
                </form>
              <!-- end form 7 -->

              <!-- ==================================================================================================== -->

                  <br>
        </div>

      </div>

      </div>

</div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>

  <script>
    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Jabatan",
      allowClear: true
    });
  </script>
    <script>
    $('#myselect2').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
  </script>

<script>
    $('#myselectjawatan').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
  </script>

  
<script>
    $('#myselectjawatanp').select2({
      width: '100%',
      placeholder: "",
      allowClear: true
    });
  </script>
  

  
  <script>

    document.getElementById('categorySelect').addEventListener('change', function () {
        var selectedCategory = this.value;
        var bakicutiCategoryInput = document.getElementById('bakicuti');
        var pertukaranicnoElement = document.getElementById('pertukaranicno');
        // ===================================================================================================
        // Added by Amal 'Izzah (PB)
        var approvalElement = document.getElementById('approval');
        var deleteCutiElement = document.getElementById('deletecuti');
        var perananElement = document.getElementById('peranan');
        var passwordElement = document.getElementById('password');
        var othersElement = document.getElementById('others');

        // ===================================================================================================
        var submitButton = document.getElementById('submitButton'); // Add this line

        bakicutiCategoryInput.style.display = 'none';
        pertukaranicnoElement.style.display = 'none';
        // ===================================================================================================
        // Added by Amal 'Izzah (PB)
        approvalElement.style.display = 'none';
        deleteCutiElement.style.display = 'none';
        perananElement.style.display = 'none';
        passwordElement.style.display = 'none';
        othersElement.style.display = 'none';

        // ===================================================================================================

        if (selectedCategory === 'bakicuti') {
            bakicutiCategoryInput.style.display = 'block';
        } else if (selectedCategory === 'pertukaranicno') {
            pertukaranicnoElement.style.display = 'block';
        } 
        // ===================================================================================================
        // added by Amal 'Izzah (PB)
        else if (selectedCategory === 'Approval') {
            approvalElement.style.display = 'block';
        } else if (selectedCategory === 'Delete Cuti') {
            deleteCutiElement.style.display = 'block';
        } else if (selectedCategory === 'Peranan') {
            perananElement.style.display = 'block';
        }  
        else if (selectedCategory === 'Password') {
            passwordElement.style.display = 'block';
        }
        else if (selectedCategory === 'others') {
            othersElement.style.display = 'block';
        }
        // ===================================================================================================
        
        // Enable submit button when a category is selected
        submitButton.disabled = selectedCategory === '';
    });
</script>


</section>

   
</body>

</html>