<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rate</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
<link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<link href="{{ asset('assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
 

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  
  <!-- ==================================================================================================== -->
  <!-- added by Amal 'Izzah (PB) -->
  <script src="https://kit.fontawesome.com/e0fb13e4c7.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
  <!-- ==================================================================================================== -->


  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
          <div class="alert alert-danger">
              Upload Validation Error<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          <!-- ==================================================================================================== -->
          <!-- Added by Amal 'Izzah (PB) -->
          <form class="" method="post" action="{{ route('moeevent.moeevent.storeRateopenform')}}" enctype="multipart/form-data">
          @csrf

            <br>

            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->
              <center><img src="{{ asset('img/newmoelogo.png') }}" class="d-block w-75" alt="MOE LOGO"></center>
              <br>
              <center><header class="card-title" style="padding: 0px; font-size: 18px;">FEEDBACK</header></center>
              
   
              <hr>

              <div class="row mb-3">
                  <label class="col-lg-4 col-form-label">Event<i style="color:red;">*</i></label>
                  <div class="col-lg-8">
                    <select class="form-select" name="event"  aria-label="Default select example" required>
                      <option value="">Select Event</option>
                      @foreach ($perkaraevent as $key => $value)
                        <option value="{{ $value }}">
                            {{ $value }}
                        </option>
                      @endforeach
                    </select>                    
                    {!! $errors->first('event', '<p class="help-block text-danger">:message</p>')!!}
                  </div>
              </div>

              <div class="row mb-3">
                <label class="col-lg-4 col-form-label">Jabatan</label>
                <div class="col-lg-8">
                  <select id="jabatan" class="form-select" name="jabatan" aria-label="Default select example" style="width: 100%;" required>
                    <option value="" disabled selected></option>
                      @foreach ($departments as $key => $value)
                      <option value="{{ $value }}">
                          {{ $value }}
                      </option>
                      @endforeach
                  </select>

                  {!! $errors->first('jabatan', '<p class="help-block text-danger">:message</p>')!!}
                </div>
              </div>
              <script>
                $('#jabatan').select2({
                    width: '100%',
                    placeholder: "Pilih Jabatan",
                    allowClear: true
                });
              </script>

              <div class="row mb-3">
                <label class="col-lg-4 col-form-label">How much would you rate for this event?<i style="color:red;">*</i></label>
                <div class="col-lg-8">
        
                  <div style="padding: 50px">
                    <i class="fa fa-star fa-2x" data-index="0" onclick="setRating(1)"></i>
                    <i class="fa fa-star fa-2x" data-index="1" onclick="setRating(2)"></i>
                    <i class="fa fa-star fa-2x" data-index="2" onclick="setRating(3)"></i>
                    <i class="fa fa-star fa-2x" data-index="3" onclick="setRating(4)"></i>
                    <i class="fa fa-star fa-2x" data-index="4" onclick="setRating(5)"></i>
                  </div>
                  <input type="hidden" name="rating" id="selectedRating" value="">
                  {!! $errors->first('rate', '<p class="help-block text-danger">:message</p>')!!}
                </div>
              </div>
              

              <div class="row mb-3">
                <label for="inputnama" class="col-lg-4 col-form-label">Is there any feedback you would like to give us? (Optional)</label>
                <div class="col-lg-8">
                  <textarea name = "feedback" placeholder = "Give a Feedback, if any" cols = "50" rows = "5"></textarea>
                </div>
              </div>
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
            <!-- ==================================================================================================== -->

            <br>
            


          </form>


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

  <!-- ==================================================================================================== -->
  <!-- Added by Amal 'Izzah -->

  <script>
    var ratedIndex = -1;

    $(document).ready(function () {
      resetStarColors();

      $('.fa-star').on('click', function(){
        ratedIndex = parseInt($(this).data('index'));
      });

      $('.fa-star').mouseover(function(){
        //console.log('here');
        resetStarColors();

        var currentIndex = parseInt($(this).data('index'));
        
        for (var i=0; i <= currentIndex; i++)
          $('.fa-star:eq('+i+')').css('color', '#F9A602');
      });

      $('.fa-star').mouseleave(function(){
        //console.log('here2');
        resetStarColors();

        if (ratedIndex != -1)
          for (var i=0; i <= ratedIndex; i++)
            $('.fa-star:eq('+i+')').css('color', '#F9A602');
      });
    });

    function resetStarColors() {
      $('.fa-star').css('color', '#c7c7c7');
    };
  </script>

  <script>
    var selectedRating = 0;

    function setRating(value) {
      selectedRating = value;
      // Optionally, you can highlight the selected stars here
      resetStarColors();
      for (var i = 0; i < value; i++)
        $('.fa-star:eq(' + i + ')').css('color', '#F9A602');
        // Update the hidden input field value
        $('#selectedRating').val(value);
      }

        function resetStarColors() {
          $('.fa-star').css('color', '#c7c7c7');
        }
  </script>
  <!-- ==================================================================================================== -->
  
</section>

   
</body>

</html>