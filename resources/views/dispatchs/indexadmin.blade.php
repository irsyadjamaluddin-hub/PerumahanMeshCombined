@extends('layouts.app-all')

@section('title', 'Admin e-Despatch')

@section('content')

<?php
$pagename = "DIS";
?>

<img src="/img/med.jpeg">

<style>                
.dataTable-info{
    color: white;
}
</style>

<section class="section">
  <div class="row">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
      <i class=" fas fa-fw fa-check"></i>
      {!! session('success_message') !!}
    </div>
    @endif


    <div class="col-lg-12 mt-2">

        <a href="{{ route('dispatchs.dis.mecuser') }}" class="btn btn-primary">
        <i class="ri-user-add-fill"></i>
        </a>

        <a href="{{ route('dispatchs.dis.untukperhatian') }}" class="btn btn-primary"> 
        UP
        </a>

    </div>
    <div class="card mt-3">
      <div class="card-body pt-3">

        <!-- Bordered Tabs -->

        <ul class="nav nav-tabs nav-tabs-bordered">

        <li class="nav-item">
          <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#profile-in">IN</button>
        </li>

        <li class="nav-item">
          <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-salinan">SALINAN</button>
        </li>
        </ul>

        <br>
        <!-- Clsoe Bordered Tabs -->

   <!-- IN -->
   <div class ="tab-content pt-2">

      <div class="tab-pane fade show active profile-in" id="profile-in">


        <div class="card-body overflow-auto">

          <table class="table table-borderless datatable mt-3">
            <thead>
              <tr>
                <th scope="col">Jenis</th>
                <th scope="col">Perkara</th>
                <th scope="col">Ruj.Persuratan</th>
                <th scope="col">Untuk Perhatian</th>
                <th scope="col">Daripada</th>
                <th scope="col">Dokumen</th> 
                <th scope="col">Kepada</th>                

                <th scope="col">Tarikh Menerima</th>
                <th scope="col">Tindakan</th>
              </tr>
            </thead>

            <tbody>
              @if(count($dispatchs) == 0)
              <tr class="text-center">
                <td colspan="8">
                  <h5>No records found</h5>
                </td>
              </tr>

              @else
              @foreach($dispatchs as $dispatch)
              @php $kpds=$dispatch->kpd ? json_decode($dispatch->kpd, true) : []; @endphp

              <tr>
                <td>{{ optional($dispatch->jenis)->label }}</td>
                <td>{{$dispatch->perkara}}</td>
                <td>{{ $dispatch->rp }}</td>
                <td>{{optional($dispatch->Untukperhatian)->kod}}</td>
               <td>{{ optional($dispatch->Daripada)->label }}</td>

                   <td>
                      @if(is_array($dispatch->lamp) && count($dispatch->lamp) > 0)
                          @foreach($dispatch->lamp as $index => $filename)
                              <a href="{{ Storage::url($filename) }}" target="_blank">
                                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top">
                                      <i class="bi bi-collection"></i>
                                  </button>
                              </a>
                          @endforeach
                      @else
                          <p>No file chosen</p>
                      @endif
                  </td>


              @foreach($employments as $employment)
    <input type="text" value="{{ optional($employment->department)->label }}" hidden>
