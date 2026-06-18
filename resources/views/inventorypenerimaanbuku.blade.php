<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Borang Penerimaan Barang</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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


  <style>
    p {
      font-size: 14px;
    }
    body {
      background: #4f77aa;
    }

      .form-check-input.disabled {
            cursor: not-allowed;
            opacity: 0.5; /* Optional: visually indicate disabled state */
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

                       

                            <br>


                           
                            <center><img src="{{ asset('img/moe-logo-latest-compressed.png') }}" class="d-block w-75" alt="MOE LOGO"></center>

                              <br>
                              <header class="card-title" style="padding: 0px; font-size: 18px;">Borang Penerimaan Barang</header>

                              
                              
                  
                              <hr>
        

                                  <!-- Add an onchange event to the select element -->

                                  
                              
                                  <div class="row mb-3">
                                      <label for="inputNama" class="col-lg-4 label">Jabatan/Sekolah:<i style="color:red;">*</i></label>
                                      <div class="col-lg-8">
                                                <select class="form-select" name="unit_sch" aria-label="Default select example" id="myselect" required onchange="filterTable()">
                                                <option selected hidden></option>
                                                @foreach ($departments as $key => $value)
                                                    <option value="{{ $value }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                                </select>
                                      </div>
                                  </div>

                                  <div id="notFoundMessage" style="display: none; color: red; text-align: center; margin-top: 10px;">Not found*</div>



                                     <!-- Table 2 -->

                                     <br>

                                
                                    <div class="table table-bordered hidden-table" id="tableContainer" >  
                                     <div class="table-responsive">
 
                                      
                                     <!--  Table 1 -->

                           

                                        <br>
                                          <table class="table table-bordered" id="table1" >
                                                <tbody>
                                                @foreach($inventoryshdept as $school)
                                                    <tr class="text-center school-row school-row-{{ $school->department->label }}">
                                                      <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color:#898196 ;">BUKU - BUKU </th>
                                                    </tr>   
                                                  @endforeach
                                             </table>

                                              <table class="table-achiev"id="table1">

                                              <thead>
                                              @foreach($inventoryshdept as $school)
                                              <tr class="text-center school-row school-row-{{ $school->department->label }}">
                                                  <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Bil.</th>
                                                  <th class="text-center"style="background-color:#9E8FB2 ; color: white;" >ISBN</th>
                                                  <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Judul Bahan</th>
                                                  <th class="text-center"style="background-color:#9E8FB2 ; color: white;" >Penulis & Penerbit</th>
                                                  <th class="text-center" style="background-color:#9E8FB2; color: white;">Harga Sebuah</th>
                                                  <th class="text-center" style="background-color:#9E8FB2 ; color: white;">Jumlah Bahan</th>
                                                  <th class="text-center" style="background-color:#9E8FB2 ; color: white;"> </th>
                                                  </tr>
                                                  @endforeach
                                              </thead> 

                                              <tbody>
                                                        @if(count( $inventoryshbook) == 0)
                                                            <tr class="text-center">
                                                              <td colspan="8">
                                                                <h5>No records found</h5>
                                                              </td>
                                                            </tr>

                                                          @else
                                                          @php $counter = 1 @endphp
                                                          @foreach( $inventoryshbook as $inventoryshbook)
                                                                @foreach($inventoryshdept as $school)
                                                                <tr class="text-center school-row school-row-{{ $school->department->label }}">
                                                                    <td>{{ $counter++ }}</td>
                                                                    <td>{{$inventoryshbook->isbn}}</td>
                                                                    <td>{{$inventoryshbook->judul_bahan}}</td>
                                                                    <td>{{$inventoryshbook->penulis_penerbit}}</td>
                                                                    <td>{{$inventoryshbook->harga}}</td>
                                                                    <td>{{$inventoryshbook->jum_bahan}}</td>
                                                            
                                                                </tr>
                                                                @endforeach

                                                            @endforeach
                                                            @endif

                                              </tbody>

                                              </table>

                                          <!-- End Table 1 -->


                                              <!-- start table 2  -->
                                              <br>
                                                <table class="table "  id="table2" >
                                                        <tbody>
                                                        @foreach($inventoryshdept as $school)
                                                    <tr class="text-center school-row school-row-{{ $school->department->label }}">
                                                        <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color:#898196  ;">SEKOLAH - SEKOLAH KERAJAAN / JABATAN PERKEMBANGAN KURIKULUM</th>
                                                        </tr>   
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                                    

                                                    <table class="table-achiev " id="table2" >
                                                    <thead>
                                                    @foreach($inventoryshdept as $school)
                                                    <tr class="text-center school-row school-row-{{ $school->department->label }}">

                                                        <th class="text-center "  style="background-color:#9E8FB2 ; color: white;">ID.</th>
                                                        <th class="text-center "  style="background-color:#9E8FB2 ; color: white;">Nama Sekolah</th>
                                                       
                                                        </tr>
                                                        @endforeach
                                                    </thead>

                                                    <tbody>
                                                @if(count($inventoryshdept) == 0)
                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>
                                                @else
                                                    @php $counter = 1 @endphp
                                                    @foreach($inventoryshdept as $school)

                                                <tr class="text-center school-row school-row-{{ $school->department->label }}">
                                                    <td><strong>{{ $counter++ }}</strong></td>
                                                    <td><strong>{{ $school->department->label }}</strong></td>

                                                   
                                                </tr>

                                                <tr class="school-row school-row-{{ $school->department->label }}">
                                                    <td colspan="7">
                                                        <!-- Display the "bilangan" data for each "sekolah" row -->
                                                        @if(isset($inventoryshdeptorder))
                                                            <table class="" style="background-color: white;">

                                                                <thead>
                                                                <tr class="text-center">
                                                                    <th class="text-center" style="background-color:#696969; color: white; padding: 8px;">Bil.Buku</th>
                                                                    <th class="text-center" style="background-color:#696969; color: white; padding: 8px;">Bil.Kuantiti</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($inventoryshdeptorder->sortBy('shbk_id') as $order)
                                                                        @if($order->unit_sch_order == $school->unit_sch)
                                                                            <tr class="text-center">
                                                                                <td>{{ $order->shbk_id }}</td>
                                                                                <td>{{ $order->qty }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            No orders found
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                                </tbody>

                                                </table>

                                              <!-- End Table 2-->
                                              <br>
                                              
                                              

                                              <form class="" method="post" action="{{ route('cddinventory.cddinventory.storepenerimaan') }}" enctype="multipart/form-data">


                                                    @csrf

                                                    <!-- start Div -->
                                                    @foreach($inventoryshdept as $school)

                                                      <div id="divSection"  class="school-row school-row-{{ $school->department->label }}" > 
                                                        <!-- Modify the input name to include the actual id value -->
                                                        <input type="text" name="id_{{ $school->id }}" value="{{ $school->id }}" class="bg-gray-200 form-control" hidden>


                                                         <input type="text" name="sh_id" value="{{$school->sh_id}}" class="bg-gray-200 form-control " hidden>


                
                                                        <div class="row mb-3">
                                                            <label for="inputNama" class="col-lg-4 col-form-label">Nama Penerima:<i style="color:red;">*</i></label>
                                                            <div class="col-lg-8">
                                                              
                                                              @if(empty(old('penerima_' . $school->id, $school->penerima)))
                                                                  <input type="text" name="penerima_{{ $school->id }}" value="{{ old('penerima_' . $school->id, $school->penerima) }}" class="form-control" placeholder="Nama penuh">
                                                              @else
                                                                  <input type="text" name="penerima_{{ $school->id }}" value="{{ old('penerima_' . $school->id, $school->penerima) }}" class="form-control" readonly>
                                                              @endif
                                                              {!! $errors->first('penerima_' . $school->id, '<p class="help-block text-danger">:message</p>') !!}
                                                            </div>
                                                          </div>

                                                          <div class="row mb-3">
                                                            <label for="inputicno" class="col-lg-4 col-form-label">No Kad Pintar:<i style="color:red;">*</i></label>
                                                            <div class="col-lg-8">
                                                            @if(empty(old('penerima_icno_' . $school->id, $school->penerima_icno)))
                                                                  <input type="text" name="penerima_icno_{{ $school->id }}" value="{{ old('penerima_icno_' . $school->id, $school->penerima_icno) }}" class="form-control" placeholder="eg 01012345">
                                                            @else
                                                                  <input type="text" name="penerima_icno_{{ $school->id }}" value="{{ old('penerima_icno_' . $school->id, $school->penerima_icno) }}" class="form-control" readonly>
                                                            @endif
                                                              {!! $errors->first('penerima_icno_' . $school->id, '<p class="help-block text-danger">:message</p>') !!}
                                                            </div>
                                                          </div>

                                                          <div class="row mb-3">
                                                            <label for="inputdo" class="col-lg-4 col-form-label">No.Do <i style="color:red;">*</i></label>
                                                            <div class="col-lg-8">
                                                            @if(empty(old('no_do_' . $school->id, $school->no_do)))
                                                                <input type="text" name="no_do_{{ $school->id }}" value="{{ old('no_do_' . $school->id, $school->no_do) }}" class="form-control" placeholder="No. Delivery Order">
                                                            @else
                                                                <input type="text" name="no_do_{{ $school->id }}" value="{{ old('no_do_' . $school->id, $school->no_do) }}" class="form-control" readonly>
                                                            @endif
                                                            {!! $errors->first('no_do_' . $school->id, '<p class="help-block text-danger">:message</p>') !!}
                                                            </div>
                                                          </div>

                                                       <div class="row mb-3">
                                                          <label for="inputfile" class="col-lg-4 col-form-label">Proof Photo:</label>
                                                          <div class="col-lg-8">
                                                          @if(empty(old('no_do_' . $school->id, $school->no_do)))
                                                          <input type="file" name="file_{{ $school->id }}" class="form-control">
                                                          @else
                                                              @if ($school->file)
                                                                
                                                                  <p><a href="{{ asset('storage/' . $school->file) }}" target="_blank">view file</a></p>
                                                              @endif
                                                          @endif
                                                          </div>
                                                      </div>


                                                          <div class="row mb-3">
                                                              <label for="inputfile" class="col-lg-4 col-form-label">Date & Time:</label>
                                                              <div class="col-lg-8">
                                                              <?php   $currentDateTime = ($school->date_recieve !== null) ? $school->date_recieve : now()->format('Y-m-d H:i:s');?>
                                                             <input type="text" name="date_recieve_{{ $school->id }}" value="{{ $currentDateTime }}" class="form-control" readonly>
                                                                  {!! $errors->first('file', '<p class="help-block text-danger">:message</p>') !!}
                                                            </div>
                                                          </div>

                                                          
                                                          <br>

                                           
                                              @if(empty(old('penerima_' . $school->id, $school->penerima))) <!-- Check if the input is empty -->
                                                  <div class="row mb-3">
                                                      <div class="col-lg-12">
                                                          <div class="form-check">
                                                              <input class="form-check-input" type="checkbox" name="responsibilityCheck_{{ $school->id }}" id="responsibilityCheck_{{ $school->id }}">
                                                              <label class="form-check-label" for="responsibilityCheck_{{ $school->id }}">
                                                                  <small><i>Adalah menjadi tanggungjawab setiap Sekolah, Maktab dan Pusat Tingkatan Enam untuk menggunakan bahan-bahan kurikulum dengan sebaiknya setelah dibekalkan oleh Jabatan Perkembangan Kurikulum. Bahan-bahan yang telah diserahkan dan diterima oleh pihak sekolah adalah menjadi hak milik pihak Sekolah, Maktab dan Pusat Tingkatan Enam seperti yang dinyatakan dalam Memorandum bilangan JPK/BBT/25 J22 (60).</i></small>
                                                              </label>
                                                          </div>
                                                      </div>
                                                  </div>
                                              @endif

                                              <div class="text-center">
                                                  @if(!empty(old('penerima_' . $school->id, $school->penerima))) <!-- Check if the input is filled -->
                                                     
                                                      <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                          <i class="bi bi-folder me-1"></i> Borang Penerimaan telah dihantar!</div>
                                                  @else
                                                      <button type="submit" class="btn btn-primary">Hantar</button> <!-- Enable submit button if not submitted -->
                                                  @endif
                                              </div>
                                                                                                
                                  
                                                    </div>
                                                    @endforeach
                                                        <!-- End Div -->

                                                
                                              </form>


                                            </div>

                                        </div>

                                  <br>
                                
                      
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
   <!-- Add JavaScript code to filter the rows based on the selected option -->
  <script>
      function filterTableori() {
          var selectedOption = document.getElementById('myselect').value;
          var rows = document.getElementsByClassName('school-row');

          // Hide all rows initially
          for (var i = 0; i < rows.length; i++) {
              rows[i].style.display = 'none';
          }

          // Show only the rows that match the selected option
          var matchingRows = document.getElementsByClassName('school-row-' + selectedOption);
          for (var j = 0; j < matchingRows.length; j++) {
              matchingRows[j].style.display = '';
          }
      }
  </script>

<style>
    .hidden-table {
        display: none;
    }

    @media (max-width: 768px) {
    /* Add your responsive styles here for smaller screens */
    body {
        background: #4f77aa; /* Example style change */
    }

    /* Example style change for table cells */
    table td {
        font-size: 12px;
    }
}

</style>




<!-- Add this script inside the <head> or at the end of the <body> before </body> tag -->
<script>
    function filterTableworking() {
        var selectedOption = document.getElementById('myselect').value;
        var rows = document.getElementsByClassName('school-row');
        var table = document.getElementById('table2');
        var tableContainer = document.getElementById('tableContainer');

        // Hide or show the table based on the selected option
        table.style.display = (selectedOption === 'Pilih') ? 'none' : '';

        // Hide or show the div based on the selected option
        tableContainer.style.display = (selectedOption === 'Pilih') ? 'none' : 'block';

        // Hide all rows initially
        for (var i = 0; i < rows.length; i++) {
            rows[i].style.display = 'none';

            // Also hide corresponding order rows
            var orderRows = rows[i].nextElementSibling;
            if (orderRows) {
                orderRows.classList.add('hidden');
            }
        }

        // Show only the rows that match the selected option
        var matchingRows = document.getElementsByClassName('school-row-' + selectedOption);
        for (var j = 0; j < matchingRows.length; j++) {
            matchingRows[j].style.display = '';

            // Also show corresponding order rows
            var orderRows = matchingRows[j].nextElementSibling;
            if (orderRows) {
                orderRows.classList.remove('hidden');
            }
        }
    }
</script>

<!-- Add this script inside the <head> or at the end of the <body> before </body> tag -->
<script>
    function filterTable() {
        var selectedOption = document.getElementById('myselect').value;
        var rows = document.getElementsByClassName('school-row');
        var table = document.getElementById('table2');
        var tableContainer = document.getElementById('tableContainer');
        var notFoundMessage = document.getElementById('notFoundMessage');

        // Hide or show the table based on the selected option
        table.style.display = (selectedOption === 'Pilih') ? 'none' : '';

        // Hide or show the div based on the selected option
        tableContainer.style.display = (selectedOption === 'Pilih') ? 'none' : 'block';

        // Hide the not found message initially
        notFoundMessage.style.display = 'none';

        // Hide all rows initially
        for (var i = 0; i < rows.length; i++) {
            rows[i].style.display = 'none';

            // Also hide corresponding order rows
            var orderRows = rows[i].nextElementSibling;
            if (orderRows) {
                orderRows.classList.add('hidden');
            }
        }

        // Show only the rows that match the selected option
        var matchingRows = document.getElementsByClassName('school-row-' + selectedOption);
        if (matchingRows.length > 0) {
            for (var j = 0; j < matchingRows.length; j++) {
                matchingRows[j].style.display = '';

                // Also show corresponding order rows
                var orderRows = matchingRows[j].nextElementSibling;
                if (orderRows) {
                    orderRows.classList.remove('hidden');
                }
            }
        } else {
            // Show the not found message if no matching rows
            notFoundMessage.style.display = 'block';
        }
    }
</script>









  
  
</section>

   
</body>

</html>