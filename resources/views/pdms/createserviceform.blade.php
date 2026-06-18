@extends('layouts.app-pdms')

@section('title', 'Create Service Record')

@section('content')

    @php $pagename = "PDMS Data"; @endphp  

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pdms.index') }}">PDMS Index</a></li>
        <li class="breadcrumb-item">{{ $recordprofiles->first()->no_ic }}</li>
        <li class="breadcrumb-item active">Create New Service Record</li>
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
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Create Service Record</h5>

                        <form class="" method="post" action="{{ route('pdms.storeserviceform' , ['no_ic' => $modified_no_ic]) }}" id="createprofile_form" enctype="multipart/form-data">
                            @csrf
                            <br>
                            <div style="padding: 0 24px 0 24px;">
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Record ID <br> <i>ID Rekod</i></div>
                                    <div class="col-md-9">
                                        <input type="number" name="id_rekod" value="{{ $recordservices->isEmpty() ? 1 : $recordservices->last()->id_rekod + 1 }}" class="form-control">
                                    </div>                                    
                                </div>

                                {{-- <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Type of Service <br> <i>Jenis Maklumat</i></div>
                                    <div class="col-md-9">
                                        <select name="jenis_maklumat[]" class="form-select">
                                            <option value=""></option>
                                            <option value="Lantikan">Lantikan</option>
                                            <option value="Prestasi">Prestasi</option>
                                            <option value="Gaji">Gaji</option>
                                            <option value="Kenaikan Pangkat">Kenaikan Pangkat</option>
                                            <option value="Memangku">Memangku</option>
                                            <option value="Jawatankuasa">Jawatankuasa</option>
                                            <option value="Kursus">Kursus</option>
                                            <option value="Lain-Lain">Lain-Lain</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Type of Service <br> <i>Jenis Maklumat</i></div>
                                    <div class="col-md-9">
                                        <div class="row" style="margin-bottom: 0;">
                                            <div class="col" style="flex: 0 1 22%">
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Lantikan">
                                                    <label class="form-check-label" for="jenis_maklumat_info">Lantikan</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Prestasi">
                                                    <label class="form-check-label" for="jenis_maklumat_info">Prestasi</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Gaji">
                                                    <label class="form-check-label" for="jenis_maklumat_info">Gaji</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Kenaikan Pangkat">
                                                    <label class="form-check-label" for="jenis_maklumat_info">Kenaikan Pangkat</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Memangku">
                                                    <label class="form-check-label" for="jenis_maklumat_info">Memangku</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Jawatankuasa">
                                                    <label class="form-check-label" for="jenis_maklumat_info">Jawatankuasa</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Kursus">
                                                    <label class="form-check-label" for="jenis_maklumat_info">Kursus</label>
                                                </div>
                                                <div class="form-check" id="jenis_maklumat">
                                                    <input type="checkbox" class="form-check-input" name="jenis_maklumat[]" id="jenis_maklumat_info" value="Lain-Lain">
                                                    <label class="form-check-label" for="jenis_maklumat_info">Lain-Lain</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Position <br> <i>Jawatan</i></div>
                                    <div class="col-md-9"><input type="text" name="jawatan" class="form-control"></div>
                                </div>         
                                
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Position <br> <i>Jawatan</i></div>
                                    <div class="col-sm-9">
                                        <select id="jawatan" class="form-select" name="jawatan" aria-label="Default select example" style="width: 100%;">
                                            <option value="" disabled selected></option>
                                            @foreach ($jawatanlists as $key => $value)
                                                <option value="{{ $value }}">
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <script>
                                  $('#jawatan').select2({
                                      width: '100%',
                                      placeholder: "Pilih Jawatan",
                                      allowClear: true
                                  });
                                </script>
                                
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date Start <br> <i>Tarikh Mula</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mula" id="date_start" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date End <br> <i>Tarikh Hingga</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_hingga" id="date_end" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Monthly Pay (BND) <br> <i>Gaji Bulanan</i></div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-text">B$:</span>
                                            <input type="text" name="gaji_bulan" class="form-control" placeholder="Enter amount" id="formattedInput">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Notes <br> <i>Catitan</i></div>
                                    <div class="col-md-9"><textarea name="catitan" class="form-control" placeholder="Enter Text..."></textarea></div>
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

{{-- Currency Script --}}
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

