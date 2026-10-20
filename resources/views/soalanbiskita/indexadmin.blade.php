@extends('layouts.app-all')

@section('title', 'Tanya? MOEBN')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

  <?php 
    $pagename = "Tanya MOEBN";
  ?>

    <div class="pagetitle">
      <h1>Tanya? @MOEBN</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Tanya @MOEBN</li>  
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="row mb-2">
           
    <div class="col-md-12" style="text-align: right;">
        <a href="{{ route('soalanbiskita.soalanbiskita.editperkara') }}" class= "btn btn-primary text-right">
              Edit Perkara
        </a>
        
        <a href="{{ route('soalanbiskita.soalanbiskita.jabatanlist') }}" class= "btn btn-primary text-right">
              Edit Jabatan
        </a>
      </div>

</div>

<section class="section profile">

  <div class="col-md-12">

    @if(Session::has('success_message'))
      <div class="alert alert-success">
          <i class=" fas fa-fw fa-check"></i>
          {!! session('success_message') !!}
      </div>
    @endif

    <!-- ACT Table -->
 
    <div class="col-12">
      <div class="card recent-sales">
        <div class="card-body overflow-auto">

            <table class="table table-borderless datatable mt-3">
              <thead>
                <tr>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Tajuk</th>
                  <th scope="col">Aduan</th>
                  <th scope="col">Nama</th>
                  <th scope="col">No.Tel</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>

                
                </tr>
              </thead>
              <tbody>
  
              @if(count($soalanbiskitas) == 0)

                <tr class="text-center">
                    <td colspan="8">
                        <h5>No records found</h5>
                    </td>
                </tr>

              @else

              @foreach($soalanbiskitas as $soalanbiskita)
              <tr>
                <td>{{ $soalanbiskita->kpd_jabatan }}</td>
                <td>{{ $soalanbiskita->tajuk }}</td>
                <td>{{ $soalanbiskita->aduan }}</td>
                <td>{{ $soalanbiskita->nama }}</td>
                <td>{{ $soalanbiskita->no_tel }}</td>

                @if ($soalanbiskita->status == null)
                <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tindakanDialog">
                <i class="bi bi-chat-left-fill"></i>
                </button>

                <!-- Dialog Box Start-->

                <div class="modal" tabindex="-1" role="dialog" id="tindakanDialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Mesej Hantaran</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form action="{{ route('soalanbiskita.soalanbiskita.tindakan') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                <input type="text" name="id" value="{{ $soalanbiskita->id }}" class="form-control" hidden>
                                <input type="text" name="no_tel" value="{{ $soalanbiskita->no_tel }}" class="form-control" hidden>
                                    <label for="mesej">Message</label>
                                    <textarea class="form-control " name="mesej" id="mesej"></textarea>
                                </div>
                                <div class="text-center">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

                <!-- Dialog Box End -->
                <a  href="{{ route('soalanbiskita.soalanbiskita.selesai', $soalanbiskita->id) }}" class=" btn btn-success bi bi-check-all"  data-bs-placement="top" title="Read"></a>
                </td>
                @elseif ($soalanbiskita->status == "tindakan")
                <td><span class="badge bg-primary">Replied</span></td>
                @else
                <td><span class="badge bg-success">Read</span></td>
                @endif
                <td>

          

                   <!----Edit Button----->
                    <form method="get" action="{{ route('soalanbiskita.soalanbiskita.show', $soalanbiskita->id ) }}">
                  @csrf
                    <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-pencil-fill"></i>
                    </button>
                  </form>

                   <!----Delete Button----->
                  <form method="post" action="{{ route('soalanbiskita.soalanbiskita.destroy', $soalanbiskita->id ) }}">
                     @csrf  @method('delete')
                    <a onclick='return confirm("Confirm to delete data?")'> <button type="submit" class="btn btn-outline-danger" > <i class="bi bi-trash-fill"></i></button>
                  </form>
                

            
              </tr>
              @endforeach
              @endif

              </tbody>
            </table>

        </div>
      </div>
    </div><!-- End Recent Sales -->
    <div class="col-12">



</section>

{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection