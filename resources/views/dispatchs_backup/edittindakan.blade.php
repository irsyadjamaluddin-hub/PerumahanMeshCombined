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

              <div class="row">
                <div class="col-lg-4 label">Tarikh Menerima</div>
                @if ($dispatch ->dispatch_recieved_at==null)
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
                <div class="col-lg-4 label">Tarikh Tutup</div>
                @if ($dispatch ->date_close==null)
                <div class="col-lg-8"></div>
                @else
                <div class="col-lg-8">{{date('d/m/Y', strtotime( $dispatch->date_close))}}</div>
                @endif
              </div>

              <div class="row">
                <div class="col-lg-4 label">Dokumen</div>
                <div class="col-lg-8">
                  <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                    <p>{{$dispatch->lamp}}</p>
                  </a>
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

              <div class="row">
                <div class="col-lg-4 label">Tindakan</div>
                <div class="col-lg-8">{{optional($dispatch->Tindakan)->kod}}</div>
              </div>

            </div>
<br>

          @foreach ($dispatchpassmecs as $dispatchpassmec)
          <?php $compA = json_decode($dispatchpassmec->tindakan_action_pass) ;   ?> 
          @endforeach
            
          <!-- Start Tindakan -->
          <div class="col profile-overview overflow-auto" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h3 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Tindakan</h3>
<br>
          


                       @foreach ($dispatchpassmecs as $dispatchpassmec)
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
                                    <div class="col-lg-4 label">Tindakansw</div>
                                    <div class="col-lg-8">{{$dispatchpassmec->created_by}}</div>
                                 
                                    <div class="col-lg-8">{{optional($dispatchpassmec->Tindakan)->kod}}</div>
                              Ekma,
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Ulasan Pengarah</div>
                                    <div class="col-lg-8">{{($dispatchpassmec->ulasan_pass)}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 label">Tindakan Diambil</div>
                                    <div class="col-lg-8">{{($dispatchpassmec->tindakan_pass)}}</div>
                                    
                                </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Default Accordion Example -->
                            @endforeach
            <input type="text" name="dispatch_infos_id" class="bg-gray-200 form-control" value="{{$dispatch->id}}" hidden>
            <input type="text" name="no_folio" class="bg-gray-200 form-control" value="{{$dispatch->no_folio}}" hidden>



            <!-- Kakitangan Pt Chechbox/Dropdown -->
            <div class="row">
              <div class="col-lg-4 label">Tindakan</div>



                @if((optional($dispatch->Tindakan)->label) == "Kakitangan PT" && (optional($dispatch->Tindakan)->ic_no) == Auth::user()->ic_no)
                <div class="col-lg-8"> 
                  <select class="form-select js-example-basic-multiple" multiple="multiple" name="tindakan_action_pass[]">

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
                </div>
            </div>
                @else

                <!-- start tindakan -->
                <div class="row">
                  <div class="col-lg-4 label">Tindakan</div>
                    <div class="col-lg-8"> 

                    @foreach ($dispatchpassmecs as $dispatchpassmec)
                    <?php $compB = json_decode($dispatchpassmec->tindakan_action_pass) ;?>
                    @endforeach

                      <select class="form-select js-example-basic-multiple" multiple="multiple" name="tindakan_action_pass[]">
                      
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
                      
                      </div> 
                </div> 

          @endif
          <!-- ends tindakan -->

          <div class="row">
            <div class="col-lg-4 label">Ulasan</div>
            <div class="col-lg-8">
              <textarea class="form-control" name="ulasan_pass" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
            </div>
          </div>

          @foreach ($dispatchs as $dispatch)
          <div class="row">
            <div class="col-lg-4 label">Tindakan Diambil</div>
            <div class="col-lg-8">
              <select class="form-select" name="tindakan_pass">
                <option value="{{optional($dispatch->tindakan)->kod}}">{{optional($dispatch->Tindakan)->kod}}</option>
                  @foreach ($tindakan as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                </option>
                  @endforeach
              </select>
              {!! $errors->first('tindakan_pass', '<p class="help-block text-danger">:message</p>') !!}
            </div>
          </div>
          @endforeach

          <!-- End Tindakan -->

          </div>

<br>

          <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
          <h3 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Dokumen</h3>

                <div class="card-body overflow-auto">

                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
                      <i class="bi bi-plus-lg"></i>
                    </button>
                  </div>

                  <input type="text" name="id" class="bg-gray-200 form-control " value="{{$dispatch->id}}" hidden>

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

                        <td>{{$dispatchfile->tindakan}}</td>

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

                        <td><a href='{{Storage::url("$dispatchfile->file") }}' target="_blank">View</a></td>


                        <td>
                          <!-- <div class="btn-group gap-2" role="group" aria-label="Basic example">

                            <form method="post" action="{{ route('dispatchs.dis.destroyfile', $dispatchfile->id ) }}">

                              @csrf
                              @method('post')

                              <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('are you sure you want to delete?')">
                                <i class="bi bi-trash-fill"></i>
                              </button>
                            </form>

                          </div> -->
                        </td>

                      </tr>

                      @endforeach

                      @endif

                    </tbody>
                  </table>

                  @endforeach

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
                        tindakan ') is-invalid @enderror" name="tindakan[]" value="{{ old('
                        tindakan ') }}" autofocus></td>';

                        html += '<td><textarea id="despatch" type="textarea"  placeholder="catatan"  class="form-control @error('
                        despatch ') is-invalid @enderror" name="despatch[]" value="{{ old('
                        despatch ') }}"  autofocus></textarea></td>';

                        html += '<td><input id="file" type="file"   class="form-control @error('
                        file ') is-invalid @enderror" name="file[]" value="{{ old('
                        file ') }}"  autofocus></td>';

                        html += '<td> <button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                        html += '</tr>';
                        $('#tableprestasi1').append(html);
                      })

                    });

                    // $(document).on('click', '#remove', function() {
                    //     $(this).closest('tr').remove();
                    // });

                    $(document).on('click', '.removeDeclare', function() {
                      $(this).parents('tr').remove();
                    });
                  </script>


                </div>
              </div>


          <script>
            $(document).ready(function() {
              $('.js-example-basic-multiple').select2();
            });
          </script>

          <br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>

</div>
</div>
</div>
</div>

</section>
@endsection