@extends('layouts.app-all')

@section('title', 'Sistem Tempahan Bilik')

@section('content')

  <?php
    $pagename = "SistemTempahanBilik";
  ?>

    <section class="section">
    <div class="row">
    
    <div class="card">
    <div class="card-body mt-3">
    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Kaunter Perkkhidmatan Setempat <br>Sistem Tempahan Bilik</h5>

                  <div class="col-lg-12 overflow-auto">
                  <table class="table table-bordered table-light" style="text-align: center; vertical-align: middle;">
                      <tbody>
                        <tr style="height: 50px;">
                            <th scope="row">Kaunter 1 <br> MKPK</th>
                            <th scope="row">Kaunter 2 <br> DE</th>
                            <th scope="row">Kaunter 3 <br> JPB</th>
                            <th scope="row">Kaunter 4 <br> JPS</th>
                            <th scope="row">Kaunter 5 <br> JPP</th>
                            <th scope="row">Kaunter 11 <br> JPPE </th>
                        </tr>

                    

                        
                      </tbody>
                  </table>
                  <br><br>
                  <table class="table-borderless" style="text-align: center; vertical-align: middle;" id="declare">
                      <tbody>
                        <tr>
                            <th scope="row"><img src="/img/syndicateroom.png" style="width: 50%"><br>
                            @if (Auth::check())
                            @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_OSC_OP'))
                                    @if(empty($booking1->status) || ($booking1->status == '2'))
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">Bilik Sindiket 1</button>
                                      @else
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal" disabled>Bilik Sindiket 1</button>
                                    @endif
                            @endif
                            @endif
                            @if (Auth::user()->hasRole('ROLE_OSCROOM'))
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal" disabled>Bilik Sindiket 1</button>
                            @endif
                            </th>
                            <!--Start of Pop Up Form -->
                                <div class="modal fade" id="ExtralargeModal">
                                  <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title">Buat Tempahan</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                          </div>
                                          <div class="modal-body">
                                              <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
                                                  @csrf
                                                  <br>
                                                  <div class="col profile-overview"style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                      <h3 class="card-title" style="padding: 0px;">Borang Tempahan Bilik Sindiket 1</i></h3>
                                                      <hr>

                                                      <br>

                                                      <h3 class="card-title" style="padding: 0px;">Maklumat Pelanggan Pengguna</i></h3>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 label">Nama</label>
                                                          <div class="col-lg-7">
                                                              <input type="text" name="name" class="form-control">
                                                              {!! $errors->first('name', '<small
                                                                  class="text-danger">:message</small>') !!}
                                                          </div>
                                                          <div class="col-lg-1">
                                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button></div>
                                                            </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Kad Pengenalan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="ic_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Giliran</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="que_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Syarikat/Jabatan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="syarikat_jabatan" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <h3 class="card-title" style="padding: 0px;">Maklumat Pegawai</i></h3>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Nama Pegawai</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="nama_pegawai" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="jbt_s1" class="col-lg-4 col-md-3  label">Jabatan Berurusan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                            <select class="form-control" name="dept" id="dept">
                                                                @foreach ($department as $dpt)
                                                                <option value="{{ $dpt->label }}">
                                                                    {{ $dpt->label }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                      </div>
                                                                
                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Telefon</label>
                                                            <div class="col-lg-0 col-md-1">
                                                                <input type="text" class="form-control" value="+673" readonly>
                                                            </div>
                                                          <div class="col-lg-0 col-md-7">
                                                              <input type="text" name="phone_number" class="form-control" disabled>
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label" hidden>No. Bilik</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="room_no" class="form-control" value="1" hidden>
                                                          </div>
                                                      </div>


                                                      <div class="row">
                                                          <label for="inputText"class="col-lg-4 col-md-3  label">Masa Mula</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
                                                          </div>
                                                      </div>

                                                      <input type="text" id="extranameMain" name="extranameMain" class="form-control" hidden>
                                                      <input type="text" id="extraic_noMain" name="extraic_noMain" class="form-control" hidden>
                                                      
                                                      <br>
                                                      <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                      </div>
                                                  </div>
                                                  <!--End of the Card -->
                                                  <br>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                              <!-- End of Pop Up Form-->
                              
                              <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Orang Tambahan</h5> 
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <textarea class="form-control" placeholder="Nama cth. Ali, Abu" id="extraname" name="extraname" style="width:50%"></textarea>
                                                <textarea class="form-control" placeholder="No. KP cth. 01234567, 00221547"  id="extraic_no" name="extraic_no" style="width:50%"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="saveextra" name="saveextra" class="btn btn-primary" data-bs-target="#ExtralargeModal" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <th scope="row"><img src="/img/syndicateroom.png" style="width: 50%"><br>
                            @if(empty($booking2->status) || ($booking2->status == '2'))
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal2">Bilik Sindiket 2</button>
                                      @else
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal2" disabled>Bilik Sindiket 2</button>
                                      @endif
                            </th>
                            <!--Start of Pop up Form -->
                            <div class="modal fade" id="ExtralargeModal2" tabindex="-1">
                                  <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title">Buat Tempahan</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                          </div>
                                          <div class="modal-body">
                                          <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
                                                  @csrf
                                                  <br>
                                                  <div class="col profile-overview"style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                      <h3 class="card-title" style="padding: 0px;">Borang Tempahan Bilik Sindiket 2</i></h3>
                                                      <hr>
                                                      <br>
                                                      <h3 class="card-title" style="padding: 0px;">Maklumat Pelanggan Pengguna</i></h3>
                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 label">Nama</label>
                                                          <div class="col-lg-7">
                                                              <input type="text" name="name" class="form-control">
                                                              {!! $errors->first('name', '<small
                                                                  class="text-danger">:message</small>') !!}
                                                          </div>
                                                          <div class="col-lg-1"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button></div>
                                                        </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Kad Pengenalan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="ic_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Giliran</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="que_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Syarikat/Jabatan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="syarikat_jabatan" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <h3 class="card-title" style="padding: 0px;">Maklumat Pegawai</i></h3>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Nama Pegawai</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="nama_pegawai" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Berurusan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                            <select class="form-control" name="dept" id="dept">
                                                                @foreach ($department as $dpt)
                                                                <option value="{{ $dpt->label }}">
                                                                    {{ $dpt->label }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                      </div>
                                                                
                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Telefon</label>
                                                            <div class="col-lg-0 col-md-1">
                                                                <input type="text" class="form-control" value="+673" readonly>
                                                            </div>
                                                          <div class="col-lg-0 col-md-7">
                                                              <input type="text" name="phone_number" class="form-control" disabled>
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label" hidden>No. Bilik</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="room_no" class="form-control" value="2" hidden>
                                                          </div>
                                                      </div>


                                                      <div class="row">
                                                          <label for="inputText"class="col-lg-4 col-md-3  label">Masa Mula</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
                                                          </div>
                                                      </div>

                                                      <input type="text" id="extranameMain2" name="extranameMain" class="form-control" hidden>
                                                      <input type="text" id="extraic_noMain2" name="extraic_noMain" class="form-control" hidden>
                                                      
                                                      <br>
                                                      <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                      </div>
                                                  </div>
                                                  <!--End of the Card -->
                                                  <br>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                              <!-- End of Pop Up Form-->
                              <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Orang Tambahan</h5> 
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <textarea class="form-control" placeholder="Nama cth. Ali, Abu" id="extraname2" name="extraname2" style="width:50%"></textarea>
                                                <textarea class="form-control" placeholder="No. KP cth. 01234567, 00221547" id="extraic_no2" name="extraic_no2" style="width:50%"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="saveextra2" name="saveextra2" class="btn btn-primary" data-bs-target="#ExtralargeModal2" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            
                          
                              <th scope="row"><img src="/img/syndicateroom.png" style="width: 50%"><br>
                                @if(empty($booking3->status) || ($booking3->status == '2'))
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal3">Bilik Sindiket 3</button>
                                        @else
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal3" disabled>Bilik Sindiket 3</button>
                                        @endif
                              </th>
                              <!--Start of Pop up Form -->
                              <div class="modal fade" id="ExtralargeModal3" tabindex="-1">
                                  <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                                <h5 class="modal-title">Buat Tempahan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                          </div>
                                          <div class="modal-body">
                                          <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
                                                  @csrf
                                                  <br>
                                                  <div class="col profile-overview"style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                      <h3 class="card-title" style="padding: 0px;">Borang Tempahan Bilik Sindiket 3</i></h3>
                                                      <hr>
                                                      <br>
                                                      <h3 class="card-title" style="padding: 0px;">Maklumat Pelanggan Pengguna</i></h3>
                                                      <br>
                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 label">Nama</label>
                                                          <div class="col-lg-7">
                                                              <input type="text" name="name" class="form-control">
                                                              {!! $errors->first('name', '<small
                                                                  class="text-danger">:message</small>') !!}
                                                          </div>
                                                          <div class="col-lg-1"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalToggle3" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button></div>
                                                        </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Kad Pengenalan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="ic_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Giliran</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="que_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Syarikat/Jabatan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="syarikat_jabatan" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <h3 class="card-title" style="padding: 0px;">Maklumat Pegawai</i></h3>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Nama Pegawai</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="nama_pegawai" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Berurusan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                            <select class="form-control" name="dept" id="dept">
                                                                @foreach ($department as $dpt)
                                                                <option value="{{ $dpt->label }}">
                                                                    {{ $dpt->label }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                      </div>
                                                                
                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Telefon</label>
                                                            <div class="col-lg-0 col-md-1">
                                                                <input type="text" class="form-control" value="+673" readonly>
                                                            </div>
                                                          <div class="col-lg-0 col-md-7">
                                                              <input type="text" name="phone_number" class="form-control" disabled>
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label" hidden>No. Bilik</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="room_no" class="form-control" value="3" hidden>
                                                          </div>
                                                      </div>


                                                      <div class="row">
                                                          <label for="inputText"class="col-lg-4 col-md-3  label">Masa Mula</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
                                                          </div>
                                                      </div>
                                                      
                                                      <input type="text" id="extranameMain3" name="extranameMain" class="form-control" hidden>
                                                      <input type="text" id="extraic_noMain3" name="extraic_noMain" class="form-control" hidden>

                                                      <br>
                                                      <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                      </div>
                                                  </div>
                                                  <!--End of the Card -->
                                                  <br>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                          </form>
                                    </div>
                                  </div>
                              </div>
                              <div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Orang Tambahan</h5> 
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <textarea class="form-control" placeholder="Nama cth. Ali, Abu" id="extraname3" name="extraname3" style="width:50%"></textarea>
                                                <textarea class="form-control" placeholder="No. KP cth. 01234567, 00221547"  id="extraic_no3" name="extraic_no3" style="width:50%"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="saveextra3" name="saveextra3" class="btn btn-primary" data-bs-target="#ExtralargeModal3" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Pop Up Form-->
                            <th scope="row"><img src="/img/syndicateroom.png" style="width: 50%"><br>
                              @if(empty($booking4->status) || ($booking4->status == '2'))
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal4">Bilik Sindiket 4</button>
                              @else
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal4" disabled>Bilik Sindiket 4</button>
                              @endif
                            </th>
                            <div class="modal fade" id="ExtralargeModal4" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                              <h5 class="modal-title">Buat Tempahan</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
                                                  @csrf
                                                  <br>
                                                  <div class="col profile-overview"style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                      <h3 class="card-title" style="padding: 0px;">Borang Tempahan Bilik Sindiket 4</i></h3>
                                                      <hr>
                                                      <br>
                                                      <h3 class="card-title" style="padding: 0px;">Maklumat Pelanggan Pengguna</i></h3>
                                                      <br>
                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 label">Nama</label>
                                                          <div class="col-lg-7">
                                                              <input type="text" name="name" class="form-control">
                                                              {!! $errors->first('name', '<small
                                                                  class="text-danger">:message</small>') !!}
                                                          </div>
                                                          <div class="col-lg-1"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalToggle4" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button></div>
                                                        </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Kad Pengenalan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="ic_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Giliran</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="que_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Syarikat/Jabatan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="syarikat_jabatan" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <h3 class="card-title" style="padding: 0px;">Maklumat Pegawai</i></h3>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Nama Pegawai</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="nama_pegawai" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Berurusan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                            <select class="form-control" name="dept" id="dept">
                                                                @foreach ($department as $dpt)
                                                                <option value="{{ $dpt->label }}">
                                                                    {{ $dpt->label }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                      </div>
                                                                
                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Telefon</label>
                                                            <div class="col-lg-0 col-md-1">
                                                                <input type="text" class="form-control" value="+673" readonly>
                                                            </div>
                                                          <div class="col-lg-0 col-md-7">
                                                              <input type="text" name="phone_number" class="form-control" disabled>
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label" hidden>No. Bilik</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="room_no" class="form-control" value="4" hidden>
                                                          </div>
                                                      </div>


                                                      <div class="row">
                                                          <label for="inputText"class="col-lg-4 col-md-3  label">Masa Mula</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
                                                          </div>
                                                      </div>

                                                      <input type="text" id="extranameMain4" name="extranameMain" class="form-control" hidden>
                                                      <input type="text" id="extraic_noMain4" name="extraic_noMain" class="form-control" hidden>

                                                      <br>
                                                      <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                      </div>
                                                  </div>
                                                  <!--End of the Card -->
                                                  <br>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                          </form>
                                  </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Orang Tambahan</h5> 
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <textarea class="form-control" placeholder="Nama cth. Ali, Abu" id="extraname4" name="extraname4" style="width:50%"></textarea>
                                                <textarea class="form-control" placeholder="No. KP cth. 01234567, 00221547"  id="extraic_no4" name="extraic_no4" style="width:50%"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="saveextra4" name="saveextra4" class="btn btn-primary" data-bs-target="#ExtralargeModal4" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                              <!-- End of Pop Up Form-->
                            <th scope="row"><img src="/img/syndicateroom.png" style="width: 50%"><br>
                            @if(empty($booking5->status) || ($booking5->status == '2'))
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal5">Bilik Sindiket 5</button>
                                      @else
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal5" disabled>Bilik Sindiket 5</button>
                                      @endif
                            </th>
                            <div class="modal fade" id="ExtralargeModal5" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                              <h5 class="modal-title">Buat Tempahan</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
                                                  @csrf
                                                  <br>
                                                  <div class="col profile-overview"style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                      <h3 class="card-title" style="padding: 0px;">Borang Tempahan Bilik Sindiket 5</i></h3>
                                                      <hr>
                                                      <br>
                                                      <h3 class="card-title" style="padding: 0px;">Maklumat Pelanggan Pengguna</i></h3>
                                                      <br>
                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 label">Nama</label>
                                                          <div class="col-lg-7">
                                                              <input type="text" name="name" class="form-control">
                                                              {!! $errors->first('name', '<small
                                                                  class="text-danger">:message</small>') !!}
                                                          </div>
                                                          <div class="col-lg-1"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalToggle5" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button></div>
                                                        </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Kad Pengenalan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="ic_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Giliran</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="que_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Syarikat/Jabatan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="syarikat_jabatan" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <h3 class="card-title" style="padding: 0px;">Maklumat Pegawai</i></h3>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Nama Pegawai</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="nama_pegawai" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Berurusan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                            <select class="form-control" name="dept" id="dept">
                                                                @foreach ($department as $dpt)
                                                                <option value="{{ $dpt->label }}">
                                                                    {{ $dpt->label }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                      </div>
                                                                
                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Telefon</label>
                                                            <div class="col-lg-0 col-md-1">
                                                                <input type="text" class="form-control" value="+673" readonly>
                                                            </div>
                                                          <div class="col-lg-0 col-md-7">
                                                              <input type="text" name="phone_number" class="form-control" disabled>
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label" hidden>No. Bilik</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="room_no" class="form-control" value="5" hidden>
                                                          </div>
                                                      </div>


                                                      <div class="row">
                                                          <label for="inputText"class="col-lg-4 col-md-3  label">Masa Mula</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
                                                          </div>
                                                      </div>

                                                      <input type="text" id="extranameMain5" name="extranameMain" class="form-control" hidden>
                                                      <input type="text" id="extraic_noMain5" name="extraic_noMain" class="form-control" hidden>
                                                      
                                                      <br>
                                                      <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                      </div>
                                                  </div>
                                                  <!--End of the Card -->
                                                  <br>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                          </form>
                                  </div>
                                </div>
                            </div>
                              <!-- End of Pop Up Form-->
                              <div class="modal fade" id="exampleModalToggle5" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Orang Tambahan</h5> 
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <textarea class="form-control" placeholder="Nama cth. Ali, Abu" id="extraname5" name="extraname5" style="width:50%"></textarea>
                                                <textarea class="form-control" placeholder="No. KP cth. 01234567, 00221547"  id="extraic_no5" name="extraic_no5" style="width:50%"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="saveextra5" name="saveextra5" class="btn btn-primary" data-bs-target="#ExtralargeModal5" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <th scope="row"><img src="/img/meeting-room.png" style="width: 50%"><br>
                            @if(empty($booking6->status) || ($booking6->status == '2'))
                                <a type="button" href="{{ route('adminbooking.systemcalendar') }}" class="btn btn-primary">Bilik Mesyuarat 6</a>
                              @else
                                <a type="button" href="{{ route('adminbooking.systemcalendar') }}" class="btn btn-primary">Bilik Mesyuarat 6</a>
                              @endif
                            </th>

                             <th scope="row"><img src="/img/syndicateroom.png" style="width: 50%"><br>
                            @if(empty($booking7->status) || ($booking7->status == '2'))
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal7">Bilik Sindiket 7</button>
                                      @else
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal7" disabled>Bilik Sindiket 7</button>
                                      @endif
                            </th>
                            <div class="modal fade" id="ExtralargeModal7" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                              <h5 class="modal-title">Buat Tempahan</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
                                                  @csrf
                                                  <br>
                                                  <div class="col profile-overview"style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                      <h3 class="card-title" style="padding: 0px;">Borang Tempahan Bilik Sindiket 7</i></h3>
                                                      <hr>
                                                      <br>
                                                      <h3 class="card-title" style="padding: 0px;">Maklumat Pelanggan Pengguna</i></h3>
                                                      <br>
                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 label">Nama</label>
                                                          <div class="col-lg-7">
                                                              <input type="text" name="name" class="form-control">
                                                              {!! $errors->first('name', '<small
                                                                  class="text-danger">:message</small>') !!}
                                                          </div>
                                                          <div class="col-lg-1"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalToggle5" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button></div>
                                                        </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Kad Pengenalan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="ic_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Giliran</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="que_no" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Syarikat/Jabatan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="syarikat_jabatan" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <h3 class="card-title" style="padding: 0px;">Maklumat Pegawai</i></h3>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Nama Pegawai</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="nama_pegawai" class="form-control">
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">Jabatan Berurusan</label>
                                                          <div class="col-lg-8 col-md-9">
                                                            <select class="form-control" name="dept" id="dept">
                                                                @foreach ($department as $dpt)
                                                                <option value="{{ $dpt->label }}">
                                                                    {{ $dpt->label }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                      </div>
                                                                
                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label">No. Telefon</label>
                                                            <div class="col-lg-0 col-md-1">
                                                                <input type="text" class="form-control" value="+673" readonly>
                                                            </div>
                                                          <div class="col-lg-0 col-md-7">
                                                              <input type="text" name="phone_number" class="form-control" disabled>
                                                          </div>
                                                      </div>

                                                      <br>

                                                      <div class="row">
                                                          <label for="inputText" class="col-lg-4 col-md-3  label" hidden>No. Bilik</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="room_no" class="form-control" value="7" hidden>
                                                          </div>
                                                      </div>


                                                      <div class="row">
                                                          <label for="inputText"class="col-lg-4 col-md-3  label">Masa Mula</label>
                                                          <div class="col-lg-8 col-md-9">
                                                              <input type="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
                                                          </div>
                                                      </div>

                                                      <input type="text" id="extranameMain7" name="extranameMain" class="form-control" hidden>
                                                      <input type="text" id="extraic_noMain7" name="extraic_noMain" class="form-control" hidden>
                                                      
                                                      <br>
                                                      <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                      </div>
                                                  </div>
                                                  <!--End of the Card -->
                                                  <br>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                          </form>
                                  </div>
                                </div>
                            </div>
                              <!-- End of Pop Up Form-->
                              <div class="modal fade" id="exampleModalToggle7" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Orang Tambahan</h5> 
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <textarea class="form-control" placeholder="Nama cth. Ali, Abu" id="extraname7" name="extraname7" style="width:50%"></textarea>
                                                <textarea class="form-control" placeholder="No. KP cth. 01234567, 00221547"  id="extraic_no7" name="extraic_no7" style="width:50%"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="saveextra7" name="saveextra7" class="btn btn-primary" data-bs-target="#ExtralargeModal7" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        </tr>
                      </tbody>
                  </table>
                  <br><br>
                  <table class="table table-bordered table-light" style="text-align: center; vertical-align: middle;">
                      <tbody>
                        <tr style="height: 50px;">
                            <th scope="row">Kaunter 6 <br> DA</th>
                            <th scope="row">Kaunter 7 <br> MAW</th>
                            <th scope="row">Kaunter 8 <br> MAW</th>
                            <th scope="row">Kaunter 9  <br>JSS</th>
                            <th scope="row">Kaunter 10 <br> JSS</th>
                            <th scope="row">Kaunter 12 <br> JPT</th>
                        </tr>
                      </tbody>
                  </table>
                  </div>
<br><br>


            <div class="card">
            <div class="card-body">
            <h5 class="card-title">Bilik Sindiket</h5>
            <div class="col" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
              <!-- Bordered Tabs Justified -->
              <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="s1-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-s1" type="button" role="tab" aria-controls="s1" aria-selected="true">Bilik Sindiket 1</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="s2-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-s2" type="button" role="tab" aria-controls="s2" aria-selected="false">Bilik Sindiket 2</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="s3-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-s3" type="button" role="tab" aria-controls="s3" aria-selected="false">Bilik Sindiket 3</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="s4-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-s4" type="button" role="tab" aria-controls="s4" aria-selected="false">Bilik Sindiket 4</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="s5-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-s5" type="button" role="tab" aria-controls="s5" aria-selected="false">Bilik Sindiket 5</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="s7-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-s7" type="button" role="tab" aria-controls="s7" aria-selected="false">Bilik Sindiket 7</button>
                </li>
                @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_OSCROOM'))
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="s8-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-s8" type="button" role="tab" aria-controls="s8" aria-selected="false">Admin Bilik Sindiket</button>
                </li>
                @endif
                @endif
                @if (Auth::check())
                @if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_OSCROOM'))
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="s9-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-s9" type="button" role="tab" aria-controls="s9" aria-selected="false">Sejarah Bilik Sindiket</button>
                </li>
                @endif
                @endif
                
              </ul>
              <div class="tab-content pt-2 overflow-auto" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-s1" role="tabpanel" aria-labelledby="s1-tab">
                <table class="table table-borderless mt-3">
                    <thead>
                        <h3>Sejarah Tempahan</h3>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">No. Bilik</th>
                            <th scope="col">No. Giliran</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Telefon</th>
                            <th scope="col">Masa Mula</th>
                            <th scope="col">Masa Tamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($bookings) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>Tiada rekod dijumpai</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($bookings as $booking)
                        @if(($booking->room_no == "1") && ( date('Y-m-d', strtotime($booking->start_time)) == date('Y-m-d', strtotime($today))))
                        
                        <tr>

                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->ic_no }}</td>
                            <td>Bilik Sindiket {{ $booking->room_no }}</td>

                            <td>{{ $booking->que_no }}</td>
                            <td>{{  $booking->dept }}</td>
                            <td>{{ $booking->phone_number}}</td>
                            <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>

                            @if ($booking -> end_time == null)
                            <td><a href="{{ route('bookings.booking.update', $booking1->id ) }}"
                                    class="btn btn-outline-danger">Tamat</a></td>
                            @else
                            <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        @endif
                        

                    </tbody>
                </table>
                </div>
                <div class="tab-pane fade" id="bordered-justified-s2" role="tabpanel" aria-labelledby="s2-tab">
                <table class="table table-borderless mt-3">
                    <thead>
                        <h3>Sejarah Tempahan</h3>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">No. Bilik</th>
                            <th scope="col">No. Giliran</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Telefon</th>
                            <th scope="col">Masa Mula</th>
                            <th scope="col">Masa Tamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($bookings) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>Tiada rekod dijumpai</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($bookings as $booking)
                        @if(($booking->room_no == "2") && ( date('Y-m-d', strtotime($booking->start_time)) == date('Y-m-d', strtotime($today))))
                        
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->ic_no }}</td>
                            <td>Bilik Sindiket {{ $booking->room_no }}</td>

                            <td>{{ $booking->que_no }}</td>
                            <td>{{  $booking->dept }}</td>
                            <td>{{ $booking->phone_number}}</td>
                            <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>

                            @if ($booking -> end_time == null)
                            <td><a href="{{ route('bookings.booking.update', $booking2->id ) }}"
                                    class="btn btn-outline-danger">Tamat</a></td>
                            @else
                            <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
                </div>
                <div class="tab-pane fade" id="bordered-justified-s3" role="tabpanel" aria-labelledby="s3-tab">
                <table class="table table-borderless mt-3">
                    <thead>
                        <h3>Sejarah Tempahan</h3>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">No. Bilik</th>
                            <th scope="col">No. Giliran</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Telefon</th>
                            <th scope="col">Masa Mula</th>
                            <th scope="col">Masa Tamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($bookings) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>Tiada rekod dijumpai</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($bookings as $booking)
                        @if(($booking->room_no == "3") && ( date('Y-m-d', strtotime($booking->start_time)) == date('Y-m-d', strtotime($today))))
                        
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->ic_no }}</td>
                            <td> Bilik Sindiket {{ $booking->room_no }}</td>

                            <td>{{ $booking->que_no }}</td>
                            <td>{{  $booking->dept }}</td>
                            <td>{{ $booking->phone_number}}</td>
                            <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>

                            @if ($booking -> end_time == null)
                            <td><a href="{{ route('bookings.booking.update', $booking3->id ) }}"
                                    class="btn btn-outline-danger">Tamat</a></td>
                            @else
                            <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
                </div>
                <div class="tab-pane fade" id="bordered-justified-s4" role="tabpanel" aria-labelledby="s4-tab">
                <table class="table table-borderless mt-3">
                    <thead>
                        <h3>Sejarah Tempahan</h3>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">No. Bilik</th>
                            <th scope="col">No. Giliran</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Telefon</th>
                            <th scope="col">Masa Mula</th>
                            <th scope="col">Masa Tamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($bookings) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>Tiada rekod dijumpai</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($bookings as $booking)
                        @if(($booking->room_no == "4") && ( date('Y-m-d', strtotime($booking->start_time)) == date('Y-m-d', strtotime($today))))
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->ic_no }}</td>
                            <td> Bilik Sindiket {{$booking->room_no }}</td>

                            <td>{{ $booking->que_no }}</td>
                            <td>{{  $booking->dept }}</td>
                            <td>{{ $booking->phone_number}}</td>
                            <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>

                            @if ($booking -> end_time == null)
                            <td><a href="{{ route('bookings.booking.update', $booking4->id ) }}"
                                    class="btn btn-outline-danger">Tamat</a></td>
                            @else
                            <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
                </div>
                <div class="tab-pane fade" id="bordered-justified-s5" role="tabpanel" aria-labelledby="s5-tab">
                <table class="table table-borderless mt-3">
                    <thead>
                        <h3>Sejarah Tempahan</h3>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">No. Bilik</th>
                            <th scope="col">No. Giliran</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Telefon</th>
                            <th scope="col">Masa Mula</th>
                            <th scope="col">Masa Tamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($bookings) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>Tiada rekod dijumpai</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($bookings as $booking)
                        @if(($booking->room_no == "5") && ( date('Y-m-d', strtotime($booking->start_time)) == date('Y-m-d', strtotime($today))))
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->ic_no }}</td>
                            <td>Bilik Sindiket {{ $booking->room_no }}</td>

                            <td>{{ $booking->que_no }}</td>
                            <td>{{ $booking->dept }}</td>
                            <td>{{ $booking->phone_number}}</td>
                            <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>

                            @if ($booking -> end_time == null)
                            <td><a href="{{ route('bookings.booking.update', $booking5->id ) }}"
                                    class="btn btn-outline-danger">Tamat</a></td>
                            @else
                            <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
                </div>
                <div class="tab-pane fade" id="bordered-justified-s7" role="tabpanel" aria-labelledby="s7-tab">
                <table class="table table-borderless mt-3">
                    <thead>
                        <h3>Sejarah Tempahan</h3>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">No. Bilik</th>
                            <th scope="col">No. Giliran</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Telefon</th>
                            <th scope="col">Masa Mula</th>
                            <th scope="col">Masa Tamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($bookings) == 0)
                       
                        <tr class="text-center">
                            <td colspan="8">
                                <h5>Tiada rekod dijumpai</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($bookings as $booking)
                         @if(($booking->room_no == "7") && ( date('Y-m-d', strtotime($booking->start_time)) == date('Y-m-d', strtotime($today))))
                        
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->ic_no }}</td>
                            <td>Bilik Sindiket {{ $booking->room_no }}</td>

                            <td>{{ $booking->que_no }}</td>
                            <td>{{ $booking->dept }}</td>
                            <td>{{ $booking->phone_number}}</td>
                            <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>

                            @if (($booking->room_no == "7") && ($booking -> end_time == null))
                            <td><a href="{{ route('bookings.booking.update', $booking7->id ) }}"
                                    class="btn btn-outline-danger">Tamat</a></td>
                            @else
                            <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        @endif
                        
                    </tbody>
                </table>
                </div>

                <div class="tab-pane fade" id="bordered-justified-s8" role="tabpanel" aria-labelledby="s8-tab">
                <table class="table table-borderless mt-3">
                    <thead>
                        <h3>Sejarah Tempahan</h3>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">No. Bilik</th>
                            <th scope="col">No. Giliran</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Telefon</th>
                            <th scope="col">Masa Mula</th>
                            <th scope="col">Masa Tamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($bookings) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>Tiada rekod dijumpai</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($bookings as $booking)
                        @if(($booking->end_time == null))
                        
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->ic_no }}</td>
                            <td>Bilik Sindiket {{ $booking->room_no }}</td>

                            <td>{{ $booking->que_no }}</td>
                            <td>{{  $booking->dept }}</td>
                            <td>{{ $booking->phone_number}}</td>
                            <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>

                            @if ($booking -> end_time == null)
                            <td><a href="{{ route('bookings.booking.update', $booking->id ) }}"
                                    class="btn btn-outline-danger">Tamat</a></td>
                            @else
                            <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
                </div>

                <div class="tab-pane fade" id="bordered-justified-s9" role="tabpanel" aria-labelledby="s9-tab">
                <table class="table table-borderless mt-3">
                    <thead>
                        <h3>Sejarah Tempahan</h3>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No. KP</th>
                            <th scope="col">No. Bilik</th>
                            <th scope="col">No. Giliran</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">No. Telefon</th>
                            <th scope="col">Masa Mula</th>
                            <th scope="col">Masa Tamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($bookings) == 0)

                        <tr class="text-center">
                            <td colspan="8">
                                <h5>Tiada rekod dijumpai</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($bookings as $booking)
                        
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->ic_no }}</td>
                            <td>Bilik Sindiket {{ $booking->room_no }}</td>

                            <td>{{ $booking->que_no }}</td>
                            <td>{{  $booking->dept }}</td>
                            <td>{{ $booking->phone_number}}</td>
                            <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>
                            <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                            
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                </div>

              </div><!-- End Bordered Tabs Justified -->
            </div>
            </div>
            </div>

    </div>
    </div>

    </div>
    </section>



