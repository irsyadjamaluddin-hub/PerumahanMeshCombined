@extends('layouts.app-all')

@section('title', 'Profile')

@section('content')

  <?php
    $pagename = "Admin User Profile";
  ?>
  
<div class="pagetitle">
      <h1>User Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">


        </div>

        <div class="col-xl-8">
         

          <div class="card mt-3" >
            <div class="card-body pt-3" >
              
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#profile-overview">Personal Information</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-edit">Contact</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-settings">Employment</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-change-password">Education</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-salary">Salary</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-achiev">Achievement</button>
                </li>

                  <li class="nav-item">
                  <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-files">Files</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                 
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Nama Penuh <br> <i>Full Name</i></div>
                    <div class="col-lg-9 col-md-7">{{ ucwords(trans ($biodata->name)) }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Tarikh Lahir <br> <i>Date of Birth</i></div>
                    <div class="col-lg-9 col-md-7">{{ $biodata->dob }}</div>
                  </div>

                 <div class="row">
                    <div class="col-lg-3 col-md-5 label">Umur <br> <i>Age</i></div>
                    <div class="col-lg-9 col-md-7">
                      @if ($biodata->dob == NULL)
                        <td></td>
                      @else
                        {{ \Carbon\Carbon::parse($biodata->dob)->diff(\Carbon\Carbon::now())->y }}
                      @endif
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                    <div class="col-lg-9 col-md-7">{{ $biodata->ic_no }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Warna Kad Pengenalan <br> <i>Identity Card Color</i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($biodata->icColor)->label }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. BruHIMS <br> <i>BruHIMS No.</i></div>
                    <div class="col-lg-9 col-md-7">{{ Str::upper($biodata->bruhims_no) }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Jantina <br> <i>Gender</i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($biodata->gender)->label }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Status Kelamin <br> <i>Martial Status</i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($biodata->maritalStatus)->label }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Bangsa <br> <i> Race </i></div>
                     <div class="col-lg-9 col-md-7">
                      @if( $biodata->race_id == '10') <p>{{ $biodata->race_other }}</p> @else{{ optional($biodata->race)->label }}@endif</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Agama <br> <i> Religion </i></div>
                    <div class="col-lg-9 col-md-7">
                      @if( $biodata->religion_id == '4')  <p>{{ $biodata->religion_other }}</p> @else{{ optional($biodata->religion)->label }}@endif</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Kerakyatan<br> <i> Citizenship </i></div>
                    <div class="col-lg-9 col-md-7">{{ $biodata->citizenship_id }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Tempat Lahir<br> <i> Place of Birth </i></div>
                    <div class="col-lg-9 col-md-7">{{ $biodata->place_of_birth }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Tarikh Bersara<br> <i> Date of Retirement </i></div>
                    <div class="col-lg-9 col-md-7">{{ $biodata->bersara_date}}</div>
                  </div>

                  <h5 class="card-title">Vaccination Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Dos Vaksinasi<br> <i> Vaccination Dose </i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($biodata->vaccinedos)->label }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Info Vaksinasi<br> <i> Vaccination Info </i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($biodata->vaccineinfo)->label }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Info Pengalak Vaksinasi<br> <i> Booster Vaccination Info </i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($biodata->vaccinebooster)->label }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Kumpulan Terdedah<br> <i> Vulnerable Group </i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($biodata->vulnerable)->label }}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-overview pt-3" id="profile-edit">

                <h5 class="card-title">Contact Details</h5>

                

                @foreach($contacts as $contact)
                
                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Alamat <br> <i>Address</i></div>
                    <div class="col-lg-9 col-md-7">{{ $contact->address }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Poskod <br> <i>Postcode</i></div>
                    <div class="col-lg-9 col-md-7">{{ $contact->postcode }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Negara <br> <i>Country</i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($contact->country)->label }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Telefon Bimbit <br> <i>No. Telephone Mobile</i></div>
                    <div class="col-lg-9 col-md-7">{{ $contact->telephone_mobile }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Telefon Pejabat <br> <i>No. Telephone Office</i></div>
                    <div class="col-lg-9 col-md-7">{{ $contact->telephone_office }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Telefon Rumah <br> <i>No. Telephone Home </i></div>
                    <div class="col-lg-9 col-md-7">{{ $contact->telephone_home }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Emel <br> <i>Email</i></div>
                    <div class="col-lg-9 col-md-7">{{ $biodata->email }}</div>
                  </div>

                 <!--  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Emel lain <br> <i>Other Email</i></div>
                    <div class="col-lg-9 col-md-7">{{ $contact->personal_email }}</div>
                  </div> -->

                  <h5 class="card-title">Emergency Contact Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Nama <br> <i>Name</i></div>
                    <div class="col-lg-9 col-md-7">{{ $contact->name_ec}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Telefon  <br> <i>No. Telephone</i></div>
                    <div class="col-lg-9 col-md-7">{{ $contact->tel_ec}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Hubungan <br> <i>Relationship</i></div>
                    <div class="col-lg-9 col-md-7">{{ optional($contact->emergencyRelationsip)->label }}</div>
                  </div>

                @endforeach


                </div>

                <div class="tab-pane fade  profile-overview pt-3" id="profile-settings">

                <h3 class="card-title">Employment Details</h3>

                @foreach($employments as $employment)

                    <div class="row">
                      <div class="col-lg-3 col-md-5 label ">Kementerian <br> <i>Ministry</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->ministry)->label }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5 label">Jabatan <br> <i>Department</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->department)->label }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5 label">Bahagian <br> <i>Section</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->bahagian_id }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Unit <br> <i>Unit</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->unit_id}}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Maktab/Sekolah <br> <i>College/School</i></div>
                      <div class="col-lg-9 col-md-7">{{ $school->school_name }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Kluster <br> <i>Cluster</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->cluster)->cluster_name }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Peranan <br> <i>Role</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->rolePeranan)->label }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Status Perkhidmatan <br> <i>Service Status</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->serviceStatus)->label }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5 label">Jenis Perkhidmatan <i>Employment Type</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->employmentstatus)->label }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Skim Perkhidmatan <br> <i>Service Scheme</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->skimperkhidmatan)->label }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Kod Jawatan <br> <i>Position Code</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->code_service }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">No Fail Peribadi <br> <i>Personnel Fail No</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->personnel_file}}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">SSM Personnel No. <br> <i>SSM Personnel No.</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->ssm_reference_no }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tanggagaji <br> <i>Salary Scale</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->salaryScale)->label }}</div>
                    </div>

                  <h3 class="card-title">Intial Service Details</h3>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Jawatan Lantikan Awal <br> <i>Intial Designation</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->designation_id }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tempat Bertugas Jawatan Lantikan Awal <br> <i>Intial Designation Placement</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->first_service_place }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tarikh Lantikan Jawatan Awal <br> <i>Intial Designation Date</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->service_begin_date }}</div>
                    </div>

                    <h3 class="card-title">Current Service Details</h3>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Jawatan Sekarang <br> <i>Current Designation </i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->current_designation_id }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tempat Bertugas Jawatan Sekarang <br> <i>Current Designation Placement</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->current_service_place }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tarikh Lantikan Jawatan Sekarang <br> <i>Current Designation Date</i></div>
                      <div class="col-lg-9 col-md-7">{{ $employment->current_designation_date }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Dearah Tempat Bertugas <br> <i>District of Work</i></div>
                      <div class="col-lg-9 col-md-7">
                        {{ optional($employment->district)->label }}
                      </div>
                    </div>

                @endforeach

                </div>

                <div class="tab-pane fade profile-overview pt-3" id="profile-change-password">

                <h3 class="card-title">Education Details</h3>

                  @foreach($educations as $education)

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Kelulusan Tertinggi <br> <i>Highest Education</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($education->educationLevel)->label }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Bidang Kelulusan <br> <i>Course Name</i></div>
                      <div class="col-lg-9 col-md-7">{{ $education->education_name }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tarikh Sijil <br> <i>Ceritificate date</i></div>
                      <div class="col-lg-9 col-md-7">
                        {{ $education->graduation_date }}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Muat Naik Sijil <br> <i>Upload Ceritificate</i></div>
                      <div class="col-lg-9 col-md-7"><a href='{{Storage::url("$education->file") }}' target="_blank">{{ $education->file_name }}</a></div>
                    </div>

                  @endforeach

                </div>

                <div class="tab-pane fade profile-overview pt-3" id="profile-salary">

                  <h3 class="card-title">Salary Details</h3>

                  @foreach($salarys as $salary)

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tanggagaji <br> <i>Salary Scale</i></div>
                      <div class="col-lg-9 col-md-7">{{ optional($employment->salaryScale)->label }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tarikh Kenaikan <br> <i>Increment Date</i></div>
                      <div class="col-lg-9 col-md-7">{{ $salary->increment_date }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Gaji <br> <i>Salary</i></div>
                      <div class="col-lg-9 col-md-7">$ {{ $salary->salary }}.00</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Bahagian <br> <i>Division</i></div>
                      <div class="col-lg-9 col-md-7">
                      {{ optional($salary->division)->label }}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Kategori Elaun  <br> <i>Allowance Category</i></div>
                      <div class="col-lg-9 col-md-7">{{ $salary->allowance_category_id }}</div>
                    </div>

                  @endforeach

                </div>
                  <!-- Start Achievement Tab -->
                  <div class="tab-pane fade profile-overview pt-3" id="profile-achiev">

<h3 class="card-title">Achievement Details</h3>
<div class="accordion" id="accordionPanelsStayOpenExample">
  {{-- PRESTASI --}}
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        Prestasi
      </button>
    </h2> 
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body">
          <form>
            <table class="table-achiev">
              <thead>
                <tr>
                  <th>Tahun (Year)</th>
                  <th>Markah (Percentage)</th>
                  <th>Gred (Grade)</th>
                  <th>Lampiran (Attachment)</th>
                </tr>
              </thead>

              <tbody>
              @if(count($performances) == 0)

              <tr class="text-center">
                <td colspan="8"><h5>No records found</h5></td>
              </tr>
                  
              @else
                  @foreach( $performances as $perf )
                      <tr>
                        <td>{{ $perf->year }}</td>
                        <td>{{ $perf->percentage }}</td> 
                        <td>{{ optional($perf->Grade)->label }}</td>
                        <td><a href='{{Storage::url("$perf->file_1") }}' target="_blank">View</a></td>
                      </tr>
                  @endforeach
              @endif
              </tbody>
            </table>
          </form>
      </div>
    </div>
  </div>
  {{-- PRESTASI ends --}}

  {{-- KURSUS --}}
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
      Kursus
    </button>
    </h2> 
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
      <div class="accordion-body">
          <form>
            <table class="table-achiev">
              <thead>
                <tr>
                  <th>Nama Kursus</th>
                  <th>Tarikh Mula</th>
                  <th>Tarikh Tamat</th>
                  <th>Tempat</th>
                  <th>Tempoh</th>
                  <th>Lampiran (Attachment)</th>
                </tr>
              </thead>

              <tbody>
                @if(count($courses) == 0)

                  <tr class="text-center">
                    <td colspan="8"><h5>No records found</h5></td>
                  </tr>
                    
                @else
                  @foreach( $courses as $course )
                      <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->start_date }}</td>
                        <td>{{ $course->end_date }}</td>
                        <td>{{ $course->venue }}</td>
                        <td>{{ $course->duration }}</td>

                        @if($course->file_1 == 0)
                        <td>(empty)</td>
                        @else
                        <td><a href='{{Storage::url("$course->file_1") }}' target="_blank">View</a></td>
                        @endif

                      </tr>
                  @endforeach
                @endif

              </tbody>
            </table>
          </form>
      </div>
    </div>
  </div>
  {{-- KURSUS ENDS--}}

  {{-- PINGAT --}}
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
      Pingat
    </button>
    </h2> 
    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
      <div class="accordion-body">
        <form>
          <table class="table-achiev">
            <thead>
              <tr>
                <th>Nama Pingat (medals name)</th>
                <th>Tahun (year)</th>
              </tr>
            </thead>

            <tbody>
            @if(count($medals) == 0)

            <tr class="text-center">
              <td colspan="8"><h5>No records found</h5></td>
            </tr>
                
            @else
                @foreach( $medals as $med )
                    <tr>
                      <td>{{ $med->name }}</td>
                      <td>{{ $med->year }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  {{-- PINGAT ENDS--}}

  {{-- SIJIL PROF--}}
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
      Sijil Profesional
    </button>
    </h2> 
    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
      <div class="accordion-body">
        <form>
          <table class="table-achiev">
            <thead>
              <tr>
                <th>Nama Sijil</th>
                <th>Tahun (year)</th>
                <th>Lampiran (Attachment)</th>
              </tr>
            </thead>

            <tbody>
            @if(count($certificates) == 0)

            <tr class="text-center">
              <td colspan="8"><h5>No records found</h5></td>
            </tr>
                
            @else
                @foreach( $certificates as $cert )
                    <tr>
                      <td>{{ $cert->name }}</td>
                      <td>{{ $cert->year }}</td>
                      
                      @if($cert->file_1 == 0)
                        <td>(empty)</td>
                        @else
                      <td><a href='{{Storage::url("$cert->file_1") }}' target="_blank">View</a></td>
                      @endif

                    </tr>
                @endforeach
            @endif
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  {{-- SIJIL PROF ENDS--}}

  {{-- PEPERIKSAAN PEPERIKSAAN AWAM --}}
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingFive">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
      Peperiksaan Perkhidmatan Awam
    </button>
    </h2> 
    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
      <div class="accordion-body">
          <form>
            <table class="table-achiev">
              <thead>
                <tr>
                  <th>Nama Peperiksaan (Exam Title)</th>
                  <th>Tarikh Lulus (Date)</th>
                  <th>Lampiran (Attachment)</th>
                </tr>
              </thead>

              <tbody>
                @if(count($exams) == 0)

                <tr class="text-center">
                  <td colspan="8"><h5>No records found</h5></td>
                </tr>
                    
                @else
                  @foreach( $exams as $exam )
                      <tr>
                        <td>{{ optional($exam->Exam)->label }}</td>
                        <td>{{ $exam->year }}</td>

                        @if($exam->file_1 == 0)
                        <td>(empty)</td>
                        @else
                        <td><a href='{{Storage::url("$exam->file_1") }}' target="_blank">View</a></td>
                        @endif

                      </tr>
                  @endforeach
                @endif

              </tbody>
            </table>
          </form>
      </div>
    </div>
  </div>
  {{-- PEPERIKSAAN PEPERIKSAAN AWAM ENDS--}}

  {{-- PROGRAM PEMBANGUNAN EKSEKUTIF --}}
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingSix">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
      Program Pembangunan Eksekutif
    </button>
    </h2> 
    <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSix">
      <div class="accordion-body">
          <form>
            <table class="table-achiev">
              <thead>
                <tr>
                  <th>Nama Program</th>
                  <th>Kohort</th>
                  <th>Tarikh Sijil</th>
                  <th>Lampiran (Attachment)</th>
                </tr>
              </thead>

              <tbody>
                @if(count($programmes) == 0)

                <tr class="text-center">
                  <td colspan="8"><h5>No records found</h5></td>
                </tr>
                    
                @else
                  @foreach( $programmes as $prog )
                      <tr>
                        <td>{{ optional($prog->Programme)->label }}</td>
                        <td>{{ $prog->cohort }}</td>
                        <td>{{ $prog->year }}</td>

                        @if($prog->file_1 == 0)
                        <td>(empty)</td>
                        @else
                        <td><a href='{{Storage::url("$prog->file_1") }}' target="_blank">View</a></td>
                        @endif

                      </tr>
                  @endforeach
                @endif

              </tbody>
            </table>
          </form>
      </div>
    </div>
  </div>
  {{-- PROGRAM PEMBANGUNAN EKSEKUTIF ENDS--}}

  {{-- KERTAS KERJA --}}
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
      Kertas Kerja
    </button>
    </h2> 
    <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSeven">
      <div class="accordion-body">
          <form>
            <table class="table-achiev">
              <thead>
                <tr>
                  <th>Tajuk Projek</th>
                  <th>Tarikh Diluluskan</th>
                  <th>Lampiran (Attachment)</th>
                </tr>
              </thead>

              <tbody>
                @if(count($paperworks) == 0)

                <tr class="text-center">
                  <td colspan="8"><h5>No records found</h5></td>
                </tr>
                    
                @else
                  @foreach( $paperworks as $ppwork )
                      <tr>
                        <td>{{ $ppwork->name}}</td>
                        <td>{{ $ppwork->approved_date}}</td>
                        
                        @if($ppwork->file_1 == 0)
                        <td>(empty)</td>
                        @else
                        <td><a href='{{Storage::url("$ppwork->file_1") }}' target="_blank">View</a></td>
                        @endif

                      </tr>
                  @endforeach
                @endif

              </tbody>
            </table>
          </form>
      </div>
    </div>
  </div>
  {{-- KERTAS KERJA ENDS--}}                    

</div><!-- End Achievement Collapse -->
</div><!-- End Achievement Tab -->


<!-- Start Files Tab -->
<div class="tab-pane fade profile-overview pt-3" id="profile-files">

  <h3 class="card-title">Files</h3>


      <div class="row">
        <div class="col-lg-3 col-md-5 label">Muat Naik Kad Pengenalan <br> <i>Upload Identification Card</i></div>
        @foreach($files as $file)
        <div class="col-lg-9 col-md-7"><a href='{{Storage::url("$file->ic_file") }}' target="_blank">{{ $file->ic_filename }}</a></div>
        @endforeach
      </div>

      <div class="row">
        <div class="col-lg-3 col-md-5 label">Muat Naik Lesen Memandu <br> <i>Upload Driving License</i></div>
        @foreach($files as $file)
        <div class="col-lg-9 col-md-7"><a href='{{Storage::url("$file->drivelicense_file") }}' target="_blank">{{ $file->drivelicense_filename }}</a></div>
        @endforeach
      </div>

      <div class="row">
        <div class="col-lg-3 col-md-5 label">Muat Naik Surat Lantikan Jawatan <br> <i>Upload Appointment Letter</i></div>
        @foreach($files as $file)
        <div class="col-lg-9 col-md-7"><a href='{{Storage::url("$file->apptletter_file") }}' target="_blank">{{ $file->apptletter_filename }}</a></div>
        @endforeach
      </div>

      <div class="row">
        <div class="col-lg-3 col-md-5 label">Muat Naik Surat Melapor Diri <br> <i>Upload Work Report Letter</i></div>
        @foreach($files as $file)
        <div class="col-lg-9 col-md-7"><a href='{{Storage::url("$file->workreport_file") }}' target="_blank">{{ $file->workreport_filename }}</a></div>
        @endforeach
      </div>

       <div class="row">
        <div class="col-lg-3 col-md-5 label">Gambar Passport <br> <i>Passport Photo</i></div>
        @foreach($files as $file)
        <div class="col-lg-9 col-md-7"><a href='{{Storage::url("$file->passport_file") }}' target="_blank">{{ $file->passport_filename }}</a></div>
        @endforeach
      </div>


  </div>
<!-- End Files Tab -->
              <!-- End Bordered Tabs -->
            </div>
          </div>

        </div>
      </div>
    </section>


@endsection