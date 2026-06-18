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
          <form class="" method="post" action="{{ route('moeevent.moeevent.storeRate', ['event_id' => $event_id]) }}" enctype="multipart/form-data">
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
                    <select class="form-select" name="event"  aria-label="Default select example">
                           <option value="{{ $perkaraevent->id }}">
                                {{ $perkaraevent->eventlabel }}
                            </option>  
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

              {{-- <div class="row mb-3">
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
              </div> --}}

              <div class="row mb-3">
                <label class=" col-form-label">How would you rate the content of the program was effective and increase your knowledge?<i style="color:red;">*</i></label></center>
                <label class=" col-form-label" style = "font-size:15px; font-style:italic;">Sila nilai jika isi kandungan program adalah berkesan dan menambah pengetahuan awda?<i style="color:red;">*</i></label></center>
                <div class="col-lg-8">
                
        
                  <!-- <div style="padding: 50px">
                    <i class="fa fa-star fa-2x" data-index="0" onclick="setRating(1, 'selectedRating1')"></i>
                    <i class="fa fa-star fa-2x" data-index="1" onclick="setRating(2, 'selectedRating1')"></i>
                    <i class="fa fa-star fa-2x" data-index="2" onclick="setRating(3, 'selectedRating1')"></i>
                    <i class="fa fa-star fa-2x" data-index="3" onclick="setRating(4, 'selectedRating1')"></i>
                    <i class="fa fa-star fa-2x" data-index="4" onclick="setRating(5, 'selectedRating1')"></i>
                  </div>
                  <input type="hidden" name="rating1" id="selectedRating1" value="">
                  {!! $errors->first('rating1', '<p class="help-block text-danger">:message</p>')!!} -->
    	          </div>

                <div class="row mb-3 rating-stars" data-input-id="selectedRating1">
        
                  <div style="padding: 5px">
                    <i class="fa fa-star fa-2x" data-index="0" onclick="setRating(1, 'selectedRating1')"></i>
                    <i class="fa fa-star fa-2x" data-index="1" onclick="setRating(2, 'selectedRating1')"></i>
                    <i class="fa fa-star fa-2x" data-index="2" onclick="setRating(3, 'selectedRating1')"></i>
                    <i class="fa fa-star fa-2x" data-index="3" onclick="setRating(4, 'selectedRating1')"></i>
                    <i class="fa fa-star fa-2x" data-index="4" onclick="setRating(5, 'selectedRating1')"></i>
                  </div>
                  <input type="hidden" name="rating1" id="selectedRating1" value="">
                  {!! $errors->first('rating1', '<p class="help-block text-danger">:message</p>')!!}
    	          </div>
                </div></center>

                <br>

                <div class="row mb-3">
                <label class="col-form-label">How would you rate the delivery of facilitator was well-organised, smooth and met the objectives?<i style="color:red;">*</i></label></center>
                <label class="col-form-label" style = "font-size:15px; font-style:italic;">Sila nilai jika fasilitator program menyampaikan secara teratur, lancar dan mencapai objektif program?<i style="color:red;">*</i></label></center>
                <div class="col-lg-8">
                <!-- <div class="col-lg-8">
        
                  <div style="padding: 50px">
                    <i class="fa fa-star fa-2x" data-index="0" onclick="setRating(1, 'selectedRating2')"></i>
                    <i class="fa fa-star fa-2x" data-index="1" onclick="setRating(2, 'selectedRating2')"></i>
                    <i class="fa fa-star fa-2x" data-index="2" onclick="setRating(3, 'selectedRating2')"></i>
                    <i class="fa fa-star fa-2x" data-index="3" onclick="setRating(4, 'selectedRating2')"></i>
                    <i class="fa fa-star fa-2x" data-index="4" onclick="setRating(5, 'selectedRating2')"></i>
                  </div>
                  <input type="hidden" name="rating2" id="selectedRating2" value="">
                  {!! $errors->first('rating2', '<p class="help-block text-danger">:message</p>')!!}
                </div> -->
    	          </div>

                <div class="row mb-3 rating-stars" data-input-id="selectedRating2">
        
                  <div style="padding: 5px">
                    <i class="fa fa-star fa-2x" data-index="0" onclick="setRating(1, 'selectedRating2')"></i>
                    <i class="fa fa-star fa-2x" data-index="1" onclick="setRating(2, 'selectedRating2')"></i>
                    <i class="fa fa-star fa-2x" data-index="2" onclick="setRating(3, 'selectedRating2')"></i>
                    <i class="fa fa-star fa-2x" data-index="3" onclick="setRating(4, 'selectedRating2')"></i>
                    <i class="fa fa-star fa-2x" data-index="4" onclick="setRating(5, 'selectedRating2')"></i>
                  </div>
                  <input type="hidden" name="rating2" id="selectedRating2" value="">
                  {!! $errors->first('rating2', '<p class="help-block text-danger">:message</p>')!!}
                </div>
    	          </div></center>

                <br>

                <div class="row mb-3 rating-stars" data-input-id="selectedRating3">
                <label class="col-form-label">How would you rate this program is relevant to my job level?<i style="color:red;">*</i></label></center>
                <label class="col-form-label" style = "font-size:15px; font-style:italic;">Sila nilai jika program ini bersesuaian dengan peringkat pekerjaan saya?<i style="color:red;">*</i></label></center>
                <div class="col-lg-8">
                <!-- <div class="col-lg-8">
        
                  <div style="padding: 50px">
                    <i class="fa fa-star fa-2x" data-index="0" onclick="setRating(1, 'selectedRating3')"></i>
                    <i class="fa fa-star fa-2x" data-index="1" onclick="setRating(2, 'selectedRating3')"></i>
                    <i class="fa fa-star fa-2x" data-index="2" onclick="setRating(3, 'selectedRating3')"></i>
                    <i class="fa fa-star fa-2x" data-index="3" onclick="setRating(4, 'selectedRating3')"></i>
                    <i class="fa fa-star fa-2x" data-index="4" onclick="setRating(5, 'selectedRating3')"></i>
                  </div>
                  <input type="hidden" name="rating3" id="selectedRating3" value="">
                  {!! $errors->first('rating3', '<p class="help-block text-danger">:message</p>')!!}
                </div> -->
    	          </div>

                <div class="row mb-3 rating-stars" data-input-id="selectedRating3">
        
                  <div style="padding: 5px">
                    <i class="fa fa-star fa-2x" data-index="0" onclick="setRating(1, 'selectedRating3')"></i>
                    <i class="fa fa-star fa-2x" data-index="1" onclick="setRating(2, 'selectedRating3')"></i>
                    <i class="fa fa-star fa-2x" data-index="2" onclick="setRating(3, 'selectedRating3')"></i>
                    <i class="fa fa-star fa-2x" data-index="3" onclick="setRating(4, 'selectedRating3')"></i>
                    <i class="fa fa-star fa-2x" data-index="4" onclick="setRating(5, 'selectedRating3')"></i>
                  </div>
                  <input type="hidden" name="rating3" id="selectedRating3" value="">
                  {!! $errors->first('rating3', '<p class="help-block text-danger">:message</p>')!!}
                </div>
    	          </div></center>

                <br>

                <div class="row mb-3">
                  <label for="inputnama" class=" col-form-label">Please provide feedback for the improvement of the program (if any)</label></center>
                  <label for="inputnama" class=" col-form-label" style = "font-size:15px; font-style:italic;">Sila nyatakan cadangan untuk penambahbaikkan program (jika ada)</label></center>
                  <div class="col-lg-8">
                    <!-- <textarea name = "feedback" placeholder = "Give a Feedback, if any" cols = "50" rows = "5"></textarea> -->
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                    <textarea name = "feedback" placeholder = "Give a Feedback, if any" cols = "50" rows = "5"></textarea>
                  </div>
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
    var ratedIndexes = [-1, -1, -1]; // Initialize an array to store rated indexes for each question

    $(document).ready(function () {
    // Bind event handlers for each set of star icons
    $('.rating-stars').each(function() {
        var ratingStars = $(this).find('.fa-star');

        ratingStars.on('click', function(){
            var ratedIndex = parseInt($(this).data('index'));
            var inputId = $(this).closest('.rating-stars').data('input-id');
            setRating(ratedIndex + 1, inputId);
        });

        ratingStars.mouseover(function(){
            var currentIndex = parseInt($(this).data('index'));
            var stars = $(this).closest('.rating-stars').find('.fa-star');

            stars.css('color', '#c7c7c7');

            for (var i = 0; i <= currentIndex; i++)
                $(stars[i]).css('color', '#F9A602');
        });

        ratingStars.mouseleave(function(){
            var inputId = $(this).closest('.rating-stars').data('input-id');
            var value = $('#' + inputId).val();
            var stars = $(this).closest('.rating-stars').find('.fa-star');

            stars.css('color', '#c7c7c7');

            for (var i = 0; i < value; i++)
                $(stars[i]).css('color', '#F9A602');
        });
    });
});

function setRating(value, inputId) {
    var stars = $('#' + inputId).closest('.rating-stars').find('.fa-star');
    $('#' + inputId).val(value);

    stars.css('color', '#c7c7c7');

    for (var i = 0; i < value; i++)
        $(stars[i]).css('color', '#F9A602');
}

</script>

  {{-- <script>
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
  </script> --}}
  <!-- ==================================================================================================== -->
  
</section>

   
</body>

</html>