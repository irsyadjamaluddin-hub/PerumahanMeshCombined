<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MOE EVENT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<!-- Favicons -->



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

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Select2 JS -->
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
          <div class="alert alert-danger">
              Upload Validation Error<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          
          @csrf

            <br>

              <br>
              <header class="card-title" style="padding: 0px; font-size: 18px;">MOE EVENT</header>
              
   
              <hr>
              <form class=""  method="get" action="{{ route('moeevent.moeevent.search') }}">
              @foreach($results as $result)

                  <div class="row mb-3">
                      <label class="col-lg-4 col-form-label">Event</label>
                      <div class="col-lg-8">
                          <select class="form-select" name="event" value="{{$result->event}}" aria-label="Select an event">
                              <option selected hidden>Select an event</option>
                              @foreach ($perkaraevent as $key => $value)
                                  <option value="{{ $key }}">{{ $value }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  
              
                  <div class="row mb-3">
                      <label class="col-lg-4 col-form-label">IC No.</label>
                      <div class="col-lg-8">
                          <input type="text" name="icno" value="{{$result->icno}}" class="form-control" placeholder="example: 00123456">
                      </div>
                  </div>

                  @endforeach
                  <div class="row mb-3">
                      <div class="col-lg-8 offset-lg-4">
                          <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                  </div>
              </form>

              @if(count($results) == 0)

              <div class="row">
                    <div class="col-lg-4 col-md-3  label">Ralat <br> <i>Error</i></div>
                    <div class="col-lg-8 col-md-9">
                      <input type="text" class="bg-gray-200 text-danger form-control" value="IC Number Not found, Try Again" readonly>
                        
                    </div>
                </div>

              @else

              @foreach($results as $result)

                  <div class="row">
                      <div class="col-lg-4 col-md-3  label"></div>
                      <div class="col-lg-8 col-md-9">
                      <br>
                  Please use this link for attendance record:-
                    <p style="color:#2b2a2a; margin-bottom: 0px;">Mesh: <a href="https://mesh.moe.gov.bn/moeeventscanqrcode/{{$result->id}}">https://mesh.moe.gov.bn/moeeventscanqrcode/{{$result->id}}</a></p>
                    <br>
                        
                      </div>
                  </div>

               

              @endforeach
              @endif




        </div>

      </div>

      </div>

</div>


    </div>

  </div>
  </div><!-- End Recent Sales -->
  </div>

  
  
</section>
</body>
</html>
