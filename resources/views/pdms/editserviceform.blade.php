@extends('layouts.app-pdms')

@section('title', 'Edit Service Record')

@section('content')

    @php $pagename = "PDMS Data"; @endphp  

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pdms.index') }}">PDMS Index</a></li>
        <li class="breadcrumb-item">{{ $recordprofiles->first()->no_ic }}</li>
        <li class="breadcrumb-item">Edit Service Record</li>
        <li class="breadcrumb-item active">Record ID: {{$recordId}}</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

@if(Session::has('error_message'))
<div class="alert alert-danger">
    <i class="fas fa-fw fa-exclamation-circle"></i>
    {!! session('error_message') !!}
</div>
@endif

<section class="section profile">

    <!----- Back out Button  ----->
    @php
        $modified_no_ic = str_replace('/', '|', $recordprofiles->first()->no_ic);
    @endphp
    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('pdms.indexfilebyic', ['no_ic' => $modified_no_ic]) }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>  

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit Service Record</h5>

                        <form class="" method="post" action="{{ route('pdms.updateserviceform', ['no_ic' => $modified_no_ic, 'id_rekod' => $recordservices->first()->id_rekod]) }}" id="updateprofile_form" enctype="multipart/form-data">
                            @csrf
                            <br>
                            <div style="padding: 0 24px 0 24px;">
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Record ID <br> <i>ID Rekod</i></div>
                                    <div class="col-md-9">
                                        <input type="number" name="id_rekod" value="{{ $recordservices->first()->id_rekod }}" class="form-control" readonly>
                                    </div>                                    
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Type of Service <br> <i>Jenis Maklumat</i></div>
                                    <div class="col-md-9">
                                        <div class="row" style="margin-bottom: 0;">
                                            <div class="col" style="flex: 0 1 22%">

                                                @php
                                                    $jenisMaklumatValue = $recordservices->first()->jenis_maklumat;
                                                    $jenisMaklumat = [];

                                                    if (!empty($jenisMaklumatValue)) {
                                                        // Check if it's a JSON string
                                                        $decoded = json_decode($jenisMaklumatValue, true);
                                                        if ($decoded !== null && json_last_error() === JSON_ERROR_NONE) {
                                                            // If it's a valid JSON, treat it as an array
                                                            $jenisMaklumat = $decoded;
                                                        } else {
                                                            // If it's not a JSON, split the string by '/'
                                                            $jenisMaklumat = explode('/', $jenisMaklumatValue);
                                                        }
                                                    }
                                                @endphp

                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Lantikan" @if(in_array('Lantikan', $jenisMaklumat)) checked @endif>
                                                    <label class="form-check-label" for="jenis_maklumat_info">Lantikan</label>
                                                </div>

                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Prestasi"  @if(in_array('Prestasi', $jenisMaklumat)) checked @endif>
                                                    <label class="form-check-label" for="jenis_maklumat_info">Prestasi</label>
                                                </div>
                                
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Gaji" @if(in_array('Gaji', $jenisMaklumat)) checked @endif>
                                                    <label class="form-check-label" for="jenis_maklumat_info">Gaji</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Kenaikan Pangkat" @if(in_array('Kenaikan Pangkat', $jenisMaklumat)) checked @endif>
                                                    <label class="form-check-label" for="jenis_maklumat_info">Kenaikan Pangkat</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Memangku" @if(in_array('Memangku', $jenisMaklumat)) checked @endif>
                                                    <label class="form-check-label" for="jenis_maklumat_info">Memangku</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Jawatankuasa" @if(in_array('Jawatankuasa', $jenisMaklumat)) checked @endif>
                                                    <label class="form-check-label" for="jenis_maklumat_info">Jawatankuasa</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Kursus" @if(in_array('Kursus', $jenisMaklumat)) checked @endif>
                                                    <label class="form-check-label" for="jenis_maklumat_info">Kursus</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Lain-Lain" @if(in_array('Lain-Lain', $jenisMaklumat)) checked @endif>
                                                    <label class="form-check-label" for="jenis_maklumat_info">Lain-Lain</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                          

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Position <br> <i>Jawatan</i></div>
                                    <div class="col-md-9">
                                        <select id="jawatan" class="form-select" name="jawatan" aria-label="Default select example" style="width: 100%;">
                                            <option value="" disabled selected></option>
                                            @foreach ($jawatanlists as $key => $value)
                                                <option value="{{ $value }}" {{ $recordservices->first()->jawatan == $value ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <script>
                                  $('#jawatan').select2({
                                      width: '100%',
                                      placeholder: "{{ $recordservices->first()->jawatan }}",
                                      allowClear: true
                                  });
                                </script>
                                
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date Start <br> <i>Tarikh Mula</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mula" value="{{ $recordservices->first()->tarikh_mula }}" id="date_start" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date End <br> <i>Tarikh Hingga</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_hingga" value="{{ $recordservices->first()->tarikh_hingga }}" id="date_end" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Monthly Pay (BND) <br> <i>Gaji Bulanan</i></div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-text">B$:</span>
                                            <input type="text" name="gaji_bulan" value="{{ $recordservices->first()->gaji_bulan }}" class="form-control" placeholder="Enter amount" id="formattedInput">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Notes <br> <i>Catitan</i></div>
                                    <div class="col-md-9"><textarea name="catitan" class="form-control" placeholder="Enter Text...">{{ $recordservices->first()->catitan }}</textarea></div>
                                </div>

                            <br><hr><br>

                            <div class="text-center">
                                <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

{{-- Disable button when Submitting --}}
<script>
    var submitButton = document.getElementById('submit-button');
    var form = document.getElementById('createprofile_form');
    
    form.addEventListener('submit', function(event) {
        if (this.getAttribute('data-submitted') !== null) {
            event.preventDefault();
        } else {
            submitButton.disabled = true;
            submitButton.innerText = 'Submitting...'; // Optional: Change the button text to indicate submission
            this.setAttribute('data-submitted', 'true');
        }
    });
</script>

{{-- Date Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the initial value of 'date_start' when the page loads
        const startDate = document.getElementById('date_start').value;

        // Set the minimum date for 'date_end' based on 'date_start'
        document.getElementById('date_end').min = startDate;
    });

    document.addEventListener('change', function (event) {
        if (event.target.id === 'date_start') {
            // Get the selected date in 'date_start'
            const startDate = event.target.value;

            // Set the minimum date for 'date_end' based on 'date_start'
            document.getElementById('date_end').min = startDate;
        }
    }, true); // Use 'true' for event capture phase
</script>

{{-- Cuurency Script --}}
<script>
    $(document).ready(function () {
        $('#formattedInput').on('input', function () {
            // Remove non-numeric characters
            let value = $(this).val().replace(/\D/g, '');

            // Format the value as desired
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

            // Display the formatted value with the currency symbol
            $(this).val('B$ ' + value);
        });
    });
</script>

