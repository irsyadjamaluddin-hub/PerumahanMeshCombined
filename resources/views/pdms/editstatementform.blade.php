@extends('layouts.app-pdms')

@section('title', 'Edit Statement Form')

@section('content')

    @php $pagename = "PDMS Data"; @endphp  

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pdms.index') }}">PDMS Index</a></li>
        <li class="breadcrumb-item">{{ $recordprofiles->first()->no_ic }}</li>
        <li class="breadcrumb-item active">Edit Statement Form</li>
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
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Edit Statement Form</h5>

                        <form class="" method="post" action="{{ route('pdms.storestatementform', ['no_ic' => $modified_no_ic]) }}" id="createprofile_form" enctype="multipart/form-data">
                            @csrf
                            <br>
                            <div style="padding: 0 24px 0 24px;">
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Applicant <br> <i>Pemohon</i></div>
                                    <div class="col-md-9"><input type="text" name="pemohon" value="{{$recordprofiles->first()->pemohon}}" class="form-control" required></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">File Statement Status <br> <i>Status Penyerahan Fail</i></div>
                                    <div class="col-md-9">
                                        <select name="penyata_fail" class="form-select" required>
                                            <option value="" @if(empty($recordprofiles->first()->penyata_fail)) selected @endif></option>
                                            <option value="Belum" @if($recordprofiles->first()->penyata_fail == 'Belum') selected @endif>Belum</option>
                                            <option value="Sudah" @if($recordprofiles->first()->penyata_fail == 'Sudah') selected @endif>Sudah</option>
                                        </select>
                                    </div>
                                </div>                                
                                
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date Given <br> <i>Tarikh Penyerahan Fail</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_diserahkan" value="{{$recordprofiles->first()->tarikh_diserahkan}}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">School <br> <i>Sekolah/Maktab</i></div>
                                    <div class="col-md-9"><input type="text" name="sekolah_maktab" value="{{$recordprofiles->first()->sekolah_maktab}}" class="form-control"></div>
                                </div>               
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

{{-- Retirement Date Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the date input elements
        const dobInput = document.querySelector('input[name="tarikh_lahir"]');
        const retirementInput = document.querySelector('input[name="tarikh_bersara"]');

        // Add an input event listener to the date of birth input
        dobInput.addEventListener('input', function () {
            // Get the entered date of birth
            const dob = new Date(this.value);

            // Calculate the retirement date (60 years later)
            const retirementDate = new Date(dob.getFullYear() + 60, dob.getMonth(), dob.getDate());

            // Format the retirement date as YYYY-MM-DD (compatible with the input type="date")
            const formattedRetirementDate = retirementDate.toISOString().split('T')[0];

            // Set the calculated retirement date to the retirement input
            retirementInput.value = formattedRetirementDate;
        });
    });
</script>

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


