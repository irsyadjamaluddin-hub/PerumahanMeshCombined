<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Change Password</title>

      <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


   <!-- Vendor CSS Files -->

   <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>


    <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
  </head>
  <body>



  
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Mesh</h5>
  <nav class="my-2 my-md-0 mr-md-3 top-nav" >
    <a class="p-2 text-dark {{(request()->route()->getName()=='home')?'active':''}}" href="{{route('home')}}">Home</a>

    @if(!auth()->check())
    <a class="p-2 text-dark {{(request()->route()->getName()=='getLogin')?'active':''}}" href="{{route('getLogin')}}">Login</a>
    @endif

    @if(auth()->check())
    
    <a class="p-2 text-dark" href="{{route('logout')}}">Logout</a>
    @endif
    
  </nav>
  @if(!auth()->check())
  <a class="btn btn-outline-primary {{(request()->route()->getName()=='getRegister')?'active':''}}" href="{{route('getRegister')}}">Sign up</a>
  @endif
</div>




<div class="container-fluid" >

@yield('body')

</div>
<footer >
  
</footer>
<script type="text/javascript">
  window.baseUrl="{{URL::to('/')}}";
  @if(session('success'))
  toastr.success('{{session("success")}}', 'Success', {timeOut: 5000});
  @endif

  @if(session('error'))
  toastr.error('{{session("error")}}', 'Error', {timeOut: 5000});
  @endif
</script>

<script type="text/javascript" src="{{asset('js/auth.js')}}"></script>
<script type="text/javascript" src="{{asset('js/profile.js')}}"></script>
</body>
</html>
