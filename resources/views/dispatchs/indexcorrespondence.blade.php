@extends('layouts.app-all')

@section('title', 'e-Correspondence')

@section('content')

<?php
$pagename = "MEC";
?>

<img src="/img/mec.jpeg">

<style>                
.dataTable-info{
    color: white;
}
</style>

@if(Session::has('success_message'))
    <div class="alert alert-success">
      <i class=" fas fa-fw fa-check"></i>
      {!! session('success_message') !!}
    </div>
@endif

    <div class="col-12 mb-2 mt-2" style="text-align: right;">
      <a href="{{ route('dispatchs.dis.createmec') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
      </a>
    </div>

<section class="section">
  <div class="row">



    <div class="card mt-3">
      <div class="card-body pt-3">
      <div class ="tab-content pt-2">

            <div class="tab-pane fade show active profile-reciever" id="profile-reciever">
            
                <div class="overflow-auto" >
                  
                    <table class="table table-borderless datatable mt-3" id="tablereciever">
                      
                        <thead> 
                            <tr>
                                <th scope="col">Jenis</th>
                                <th scope="col">No.Rujukan</th>
                                <th scope="col">Kepada</th>
                                <th scope="col">Perkara</th>
                                <th scope="col">Tarikh</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
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

                      <tr>

                     
                        <td>{{ optional($dispatch->jenis)->label }}</td>
                        <td>{{$dispatch->no_folio}}</td>

                          <?php $kpds = $dispatch->kpd ? json_decode($dispatch->kpd, true) : []; ?>
                        <td>
                                  @if ($kpds)
                                      @foreach ($kpds as $kpd)
                                          &nbsp;{{ $kpd }}
                                          <br>
                                      @endforeach
                                  @endif
                          </td>

                        <td>{{$dispatch->perkara}}</td>

                        <td>{{ date('d/m/Y', strtotime($dispatch->date_admin_submit)) }}</td>

                        <td>
                            @php
                            $statusRecords = \App\Models\DispatchPassMec::pluck('status')->all();

                            @endphp

                            
                                @if (in_array($dispatch->dispatch_infos_id, $statusRecords))
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-warning">Proses</span>
                                @endif
                            
                        </td>


                          <td>
                            
                            <div class="btn-group gap-2" role="group" aria-label="Basic example">

                              <!----Editflow mec Button----->
                              <form method="get" action="{{ route('dispatchs.dis.editflowcorrespondence', $dispatch->id ) }}">
                                    @csrf
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-collection-fill"></i>
                                        </button>
                                  </form>

                              <!----Show Button----->
                              <form method="get" action="{{ route('dispatchs.dis.showcorrespondence', $dispatch->id ) }}">
                                  @csrf
                                      <button type="submit" class="btn btn-outline-primary">
                                          <i class="bi bi-eye-fill"></i>
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
        
 

    

</div>
</div>

</div>
</section>
@endsection