<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PostUp</title>
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

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      @if(Session::has('success_message'))
        <div class="alert alert-success">
          {{Session::get('success_message')}}
        </div>
      @endif

  <!-- Borang Table -->
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">

              <div class="col-12">
                <div class="card" style="padding-left: 20px; padding-right: 20px;">
                
                  <div class="card-body">
                      <div class="profile-overview pt-3">

                           @if (count($errors) > 0)
                              <div class="alert alert-danger"> Upload Validation Error<br><br> 
                                <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                              </div>
                           @endif

                              <form class="" method="post" action="{{ route('postup.postup.store') }}" enctype="multipart/form-data" id="postups_form">
                              @csrf

                                <br>

                                <center><img src="img\moe-logo-latest-compressed.png" class="d-block w-75" alt="MOE LOGO"></center>
                                  <br>
                                  <br>
                                  <header class="card-title" style="padding: 0px; font-size: 18px;">PostUp</header>
                                  
                      
                                  <hr>
                                  <form>


                                    <div class="row mb-3">
                                      <label for="inputSubjek" class="col-lg-4 col-form-label">Subjek:</label>
                                      <div class="col-lg-8">
                                      <input type="text" name="subjek" class="form-control" placeholder="">
                                      {!! $errors->first('subjek', '<p class="help-block text-danger">:message</p>')!!}
                                      </div>
                                    </div>

  
                                    <div class="row mb-3">
                                        <label for="inputrujukan" class="col-lg-4 col-form-label">Rujukan:</label>
                                        <div class="col-lg-8">
                                          <input type="text" name="rujukan" class="form-control" placeholder="">

                                          {!! $errors->first('rujukan', '<p class="help-block text-danger">:message</p>')!!}
                                        </div>
                                    </div>

                                      <div class="row mb-3">
                                        <label for="inputname" class="col-lg-4 col-form-label">Nama:</label>
                                        <div class="col-lg-8">
                                          <input type="text" name="name" class="form-control" placeholder="">

                                          {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
                                        </div>
                                      </div>

                                      <div class="row mb-3">
                                        <label for="inputkadpengenalan" class="col-lg-4 col-form-label">No. Kad Pengenalan:</label>
                                        <div class="col-lg-8">
                                          <input type="text" name="ic_no" class="form-control" placeholder="IC No. 0001234">

                                          {!! $errors->first('ic_no', '<p class="help-block text-danger">:message</p>')!!}
                                        </div>
                                      </div>

                                        <div class="row mb-3">
                                          <label for="inputfile" class="col-lg-4 col-form-label">Muat Naik Dokumen:</label>
                                        </div>

                                      <div id="file-input-container">
                                        <div class="row mb-3">
                                          <div class="col-md-6">
                                            <input class="form-control postups-file-input" type="file" name="filename[]" accept=".jpg, .jpeg, .png, .pdf">    
                                          </div>
                                          <div class="col-md-6">
                                              <button type="button" class="btn btn-primary add-file-input">Add</button>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="text-center">
                                        <button id ="submit-button" type="submit" class="btn btn-primary">Hantar</button>
                                      </div>

                                    <br>
                                  </form>

                      </div>
                </div>

              </div>
            </div>
            </div>
          </div><!-- End Recent Sales -->
        </div>

</section>
</body>

  <script>
      var submitButton = document.getElementById('submit-button');
      var form = document.getElementById('postups_form');
      
      form.addEventListener('submit', function(event) {
          if (this.getAttribute('data-submitted') !== null) {
              event.preventDefault();
          } else {                    
              submitButton.disabled = true;
              submitButton.innerText = 'Di Hantar...'; // Optional: Change the button text to indicate submission
              this.setAttribute('data-submitted', 'true');
          }
      });

      $(document).ready(function() {
          // Add new file input field when the "Add" button is clicked
          $(document).on("click", ".add-file-input", function() {
              var fileInputContainer = $(this).closest("#file-input-container"); // Get the closest file input container
              var clonedFileInput = fileInputContainer.find(".postups-file-input").first().clone(); // Clone the first file input field
              var removeButton = "<button type='button' class='btn btn-primary remove-file-input'>Remove</button>"; // Create the remove button
              var newRow = $("<div class='row mb-3'><div class='col-md-6'>" + clonedFileInput[0].outerHTML + "</div><div class='col-md-6'>" + removeButton + "</div></div>"); // Create the new row with the cloned file input and remove button
              newRow.appendTo(fileInputContainer); // Append the new row to the file input container
          });

          // Remove file input field when the "Remove" button is clicked
          $(document).on("click", ".remove-file-input", function() {
              $(this).closest(".row.mb-3").remove(); // Remove the closest file input container
          });
      });
  </script>

</html>