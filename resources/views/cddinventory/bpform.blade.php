@extends('layouts.app-all')

@section('title', 'Borang Pengeluaran')

@section('content')
@if(session('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-1"></i>
        {{ session('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<?php
$pagename = "Cddinventory";
?>

<section class="section profile">

  <a href="{{ route('cddinventory.cddinventory.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">
      <div class="card-body">


              <!-- Bahan bahan kurikulum -->

              <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                 <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #40826d;">BORANG PENGELUARAN BAHAN-BAHAN KURIKULUM <br>BAGI SEKOLAH-SEKOLAH KERAJAAN</h5>
                  <br>

                  <form class="" method="post" action="{{ route('cddinventory.cddinventory.updatebp') }}" enctype="multipart/form-data" id="bpForm">
                   @csrf

      
           

           

                <table class="table table-bordered">
                 <tbody>

                    <tr>
                        <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #355e3b;">Bahan - Bahan Kurikulum</th>
                    </tr>   
                 @foreach($inventory as $inventory)
                    
                    <input type="text" name="id" value="{{$inventory->id}}" class="bg-gray-200 form-control " hidden>
            

                 <div class="table-responsive">
                  <table class="table-achiev" id="tableprestasi1">

                    <thead>
                    <tr>
                        <th class="text-center" style="background-color:#40826d ; color: white;">Bil.</th>
                        <th class="text-center" style="background-color:#40826d ; color: white;">Judul Bahan</th>
                        <th class="text-center" style="background-color:#40826d ; color: white;">ISBN No.</th>
                        <th class="text-center" style="background-color:#40826d ; color: white;">Kuantiti</th>
                        <th class="text-center" style="background-color:#40826d ; color: white;">Harga @</th>
                    </tr>
                    </thead>

                    <tbody>
                  @php
                      $counter = 1; // Initialize counter variable
                      $hasItems = false;
                  @endphp

                  {{-- Display items from BP table --}}
                  @if(isset($inventorybp) && count($inventorybp) > 0)
                      @php $hasItems = true; @endphp
                      @foreach($inventorybp as $bp)
                      <tr class="text-center">
                          <td>{{ $counter++ }}</td>
                          <td>{{$bp->bp_judulbahan}}</td>
                          <td>{{$bp->bp_isbn}}</td>
                          <td>{{$bp->bp_qty}}</td>
                          <td>{{$bp->bp_harga}}</td>
                      </tr>
                      @endforeach
                  @endif

                  <!-- {{-- Display items from BBK table with Borang Pengeluaran status --}}
                  @if(isset($inventorybbk) && count($inventorybbk) > 0)
                      @php $hasItems = true; @endphp
                      @foreach($inventorybbk as $bbk)
                      <tr class="text-center">
                          <td>{{ $counter++ }}</td>
                          <td>{{$bbk->judulbahan}}</td>
                          <td>{{$bbk->isbn}}</td>
                          <td>
                              @if($bbk->cdd_status == 'Borang Pengeluaran & Sebutharga')
                                  {{$bbk->kqty_pengeluaran ?? '-'}}
                              @else
                                  {{$bbk->cdd_qty_diluluskan ?? '-'}}
                              @endif
                          </td>
                          <td>-</td>
                      </tr>
                      @endforeach
                  @endif -->

                  {{-- Show "No records" if both are empty --}}
                  @if(!$hasItems)
                      <tr class="text-center">
                          <td colspan="5">
                              <h5>No records found</h5>
                          </td>
                      </tr>
                  @endif

                    </tbody>
                 </table>

                 </div>

                

               


                    <table class="table table-bordered">
                      <br>
                        <tbody>
                        <tr>
                            <th scope="row">Sebab Dibekalkan: </th>
                            <td><textarea type="text"  class="form-control" readonly>{{$inventory->bp_catatan}}</textarea></td>
                    
                          </tr>
                       
                        
                        </tbody>
                    </table>

                    

                    <!-- Bahan-bahan Kurikulum -->
                                  
                    <br>
                    <br>           
                    
                    <!-- Maklumat Penerima dan Disahkan Oleh -->
                    <table class="table table-bordered">
                      <tbody>

                        <tr>
                            <th colspan="2" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #355e3b;">Diterima Oleh</th>
                            <th colspan="3" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #355e3b;">Disahkan Oleh</th>
                        </tr>

                        @php
                            // Check if bp_icno exists and has values
                            $hasIcNumbers = false;
                            if (!empty($inventory->bp_icno)) {
                                if (is_array($inventory->bp_icno) && count($inventory->bp_icno) > 0) {
                                    // Filter out empty values
                                    $validIcNumbers = array_filter($inventory->bp_icno, function($ic) {
                                        return !empty($ic) && trim($ic) !== '';
                                    });
                                    $hasIcNumbers = count($validIcNumbers) > 0;
                                }
                            }
                        @endphp
                
                        <tr>
                            <th scope="row">No. Kad Pengenalan</th>
                            <td>
                                @if($hasIcNumbers)
                                    <!-- Display dropdown if IC numbers exist -->
                                    @if(empty($inventory->bp_recieve_icno) || empty($inventory->bp_recieve_nama) || empty($inventory->bp_recieve_jawatan) || empty($inventory->bp_recieve_date))
                                        <select id="bp_recieve_icno" name="bp_recieve_icno" class="form-control">
                                            <option value="">-- Pilih IC Number --</option>
                                            @foreach($validIcNumbers as $icno)
                                                <option value="{{ $icno }}" {{ $inventory->bp_recieve_icno == $icno ? 'selected' : '' }}>
                                                    {{ $icno }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" value="{{$inventory->bp_recieve_icno}}" class="form-control" readonly>
                                    @endif
                                    <!-- Hidden input to store logged-in user's IC for comparison -->
                                    <input type="hidden" id="logged_user_ic" value="{{ Auth::user()->ic_no }}">
                                    <input type="hidden" id="has_ic_dropdown" value="true">
                                @else
                                    <!-- Display logged-in user IC if no IC numbers exist -->
                                    <input type="text" id="bp_recieve_icno" name="bp_recieve_icno" value="{{$inventory->bp_recieve_icno ?: Auth::user()->ic_no}}" class="form-control" readonly>
                                    <input type="hidden" id="logged_user_ic" value="{{ Auth::user()->ic_no }}">
                                    <input type="hidden" id="has_ic_dropdown" value="false">
                                @endif
                            </td>

                            <th scope="row">No. Kad Pengenalan</th>
                            <td><input type="text" value="{{$inventory->bp_disahkan_icno}}" class="form-control" disabled></td>
                        </tr>

                        <tr>
                            <th scope="row">Nama</th>
                            <td>
                                @if(empty($inventory->bp_recieve_icno) || empty($inventory->bp_recieve_nama) || empty($inventory->bp_recieve_jawatan) || empty($inventory->bp_recieve_date))
                                    <input type="text" id="bp_recieve_nama" name="bp_recieve_nama" value="{{$inventory->bp_recieve_nama ?: Auth::user()->name}}" class="form-control" readonly>
                                @else
                                    <input type="text" value="{{$inventory->bp_recieve_nama}}" class="form-control" readonly>
                                @endif
                            </td>
                            <th scope="row">Nama</th>
                            <td><input type="text" value="{{$inventory->bp_disahkan_nama}}" class="form-control" readonly></td>
                        </tr>

                        <tr>
                            <th scope="row">Jawatan</th>
                            <td>
                                @if(empty($inventory->bp_recieve_icno) || empty($inventory->bp_recieve_nama) || empty($inventory->bp_recieve_jawatan) || empty($inventory->bp_recieve_date))
                                    <input type="text" id="bp_recieve_jawatan" name="bp_recieve_jawatan" value="{{$inventory->bp_recieve_jawatan}}" class="form-control" placeholder="Sila masukkan jawatan">
                                @else
                                    <input type="text" value="{{$inventory->bp_recieve_jawatan}}" class="form-control" readonly>
                                @endif
                            </td>
                            <th></th><td></td>
                        </tr>
                    
                        <tr>
                            <th scope="row">Tarikh</th>
                            <td>
                                @if(empty($inventory->bp_recieve_icno) || empty($inventory->bp_recieve_nama) || empty($inventory->bp_recieve_jawatan) || empty($inventory->bp_recieve_date))
                                    @if ($inventory->bp_recieve_date == NULL)
                                        <input type="date" id="bp_recieve_date" name="bp_recieve_date" value="{{ date('Y-m-d') }}" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" readonly>
                                    @else
                                        <input type="text" id="bp_recieve_date" name="bp_recieve_date" value="{{$inventory->bp_recieve_date}}" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" readonly>
                                    @endif
                                @else
                                    <input type="text" value="{{$inventory->bp_recieve_date}}" class="bg-gray-200 form-control form-control-sm" style="width: 200px;" readonly>
                                @endif
                            </td>
                            <th></th>
                            <td></td>
                        </tr>

                        @endforeach

                        </tbody>
                    </table>
                  
                    @if(empty($inventory->bp_recieve_icno) || empty($inventory->bp_recieve_nama) || empty($inventory->bp_recieve_jawatan) || empty($inventory->bp_recieve_date))
                        <a href="{{ route('cddinventory.cddinventory.addicnumber',$inventory->id) }}" class="btn btn-primary mb-2">Add IC Number</a>
                    @endif

            <br>
            <br>

                    @if(empty($inventory->bp_recieve_icno) || empty($inventory->bp_recieve_nama) || empty($inventory->bp_recieve_jawatan) || empty($inventory->bp_recieve_date))
                        <!-- <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="responsibilityCheck" required>
                                    <label class="form-check-label" for="responsibilityCheck">
                                        <small><i>Adalah menjadi tanggungjawab setiap Sekolah, Maktab dan Pusat Tingkatan Enam untuk menggunakan bahan-bahan kurikulum dengan sebaiknya setelah dibekalkan oleh Jabatan Perkembangan Kurikulum. Bahan-bahan yang telah diserahkan dan diterima oleh pihak sekolah adalah menjadi hak milik pihak Sekolah, Maktab dan Pusat Tingkatan Enam seperti yang dinyatakan dalam Memorandum bilangan JPK/BBT/25 J22 (60).</i></small>
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <!-- Warning message when IC doesn't match -->
                        <div class="alert alert-warning" id="icMismatchWarning" style="display: none;">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            You can only submit this form if your IC number matches the selected IC number.
                        </div>
                    @endif

                @if(empty($inventory->bp_recieve_icno) || empty($inventory->bp_recieve_nama) || empty($inventory->bp_recieve_jawatan) || empty($inventory->bp_recieve_date))
                <div class="text-center" id="submitButtonContainer">
                     <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                     <button type="button" class="btn btn-secondary" id="submittingBtn" style="display: none;" disabled>
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Submitting...
                     </button>
                </div>
                @else
                <div class="text-center">
                     <p class="text-success"><i class="bi bi-check-circle me-1"></i> Form has been submitted successfully</p>
                </div>
                @endif

            </form>

        </div>
    </div>
</div>

                </div>

</section>

<!-- IC Number Lookup Script -->
<script type="text/javascript">
    $(document).ready(function() {
        // Function to check if logged-in user IC matches selected IC
        function checkICMatch() {
            var hasDropdown = $('#has_ic_dropdown').val() === 'true';
            
            // If no dropdown (no IC numbers added), always allow submission
            if (!hasDropdown) {
                $('#submitBtn').show();
                $('#icMismatchWarning').hide();
                return true;
            }
            
            // If dropdown exists, check for IC match
            var loggedUserIC = $('#logged_user_ic').val();
            var selectedIC = $('#bp_recieve_icno').val();
            
            console.log('Logged User IC:', loggedUserIC);
            console.log('Selected IC:', selectedIC);
            
            // If no IC selected yet, use logged-in user's info and allow submission
            if (!selectedIC || selectedIC === '') {
                $('#bp_recieve_nama').val('{{ Auth::user()->name }}');
                $('#bp_recieve_jawatan').val('');
                $('#submitBtn').show();
                $('#icMismatchWarning').hide();
                return true;
            }
            
            // If selected IC matches logged-in user IC, show submit button
            if (selectedIC === loggedUserIC) {
                $('#submitBtn').show();
                $('#icMismatchWarning').hide();
                return true;
            } else {
                $('#submitBtn').hide();
                $('#icMismatchWarning').show();
                return false;
            }
        }

        // IC Number lookup functionality - works for both input and select
        function fetchUserByIC(icNo) {
            console.log('Fetching user for IC:', icNo);
            
            if(icNo.length > 0) {
                $.ajax({
                    url: '{{ url("/inventory/get-user-by-ic") }}',
                    method: 'GET',
                    data: { ic_no: icNo },
                    dataType: 'json',
                    success: function(response) {
                        console.log('Response:', response);
                        
                        if(response.success) {
                            // Only update name, let user type jawatan manually
                            $('#bp_recieve_nama').val(response.data.name);
                            
                            // Clear jawatan so user can type their own
                            $('#bp_recieve_jawatan').val('');
                            $('#bp_recieve_jawatan').focus(); // Focus on jawatan field
                            
                            console.log('Name updated. Please enter jawatan.');
                            
                            // Check IC match after fetching user data
                            checkICMatch();
                        } else {
                            alert('IC Number not found in system');
                            $('#bp_recieve_nama').val('');
                            $('#bp_recieve_jawatan').val('');
                            $('#submitBtn').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                        alert('Error fetching user information. Please try again.');
                    }
                });
            } else {
                // If no IC selected (back to default), check IC match which will handle visibility
                checkICMatch();
            }
        }

        // For text input (blur event)
        $(document).on('blur', '#bp_recieve_icno', function() {
            if($(this).is('input[type="text"]')) {
                var icNo = $(this).val();
                fetchUserByIC(icNo);
            }
        });

        // For dropdown select (change event)
        $(document).on('change', '#bp_recieve_icno', function() {
            if($(this).is('select')) {
                var icNo = $(this).val();
                fetchUserByIC(icNo);
            }
        });

        // Check IC match on page load
        checkICMatch();

        // Handle form submission
        $('#bpForm').on('submit', function(e) {
            var hasDropdown = $('#has_ic_dropdown').val() === 'true';
            
            // If dropdown exists and no IC selected, use logged-in user's IC
            if (hasDropdown) {
                var selectedIC = $('#bp_recieve_icno').val();
                var loggedUserIC = $('#logged_user_ic').val();
                
                // If no IC selected, use logged-in user's IC
                if (!selectedIC || selectedIC === '') {
                    // Add hidden input with logged-in user's IC
                    $('#bp_recieve_icno').prop('disabled', true);
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'bp_recieve_icno',
                        value: loggedUserIC
                    }).appendTo($(this));
                } else if (selectedIC !== loggedUserIC) {
                    // If IC selected but doesn't match, prevent submission
                    e.preventDefault();
                    alert('You can only submit this form if your IC number matches the selected IC number.');
                    return false;
                }
            }

            // Check if already submitted
            if ($(this).data('submitted') === true) {
                e.preventDefault();
                return false;
            }

            // Validate required fields
            var nama = $('#bp_recieve_nama').val();
            var jawatan = $('#bp_recieve_jawatan').val();

            if (!nama || !jawatan) {
                alert('Please fill in all required fields');
                return false;
            }

            // Mark as submitted immediately
            $(this).data('submitted', true);

            // Hide submit button and show loading state immediately
            $('#submitBtn').hide();
            $('#submittingBtn').show();

            // Disable the entire submit button container to prevent any clicks
            $('#submitButtonContainer').css('pointer-events', 'none');

            // Store in sessionStorage that form was submitted
            sessionStorage.setItem('formSubmitted', 'true');

            // Allow form to submit
            return true;
        });

        // Check if form was just submitted (after page reload)
        if (sessionStorage.getItem('formSubmitted') === 'true') {
            sessionStorage.removeItem('formSubmitted');
            // Keep the button hidden if it's still showing
            $('#submitBtn').hide();
            $('#submittingBtn').hide();
        }
    });
</script>

@endsection