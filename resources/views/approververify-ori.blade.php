<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MESH VERIFICATION</title>
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

            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>  @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
            </ul>
            </div>
          @endif

            
@foreach ($registerverify as $rv)
            <br>

            <!-- <div class="col profile-overview" style="border: 8px solid #012970; padding: 20px; border-radius: 25px;"> -->

            <table class="table table-bordered" id="table1">
              <tr class="text-center">
                 <th colspan="3" style ="text-align:center; color:white; padding:10px; border-radius:0px; background-color:#574AE2;">REQUESTOR'S MESH ACCOUNT REGISTRATION</th>
                 </tr>
            </table>

            <form class="" method="post" action="{{ route('registerverify.registerverify.update') }}" enctype="multipart/form-data">
            @csrf
                <div class="col-12">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$rv->name}}" required autocomplete="name" autofocus readonly>
                </div>

                  <div class="row">
                    <!-- IC Number FIeld -->
                     <div class ="col-md-4">
                      <label for="name" class="col-form-label">{{ __('IC Number') }}</label>
                      <input id="ic_no" type="text" class="form-control @error('ic_no') is-invalid @enderror" value="{{ $rv->ic_no }}" placeholder="Eg. 00123456" required autocomplete="ic_no" readonly>
                    </div>

                     <!-- Email Address field -->
                      <div class="col-md-4">
                        <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $rv->email }}" required autocomplete="email" readonly>
                      </div>

                      <!-- Phone Numberfield -->
                      <div class="col-md-4">
                       <label for ="telephone_mobile" class="col-form-label">{{('Phone NUmber')}}</label>
                       <div class ="input-group">
                         <div class="input-group-prepend">
                          <span class="input-group-text">+673 </span>
                        </div>
                        <input id="telephone_mobile" type="telephone_mobile" class="form-control @error('telephone_mobile') is-invalid @enderror"  value="{{ $rv->telephone_mobile }}" placeholder="Eg. 8888888" required autocomplete="telephone_mobile" readonly>
                       </div>
                      </div>
                   </div>

                   <div class="row">

                    <!-- Bahagian Unit -->
                    <div class ="col-md-4">
                        <label for="bahagian_id" class="col-form-label">{{ __('Bahagian/Unit') }}</label>
                        <input id="bahagian_id" type="text" class="form-control @error('bahagian_id') is-invalid @enderror" value="{{ $rv->bahagian_id }}"readonly>
                      </div>

                     <!-- Bahagian Tanggagaji -->
                      <div class="col-md-4">
                        <label for="division_id" class="col-form-label">{{ __('Bahagian(Tanggagaji)') }}</label>
                        @foreach($employments as $employment)
                        <input id="division_id" type="text" class="form-control @error('text') is-invalid @enderror"  value="{{ optional($employment->division)->label }}"readonly>
                        @endforeach
                      </div>

                         <!-- Jenis PERkhidmatan field -->
                        <div class="col-md-4">
                        <label for="employment_status_id" class="col-form-label">{{ __('Jenis Perkhidmatan') }}</label>
                        @foreach($employments as $employment)
                        <input id="employment_status_id" type="text" class="form-control @error('text') is-invalid @enderror"  value="{{ optional($employment->employmentstatus)->label }}"readonly>
                        @endforeach
                      </div>

                   </div>

                  <div class="col-12">
                        <label for="department_id" class="col-md-6 col-form-label text-md-right">{{ __('Jabatan') }}</label>
                        <div class="col-md-12">
                            <div class="col-md-12">
                              @foreach($employments as $employment)
                            <input id="department_id" type="text" class="form-control @error('text') is-invalid @enderror"  value="{{ optional($employment->department)->label }}"readonly>
                                @endforeach
                            </div>
                        </div>
                  </div>
                  
                  <br>

            <table class="table table-bordered" id="table1">
              <tr class="text-center">
                 <th colspan="3" style ="text-align:center; color:white; padding:10px; border-radius:0px; background-color:#574AE2;">VERIFIER DETAIL</th>
                 </tr>
            </table>

            <div class ="row">
              


              <div class="col-md-6">
                <label for="fullnameapprover1" class="col-form-label text-md-right">{{ __('Full Name') }}</label>
                <input id="fullnameapprover1" type="text" class="form-control @error('fullnameapprover1') is-invalid @enderror" name="ap1_name" value="{{ $rv->ap1_name}}" required autocomplete="fullnameapprover1" autofocus readonly>
                @error('fullnameapprover1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>


              <div class="col-md-6">
                <label for="ap1_email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <input id="ap1_email" type="email" class="form-control @error('ap1_email') is-invalid @enderror"name="ap1_email" value="{{ $rv->ap1_email }}" required autocomplete="email"pattern="[a-zA-Z0-9._%+-]+@moe\.gov\.bn$" title="Please enter a valid moe.gov.bn email address" readonly>
                 @error('ap1_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
             </div>
              <br>
              
             
              <input type="hidden" name="id" value="{{ $rv->id }}" />
        <input type="hidden" id="approval_response" name="approval_response" value="{{ old('approval_response', $rv->approval_response) }}">

        @if(empty($rv->approval_response))
        <table style="margin: 0 auto; text-align: center;">
                <tr>
                    <td>
                        <button type="submit" class="btn btn-success w-100" onclick="setApprovalResponse('Accept Registration')">
                            Accept
                        </button>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-danger w-100" onclick="setApprovalResponse('Decline Registration')">
                            Decline 
                        </button>
                    </td>
                </tr>
            </table>
        @endif

        <script>
            function setApprovalResponse(value) {
                document.getElementById('approval_response').value = value;
            }
        </script>

                
            
            </form>
        @endforeach




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

  <!-- eye toogle-->







</section>


</body>

</html>
