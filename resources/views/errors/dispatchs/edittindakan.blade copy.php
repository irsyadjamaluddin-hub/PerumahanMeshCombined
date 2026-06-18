@extends('layouts.app-all')

@section('title', 'Edit Tindakan MEC')

@section('content')

<?php
$pagename = "MED";
?>

<div class="pagetitle">
  <!-- <h1>Pengarah</h1> -->
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">MOEDISPATCH</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<style>
  div1 {
    border: 1px solid black;
    padding: 12px;
    background-color: lightgrey;
  }
</style>

<section class="section profile">


  <a href="{{ route('dispatchs.dis.indexadmin') }}" class="btn btn-primary text-right mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>





  <div class="col-12">
    <div class="card recent-sales">



      <div class="card-body">

        <div class="profile-overview pt-3">

          <form class="" method="post" action="{{ route('dispatchs.dis.updatetindakan') }}" enctype="multipart/form-data">
            @csrf

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <h3 class="card-title" style="padding: 0px;">Rujukan (Admin)</i></h3>
              <hr>


              @foreach ($dispatchs as $dispatch)
              <br>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">Tarikh Menerima <br></div>
                <div class="col-lg-8 col-md-9">{{date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">Tarikh Memproses </div>
                <div class="col-lg-8 col-md-9">{{date('d/m/Y', strtotime( $dispatch->date_process))}}</div>
              </div>


              <div class="row">
                <div class="col-lg-4 col-md-3  label">Tarikh Tutup</div>
                <div class="col-lg-8 col-md-9">{{date('d/m/Y', strtotime( $dispatch->date_close))}}</div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-3  label">Dokumen</div>
                <div class="col-lg-8 col-md-9">
                  <a href='{{Storage::url("$dispatch->lamp") }}' target="_blank">
                    <p>View Uploaded File</p>
                  </a>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">No. Rujukan</div>
                <div class="col-lg-8 col-md-9">{{ $dispatch->no_folio}}</div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">Catatan</div>
                <div class="col-lg-8 col-md-9">{{ $dispatch->catatan_admin}}</div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-3  label">Tindakan</div>
                <div class="col-lg-8 col-md-9">{{optional($dispatch->Tindakan)->kod}}</div>
              </div>

              @endforeach

            </div>

            <br>

            <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <h3 class="card-title" style="padding: 0px;">Tindakan</i></h3>
              <hr>
              <br>

              @if((optional($dispatch->Tindakan)->label) == "Kakitangan PT" && (optional($dispatch->Tindakan)->ic_no) == Auth::user()->ic_no )

              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">Tindakan</label>

                <div class="col-lg-3 col-md-2">

                  <label><input type="checkbox" name="tindakan_pt[]" value="Untuk disemak"> Untuk disemak</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_pt[]" value="Sila rujuk lampiran"> Sila rujuk lampiran</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_pt[]" value="Lain-lain(sila lihat ulasan)"> Lain-lain(sila lihat ulasan)</label>

                </div>

                @if($dispatch->tindakan_pt == null)

                <div></div>

                @else

                <div1 class="col-lg-5 col-md-5">

                  <label for="inputText" class="col-lg-4 col-md-3  label">Selected Tindakan:</label>


                  @php $tindakan_pts=$dispatch->tindakan_pt ? json_decode($dispatch->tindakan_pt, true) : []; @endphp
                  @foreach($tindakan_pts as $tindakan_pt)

                  <br>
                  {{($tindakan_pt)}}


                  @endforeach



                </div1>
                @endif
                <br>

                <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Ulasan</label>
                  <div class="col-lg-8 col-md-9">
                    <textarea class="form-control" name="ulasan_pt" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                  </div>
                </div>
              </div>

              @else

              <!-- start tindakan -->
              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">Tindakan</label>
                <div class="col-lg-3 col-md-2">
                  <label><input type="checkbox" name="tindakan_mec[]" value="Untuk makluman/perhatian"> Untuk makluman/perhatian</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Untuk disemak"> Untuk disemak</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Untuk tindakan"> Untuk tindakan</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Sila sediakan surat/memo/minit/maklumat"> Sila sediakan surat/memo/minit/maklumat</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Sila buat penambahbaikan"> Sila buat penambahbaikan</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Sila berjumpa"> Sila berjumpa</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Sila fail"> Sila fail</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Sila proses/uruskan"> Sila proses/uruskan</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Sila rujuk lampiran"> Sila rujuk lampiran</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Menetapkan tarikh perjumpaan"> Menetapkan tarikh perjumpaan</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Diambil maklum"> Diambil maklum</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Tindakan diambil"> Tindakan diambil</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Diluluskan"> Diluluskan</label>
                  <br>
                  <label><input type="checkbox" name="tindakan_mec[]" value="Lain-lain(sila lihat ulasan)"> Lain-lain(sila lihat ulasan)</label>
                </div>

                @if($dispatch->tindakan_mec== null)

                <div></div>
                @else

                <div1 class="col-lg-5 col-md-5">

                  <label for="inputText" class="col-lg-4 col-md-3  label">Selected Tindakan:</label>


                  @php $tindakan_mecs=$dispatch->tindakan_mec ? json_decode($dispatch->tindakan_mec, true) : []; @endphp
                  @foreach($tindakan_mecs as $tindakan_mec)

                  <br>
                  {{($tindakan_mec)}}


                  @endforeach



                </div1>
                @endif

              </div>
              <!-- ends tindakan -->


              <div class="row">
                <label for="inputText" class="col-lg-4 col-md-3  label">Ulasan Pengarah</label>
                <div class="col-lg-8 col-md-9">
                  <textarea class="form-control" name="ulasan_mec" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                </div>
              </div>

              @endif



              <br>

              <div class="row">
                <label class="col-lg-4 col-md-3  label">Tindakan</label>

                <div class="col-lg-8 col-md-9">
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
            </div>

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