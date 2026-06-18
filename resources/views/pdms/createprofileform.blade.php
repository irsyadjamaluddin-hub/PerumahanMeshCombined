@extends('layouts.app-pdms')

@section('title', 'Create Profile')

@section('content')

    @php $pagename = "PDMS Data"; @endphp  

<div class="pagetitle">
    <h1>Personnel Data Management System</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pdmshome') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pdms.index') }}">PDMS Index</a></li>
        <li class="breadcrumb-item active">Create New Profile</li>
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
    <div class="col-md-1 text-left">
        <a href="{{ route('pdms.index') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem; padding-top: 10px;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>  

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="profile-overview pt-3">
                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Create New PDMS Profile</h5>

                        <form class="" method="post" action="{{ route('pdms.storeprofile') }}" id="createprofile_form" enctype="multipart/form-data">
                            @csrf
                            <br>
                            <div style="padding: 0 24px 0 24px;">
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Name <br> <i>Nama</i></div>
                                    <div class="col-md-9"><input type="text" name="name" class="form-control" required></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Ic No. <br> <i>No. Ic</i></div>
                                    <div class="col-md-9"><input type="number" name="no_ic" class="form-control" placeholder="00000000" required></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Ic Colour <br> <i>Warna Ic</i></div>
                                    <div class="col-md-9"><input type="text" name="ic_colour" class="form-control" placeholder="Kuning/Hijau/Unggu/Merah/..."></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Department File No. <br> <i>No. Fail Jabatan</i></div>
                                    <div class="col-md-9"><input type="text" name="no_fail_jabatan" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Position <br> <i>Jawatan</i></div>
                                    <div class="col-sm-9">
                                        <select id="jawatan_sekarang" class="form-select" name="jawatan_sekarang" aria-label="Default select example" style="width: 100%;">
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
                                  $('#jawatan_sekarang').select2({
                                      width: '100%',
                                      placeholder: "Pilih Jawatan",
                                      allowClear: true
                                  });
                                </script>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Type of Service <br> <i>Jenis Perkhidmatan</i></div>
                                    <div class="col-md-9"><input type="text" name="jenis_perkhidmatan" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Salary Type <br> <i>Bahagian</i></div>
                                    <div class="col-md-9"><input type="text" name="bahagian" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Section <br> <i>Tangga-gaji</i></div>
                                    <div class="col-md-9"><input type="text" name="tanggagaji" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0 !important;">
                                    <div class="col-md-3 label">JPA File No. <br> <i>No. Fail JPA</i></div>
                                    <div class="col-md-9"><input type="text" name="no_fail_jpa" class="form-control"></div>
                                </div>

                                <br><hr><br>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Sex <br> <i>Jantina</i></div>
                                    <div class="col-md-9">
                                        <select name="jantina" class="form-select">
                                            <option value=""></option>
                                            <option value="Lelaki">Male</option>
                                            <option value="Perempuan">Female</option>
                                        </select>
                                    </div>
                                </div>                                
                                
                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date of Birth <br> <i>Tarikh Lahir</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_lahir" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Date of Retirement (60 Yrs old) <br> <i>Tarikh Bersara</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_bersara" id="tarikh_bersara" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Place of Birth <br> <i>Tempat Lahir</i></div>
                                    <div class="col-md-9"><input type="text" name="tempat_lahir" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Religion <br> <i>Ugama</i></div>
                                    <div class="col-md-9"><input type="text" name="ugama" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Race <br> <i>Bangsa</i></div>
                                    <div class="col-md-9"><input type="text" name="bangsa" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Citizenship <br> <i>Kerakyatan</i></div>
                                    <div class="col-md-9"><input type="text" name="kerakyatan" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Marital Status <br> <i>Taraf Kelamin</i></div>
                                    <div class="col-md-9"><input type="text" name="taraf_kelamin" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Starting of Service Date <br> <i>Tarikh Mula Berkhidmat</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_mula_berkhidmat" class="form-control">
                                    </div>
                                </div>

                                <br><hr><br>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Home Address <br> <i>Alamat Rumah</i></div>
                                    <div class="col-md-9"><textarea name="alamat_rumah" class="form-control"></textarea></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Different Address <br> <i>Alamat Lain</i></div>
                                    <div class="col-md-9"><textarea name="alamat_lain" class="form-control"></textarea></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Phone (Home) <br> <i>Telefon Rumah</i></div>
                                    <div class="col-md-9"><input type="text" name="telefon_rumah" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Phone (Mobile) <br> <i>Telefon Mobile</i></div>
                                    <div class="col-md-9"><input type="text" name="telefon_mobile" class="form-control"></div>
                                </div>

                                <br><hr><br>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Current Chosen Date <br> <i>Tarikh Lantikan Sekarang</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_lantikan_sekarang" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Place of Work <br> <i>Tempat Bertugas</i></div>
                                    <div class="col-md-9"><input type="text" name="tempat_bertugas" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Department <br> <i>Jabatan</i></div>
                                    <div class="col-sm-9">
                                        <select id="jabatan" class="form-select" name="jabatan" aria-label="Default select example" style="width: 100%;">
                                            <option value="" disabled selected></option>
                                            @foreach ($departments as $key => $value)
                                                <option value="{{ $value }}">
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <script>
                                  $('#jabatan').select2({
                                      width: '100%',
                                      placeholder: "Pilih Jabatan",
                                      allowClear: true
                                  });
                                </script>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Ministry <br> <i>Kementerian</i></div>
                                    <div class="col-md-9"><input type="text" name="kementerian" class="form-control"></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Fixation Department Date <br> <i>Tarikh Penepatan Jawatan</i></div>
                                    <div class="col-md-9">
                                        <input type="date" name="tarikh_penepatan_jawatan" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Status <br> <i>Status</i></div>
                                    <div class="col-md-9">
                                        <input type="text" name="status" class="form-control" placeholder="AKTIF/BERHENTI/BERSARA/...">
                                    </div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Service scheme <br> <i>Skim Perkidmatan</i></div>
                                    <div class="col-md-9"><textarea name="skim_perkhidmatan" class="form-control"></textarea></div>
                                </div>

                                <div class="row mb-2" style="margin-bottom: 0.75rem !important;">
                                    <div class="col-md-3 label">Teacher Scheme <br> <i>Skim Perguruan</i></div>
                                    <div class="col-md-9">
                                        <select name="skim_perguruan" class="form-select">
                                            <option value=""></option>
                                            <option value="Skim Perkhidmatan Guru (SPG)">Skim Perkhidmatan Guru (SPG)</option>
                                            <option value="Skim Guru (G)">Skim Guru (G)</option>
                                            <option value="Skim Perjawatan">Skim Perjawatan</option>
                                        </select>
                                    </div>
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


