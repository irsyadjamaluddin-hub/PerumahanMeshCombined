@extends('layouts.app-all')

@section('title', 'Edit Tindakan MEC')

@section('content')

<?php
$pagename = "MEc";
?>

<section class="section profile">

  <a href="{{ route('dispatchs.dis.indextindakan') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  <div class="col-12">
    <div class="card pt-3">

      <div class="card-body">

        <div class="col profile-overview ">

          <form class="" method="post" action="{{ route('dispatchs.dis.updatetindakan') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="background: #e9ecef; border: 2px solid #012970; padding: 20px; border-radius: 25px;">

              <h3 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Rujukan (Admin)</h3>
              
              <br>

              @foreach ($dispatchs as $dispatch)

              <!-- TAB 1: Rujukan (ADMIN) -->

              <div class="row">
                <div class="col-lg-4 label">Tarikh Menerima</div>
                @if ($dispatch->dispatch_recieved_at==null)
                <div class="col-lg-8"></div>
                @else
                <div class="col-lg-8">{{date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
                @endif
              </div>

              <div class="row">
                <div class="col-lg-4 label">Tarikh Memproses</div>
                @if ($dispatch ->date_process==null)
                <div class="col-lg-8"></div>
                @else
                <div class="col-lg-8">{{date('d/m/Y', strtotime( $dispatch->date_process))}}</div>
                @endif
              </div>


            
              <div class="row">
                  <div class="col-lg-4 label">Dokumen</div>
                  <div class="col-lg-8">
                      <!-- Display Current Files -->
                      @if(!empty($dispatch->lamp))
                          @php
                              $filePaths = explode(',', $dispatch->lamp); // Split the string into an array
                              $filePaths = array_map('trim', $filePaths); // Remove leading/trailing spaces from each path
                              $filePaths = array_map(function ($path) {
                                  return trim($path, '" ]'); // Remove leading/trailing double quotation marks and trailing square brackets
                              }, $filePaths);
                          @endphp
                          @foreach($filePaths as $filename)
                              <div class="row">
                                  <a href="{{ Storage::url($filename) }}" target="_blank">
                                      <p>{{ basename($filename) }}</p>
                                  </a>
                              </div>
                          @endforeach
                      @else
                          <p>No files</p>
                      @endif
                  </div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">No. Rujukan</div>
                <div class="col-lg-8">{{ $dispatch->no_folio}}</div>
              </div>

              <div class="row">
                <div class="col-lg-4 label">Catatan</div>
                <div class="col-lg-8">{{ $dispatch->catatan_admin}}</div>
              </div>


            <?php $selectedValues1 = json_decode($dispatch->tindakan);?>

              <div class="row">
              <div class="col-lg-4 label">Tindakan</div>
              <div class="col-lg-8">
                
              <select class=" form-control select2"  id="myselect" data-select2-id="myselect" multiple="multiple" tabindex="-1" aria-hidden="true" disabled>
                <option value="{{optional($dispatch->Tindakan)->kod}}">{{optional($dispatch->Tindakan)->kod}}</option>
                    @foreach ($tindakan as $key => $value)
                      <option value="{{ $key }}" {{ is_array($selectedValues1) && in_array($key, $selectedValues1) ? 'selected' : '' }}>
                      {{ $value }}
                      </option>
                    @endforeach
              </select>


              </div>
            </div>

              <!-- END TAB 1: RUJUKAN(ADMIN) -->


           </div>

            
            <br>

          @foreach($dispatchpassmecs as $dispatchpassmec)
            
            <!-- Start Tindakan -->
            
        <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

              <h3 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;"> Tindakan (Rujukan)</h3>
              <hr>
          
               <br>

               <!-- TAB 2: TINDAKAN(RUJUKAN) -->

          
              <!-- Default Accordion -->
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Tindakan
                    </button>
                  </h2>

                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

     
                      <div class="row">
                   
           
                              <div class="col-lg-4 label">Daripada</div>
                                    <!-- Created by -->
                                    @foreach ($dispatchpassmecskods as $dispatchpassmecskod)
                                    <div class="col-lg-8">{{$dispatchpassmecskod->kod}}</div>
                            
                                    @endforeach
                                </div>


                                @if ($dispatchpassmec->tindakan_action_pass != null)
                                <div class="row">
                                    <div class="col-lg-4 label">Tindakan</div>
                                    <div class="col-lg-8"> 
                                    @php $tindakan_action_passs=$dispatchpassmec->tindakan_action_pass ? json_decode($dispatchpassmec->tindakan_action_pass, true) : []; @endphp
                                    @foreach($tindakan_action_passs as $tindakan_pass)
                                  
                                    {{($tindakan_pass)}}
                                    
                                    @endforeach
                                  </div>
                                </div>

                                @else

                                <div> </div>
                                @endif


                                <div class="row">
                                    <div class="col-lg-4 label">Ulasan</div>
                                    <div class="col-lg-8">{{($dispatchpassmec->ulasan_pass)}}</div>
                                </div>
                          
                                 <!-- <div class="row"> -->
                                @foreach($dispatchpassmecstindakanpasss as $dispatchpassmecstindakanpass)
                                  <!-- Tindakan_pass -->
                                    <!-- <div class="col-lg-4 label">Tindakan Diperlukan</div> -->
                                    <!-- <div class="col-lg-8">{{$dispatchpassmecstindakanpass->kod}}</div> -->
                                @endforeach
                                <!-- </div> -->

                                <!-- Start  -->

                                <?php $selectedValues = json_decode($dispatchpassmecstindakanpass->tindakan_pass);?>

                                      <div class="row">
                                        <div class="col-lg-4 label">Tindakan Diperlukan</div>
                                        <div class="col-lg-8">
                                          
                                        <select class=" form-control select2"  id="myselect" data-select2-id="myselect" multiple="multiple" tabindex="-1" aria-hidden="true" disabled>
                                              @foreach ($tindakan as $key => $value)
                                                <option value="{{ $key }}" {{ is_array($selectedValues) && in_array($key, $selectedValues) ? 'selected' : '' }}>
                                                {{ $value }}
                                                </option>
                                              @endforeach
                                        </select>


                                        </div>
                                      </div>
                                <!-- end -->
                            
                    </div>
                  
                  </div>
                </div>
              </div><!-- End Default Accordion Example -->

              <!-- END TAB2: TINDAKAN RUJUKAN -->

              <br>


              <!-- TAB3: TINDAKAN -->


              <!-- Start Tindakan -->
              <h3 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Tindakan</h3>
          
              <br>
          
                <input type="text" name="dispatch_infos_id" class="bg-gray-200 form-control" value="{{$dispatchpassmec->dispatch_infos_id}}" hidden>
                <input type="text" name="no_folio" class="bg-gray-200 form-control" value="{{$dispatch->no_folio}}" hidden>
      
                <input type="text" name="dispatch_pass_mecs_id" class="bg-gray-200 form-control" value="{{$dispatchpassmec->id}}"hidden > 
    

          @endforeach
          
          
          
          <!-- Start Edit Tindakan -->

            <!-- Reverse id the edittindakan page belum diambil action -->

          @if(count($dispatchpassmecreverses) == 0)

          <div>
              
              @foreach($dispatchpassmecs as $dispatchpassmec)

                @if((optional($dispatch->Tindakan)->label) == "Kakitangan PT" && (optional($dispatch->Tindakan)->ic_no) == Auth::user()->ic_no)
                      <div class="row">

                            <div class="col-lg-4 label">Tindakan</div>

                                <div class="col-lg-8">
                                  <!-- Condition Kakitangan Dropdown -->
                                  
                               
                                     <select class="form-control select2" id="myselect" data-select2-id="myselect" multiple="multiple" name="tindakan_action_pass[]" tabindex="-1" aria-hidden="true">
                                          @foreach ($kakitanganlist as $key => $value)
                                              @if(in_array($key, $compA ?? []))
                                                  <option value="{{ $key }}" selected>
                                              @else
                                                    <option value="{{ $key }}">
                                              @endif
                                                    {{ $value }}
                                                    </option>
                                          @endforeach
                                      </select>
                                        {!! $errors->first('kakitanganlist', '<p class="help-block text-danger">:message</p>')!!}

                                  <!-- End Condition Kakitangan Dropdown -->
                            </div>
                      </div>
                @else 
                      <div class="row">
                            <div class="col-lg-4 label">Tindakan</div>
                                <div class="col-lg-8">
                                    
                                  <!-- Condition NOT Kakitangan Dropdown -->
                                        
                                         <select class="form-control select2" id="myselect" data-select2-id="myselect" multiple="multiple" name="tindakan_action_pass[]" tabindex="-1" aria-hidden="true">
                                          
                                        @foreach ($tindakanlist as $key => $value)
                                                          @if(in_array($key, $compB ?? [] ))
                                                                <option value="{{ $key }}" selected>
                                                          @else
                                                                <option value="{{ $key }}">
                                                          @endif
                                                                  {{ $value }}
                                                                </option>
                                                          @endforeach
                                                  </select>
                                                  {!! $errors->first('tindakanlist', '<p class="help-block text-danger">:message</p>')!!}
                                  <!-- End Condition NOT Kakitangan Dropdown -->
                                </div>
                        </div>
                @endif
                
                  <div class="row">
                        <div class="col-lg-4 label">Ulasan</div>
                              <div class="col-lg-8">
                                  <textarea class="form-control" name="ulasan_pass"  placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>    
                              </div>
                  </div>

 					<div class="row">
                        <div class="col-lg-4 label">Tindakan Diambil</div>
                            <div class="col-lg-8">
                                 
                                  <select class=" form-control select2" name="tindakan_pass[]"  id="myselect" data-select2-id="myselect" multiple="multiple" tabindex="-1" aria-hidden="true">

                                        <option value=""></option>
                                                @foreach ($tindakan as $key => $value)
                                                        <option value="{{ $key }}" >
                                                              {{ $value }}
                                                        </option>
                                                @endforeach
                                  </select>
                                        {!! $errors->first('tindakan_pass', '<p class="help-block text-danger">:message</p>') !!}
                              </div>
                  </div>

                  <br>

                    <input type="checkbox" name="status"> <label><i>Proses Kerja telah selesai</i></label>
                @endforeach
          </div> 

        
          @else

          <!-- when reverse is not empty, Bila edit tindakan sudah diambil -->

          <!-- Start -->
                  <div>
                  
                  @if((optional($dispatch->Tindakan)->label) == "Kakitangan PT" && (optional($dispatch->Tindakan)->ic_no) == Auth::user()->ic_no)
                  
                  <div class="row">
                    
                  @foreach($dispatchpassmecreverses as $dispatchpassmecreverse)
                  
                  <div class="col-lg-4 label">Tindakan</div>
                  
                  <div class="col-lg-8">
                    
                  <!-- Condition Kakitangan Dropdown -->
                            <?php $compA = json_decode( $dispatchpassmecreverse->tindakan_action_pass) ;?>
                            
                            <select class="form-control select2" id="myselect" data-select2-id="myselect" multiple="multiple" name="tindakan_action_pass[]" tabindex="-1" aria-hidden="true">
                              
                            @foreach ($kakitanganlist as $key => $value)
                                  @if(in_array($key, $compA ?? []))
                                        <option value="{{ $key }}" selected>
                                  @else
                                        <option value="{{ $key }}">
                                  @endif
                                      {{ $value }}
                                        </option>
                                  @endforeach
                            </select>
                            {!! $errors->first('kakitanganlist', '<p class="help-block text-danger">:message</p>')!!}
                  <!-- End Condition Kakitangan Dropdown -->
                  </div>
                  @endforeach
                            
                </div>
                
                @else 
                  <div class="row">
                    
                  @foreach($dispatchpassmecreverses as $dispatchpassmecreverse)
                        <div class="col-lg-4 label">Tindakan</div>
                              <div class="col-lg-8">
                                
                              <!-- Condition NOT Kakitangan Dropdown -->
                                <?php $compB = json_decode( $dispatchpassmecreverse->tindakan_action_pass) ;?>
                                
                                <select class="form-control select2" id="myselect" data-select2-id="myselect" multiple="multiple" name="tindakan_action_pass[]" tabindex="-1" aria-hidden="true">
                                  
                                @foreach ($tindakanlist as $key => $value)
                                
                                @if(in_array($key, $compB ?? [] ))
                                
                                <option value="{{ $key }}" selected>
                                  
                                @else
                                <option value="{{ $key }}">
                                @endif
                                    {{ $value }}
                                </option>
                                @endforeach
                                </select>
                                
                                {!! $errors->first('tindakanlist', '<p class="help-block text-danger">:message</p>')!!}
                                <!-- End Condition NOT Kakitangan Dropdown -->
                                      </div>
                          @endforeach
                          </div>
                        @endif
  
  
                      @foreach($dispatchpassmecreverses as $dispatchpassmecreverse)
                        <div class="row">
                                <div class="col-lg-4 label">Ulasan</div>
                                <div class="col-lg-8">
                                  <textarea class="form-control" name="ulasan_pass" value="{{$dispatchpassmecreverse->ulasan_pass}}" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;">{{$dispatchpassmecreverse->ulasan_pass}}</textarea>
                                  </div>
                            </div>
                            @endforeach

                            @foreach($dispatchpassmecreversestindakan as $dispatchpassmecreversestindakan)
                            <?php $selectedValuesreverse = json_decode($dispatchpassmecreversestindakan->tindakan_pass);?>
                          <div class="row">
                          <div class="col-lg-4 label">Tindakan Diambil</div>
                            <div class="col-lg-8">
                                <select class=" form-control select2" name="tindakan_pass[]"  id="myselect" data-select2-id="myselect" multiple="multiple" tabindex="-1" aria-hidden="true">
                                  
                                    <option value="{{$dispatchpassmecreversestindakan->kod}}">{{$dispatchpassmecreversestindakan->kod}}</option>
                                    
                                      @foreach ($tindakanpass as $key => $value)
                                      <option value="{{ $key }}" {{ is_array($selectedValuesreverse) && in_array($key, $selectedValuesreverse) ? 'selected' : '' }}>
                                      {{ $value }}
                                    </option>
                                      @endforeach
                                </select>
                                    {!! $errors->first('tindakan_pass', '<p class="help-block text-danger">:message</p>') !!}
                          </div>
                        </div>
                        @endforeach

                        <br>

                          <input type="checkbox" name="status" value="selesai"> <label><i>Proses Kerja telah selesai</i></label>
  
                 
  
                      
                </div>
                
                <!-- End -->

          @endif
      
        </div>

        <!-- END TAB3:TINDAKAN -->

   
          <br>

          <!-- TAB 4:FILE  -->
          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h3 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Dokumen</h3>

                <div class="card-body overflow-auto">

                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                      <i class="bi bi-plus-lg"></i>
                    </button>
                  </div>

                
                  <input type="text" name="id" class="bg-gray-200 form-control " value="{{$dispatchpassmec->dispatch_infos_id}}" hidden>
                 
                  <table class="table-achiev" id="tableprestasi1">
                    <thead>
                      <tr>
                        <th class="text-center">Daripada</th>
                        <th class="text-center">No. Rujukan</th>
                        <th class="text-center">Tarikh Surat</th>
                        <th class="text-center">Tindakan</th>
                        <th class="text-center">Catatan</th>
                        <th class="text-center">Dokumen</th>
                        <th></th>
                      </tr>
                    </thead>


                    <tbody>

                      @if(count( $dispatchfiles) == 0)

                      <tr class="text-center">
                        <td colspan="8">
                          <h5>No records found</h5>
                        </td>
                      </tr>

                      @else

                      @foreach( $dispatchfiles as $dispatchfile)

                      <tr class="text-center">

                        <td>{{$dispatchfile->daripada}}</td>
                        <td>{{$dispatchfile->no_folio_dokumen}}</td>

                        @if ($dispatchfile->tarikh_surat == null)
                        <td></td>
                        @else
                        <td>{{ date('d/m/Y', strtotime($dispatchfile->tarikh_surat)) }}</td>
                        @endif

                        <td>{{$dispatchfile->tindakanfile}}</td>

                        <td>
                          <!-- Basic Modal -->
                          <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#StrategicThinkingEvidence">
                          </button>
                          <div class="modal fade" id="StrategicThinkingEvidence" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Catatan</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <textarea class="form-control" style="height: 150px" readonly>{{$dispatchfile->despatch}}</textarea>
                                </div>

                              </div>
                            </div>
                          </div><!-- End Basic Modal-->
                        </td>

                        <td><a href='{{Storage::url("$dispatchfile->mec_file") }}' target="_blank">View</a></td>

                      </tr>

                      @endforeach

                      @endif

                    </tbody>
                  </table>

            

                  <script type="text/javascript">
                    $(document).ready(function() {
                      $('#addbtn2').off().on('click', function() {

                        var html = '';
                        html += '<tr>';

                        html += '<td><input id="daripada" type="text"  placeholder=""  class="form-control @error('
                        dariapda ') is-invalid @enderror" name="daripada[]" value="{{ old('
                        daripada ') }}"  autofocus></td>';

                        html += '<td><input id="no_folio_dokumen" type="text"  placeholder="No. Rujukan"  class="form-control @error('
                        no_folio_dokumen ') is-invalid @enderror" name="no_folio_dokumen[]" value="{{ old('
                        no_folio_dokumen ') }}"  autofocus></td>';

                        html += '<td><input id="tarikh_surat" type="date"  placeholder="tarikh"  class="form-control @error('
                        tarikh_surat ') is-invalid @enderror" name="tarikh_surat[]" value="{{ old('
                        tarikh_surat ') }}"  autofocus></td>';

                        html += '<td><input id="tindakan" type="text"  placeholder=""  class="form-control @error('
                        tindakan ') is-invalid @enderror" name="tindakanfile[]" value="{{ old('
                        tindakan ') }}" autofocus></td>';

                        html += '<td><textarea id="despatch" type="textarea"  placeholder="catatan"  class="form-control @error('
                        despatch ') is-invalid @enderror" name="despatch[]" value="{{ old('
                        despatch ') }}"  autofocus></textarea></td>';

                        html += '<td><input id="file" type="file"   class="form-control @error('
                        file ') is-invalid @enderror" name="mec_file[]" value="{{ old('
                        file ') }}"  autofocus></td>';

                        html += '<td> <button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                        html += '</tr>';
                        $('#tableprestasi1').append(html);
                      })

                    });

               
                    $(document).on('click', '.removeDeclare', function() {
                      $(this).parents('tr').remove();
                    });
                  </script>


                </div>
              </div>
              
        @endforeach

        <!-- END TAB4: FILE -->


     <!--      <script>
            $(document).ready(function() {
              $('.js-example-basic-multiple').select2();
            });
          </script> -->

            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>

           <script>
  
    $(document).ready(function(){

        // Initialize select2
        $("#myselection").select2();

        // Read selected option
        $('#but_read').click(function(){
        var username = $('#myselection option:selected').text();
        var userid = $('#myselection').val();

        $('#result').html("id : " + userid + ", name : " + username);

        });
        });
 </script>

          <br>

            <div class="text-center">
              <button type="submit" onclick="this.disabled=true;this.value='Sending,please wait..';this.form.submit();"  class="btn btn-primary">Submit</button>
            </div>

          </form>

</div>
</div>
</div>


</section>
@endsection