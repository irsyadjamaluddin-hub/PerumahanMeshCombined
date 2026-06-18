<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'alhfz | Internal') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  
  
</head>
<body class="hold-transition skin-blue sidebar-collapse" style="width: 80%; margin:auto;">
	<div class="wrapper">   
		
		
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid" style="padding-top: 20px;">
            @yield('content') 
		</div>
	</section>
    
	
	{{-- Yield other scripts required by the page. --}}
	@yield( 'scripts' )
	
		<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
  $(function() {
    $( "#datepicker_dob" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  format: 'dd-mm-yy',
	dateFormat: 'dd-mm-yy',
	  yearRange:  "-80:-0",
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    $( "#datepicker_service" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  format: 'dd-mm-yy',
	dateFormat: 'dd-mm-yy',
	  yearRange:  "-80:-0",
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    $( "#datepicker_registrationDate" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  format: 'dd-mm-yy',
	dateFormat: 'dd-mm-yy',
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    $( "#datepicker_roadtaxExpiry" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  format: 'dd-mm-yy',
	dateFormat: 'dd-mm-yy',
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    $( "#datepicker_drivingExpiry" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  format: 'dd-mm-yy',
	dateFormat: 'dd-mm-yy',
    });
  });
</script>

	</div>
	
</body>
</html>
