
                <div class="tab-pane fade show active profile-overview" id="profile-overview">

          
                 
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Nama Penuh <br> <i>Full Name</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('name_user', $usersname, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Tarikh Lahir <br> <i>Date of Birth</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('dob', null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_dob', 'placeholder' => '', ]) !!}</div>
                  </div>

                <!--   <div class="row">
                    <div class="col-lg-3 col-md-5 label">Umur <br> <i>Age</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('age', null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_dob', 'placeholder' => '', ]) !!}</div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Kad Pengenalan <br> <i>Identity Card No.</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('ic_no', $icNos, ['class' => 'form-control', 'readonly', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Warna Kad Pengenalan <br> <i>Identity Card Color</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('ic_color_id', $iccolors, null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. BruHIMS <br> <i>BruHIMS No.</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('bruhims_no', null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Jantina <br> <i>Gender</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('gender_id', $genders, null,  ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Status Kelamin <br> <i>Martial Status</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('marital_status_id', $maritalstatuss,null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '2', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Bangsa <br> <i> Race </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('race_id', $races, null,['id' => 'races', 'class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-5 label"> <br> <i> </i></div>
                    <div class="col-lg-9 col-md-7"> {!! Form::text('race_other', null,['id' => 'raceOther','class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '50', 'placeholder' => 'Enter races...', ]) !!}</div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Agama <br> <i> Religion </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('religion_id', $religions, null,['id' => 'religions','class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label"> <br> <i> </i></div>
                    <div class="col-lg-9 col-md-7"> {!! Form::text('religion_other', null,['id' => 'religionOther','class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '50', 'placeholder' => 'Enter Religion...', ]) !!}</div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Kerakyatan<br> <i> Citizenship </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('citizenship_id', null,['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Tempat Lahir<br> <i> Place of Birth </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('place_of_birth', null, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Tarikh Bersara<br> <i> Date of Retirement </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('bersara_date',null, ['class' => 'form-control', 'readonly', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => '', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <h5 class="card-title">Vaccination Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Dos Vaksinasi<br> <i> Vaccination Dose </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('vac_dose', $vaccinationdoses,  null, ['class' => 'form-control',  'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Info Vaksinasi (Dose 1 & Dose 2)<br> <i> Vaccination Info (Dose 1 & Dose 2) </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('vac_info', $vaccinationinfos,  null, ['class' => 'form-control',  'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Penggalak Vaksinasi<br> <i> Booster Vaccination Info </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('vac_boost', $vaccinationboosters,  null, ['class' => 'form-control',  'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Kumpulan Terdedah<br> <i> Vulnerable Group </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('vulnerable_id', $vulnerable,  null, ['class' => 'form-control',  'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}</div>
                  </div>

                

                </div>

                <div class="tab-pane fade profile-overview pt-3" id="profile-edit">

                <h5 class="card-title">Contact Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Alamat <br> <i>Address</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('address', $address, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Poskod <br> <i>Postcode</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('postcode', $postcode, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Negara <br> <i>Country</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('country', $countrys, $country, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Telefon Bimbit <br> <i>No. Telephone Mobile</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('telephone_mobile', $telMobile, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Telefon Pejabat <br> <i>No. Telephone Office</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('telephone_office', $telOffice, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20',  'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Telefon Rumah <br> <i>No. Telephone Home </i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('telephone_home', $telHome, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20',  'placeholder' => '', ]) !!}</div>
                  </div>

                <div class="row">
                    <div class="col-lg-3 col-md-5 label">Emel <br> <i>Email</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('email', $usersEmail, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                 <!--  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Emel lain<br> <i>Other Email</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('personal_email', $personalEmail, ['class' => 'form-control',  'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div> -->

                  <h5 class="card-title">Emergency Contact Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Nama <br> <i>Name</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('name_ec', $nameEmergency, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">No. Telefon  <br> <i>No. Telephone</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::text('tel_ec', $telEmergency, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5 label">Hubungan <br> <i>Relationship</i></div>
                    <div class="col-lg-9 col-md-7">{!! Form::select('rs_ec', $relationEmergencys, $relationEmergency, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}</div>
                  </div>

                </div>

                <div class="tab-pane fade  profile-overview pt-3" id="profile-settings">

                <h3 class="card-title">Employment Details</h3>

                    <div class="row">
                      <div class="col-lg-3 col-md-5 label ">Kementerian <br> <i>Ministry</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::text('ministry_id', $ministry->ministry_name, ['readonly' => 'true', 'class' => 'bg-gray-200 form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5 label">Jabatan <br> <i>Department</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::select('department_id', $departments, $department, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5 label">Bahagian <br> <i>Section</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::Text('bahagian_id', $bahagian, ['id' => 'bahagian', 'class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Unit <br> <i>Unit</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::Text('unit_name', $unit, ['id' => 'unit_id', 'class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Maktab/Sekolah <br> <i>College/School</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::select('school_id', $departments, $school, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Kluster <br> <i>Cluster</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::select('cluster_id', $clusters, $cluster, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Peranan <br> <i>Role</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::select('role', $roles, $role, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Status Perkhidmatan <br> <i>Service Status</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::text('status_service', $serviceStatus->service_status_name, ['readonly' => 'true', 'class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5 label">Jenis Perkhidmatan <br> <i>Employment Type</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::select('employment_status_id', $employmentstatuss, $employmentStatus, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Skim Perkhidmatan <br> <i>Service Scheme</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::select('skim_perkhidmatan_id', $skimPerkhidmatans, $skimPerkhidmatan, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Kod Jawatan <br> <i>Position Code</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::text('code_service', null, ['readonly' => 'true', 'class' => 'bg-gray-200 form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">No Fail Peribadi <br> <i>Personnel Fail No</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::text('personnel_file', $personnelFail, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">SSM Personnel No. <br> <i>SSM Personnel No.</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::text('ssm_reference_no', $ssmRefNo, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tanggagaji <br> <i>Salary Scale</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::select('salary_scale', $salaryScales, $salaryScale, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                  <h3 class="card-title">Intial Service Details</h3>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Jawatan Lantikan Awal <br> <i>Intial Designation</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::text('designation_id', $designation, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tempat Bertugas Jawatan Lantikan Awal <br> <i>Intial Designation Placement</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::text('first_service_place', $designationPlace, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tarikh Lantikan Jawatan Awal <br> <i>Intial Designation Date</i></div>
                      <div class="col-lg-9 col-md-7">
                      {!! Form::text('service_begin_date', $serviceDate, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_service', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <h3 class="card-title">Current Service Details</h3>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Jawatan Sekarang <br> <i>Current Designation </i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::text('current_designation_id', $currentDesignation, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tempat Bertugas Jawatan Sekarang <br> <i>Current Designation Placement</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::text('current_service_place', $designationCurrentPlace, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '100', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tarikh Lantikan Jawatan Sekarang <br> <i>Current Designation Date</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::text('current_designation_date', $roleDateStart, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_role_start', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Dearah Tempat Bertugas <br> <i>District of Work</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::select('district_work_id', $districts, $district, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '', 'placeholder' => '', ]) !!}
                      </div>
                    </div>
                

                </div>

                <div class="tab-pane fade profile-overview pt-3" id="profile-change-password">

                  <h3 class="card-title">Education Details</h3>

               

                  <div class="row">
                    <div class="col-lg-3 col-md-5  label">Kelulusan Tertinggi <br> <i>Highest Education</i></div>
                    <div class="col-lg-9 col-md-7">
                        {!! Form::select('education_id', $educations, $eduId, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '', 'placeholder' => '', ]) !!}
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5  label">Bidang Kelulusan <br> <i>Course Name</i></div>
                    <div class="col-lg-9 col-md-7">
                        {!! Form::text('education_name', $eduName, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '', 'id' => '', 'placeholder' => '', ]) !!}
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5  label">Tarikh Sijil <br> <i>Ceritificate date</i></div>
                    <div class="col-lg-9 col-md-7">
                        {!! Form::text('graduation_date', $gradDate, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'id' => 'datepicker_graduate', 'placeholder' => '', ]) !!}
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5  label">Muat Naik Sijil <br> <i>Upload Ceritificate</i></div>
                    <div class="col-lg-9 col-md-7">
                        <input type="file" name="file" accept=".jpg, .jpeg, .png, .pdf"  id="file">

                        <a href='{{Storage::url("$eduFilePath") }}' target="_blank"><p>{{$eduFile}}</p></a>
                    </div>
                  </div>
        

                </div>

                <div class="tab-pane fade profile-overview pt-3" id="profile-salary">

                    <h3 class="card-title">Salary Details</h3>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tanggagaji <br> <i>Salary Scale</i></div>
                      <div class="col-lg-9 col-md-7">
                       
                      {!! Form::text('salaryscale_id', optional($employment->salaryScale)->label, ['readonly' => 'true','class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tarikh Kenaikan <br> <i>Increment Date</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::text('increment_date', $incrementDate2, ['readonly' => 'true', 'class' => 'bg-gray-200 form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Gaji <br> <i>Salary</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::text('salary', $salary, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Tanggagaji <br> <i>Salary Scale</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::select('salary_scale', $salaryScales, $salaryScale, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-5  label">Bahagian <br> <i>Division</i></div>
                      <div class="col-lg-9 col-md-7">
                        {!! Form::select('division_id', $divisions, $division, ['class' => 'form-control', 'spellcheck' => 'false','autocomplete'=>'off', 'maxlength' => '20', 'placeholder' => '', ]) !!}
                      </div>
                    </div>

                  </div>

                  

                 
                    <div class="tab-pane fade profile-overview pt-3" id="profile-files">

                  <h3 class="card-title">Files</h3>

                  <div class="row">
                    <div class="col-lg-3 col-md-5  label">Muat Naik Kad Pengenalan <br> <i>Upload Identification Card</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
                    <div class="col-lg-9 col-md-7">
                        <input type="file" name="ic_file" accept=".jpg, .jpeg, .png, .pdf"  id="ic_file">

                        <a href='{{Storage::url("$icFilePath") }}' target="_blank"><p>{{$icFile}}</p></a>
                    </div>
                  </div>
        
                  <div class="row">
                    <div class="col-lg-3 col-md-5  label">Muat Naik Lesen Memandu <br> <i>Upload Driving License</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
                    <div class="col-lg-9 col-md-7">
                        <input type="file" name="drivelicense_file" accept=".jpg, .jpeg, .png, .pdf"  id="drivelicense_file">

                        <a href='{{Storage::url("$drivelicenseFilePath") }}' target="_blank"><p>{{$drivelicenseFile}}</p></a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5  label">Muat Naik Surat Lantikan Jawatan <br> <i>Upload Appointment Letter</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
                    <div class="col-lg-9 col-md-7">
                        <input type="file" name="apptletter_file" accept=".jpg, .jpeg, .png, .pdf"  id="apptletter_file">

                        <a href='{{Storage::url("$apptletterFilePath") }}' target="_blank"><p>{{$apptletterFile}}</p></a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-5  label">Muat Naik Surat Melapor Diri <br> <i>Upload Work Report Letter</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
                    <div class="col-lg-9 col-md-7">
                        <input type="file" name="workreport_file" accept=".jpg, .jpeg, .png, .pdf"  id="workreport_file">

                        <a href='{{Storage::url("$workreportFilePath") }}' target="_blank"><p>{{$workreportFile}}</p></a>
                    </div>
                  </div>

                    <div class="row">
                    <div class="col-lg-3 col-md-5  label">Gambar Passport <br> <i>Passport Photo</i><br>(Saiz maksima fail: 2MB)<i style="color:red;">*</i></div>
                    <div class="col-lg-9 col-md-7">
                        <input type="file" name="passport_file" accept=".jpg, .jpeg, .png, .pdf"  id="passport_file">

                        <a href='{{Storage::url("$passportFilePath") }}' target="_blank"><p>{{$passportFile}}</p></a>
                    </div>
                  </div>
                </div>