@endforeach

            <td>
                @if (!is_null($dispatch->kpd))
                    @foreach (json_decode($dispatch->kpd) as $kpds)
                        @php
                            $statusmemoArray1 = json_decode($dispatch->statusmemo1);
                            $isSelected = is_array($statusmemoArray1) && in_array($kpds, $statusmemoArray1);
                        @endphp

                        @if ($isSelected)
                            <i class="bi bi-check-all text-primary"></i>
                        @else
                        @if ($kpds === optional($employment->department)->label)
                              <a href="{{ route('dispatchs.dis.terimamemo1', ['dis' => $dispatch->id, 'selected_value' => $kpds]) }}">
                                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Please Click to Receive">
                                      <i class="bi bi-exclamation-diamond-fill"></i>
                                  </button>
                              </a>
                          @else
                              <a href="#">
                                  <button type="button" class="btn btn-secondary btn-sm disabled">
                                      <i class="bi bi-exclamation-diamond-fill"></i>
                                  </button>
                              </a>
                          @endif


                        @endif
                        &nbsp;{{ $kpds }}
                        <br>
                    @endforeach
                @endif
            </td>


              


                @if ($dispatch->dispatch_recieved_at == null)
                <td><a href="{{ route('dispatchs.dis.terima', $dispatch->id) }}" class="btn btn-success">Terima</a></td>
                @else
                <td>{{ date('d/m/Y', strtotime($dispatch->dispatch_recieved_at)) }}</td>
                @endif

                <td>
                  <div class="btn-group gap-2" role="group" aria-label="Basic example">

                    <!----Edit Button----->
                    <form method="get" action="{{ route('dispatchs.dis.editadmin', $dispatch->id ) }}">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                      </button>
                    </form>

                    <!----Show Button----->
                    <form method="get" action="{{ route('dispatchs.dis.showadmin', $dispatch->id) }}">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-eye-fill"></i>
                      </button>
                    </form>

                    <!----Delete Button----->
                    <form method="post" action="{{ route('dispatchs.dis.destroyadmin', $dispatch->id ) }}">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-outline-danger">
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

      <!-- end IN Tab -->

      <div class="tab-pane fade profile-salinan pt-2" id="profile-salinan">


      <div class="card-body overflow-auto">

          <table class="table table-borderless datatable mt-3">
              <thead>
                  <tr>
                      <th scope="col">Jenis</th>
                      <th scope="col">Daripada</th>
                      <th scope="col">Kepada</th>
                      <th scope="col">Untuk Perhatian</th>
                      <th scope="col">Perkara</th>
                      <th scope="col">Rujukan Persuratan</th>
                      <th scope="col">Dokumen</th>
                      <th scope="col">Tarikh</th>
                      <th scope="col">Recieved Status</th>
                  </tr>
              </thead>

              <tbody>
                  @if(count($dispatchs) == 0)
                  <tr class="text-center">
                      <td colspan="8">
                          <h5>No records found</h5>
                      </td>
                  </tr>

                  @else

            
                          @foreach($dispatchs as $dispatch)
                          <?php $kpds = $dispatch->kpd ? json_decode($dispatch->kpd, true) : []; ?>

                          <tr>
                              <td>{{ optional($dispatch->jenis)->label }}</td>
                              <td>{{ optional($dispatch->Daripada)->label }}</td>
                              <td>
                                  @if ($kpds)
                                      @foreach ($kpds as $kpd)
                                          &nbsp;{{ $kpd }}
                                          <br>
                                      @endforeach
                                  @endif
                              </td>
                          <td>{{ $dispatch->up }}</td>
                          <td>{{ $dispatch->perkara }}</td>
                          <td>{{ $dispatch->rp }}</td>

                          <td>
                              @if(is_array($dispatch->lamp) && count($dispatch->lamp) > 0)
                                  @foreach($dispatch->lamp as $index => $filename)
                                      <a href="{{ Storage::url($filename) }}" target="_blank">
                                          <button type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top">
                                              <i class="bi bi-collection"></i>
                                          </button>
                                      </a>
                                  @endforeach
                              @else
                                  <p>No file chosen</p>
                              @endif
                          </td>





              <td>{{ $dispatch->created_at }}</td>

                @foreach($employments as $employment)
                    <input type="text" value="{{ optional($employment->department)->label }}" hidden>
                @endforeach


              <td>
                  @if (!is_null($dispatch->salinankpd))
                      @foreach (json_decode($dispatch->salinankpd) as $salinankpds)
                          @php
                              $statusmemoArray = json_decode($dispatch->statusmemo);
                              $isSelected = is_array($statusmemoArray) && in_array($salinankpds, $statusmemoArray);
                          @endphp



                          @if ($isSelected)
                              <i class="bi bi-check-all text-primary"></i>
                          @else

                             @if ($salinankpds === optional($employment->department)->label)
                                <a href="{{ route('dispatchs.dis.terimamemo', ['dis' => $dispatch->id, 'selected_value' => $salinankpds]) }}">
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Please Click to Receive">
                                        <i class="bi bi-exclamation-diamond-fill"></i>
                                    </button>
                                </a>
                            @else
                                <a href="#">
                                    <button type="button" class="btn btn-secondary btn-sm disabled">
                                        <i class="bi bi-exclamation-diamond-fill"></i>
                                    </button>
                                </a>
                            @endif
                          
                          @endif
                          &nbsp;{{ $salinankpds }}
                          <br>
                      @endforeach
                  @endif
              </td>

              
        


            
            </tr>

                  @endforeach
                  @endif

              </tbody>
          </table>

</div>









    </div>
  </div>

@endsection