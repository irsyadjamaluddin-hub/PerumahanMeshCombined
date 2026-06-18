<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/js/apexcharts-bundle.js') }}"></script>  

  <!-- {{-- Tailwind CSS --}} -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <!-- Jquery UI (date-picker) -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  
  <!-- Bootstrap table with add new row button-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
  function toggle1(){
    var x = document.getElementById("btn-submit");
      x.style.display = "block";
  }
  </script>
  
  <script>
  function toggle2(){
    var x = document.getElementById("btn-submit");
      x.style.display = "block";
  }
  </script>
  
  <script>
  function toggle3(){
    var x = document.getElementById("btn-submit");
      x.style.display = "block";
  }
  </script>
  
  <script>
  function toggle4(){
    var x = document.getElementById("btn-submit");
      x.style.display = "block";
  }
  </script>
  
  <script>
  function toggle5(){
    var x = document.getElementById("btn-submit");
      x.style.display = "block";
  }
  </script>
  
  
  <script>
  function toggle6(){
    var x = document.getElementById("btn-submit");
      x.style.display = "none";
  }
  </script>

  <style>
    .check {
        border: 2px solid red;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
    }

    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;  
    }

    .collapse{
        visibility: visible !important;
    }

    .btn-primary{
        background-color: #0d6efd !important;
    }

    .dataTable-input{
        border-width: 2px !important;
    }

    .dataTable-selector{
        border-width: 2px !important;
    }

    .btn-success{
        background-color: #198754 !important;
    }

    #pgap {
        margin-bottom: 0px !important;
    }

    #justify {
        text-align: justify;
        text-justify: inter-word;
    }

    #background {
        background: #f6f9ff;
    }

    #announcementgap {
        margin-top: 0px !important;
    }

    #announcementtextgap {
        padding-left: 4rem;
    }

    .labeledit {
      font-weight: 600;
      color: rgba(1, 41, 112, 0.6);
      width: 25%;
      font-size: 15px;
    }

    .labeleditgap {
      margin-bottom: 25px;
    }
  </style>

</head>

<body>

  <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/home" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">M E S H</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-person-fill"></i>
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a><!-- End Profile Image Icon -->

            
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('biodatas.biodata.show', [Auth::user()->ic_no]) }}">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('change_password') }}">
                        <i class="bi bi-key-fill"></i>
                        <span>Change Password</span>
                    </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>
                    <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->

            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    @if (Auth::check())
      @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PDMS_ADMIN') 
      || Auth::user()->hasRole('ROLE_PDMS_SERVICE') || Auth::user()->hasRole('ROLE_PDMS_CUTI'))
      <li class="nav-heading">PDMS Access</li>
      <li class="nav-item">
        <a class="@if($pagename == 'pdmshome') nav-link @else nav-link collapsed @endif" href="{{ route('pdmshome') }}">
          <i class="bi bi-pc-display"></i>
          <span>PDMS Home</span>
        </a>
      </li>
      @endif
	
      <li class="nav-heading">Main Menu</li>

      <li class="nav-item">
        <a class="@if($pagename == 'home') nav-link @else nav-link collapsed @endif" href="{{ route('home') }}">
          <i class="bi bi-house-fill"></i>
          <span>MESH Home</span>
        </a>
      </li>

      @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PDMS_ADMIN') || Auth::user()->hasRole('ROLE_PDMS_CUTI'))
      <li class="nav-item">
        <a class="@if($pagename == 'PDMS Cuti') nav-link @else nav-link collapsed @endif" href="{{ route('pdms.cutiindex') }}">
          <i class="bi bi-list-check"></i>
          </i><span>PDMS Cuti Records</span>
        </a>
      </li>
      @endif

      @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PDMS_ADMIN') || Auth::user()->hasRole('ROLE_PDMS_SERVICE'))
      <li class="nav-item">
        <a class="@if($pagename == 'PDMS Service') nav-link @else nav-link collapsed @endif" href="{{ route('pdms.serviceindex') }}">
          <i class="bi bi-list-ol"></i>
          </i><span>PDMS Service Records</span>
        </a>
      </li>
      @endif

        {{-- <li class="nav-item">
          <a class="@if($pagename == 'PDMSServices') nav-link @else nav-link collapsed @endif" href="{{ route('pdmsservicesdashboard') }}">
            <i class="bi bi-list-task">
            </i><span>Services</span>
          </a>
        </li> --}}

      @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PDMS_ADMIN') )
      <li class="nav-heading">Admin</li>
      <li class="nav-item">
        <a class="@if($pagename == 'PDMS Data') nav-link @else nav-link collapsed @endif" href="{{ route('pdms.index') }}">
          <i class="bi bi-archive"></i>
          </i><span>PDMS Admin</span>
        </a>
      </li>
      @endif
    @endif

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="row">
      @yield('content')
    </div>            
  </main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      <span style="color:black" title="Developed by: Saidatul Ekma (MESH Lead Developer), Laila Khamis(EASE Lead Developer), Nurul Hasinah(Database Administrator), Nadzirah Ali Hassim(Programmer), Wan Arif(Project Officer), Lyanna Karim (MESH Layout & Design)">
		Ministry of Education &copy; 2021 All Rights Reserved</span>
    </div>
</footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  {{-- Jquery For Date-Picker --}}
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

	{{-- Script For Date --}}
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
			$( "#datepicker_retirement" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			minDate:  '0',
			});
		});
	</script>

	<script type="text/javascript">
		$(function() {
			$( "#datepicker_graduate" ).datepicker({
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
	<script type="text/javascript">
		$(function() {
			$( "#datepicker_date_graduate" ).datepicker({
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
			$( "#datepicker_date_end" ).datepicker({
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
			$( "#datepicker_role_start" ).datepicker({
			changeMonth: true,
			changeYear: true,
			format: 'dd-mm-yy',
			dateFormat: 'dd-mm-yy',
			yearRange:  "-80:-0",
			});
		});
	</script>
	<script type="text/javascript">
    $(document).ready(function(){
    $('#bahagianOther').hide();	
      $('#bahagian').on('change', function() {
        if ( this.value == '999')
        {
        $("#bahagianOther").show();
        }
        else
        {
        $("#bahagianOther").hide();
        }
      });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
    $('#unitOther').hide();	
      $('#unit').on('change', function() {
        if ( this.value == '999')
        {
        $("#unitOther").show();
        }
        else
        {
        $("#unitOther").hide();
        }
      });
    });
	</script>

<script type="text/javascript">
	$(document).ready(function(){
	$('#raceOther').hide();	
		$('#races').on('change', function() {
		  if ( this.value == '10')
		  {
			$("#raceOther").show();
		  }
		  else
		  {
			$("#raceOther").hide();
		  }
		});
	});
	</script>

<script type="text/javascript">
	$(document).ready(function(){
	$('#religionOther').hide();	
		$('#religions').on('change', function() {
		  if ( this.value == '4')
		  {
			$("#religionOther").show();
		  }
		  else
		  {
			$("#religionOther").hide();
		  }
		});
	});
	</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
  let selectAllButtonTrans = '{{ trans('global.select_all') }}'
  let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-primary',
        text: selectAllButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'copy',
        className: 'btn-default',
        text: copyButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'colvis',
        className: 'btn-default',
        text: colvisButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>
    @yield('scripts')

</body>

</html>