@extends('layouts.app-all')

@section('title', 'Edit Admin Despatch')

@section('content')

<?php
$pagename = "MED";
?>

<div class="pagetitle">
  <h1>edit form</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">MOE e-Dispatch</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">


  <a href="{{ route('dispatchs.dis.indexadmin') }}" class="btn btn-primary text-right mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>






  <!-- QO Table -->
  <div class="col-12">
    <div class="card recent-sales">



      <div class="card-body">

        <div class="profile-overview pt-3">

          @foreach($dispatchs as $dispatch)

          <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
            <h5 class="card-title">Rujukan e-Despatch</h5>
            <hr>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Tarikh Diterima </div>
              @if ($dispatch ->dispatch_recieved_at==null)
              <div class="col-lg-8 col-md-9"> <span class="badge bg-danger"> Belum Diterima</span></div>
              @else
              <div class="col-lg-8 col-md-9">{{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
              @endif
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Jenis </div>
              <div class="col-lg-8 col-md-9">{{ optional($dispatch->jenis)->label }}</div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Daripada</div>
              <div class="col-lg-8 col-md-9">{{ optional($dispatch->Daripada)->label }}</div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Kepada</div>
              <div class="col-lg-8 col-md-9">{{ optional($dispatch->kepada)->label }}</div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Untuk Perhatian</div>
              <div class="col-lg-8 col-md-9">{{$dispatch->up}}</div>
            </div>


            <div class="row">
              <div class="col-lg-4 col-md-3  label">Perkara</div>
              <div class="col-lg-8 col-md-9">{{$dispatch->perkara}}</div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Rujukan Persuratan</div>
              <div class="col-lg-8 col-md-9">{{$dispatch->rp}}</div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Rujukan Pejabat Yang Menghadapkan</div>
              <div class="col-lg-8 col-md-9">{{$dispatch->rm}}</div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Muat Naik Dokumen</div>
              <div class="col-lg-8 col-md-9">
                <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                  <p>View Uploaded File</p>
                </a>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-3  label">Catatan</div>
              <div class="col-lg-8 col-md-9">{{$dispatch->catt}}</div>
            </div>
          </div>

          @endforeach
          <br>


          <form class="" method="post" action="{{ route('dispatchs.dis.updateadmin') }}" enctype="multipart/form-data">
            @csrf
            <br>


            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <h3 class="card-title" style="padding: 0px;">Admin</i></h3>
              <hr>
              <br>

              @foreach($dispatchs as $dispatch)


              <div class="row">
                <div class="col-lg-4 col-md-3  label">Tarikh Menerima <br></div>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="" class="bg-gray-200 form-control" value="{{date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}" readonly>
                  {!! $errors->first('dispatch_recieved_at', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>


              <div class="row">
                <div class="col-lg-4 col-md-3  label">Tarikh Memproses</div>
                <div class="col-lg-8 col-md-9">
                  <input type="date" name="date_process" class="form-control" value="{{ $dispatch->date_process}}">
                  {!! $errors->first('date_process', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">Tarikh Tutup</div>
                <div class="col-lg-8 col-md-9">
                  <input type="date" name="date_close" class="form-control" value="{{ $dispatch->date_close}}">
                  {!! $errors->first('date_close', '<p class="help-block text-danger">:message</p>') !!}
                </div>
              </div>

              <div class="row">
                <label for="inputNumber" class="col-lg-4 col-md-3  label">Dokumen</label>
                <div class="col-lg-8 col-md-9">
                  <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                    <p>View Uploaded File</p>
                  </a>
                </div>
              </div>

              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">No. Rujukan</label>
                <div class="col-lg-8 col-md-9">
                  <input type="text" name="no_folio" class="form-control" value="{{ $dispatch->no_folio}}">
                </div>
              </div>


              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">Catatan</label>
                <div class="col-lg-8 col-md-9">
                  <textarea class="form-control" name="catatan_admin" placeholder="Sebarang Ulasan" id="floatingTextarea" style="height: 100px;">{{ $dispatch->catatan_admin}}</textarea>
                </div>
              </div>

              <div class="row">
                <label class="col-lg-4 col-md-3  label">Tindakan</label>

                <div class="col-lg-7 col-md-8">
                  <select class="form-select" name="tindakan">
                  
                    <option value="{{optional($dispatch->tindakan)->kod}}"></option>
                    
                    
                    @foreach ($tindakan as $key => $value)
                    <option value="{{ $key }}">
                      {{ $value }}
                    </option>
                    @endforeach



                  </select>
                  {!! $errors->first('tindakan', '<p class="help-block text-danger">:message</p>') !!}




                </div>


                <!-- add ppl button -->
                <div class="col-lg-1 col-md-1">
                  <!-- <button type="button" class="btn btn-primary " id="addbtn" href="{{ route('dispatchs.dis.mecuser') }}">
                    <i class="ri-user-add-fill"></i>
                  </button> -->
                  <a href="{{ route('dispatchs.dis.mecuser') }}" class="btn btn-primary text-right mb-2">
                    <i class="ri-user-add-fill"></i>
                  </a>
                </div>
              </div>

            </div>

            @endforeach

            <br>


            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <h3 class="card-title" style="padding: 0px;">Dokumen</i></h3>
              <hr>



              <div class="">


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
                        <th>Daripada</th>
                        <th>No. Rujukan</th>
                        <th>Tarikh Surat</th>
                        <th>Tindakan</th>
                        <th>Catatan</th>
                        <th>Dokumen</th>
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

                        html += '<td><input id="despatch" type="textarea"  placeholder="catatan"  class="form-control @error('
                        despatch ') is-invalid @enderror" name="despatch[]" value="{{ old('
                        despatch ') }}"  autofocus></td>';

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
            </div>



            <br>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>



        </div>

      </div>


    </div>

  </div>
  </div><!-- End Recent Sales -->

  </div>


</section>
@endsection