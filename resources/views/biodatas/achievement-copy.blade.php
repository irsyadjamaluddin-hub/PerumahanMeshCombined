                <!--Alert message if field is empty-->
                @if ($errors->any())
                  <div class="alert alert-danger">
                  <ul>  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                  </ul>
                  </div>
                @endif

                <!-- Start Achievement Tab -->
                <div class="tab-pane fade profile-overview pt-3" id="profile-achiev">
                  <h3 class="card-title">Achievement Details</h3>

                  {{-- PRESTASI --}}
                  <div class="card">
                    <h5 class="card-header text-lg font-extrabold" >Prestasi</h5>

                      <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                          <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                            <i class="bi bi-plus-lg"></i>
                          </button>
                        </div>

                        <form>
                          <table id="table-achiev">
                            <thead>
                              <tr>
                                <th>Tahun (Year)</th>
                                <th>Markah (Percentage)</th>
                                <th>Gred (Grade)</th>
                                <th>Lampiran (Attachment)</th>
                                <th>Action</th>
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
                                      <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                          <!----Edit Button----->
                                          <form method="get" action="">
                                          @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm" disabled>
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                          </form>
                                          <!----Delete Button----->
                                          <form method="post" action="{{ route('performances.performance.destroy', $perf->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" >
                                            <i class="bi bi-trash-fill"></i>
                                            </button>
                                          </form>
                                        </div>
                                      </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                          </table>
                        </form>
                      </div>
                    </div>

                        <!-- Prestasi Modal -->
                        <div class="modal fade" id="prestasiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="prestasiModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="prestasiModalLabel">Prestasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!--MODAL ADD PRESTASI-->
                              <form method="POST" action="{{ route('performances.performance.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                              @csrf
                                <div class="modal-body">
                                   <div class="row">
                                      <div class="col-lg-4 col-md-5  label">Tahun<i style="color:red;">*</i><br> <i>Year</i></div>
                                      <div class="col-lg-8 col-md-7">
                                      <input id="perf_year" type="month" class="form-control @error('perf_year') is-invalid @enderror" name="perf_year" value="{{ old('perf_year') }}" required autocomplete="perf_year" autofocus>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-4 col-md-5  label">Markah<i style="color:red;">*</i><br> <i>Percentage</i></div>
                                      <div class="col-lg-8 col-md-7">
                                      <input id="perf_markah" type="text" class="form-control @error('perf_markah') is-invalid @enderror" name="perf_markah" value="{{ old('perf_markah') }}" required autocomplete="perf_markah" autofocus>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-4 col-md-5  label">Gred<i style="color:red;">*</i><br> <i>Grade</i></div>
                                      <div class="col-lg-8 col-md-7">
                                        <select name="perf_grade" class="form-control @error('perf_grade') is-invalid @enderror" name="perf_grade" required autocomplete="perf_grade" autofocus>
                                          <option value="">Select Grade</option>
                                          @foreach ($grades as $key => $value)
                                            <option value="{{ $key }}" {{ ( $key == $gradId) ? 'selected' : '' }}> 
                                                {{ $value }} 
                                            </option>
                                          @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-4 col-md-5  label">Muat Turun Dokumen<i style="color:red;">*</i><br>(Saiz maksima fail: 2MB)</div>
                                    <div class="col-lg-8 col-md-7">
                                      <input id="perf_file" type="file" class="form-control @error('perf_file') is-invalid @enderror" name="perf_file" value="{{ old('perf_file') }}" required autocomplete="perf_file" autofocus>
                                    </div>
                                    <div class="col-lg-4 col-md-5  label"><i>Upload Document</i><i>(Max file size: 2MB)</i></div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                  {{-- PRESTASI ends --}}

                  {{-- KURSUS --}}
                  <div class="card">
                      <h5 class="card-header text-lg font-extrabold">Kursus</h5>

                    <div class="card-body">
                      <!-- Button trigger modal -->
                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" data-bs-toggle="modal" data-bs-target="#kursusModal">
                          <i class="bi bi-plus-lg"></i>
                        </button>
                      </div>

                      <form>
                            <table id="table-achiev">
                              <thead>
                                <tr>
                                  <th>Nama Kursus</th>
                                  <th>Tarikh Mula</th>
                                  <th>Tarikh Tamat</th>
                                  <th>Tempat</th>
                                  <th>Tempoh</th>
                                  <th>Lampiran (Attachment)</th>
                                  <th>Action</th>
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

                                        <td>
                                          <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                            <!----Edit Button----->
                                            <form method="get" action="">
                                            @csrf
                                              <button type="submit" class="btn btn-outline-primary btn-sm" disabled>
                                              <i class="bi bi-pencil-fill"></i>
                                              </button>
                                            </form>
                                            <!----Delete Button----->
                                            <form method="post" action="{{ route('courseworks.coursework.destroy', $course->id) }}">
                                              @csrf
                                              @method('delete')
                                              <button type="submit" class="btn btn-outline-danger btn-sm" >
                                              <i class="bi bi-trash-fill"></i>
                                              </button>
                                            </form>
                                          </div>
                                        </td>
                                      </tr>
                                  @endforeach
                                @endif

                              </tbody>
                            </table>
                          </form>
                        </div>
                      </div>

                      <!-- Kursus Modal -->
                      <div class="modal fade" id="kursusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kursusModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="kursusModalLabel">Kursus</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!--MODAL ADD Kursus-->
                            <form method="POST" action="{{ route('courseworks.coursework.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                              @csrf
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Nama Kursus<i style="color:red;">*</i> <br> <i>Course Name</i></div>
                                  <div class="col-lg-8 col-md-7">
                                    <input id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ old('course_name') }}" required autocomplete="course_name" autofocus>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Tarikh Mula<i style="color:red;">*</i><br> <i>Start Date </i></div>
                                  <div class="col-lg-8 col-md-7">
                                    <input id="course_startdate" type="date" class="form-control @error('course_startdate') is-invalid @enderror" name="course_startdate" value="{{ old('course_startdate') }}" required autocomplete="course_startdate" autofocus>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Tarikh Tamat<i style="color:red;">*</i><br> <i>End Date</i></div>
                                  <div class="col-lg-8 col-md-7">
                                    <input id="course_enddate" type="date" class="form-control @error('course_enddate') is-invalid @enderror" name="course_enddate" value="{{ old('course_enddate') }}" required autocomplete="course_enddate" autofocus>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Tempat<i style="color:red;">*</i><br> <i>Venue</i></div>
                                  <div class="col-lg-8 col-md-7">
                                    <input id="course_venue" type="text" class="form-control @error('course_venue') is-invalid @enderror" name="course_venue" value="{{ old('course_venue') }}" required autocomplete="course_venue" autofocus>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Tempoh<i style="color:red;">*</i><br> <i>Duration</i></div>
                                  <div class="col-lg-8 col-md-7">
                                    <input id="course_duration" type="text" class="form-control @error('course_duration') is-invalid @enderror" name="course_duration" value="{{ old('course_duration') }}" required autocomplete="course_duration" autofocus>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Muat Turun Sijil<br> (Saiz maksima fail: 2MB)</div>
                                  <div class="col-lg-8 col-md-7">
                                    <input type="file" class="form-control" name="course_file">
                                  </div>
                                  <div class="col-lg-4 col-md-5  label"><i>Upload Certificate</i> <br> <i>(Max file size: 2MB)</i></div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                  {{-- KURSUS ENDS--}}

                  {{-- PINGAT --}}

                  <div class="card">
                    <h5 class="card-header text-lg font-extrabold">Pingat</h5>

                    <div class="card-body">

                      <!-- Button trigger modal -->
                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" data-bs-toggle="modal" data-bs-target="#pingatModal">
                          <i class="bi bi-plus-lg"></i>
                        </button>
                      </div>

                        <form>
                          <table id="table-achiev">
                            <thead>
                              <tr>
                                <th>Nama Pingat (medal name)</th>
                                <th>Tahun (year)</th>
                                <th>Action</th>
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
                                      <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                          <!----Edit Button----->
                                          <form method="get" action="">
                                          @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm" disabled>
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                          </form>	
                                          <!----Delete Button----->
                                          <form method="post" action="{{ route('medals.medal.destroy', $med->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" >
                                            <i class="bi bi-trash-fill"></i>
                                            </button>
                                          </form>
                                        </div>
                                      </td>
                                    </tr>
                                @endforeach
                                @endif

                            </tbody>
                          </table>
                        </form>
                      </div>
                    </div>

                    <!-- Pingat Modal -->
                    <div class="modal fade" id="pingatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pingatModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="pingatModalLabel">Pingat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <!--MODAL ADD PINGAT-->
                          <form method="POST" action="{{ route('medals.medal.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-4 col-md-5  label">Nama Pingat<i style="color:red;">*</i><br> <i>Medal Name</i></div>
                                <div class="col-lg-8 col-md-7">
                                  <input id="medal_name" type="text" class="form-control @error('medal_name') is-invalid @enderror" name="medal_name" value="{{ old('medal_name') }}" required autocomplete="medal_name" autofocus>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-4 col-md-5  label">Tahun<i style="color:red;">*</i><br> <i>Year</i></div>
                                <div class="col-lg-8 col-md-7">
                                  <input id="medal_year" type="month" class="form-control @error('medal_year') is-invalid @enderror" name="medal_year" value="{{ old('medal_year') }}" required autocomplete="medal_year" autofocus>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  {{-- PINGAT ENDS--}}

                  {{-- SIJIL PROF--}}
                  <div class="card">
                  <h5 class="card-header text-lg font-extrabold">Sijil Profesional</h5>

                  <div class="card-body">
                  <!-- Button trigger modal -->
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" data-bs-toggle="modal" data-bs-target="#sijilprofModal">
                      <i class="bi bi-plus-lg"></i>
                    </button>
                  </div>

                    <form>
                          <table id="table-achiev">
                            <thead>
                              <tr>
                                <th>Nama Sijil</th>
                                <th>Tahun (year)</th>
                                <th>Lampiran (Attachment)</th>
                                <th>Action</th>
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

                                      <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                          <!----Edit Button----->
                                          <form method="get" action="">
                                          @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm" disabled>
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                          </form>	
                                          <!----Delete Button----->
                                          <form method="post" action="{{ route('certificates.certificate.destroy', $cert->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" >
                                            <i class="bi bi-trash-fill"></i>
                                            </button>
                                          </form>
                                        </div>
                                      </td>
                                    </tr>
                                @endforeach
                                @endif

                            </tbody>
                          </table>
                        </form>
                      </div>
                    </div>

                        <!-- Sijil Profesional Modal -->
                        <div class="modal fade" id="sijilprofModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sijilprofModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="sijilprofModalLabel">Sijil Profesional</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!--MODAL ADD SIJIL PROFESIONAL-->
                              <form method="POST" action="{{ route('certificates.certificate.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-lg-4 col-md-5  label">Nama Sijil<i style="color:red;">*</i><br> <i>Certificate Name</i></div>
                                    <div class="col-lg-8 col-md-7">
                                      <input id="cert_name" type="text" class="form-control @error('cert_name') is-invalid @enderror" name="cert_name" value="{{ old('cert_name') }}" required autocomplete="cert_name" autofocus>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-4 col-md-5  label">Tahun<i style="color:red;">*</i><br> <i>Year</i></div>
                                    <div class="col-lg-8 col-md-7">
                                      <input id="cert_year" type="month" class="form-control @error('cert_year') is-invalid @enderror" name="cert_year" value="{{ old('cert_year') }}" required autocomplete="cert_year" autofocus>
                                    </div>
                                  </div>
                                  <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Muat Turun Sijil<br> (Saiz maksima fail: 2MB)</div>
                                    <div class="col-lg-8 col-md-7">
                                      <input type="file" class="form-control" name="cert_file">
                                    </div>
                                    <div class="col-lg-4 col-md-5  label"><i>Upload Certificate</i> <br> <i>(Max file size: 2MB)</i></div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>                        
                  {{-- SIJIL PROF ENDS--}}

                  {{-- PEPERIKSAAN PERKHIDMATAN AWAM --}}
                  <div class="card">
                  <h5 class="card-header text-lg font-extrabold">Peperiksaan Perkhidmatan Awam</h5>

                  <div class="card-body">
                  <!-- Button trigger modal -->
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" data-bs-toggle="modal" data-bs-target="#ppawamModal">
                      <i class="bi bi-plus-lg"></i>
                    </button>
                  </div>

                    <form>
                          <table id="table-achiev">
                            <thead>
                              <tr>
                                <th>Nama Peperiksaan</th>
                                <th>Tarikh Lulus (Date)</th>
                                <th>Lampiran (Attachment)</th>
                                <th>Action</th>
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
 
                                    <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="">
                                        @csrf
                                          <button type="submit" class="btn btn-outline-primary btn-sm" disabled>
                                          <i class="bi bi-pencil-fill"></i>
                                          </button>
                                        </form>	
                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('exams.exam.destroy', $exam->id ) }}">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-outline-danger btn-sm" >
                                          <i class="bi bi-trash-fill"></i>
                                          </button>
                                        </form>
                                      </div>
                                    </td>
                                  </tr>
                              @endforeach
                            @endif

                            </tbody>
                          </table>
                        </form>
                      </div>
                    </div>

                        <!-- Peperiksaan Awam Modal -->
                        <div class="modal fade" id="ppawamModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ppawamModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="ppawamModalLabel">Peperiksaan Perkhidmatan Awam</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!--MODAL ADD Peperiksaan Awam-->
                              <form method="POST" action="{{ route('exams.exam.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                  <div class="row">
                                      <div class="col-lg-4 col-md-5  label">Nama Peperiksaan<i style="color:red;">*</i><br> <i>Exam Name</i></div>
                                      <div class="col-lg-8 col-md-7">
                                        <select name="exam_name" class="form-control @error('exam_name') is-invalid @enderror" name="exam_name" required autocomplete="exam_name" autofocus>
                                          <option value=""></option>
                                          @foreach ($examawam as $key => $value)
                                            <option value="{{ $key }}" {{ ( $key == $examId) ? 'selected' : '' }}> 
                                                {{ $value }} 
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  <div class="row">
                                    <div class="col-lg-4 col-md-5  label">Gred<i style="color:red;">*</i><br> <i>Grade</i></div>
                                    <div class="col-lg-8 col-md-7">
                                      <select name="exam_grade" class="form-control @error('exam_grade') is-invalid @enderror" name="exam_grade" required autocomplete="exam_grade" autofocus>
                                        <option value="">Select Grade</option>
                                        @foreach ($grades as $key => $value)
                                          <option value="{{ $key }}" {{ ( $key == $examgradId) ? 'selected' : '' }}> 
                                              {{ $value }} 
                                          </option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-4 col-md-5  label">Tarikh Lulus<i style="color:red;">*</i><br> <i>Date Passed Examination</i></div>
                                    <div class="col-lg-8 col-md-7">
                                      <input id="exam_year" type="month" class="form-control @error('exam_year') is-invalid @enderror" name="exam_year" value="{{ old('exam_year') }}" required autocomplete="exam_year" autofocus>
                                    </div>
                                  </div>
                                  <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Muat Turun Sijil <br> (Saiz maksima fail: 2MB)</div>
                                    <div class="col-lg-8 col-md-7">
                                      <input type="file" class="form-control" name="exam_file">
                                    </div>
                                  <div class="col-lg-4 col-md-5  label"><i>Upload Certificate</i> <br> <i>(Max file size: 2MB)</i></div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                  {{-- PEPERIKSAAN PEPERIKSAAN AWAM ENDS--}}

                  {{-- PROGRAM PEMBANGUNAN EKSEKUTIF --}}
                  <div class="card">
                    <h5 class="card-header text-lg font-extrabold">Program Pembangunan Eksekutif</h5>

                    <div class="card-body">
                    <!-- Button trigger modal -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" data-bs-toggle="modal" data-bs-target="#programModal">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                    </div>

                    <form>
                          <table id="table-achiev">
                            <thead>
                              <tr>
                                <th>Nama Program</th>
                                <th>Kohort</th>
                                <th>Tarikh Sijil</th>
                                <th>Lampiran (Attachment)</th>
                                <th>Action</th>
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

                                      <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                          <!----Edit Button----->
                                          <form method="get" action="">
                                          @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm" disabled>
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                          </form>  
                                        <!----Delete Button----->
                                          <form method="post" action="{{ route('programmes.programme.destroy', $prog->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" >
                                            <i class="bi bi-trash-fill"></i>
                                            </button>
                                          </form>
                                        </div>
                                      </td>
                                    </tr>
                                @endforeach

                            @endif

                            </tbody>
                          </table>
                        </form>
                      </div>
                    </div>

                        <!-- Program Pembangunan Eksekutif Modal -->
                        <div class="modal fade" id="programModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="programModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="programModalLabel">Program Pembangunan Eksekutif</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <!--MODAL ADD Program Pembangunan Eksekutif-->
                              <form method="POST" action="{{ route('programmes.programme.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                  <div class="row">
                                      <div class="col-lg-4 col-md-5  label">Nama Program<i style="color:red;">*</i><br> <i>Programme Name</i></div>
                                      <div class="col-lg-8 col-md-7">
                                        <select name="program_name" class="form-control @error('program_name') is-invalid @enderror" name="program_name" required autocomplete="program_name" autofocus>
                                          <option value=""></option>
                                          @foreach ($progs as $key => $value)
                                            <option value="{{ $key }}" {{ ( $key == $progId) ? 'selected' : '' }}> 
                                                {{ $value }} 
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  <div class="row">
                                    <div class="col-lg-4 col-md-5  label">Kohort<i style="color:red;">*</i><br> <i>Cohort</i></div>
                                    <div class="col-lg-8 col-md-7">
                                      <input id="program_cohort" type="text" class="form-control @error('program_cohort') is-invalid @enderror" name="program_cohort" value="{{ old('program_cohort') }}" required autocomplete="program_cohort" autofocus>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-4 col-md-5  label">Tarikh Sijil<i style="color:red;">*</i><br> <i>Certificate Date</i></div>
                                    <div class="col-lg-8 col-md-7">
                                      <input id="program_year" type="month" class="form-control @error('program_year') is-invalid @enderror" name="program_year" value="{{ old('program_year') }}" required autocomplete="program_year" autofocus>
                                    </div>
                                  </div>
                                  <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Muat Turun Sijil<br> (Saiz maksima fail: 2MB)</div>
                                    <div class="col-lg-8 col-md-7">
                                      <input type="file" class="form-control" name="program_file">
                                    </div>
                                    <div class="col-lg-4 col-md-5  label"><i>Upload Certificate </i><br> <i>(Max file size: 2MB)</i></div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                  {{-- PROGRAM PEMBANGUNAN EKSEKUTIF ENDS--}}

                  {{-- KERTAS KERJA --}}
                  <div class="card">
                    <h5 class="card-header text-lg font-extrabold">Kertas Kerja</h5>

                    <div class="card-body">
                    <!-- Button trigger modal -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" data-bs-toggle="modal" data-bs-target="#kertaskerjaModal">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                    </div>

                    <form>
                        <table id="table-achiev">
                          <thead>
                            <tr>
                              <th>Tajuk Projek</th>
                              <th>Tarikh Diluluskan</th>
                              <th>Lampiran (Attachment)</th>
                              <th>Action</th>
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

                                    <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                        <!----Edit Button----->
                                        <form method="get" action="">
                                        @csrf
                                          <button type="submit" class="btn btn-outline-primary btn-sm" disabled>
                                          <i class="bi bi-pencil-fill"></i>
                                          </button>
                                        </form>
                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('paperworks.paperwork.destroy', $ppwork->id) }}">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-outline-danger btn-sm" >
                                          <i class="bi bi-trash-fill"></i>
                                          </button>
                                        </form>
                                      </div>
                                    </td>
                                  </tr>
                              @endforeach
                            @endif

                          </tbody>
                        </table>
                      </form>
                    </div>
                  </div>

                      <!-- Kertas Kerja Modal -->
                      <div class="modal fade" id="kertaskerjaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kertaskerjaModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="kertaskerjaModalLabel">Kertas Kerja</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!--MODAL ADD Kertas Kerja-->
                            <form method="POST" action="{{ route('paperworks.paperwork.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                              @csrf
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Tajuk Projek<i style="color:red;">*</i><br> <i>Project Name</i></div>
                                  <div class="col-lg-8 col-md-7">
                                    <input id="paperwork_name" type="text" class="form-control @error('paperwork_name') is-invalid @enderror" name="paperwork_name" value="{{ old('paperwork_name') }}" required autocomplete="paperwork_name" autofocus>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4 col-md-5  label">Tarikh Diluluskan<i style="color:red;">*</i><br> <i>Date Of Approval</i></div>
                                  <div class="col-lg-8 col-md-7">
                                    <input id="paperwork_year" type="date" class="form-control @error('paperwork_year') is-invalid @enderror" name="paperwork_year" value="{{ old('paperwork_year') }}" required autocomplete="paperwork_year" autofocus>
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-4 col-md-5  label">Muat Turun Dokumen <br> (Saiz Maksima Fail: 2MB)</div>
                                  <div class="col-lg-8 col-md-7">
                                    <input type="file" class="form-control" name="paperwork_file">
                                  </div>
                                <div class="col-lg-4 col-md-5  label"><i>Upload Document </i><br> <i>(Max file size: 2MB)</i></div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                  {{-- KERTAS KERJA ENDS--}}                    
                  
                </div><!-- End Achievement Tab -->