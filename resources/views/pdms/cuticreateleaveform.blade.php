@extends('layouts.app-pdms')

@section('title', 'Create Leave Record')

@section('content')

    @php $pagename = "PDMS Cuti"; @endphp  

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pdms.cutiindex') }}">PDMS Index</a></li>
        <li class="breadcrumb-item">{{ $recordprofiles->first()->no_ic }}</li>
        <li class="breadcrumb-item active">Create New Leave Record</li>
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
        <a href="{{ route('pdms.cutiindexfilebyic', ['no_ic' => $modified_no_ic]) }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>  

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Create Service Record</h5>

                        <form class="" method="post" action="{{ route('pdms.cutistoreleaveform' , ['no_ic' => $modified_no_ic]) }}" id="createprofile_form" enctype="multipart/form-data">
                            @csrf
                            <br>
                            <div style="padding: 0 24px 0 24px;">
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Record ID <br> <i>ID Rekod</i></div>
                                    <div class="col-md-9">
                                        <input type="number" name="id_rekod" value="{{ $recordcutis->isEmpty() ? 1 : $recordcutis->last()->id_rekod + 1 }}" class="form-control">
                                    </div>                                    
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Type of Leave <br> <i>Jenis Cuti</i></div>
                                    <div class="col-md-9"><input type="text" name="jenis_cuti" class="form-control"></div>
                                </div>                            

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Total day on Leave <br> <i>Jumlah Hari Cuti</i></div>
                                    <div class="col-md-9">
                                        <input type="number" name="jumlah_hari" id="jumlah_hari" placeholder="0" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date Start <br> <i>Tarikh Mula</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mula" id="date_start" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date End <br> <i>Tarikh Akhir</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_akhir" id="date_end" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Remark <br> <i>Remark</i></div>
                                    <div class="col-md-9"><textarea name="remark" class="form-control" placeholder="Enter Text..."></textarea></div>
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
