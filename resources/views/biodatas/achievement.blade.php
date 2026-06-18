
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
                <form method="POST" action="{{ route('achievements.achievement.store', [Auth::user()->ic_no]) }}" class="" enctype="multipart/form-data">
                @csrf
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" id="btn-submit" text-align="right"><i class="ri-save-3-line"></i></button>
                  </div>
                  
                  <h3 class="card-title">Achievement Details</h3>

                  {{-- PRESTASI --}}
                  <div class="card">
                    <h5 class="card-header text-lg font-extrabold" >Prestasi</h5>

                      <div class="card-body overflow-auto">
                        <!-- Add rows button-->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                          <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowPrestasi" href="#">
                            <i class="bi bi-plus-lg"></i>
                          </button>
                        </div>
                        
                          <table class="table-achiev" id="tableprestasi">
                            <thead>
                              <tr>
                                <th>Bil</th>
                                <th>Tahun</th>
                                <th>Markah</th>
                                <th>Gred</th>
                                <th>Lampiran</th>
                                <th>Hapus</th>
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
                                      <td scope="row">{{ $loop->iteration }}</td>
                                      <td>{{ $perf->year }}</td>
                                      <td>{{ $perf->percentage }}</td> 
                                      <td>{{ optional($perf->Grade)->label }}</td>
                                      <td><a href='{{Storage::url("$perf->file_1") }}' target="_blank">View</a></td>
                                      <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                          <!----Edit Button----->
                                          <form method="get" action="">
                                          @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm" disabled hidden>
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                          </form>
                                          <!----Delete Button----->
                                          <form method="post" action="{{ route('performances.performance.destroy', $perf->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete performance year {{ $perf->year }}?')">
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
                    
                      </div>
                  </div>

                  <script>
                  $(function () {

                    // Start counting from the third row
                    // var counter = 3;
                    var counter = 0;

                    $("#insertRowPrestasi").on("click", function (event) {
                      event.preventDefault();

                      var newRow = $("<tr>");
                      var cols = '';

                      // Table columns
                      // cols += '<th scrope="row">' + counter + '</th>';
                      cols += '<td></td>';
                      cols += '<td><input id="perf_year" type="month" class="form-control @error('perf_year') is-invalid @enderror" name="perf_year[]" value="{{ old('perf_year') }}" required autocomplete="perf_year" autofocus></td>';
                      cols += '<td><input id="perf_markah" type="text" class="form-control @error('perf_markah') is-invalid @enderror" name="perf_markah[]" value="{{ old('perf_markah') }}" required autocomplete="perf_markah" placeholder="Markah (Percentage)" autofocus></td>';
                      cols += '<td><select class="form-control @error('perf_grade') is-invalid @enderror" name="perf_grade[]" required autocomplete="perf_grade" autofocus><option value="">Select Grade</option>@foreach ($grades as $key => $value)<option value="{{ $key }}" {{ ( $key == $gradId) ? 'selected' : '' }}>{{ $value }}</option>@endforeach</select></td>';
                      cols += '<td><input id="perf_file" type="file" class="form-control @error('perf_file') is-invalid @enderror" name="perf_file[]" value="{{ old('perf_file') }}" required autocomplete="perf_file" autofocus></td>';
                      cols += '<td><button class="btn btn-outline-danger btn-sm" id ="deleteRow"><i class="bi bi-trash-fill"></i></button></td>';
                      
                      // Insert the columns inside a row
                      newRow.append(cols);

                      // Insert the row inside a table
                      $("#tableprestasi").append(newRow);
                        // Increase counter after each row insertion
                        counter++;
                      });

                      // Remove row when delete btn is clicked
                      $("#tableprestasi").on("click", "#deleteRow", function (event) {
                          $(this).closest("tr").remove();
                          counter -= 1
                      });
                    });
                    </script>
              
                  {{-- PRESTASI ends --}}

                  {{-- KURSUS --}}
                  <div class="card">
                      <h5 class="card-header text-lg font-extrabold">Kursus</h5>

                    <div class="card-body">
                      <!-- Add rows button-->
                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowKursus" href="#">
                          <i class="bi bi-plus-lg"></i>
                        </button>
                      </div>

                        <table class="table-achiev" id="tablekursus">
                          <thead>
                            <tr>
                              <th>Bil</th>
                              <th>Nama Kursus</th>
                              <th>Tarikh Mula</th>
                              <th>Tarikh Tamat</th>
                              <th>Tempat</th>
                              <th>Tempoh</th>
                              <th>Lampiran</th>
                              <th>Hapus</th>
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
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->start_date }}</td>
                                    <td>{{ $course->end_date }}</td>
                                    <td>{{ $course->venue }}</td>
                                    <td>{{ $course->duration }}</td>

                                    @if($course->file_1 == 0)
                                    <td>
                                      <!-- Button trigger modal -->
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                          <button type="button" class="open-kursusModal btn btn-outline-primary btn-sm" data-id="{{ $course->id }}" data-bs-toggle="modal" data-bs-target="#kursusModal">
                                            <i class="bi bi-upload"></i>
                                          </button>
                                        </div>
                                      </div>

                                      <!-- Kursus Modal -->
                                      <div class="modal hide" id="kursusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kursusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="kursusModalLabel">Kursus : Upload File</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!--MODAL ADD Kursus-->
                                            <form method="POST" action="{{ route('courseworks.coursework.update' , [Auth::user()->ic_no])}}" class="" enctype="multipart/form-data">
                                                @csrf
                                                
                                                <div class="modal-body">
                                                    <input type="text" name="kursusId" id="kursusId" hidden/>
                                                    <small class="text-danger"><b>(Max file size: 2MB)</b></small>
                                                    <input type="file" class="form-control" name="course_file">
                                              
                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                      <script>
                                        $(document).on("click", ".open-kursusModal", function () {
                                            var myBookId = $(this).data('id');
                                            $(".modal-body #kursusId").val( myBookId );
                                            $('#kursusModal').modal('show');
                                        });
                                      </script>
                                    </td>
                                    @else
                                    <td><a href='{{Storage::url("$course->file_1") }}' target="_blank">View</a></td>
                                    @endif

                                    <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                        <!----Edit Button----->
                                        <form method="get" action="">
                                        @csrf
                                          <button type="submit" class="btn btn-outline-primary btn-sm" disabled hidden>
                                          <i class="bi bi-pencil-fill"></i>
                                          </button>
                                        </form>
                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('courseworks.coursework.destroy', $course->id) }}">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete {{ $course->name }}?')">
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
                    </div>
                  </div>

                  <script>
                  $(function () {

                    // Start counting from the third row
                    // var counter = 3;
                    var counter = 0;

                    $("#insertRowKursus").on("click", function (event) {
                      event.preventDefault();

                      var newRow = $("<tr>");
                      var cols = '';

                      // Table columns
                      // cols += '<th scrope="row">' + counter + '</th>';
                      cols += '<td></td>';
                      cols += '<td><input id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name[]" value="{{ old('course_name') }}" required autocomplete="course_name"  placeholder="Nama Kursus (Course Name)" autofocus></td>';
                      cols += '<td><input id="course_startdate" type="date" class="form-control @error('course_startdate') is-invalid @enderror" name="course_startdate[]" value="{{ old('course_startdate') }}" required autocomplete="course_startdate" autofocus></td>';
                      cols += '<td><input id="course_enddate" type="date" class="form-control @error('course_enddate') is-invalid @enderror" name="course_enddate[]" value="{{ old('course_enddate') }}" required autocomplete="course_enddate" autofocus></td>';
                      cols += '<td><input id="course_venue" type="text" class="form-control @error('course_venue') is-invalid @enderror" name="course_venue[]" value="{{ old('course_venue') }}" required autocomplete="course_venue"  placeholder="Tempat (Venue)" autofocus></td>';
                      cols += '<td><input id="course_duration" type="text" class="form-control @error('course_duration') is-invalid @enderror" name="course_duration[]" value="{{ old('course_duration') }}" required autocomplete="course_duration"  placeholder="Tempoh (Duration)" autofocus></td>';
                      cols += '<td></td>';
                      cols += '<td><button class="btn btn-outline-danger btn-sm" id ="deleteRow"><i class="bi bi-trash-fill"></i></button></td>';
                      
                      // Insert the columns inside a row
                      newRow.append(cols);

                      // Insert the row inside a table
                      $("#tablekursus").append(newRow);
                        // Increase counter after each row insertion
                        counter++;
                      });

                      // Remove row when delete btn is clicked
                      $("#tablekursus").on("click", "#deleteRow", function (event) {
                          $(this).closest("tr").remove();
                          counter -= 1
                      });
                    });
                    </script>
                
                  {{-- KURSUS ENDS--}}

                  {{-- PINGAT --}}

                  <div class="card">
                    <h5 class="card-header text-lg font-extrabold">Pingat</h5>

                    <div class="card-body">

                      <!-- Button trigger modal -->
                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowPingat" href="#">
                          <i class="bi bi-plus-lg"></i>
                        </button>
                      </div>

                        
                          <table class="table-achiev" id="tablepingat">
                            <thead>
                              <tr>
                                <th>Bil</th>
                                <th>Nama Pingat</th>
                                <th>Tahun</th>
                                <th>Hapus</th>
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
                                      <td scope="row">{{ $loop->iteration }}</td>
                                      <td>{{ $med->name }}</td>
                                      <td>{{ $med->year }}</td>
                                      <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                          <!----Edit Button----->
                                          <form method="get" action="">
                                          @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm" disabled hidden>
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                          </form>	
                                          <!----Delete Button----->
                                          <form method="post" action="{{ route('medals.medal.destroy', $med->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete {{ $med->name }}?')">
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
                        
                      </div>
                    </div>

                    <script>
                      $(function () {

                        // Start counting from the third row
                        // var counter = 3;
                        var counter = 0;

                        $("#insertRowPingat").on("click", function (event) {
                          event.preventDefault();

                          var newRow = $("<tr>");
                          var cols = '';

                          // Table columns
                          // cols += '<th scrope="row">' + counter + '</th>';
                          cols += '<td></td>';
                          cols += '<td><input id="medal_name" type="text" class="form-control @error('medal_name') is-invalid @enderror" name="medal_name[]" value="{{ old('medal_name') }}" required autocomplete="medal_name"  placeholder="Nama Pingat (Medal Name)" autofocus></td>';
                          cols += '<td><input id="medal_year" type="month" class="form-control @error('medal_year') is-invalid @enderror" name="medal_year[]" value="{{ old('medal_year') }}" required autocomplete="medal_year" autofocus></td>';
                          cols += '<td><button class="btn btn-outline-danger btn-sm" id ="deleteRow"><i class="bi bi-trash-fill"></i></button></td>';
                          
                          // Insert the columns inside a row
                          newRow.append(cols);

                          // Insert the row inside a table
                          $("#tablepingat").append(newRow);
                            // Increase counter after each row insertion
                            counter++;
                          });

                          // Remove row when delete btn is clicked
                          $("#tablepingat").on("click", "#deleteRow", function (event) {
                              $(this).closest("tr").remove();
                              counter -= 1
                          });
                        });
                    </script>
                  {{-- PINGAT ENDS--}}

                  {{-- SIJIL PROF--}}
                  <div class="card">
                  <h5 class="card-header text-lg font-extrabold">Sijil Profesional</h5>

                  <div class="card-body">
                  <!-- Button trigger modal -->
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowSijil" href="#">
                      <i class="bi bi-plus-lg"></i>
                    </button>
                  </div>

                          <table class="table-achiev" id="tablesijil">
                            <thead>
                              <tr>
                                <th>Bil</td>
                                <th>Nama Sijil</th>
                                <th>Tahun</th>
                                <th>Lampiran</th>
                                <th>Hapus</th>
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
                                      <td scope="row">{{ $loop->iteration }}</td>
                                      <td>{{ $cert->name }}</td>
                                      <td>{{ $cert->year }}</td>

                                      @if($cert->file_1 == 0)
                                      <td>
                                        <!-- Button trigger modal -->
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="open-sijilModal btn btn-outline-primary btn-sm" data-id="{{ $cert->id }}" data-bs-toggle="modal" data-bs-target="#sijilModal">
                                              <i class="bi bi-upload"></i>
                                            </button>
                                          </div>
                                        </div>

                                        <!-- Sijil Modal -->
                                        <div class="modal hide" id="sijilModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sijilModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="sijilModalLabel">Sijil Profesional : Upload File</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <!--MODAL ADD Sijil-->
                                              <form method="POST" action="{{route('certificates.certificate.update' , [Auth::user()->ic_no])}}" class="" enctype="multipart/form-data">
                                                  @csrf
                                                  
                                                  <div class="modal-body">
                                                      <input type="text" name="sijilId" id="sijilId" hidden/>
                                                      <small class="text-danger"><b>(Max file size: 2MB)</b></small>
                                                      <input type="file" class="form-control" name="cert_file">
                                                  </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                        <script>
                                          $(document).on("click", ".open-sijilModal", function () {
                                              var mySijilId = $(this).data('id');
                                              $(".modal-body #sijilId").val( mySijilId );
                                              $('#sijilModal').modal('show');
                                          });
                                        </script>
                                      </td>
                                      @else
                                      <td><a href='{{Storage::url("$cert->file_1") }}' target="_blank">View</a></td>
                                      @endif

                                      <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                          <!----Edit Button----->
                                          <form method="get" action="">
                                          @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm" hidden disabled>
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                          </form>	
                                          <!----Delete Button----->
                                          <form method="post" action="{{ route('certificates.certificate.destroy', $cert->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete {{ $cert->name }}?')">
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
                      </div>
                    </div>

                    <script>
                      $(function () {

                        // Start counting from the third row
                        // var counter = 3;
                        var counter = 0;

                        $("#insertRowSijil").on("click", function (event) {
                          event.preventDefault();

                          var newRow = $("<tr>");
                          var cols = '';

                          // Table columns
                          // cols += '<th scrope="row">' + counter + '</th>';
                          cols += '<td></td>';
                          cols += '<td><input id="cert_name" type="text" class="form-control @error('cert_name') is-invalid @enderror" name="cert_name[]" value="{{ old('cert_name') }}" required autocomplete="cert_name"  placeholder="Nama Sijil (Certificate Name)" autofocus></td>';
                          cols += '<td><input id="cert_year" type="month" class="form-control @error('cert_year') is-invalid @enderror" name="cert_year[]" value="{{ old('cert_year') }}" required autocomplete="cert_year"  placeholder="Tahun (Year)" autofocus></td>';
                          cols += '<td></td>';
                          cols += '<td><button class="btn btn-outline-danger btn-sm" id ="deleteRow"><i class="bi bi-trash-fill"></i></button></td>';
                          
                          // Insert the columns inside a row
                          newRow.append(cols);

                          // Insert the row inside a table
                          $("#tablesijil").append(newRow);
                            // Increase counter after each row insertion
                            counter++;
                          });

                          // Remove row when delete btn is clicked
                          $("#tablesijil").on("click", "#deleteRow", function (event) {
                              $(this).closest("tr").remove();
                              counter -= 1
                          });
                        });
                    </script>
                     
                  {{-- SIJIL PROF ENDS--}}

                  {{-- PEPERIKSAAN PERKHIDMATAN AWAM --}}
                  <div class="card">
                  <h5 class="card-header text-lg font-extrabold">Peperiksaan Perkhidmatan Awam</h5>

                  <div class="card-body">
                  <!-- Button trigger modal -->
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowPeperiksaan" href="#">
                      <i class="bi bi-plus-lg"></i>
                    </button>
                  </div>
                          <table class="table-achiev" id="tablepeperiksaan">
                            <thead>
                              <tr>
                                <th>Bil</th>
                                <th>Nama Peperiksaan</th>
                                <th>Gred</th>
                                <th>Tarikh Lulus</th>
                                <th>Lampiran</th>
                                <th>Hapus</th>
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
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ optional($exam->Exam)->label }}</td>
                                    <td>{{ optional($exam->Grade)->label }}</td>
                                    <td>{{ $exam->year }}</td>

                                    @if($exam->file_1 == 0)
                                    <td>
                                      <!-- Button trigger modal -->
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                          <button type="button" class="open-peperiksaanModal btn btn-outline-primary btn-sm" data-id="{{ $exam->id }}" data-bs-toggle="modal" data-bs-target="#peperiksaanModal">
                                            <i class="bi bi-upload"></i>
                                          </button>
                                        </div>
                                      </div>

                                      <!-- Peperiksaan Modal -->
                                      <div class="modal hide" id="peperiksaanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="peperiksaanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="peperiksaanModalLabel">Peperiksaan Perkhidmatan Awam : Upload File</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!--MODAL ADD Peperiksaan-->
                                            <form method="POST" action="{{ route('exams.exam.update' , [Auth::user()->ic_no])}}" class="" enctype="multipart/form-data">
                                                @csrf
                                                
                                                <div class="modal-body">
                                                    <input type="text" name="peperiksaanId" id="peperiksaanId" hidden/>
                                                    <small class="text-danger"><b>(Max file size: 2MB)</b></small>
                                                    <input type="file" class="form-control" name="exam_file">
                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                      <script>
                                        $(document).on("click", ".open-peperiksaanModal", function () {
                                            var myPeperiksaanId = $(this).data('id');
                                            $(".modal-body #peperiksaanId").val( myPeperiksaanId );
                                            $('#peperiksaanModal').modal('show');
                                        });
                                      </script>
                                    </td>
                                    @else
                                    <td><a href='{{Storage::url("$exam->file_1") }}' target="_blank">View</a></td>
                                    @endif
 
                                    <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="">
                                        @csrf
                                          <button type="submit" class="btn btn-outline-primary btn-sm" hidden disabled>
                                          <i class="bi bi-pencil-fill"></i>
                                          </button>
                                        </form>	
                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('exams.exam.destroy', $exam->id ) }}">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete {{ optional($exam->Exam)->label }} {{ $exam->year }}?')">
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
                      </div>
                    </div>

                    <script>
                      $(function () {

                        // Start counting from the third row
                        // var counter = 3;
                        var counter = 0;

                        $("#insertRowPeperiksaan").on("click", function (event) {
                          event.preventDefault();

                          var newRow = $("<tr>");
                          var cols = '';

                          // Table columns
                          // cols += '<th scrope="row">' + counter + '</th>';
                          cols += '<td></td>';
                          cols += '<td><select id="exam_name" class="form-control @error('exam_name') is-invalid @enderror" name="exam_name[]" required autocomplete="exam_name" autofocus><option value="">Select Exam</option>@foreach ($examawam as $key => $value)<option value="{{ $key }}" {{ ( $key == $examId) ? 'selected' : '' }}>{{ $value }}</option>@endforeach</select></td>';
                          cols += '<td><select id="exam_grade" class="form-control @error('exam_grade') is-invalid @enderror" name="exam_grade[]" required autocomplete="exam_grade" autofocus><option value="">Select Grade</option>@foreach ($grades as $key => $value)<option value="{{ $key }}" {{ ( $key == $examgradId) ? 'selected' : '' }}>{{ $value }}</option>@endforeach</select></td>';
                          cols += '<td><input id="exam_year" type="number" min="1980" minlength="4" maxlength="4" placeholder="Year (Tahun)" class="form-control @error('exam_year') is-invalid @enderror" name="exam_year[]" value="{{ old('exam_year') }}" required autocomplete="exam_year" autofocus></td>';
                          cols += '<td></td>';
                          cols += '<td><button class="btn btn-outline-danger btn-sm" id ="deleteRow"><i class="bi bi-trash-fill"></i></button></td>';
                          
                          // Insert the columns inside a row
                          newRow.append(cols);

                          // Insert the row inside a table
                          $("#tablepeperiksaan").append(newRow);
                            // Increase counter after each row insertion
                            counter++;
                          });

                          // Remove row when delete btn is clicked
                          $("#tablepeperiksaan").on("click", "#deleteRow", function (event) {
                              $(this).closest("tr").remove();
                              counter -= 1
                          });
                        });
                    </script>
                  {{-- PEPERIKSAAN PEPERIKSAAN AWAM ENDS--}}

                  {{-- PROGRAM PEMBANGUNAN EKSEKUTIF --}}
                  <div class="card">
                    <h5 class="card-header text-lg font-extrabold">Program Pembangunan Eksekutif</h5>

                    <div class="card-body">
                    <!-- Button trigger modal -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowProgram" href="#">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                    </div>

                          <table class="table-achiev" id="tableprogram">
                            <thead>
                              <tr>
                                <th>Bil</th>
                                <th>Nama Program</th>
                                <th>Kohort</th>
                                <th>Tarikh Sijil</th>
                                <th>Lampiran</th>
                                <th>Hapus</th>
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
                                      <td scope="row">{{ $loop->iteration }}</td>
                                      <td>{{ optional($prog->Programme)->label }}</td>
                                      <td>{{ $prog->cohort }}</td>
                                      <td>{{ $prog->year }}</td>
 
                                      @if($prog->file_1 == 0)
                                      <td>
                                          <!-- Button trigger modal -->
                                          <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                              <button type="button" class="open-programModal btn btn-outline-primary btn-sm" data-id="{{ $prog->id }}" data-bs-toggle="modal" data-bs-target="#programModal">
                                              <i class="bi bi-upload"></i>
                                              </button>
                                            </div>
                                          </div>

                                          <!-- Program Modal -->
                                          <div class="modal hide" id="programModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="programModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="programModalLabel">Program Pembangunan Eksekutif : Upload File</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <!--MODAL ADD Program-->
                                                <form method="POST" action="{{ route('programmes.programme.update' , [Auth::user()->ic_no])}}" class="" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                    <div class="modal-body">
                                                        <input type="text" name="programId" id="programId" hidden/>
                                                        <small class="text-danger"><b>(Max file size: 2MB)</b></small>
                                                        <input type="file" class="form-control" name="program_file">
                                                    </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
                                        <script>
                                          $(document).on("click", ".open-programModal", function () {
                                              var myProgramId = $(this).data('id');
                                              $(".modal-body #programId").val( myProgramId );
                                              $('#programModal').modal('show');
                                          });
                                        </script>
                                      </td>
                                      @else
                                      <td><a href='{{Storage::url("$prog->file_1") }}' target="_blank">View</a></td>
                                      @endif

                                      <td>
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                          <!----Edit Button----->
                                          <form method="get" action="">
                                          @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm" hidden disabled>
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                          </form>  
                                        <!----Delete Button----->
                                          <form method="post" action="{{ route('programmes.programme.destroy', $prog->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete {{ optional($prog->Programme)->label }} {{ $prog->year }}?')">
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
                     
                      </div>
                    </div>

                    <script>
                      $(function () {

                        // Start counting from the third row
                        // var counter = 3;
                        var counter = 0;

                        $("#insertRowProgram").on("click", function (event) {
                          event.preventDefault();

                          var newRow = $("<tr>");
                          var cols = '';

                          // Table columns
                          // cols += '<th scrope="row">' + counter + '</th>';
                          cols += '<td></td>';
                          cols += '<td><select id="program_name" class="form-control @error('program_name') is-invalid @enderror" name="program_name[]" required autocomplete="program_name" autofocus><option value="">Select Program</option>@foreach ($progs as $key => $value)<option value="{{ $key }}" {{ ( $key == $progId) ? 'selected' : '' }}>{{ $value }}</option>@endforeach</select></td>';
                          cols += '<td><input id="program_cohort" type="text" placeholder="Kohort (Cohort)" class="form-control @error('program_cohort') is-invalid @enderror" name="program_cohort[]" value="{{ old('program_cohort') }}" required autocomplete="program_cohort" autofocus></td>';
                          cols += '<td><input id="program_year" type="date" class="form-control @error('program_year') is-invalid @enderror" name="program_year[]" value="{{ old('program_year') }}" required autocomplete="program_year" autofocus></td>';
                          cols += '<td></td>';
                          cols += '<td><button class="btn btn-outline-danger btn-sm" id ="deleteRow"><i class="bi bi-trash-fill"></i></button></td>';
                          
                          // Insert the columns inside a row
                          newRow.append(cols);

                          // Insert the row inside a table
                          $("#tableprogram").append(newRow);
                            // Increase counter after each row insertion
                            counter++;
                          });

                          // Remove row when delete btn is clicked
                          $("#tableprogram").on("click", "#deleteRow", function (event) {
                              $(this).closest("tr").remove();
                              counter -= 1
                          });
                        });
                    </script>

                  {{-- PROGRAM PEMBANGUNAN EKSEKUTIF ENDS--}}

                  {{-- KERTAS KERJA --}}
                  <div class="card">
                    <h5 class="card-header text-lg font-extrabold">Kertas Kerja</h5>

                    <div class="card-body">
                    <!-- Button trigger modal -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="insertRowKertaskerja" href="#">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                    </div>

                        <table class="table-achiev" id="tablekertaskerja">
                          <thead>
                            <tr>
                              <th>Bil</th>
                              <th>Tajuk Projek</th>
                              <th>Tarikh Diluluskan</th>
                              <th>Lampiran</th>
                              <th>Hapus</th>
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
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $ppwork->name}}</td>
                                    <td>{{ $ppwork->approved_date}}</td>

                                    @if($ppwork->file_1 == 0)
                                    <td>
                                      <!-- Button trigger modal -->
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                          <button type="button" class="open-kertaskerjaModal btn btn-outline-primary btn-sm" data-id="{{ $ppwork->id }}" data-bs-toggle="modal" data-bs-target="#kertaskerjaModal">
                                            <i class="bi bi-upload"></i>
                                          </button>
                                        </div>
                                      </div>

                                      <!-- Kertas Kerja Modal -->
                                      <div class="modal hide" id="kertaskerjaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kertaskerjaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="kertaskerjaModalLabel">Kertas Kerja : Upload File</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!--MODAL ADD Kertas Kerja-->
                                            <form method="POST" action="{{ route('paperworks.paperwork.update' , [Auth::user()->ic_no])}}" class="" enctype="multipart/form-data">
                                                @csrf
                                                
                                                <div class="modal-body">
                                                    <input type="text" name="kertaskerjaId" id="kertaskerjaId" value="" hidden/>
                                                    <small class="text-danger"><b>(Max file size: 2MB)</b></small>
                                                    <input type="file" class="form-control" name="paperwork_file">
                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                      <script>
                                        $(document).on("click", ".open-kertaskerjaModal", function () {
                                            var myKertaskerjaId = $(this).data('id');
                                            $(".modal-body #kertaskerjaId").val( myKertaskerjaId );
                                            $('#kertaskerjaModal').modal('show');
                                        });
                                      </script>
                                    </td>
                                     @else
                                     <td><a href='{{Storage::url("$ppwork->file_1") }}' target="_blank">View</a></td>
                                     @endif

                                    <td>
                                      <div class="btn-group gap-2" role="group" aria-label="Basic example">	
                                        <!----Edit Button----->
                                        <form method="get" action="">
                                        @csrf
                                          <button type="submit" class="btn btn-outline-primary btn-sm" hidden disabled>
                                          <i class="bi bi-pencil-fill"></i>
                                          </button>
                                        </form>
                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('paperworks.paperwork.destroy', $ppwork->id) }}">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete {{ $ppwork->name}}?')">
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
                      
                    </div>
                  </div>

                  <script>
                      $(function () {

                        // Start counting from the third row
                        // var counter = 3;
                        var counter = 0;

                        $("#insertRowKertaskerja").on("click", function (event) {
                          event.preventDefault();

                          var newRow = $("<tr>");
                          var cols = '';

                          // Table columns
                          // cols += '<th scrope="row">' + counter + '</th>';
                          cols += '<td></td>';
                          cols += '<td><input id="paperwork_name" type="text" placeholder="Tajuk Projek (Project Title)" class="form-control @error('paperwork_name') is-invalid @enderror" name="paperwork_name[]" value="{{ old('paperwork_name') }}" required autocomplete="paperwork_name" autofocus></td>';
                          cols += '<td><input id="paperwork_year" type="date" class="form-control @error('paperwork_year') is-invalid @enderror" name="paperwork_year[]" value="{{ old('paperwork_year') }}" required autocomplete="paperwork_year" autofocus></td>';
                          cols += '<td></td>';
                          cols += '<td><button class="btn btn-outline-danger btn-sm" id ="deleteRow"><i class="bi bi-trash-fill"></i></button></td>';
                          
                          // Insert the columns inside a row
                          newRow.append(cols);

                          // Insert the row inside a table
                          $("#tablekertaskerja").append(newRow);
                            // Increase counter after each row insertion
                            counter++;
                          });

                          // Remove row when delete btn is clicked
                          $("#tablekertaskerja").on("click", "#deleteRow", function (event) {
                              $(this).closest("tr").remove();
                              counter -= 1
                          });
                        });
                    </script>
                </form>  
                  {{-- KERTAS KERJA ENDS--}}                    
                 
              </div><!-- End Achievement Tab -->