<script>
    $('#saveextra').on('click',function(){

        var name = $('#extraname').val();
        var icno = $('#extraic_no').val();

        $('#extranameMain').val(name);
        $('#extraic_noMain').val(icno);
    })
    $('#saveextra2').on('click',function(){

         var name2 = $('#extraname2').val();
         var icno2 = $('#extraic_no2').val();

         $('#extranameMain2').val(name2);
         $('#extraic_noMain2').val(icno2);
    })
    $('#saveextra3').on('click',function(){

        var name3 = $('#extraname3').val();
        var icno3 = $('#extraic_no3').val();

        $('#extranameMain3').val(name3);
        $('#extraic_noMain3').val(icno3);
    })
    $('#saveextra4').on('click',function(){

        var name4 = $('#extraname4').val();
        var icno4 = $('#extraic_no4').val();

        $('#extranameMain4').val(name4);
        $('#extraic_noMain4').val(icno4);
    })  
    $('#saveextra5').on('click',function(){

        var name5 = $('#extraname5').val();
        var icno5 = $('#extraic_no5').val();

        $('#extranameMain5').val(name5);
        $('#extraic_noMain5').val(icno5);
    })
    $('#saveextra7').on('click',function(){

        var name7 = $('#extraname7').val();
        var icno7 = $('#extraic_no7').val();

        $('#extranameMain7').val(name7);
        $('#extraic_noMain7').val(icno7);
    })    
</script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


@endsection