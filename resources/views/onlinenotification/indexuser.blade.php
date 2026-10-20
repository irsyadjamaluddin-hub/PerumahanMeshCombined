@extends('layouts.app-all')

@section('title', 'MESH Perkhidmatan Notifikasi')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- #============= ORI CODE ============== --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: shared styles in public/css/mesh-home-theme.css, --}}
{{-- applied to everything inside the mesh-home-theme wrapper below. Light mode is unchanged. --}}
{{-- <link href="{{ asset('css/mesh-home-theme.css') }}?v={{ filemtime(public_path('css/mesh-home-theme.css')) }}" rel="stylesheet"> --}}
{{-- #================================ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" section; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
{{-- #================================ --}}
<style>
  /* Form outline (set inline in navy) */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme .profile-overview[style*="border"] { border-color: #4a3590 !important; }
</style>
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "OnlineNotification";
?>

<div class="pagetitle">
    <h1>MESH Perkhidmatan Notifikasi </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Laman Utama</a></li>
            <li class="breadcrumb-item">Pengguna</li>
            <li class="breadcrumb-item active">MESH Perkhidmatan Notifikasi</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    
    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    @if(Session::has('error_message'))
    <div class="alert alert-danger">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('error_message') !!}
    </div>
    @endif

    <div class="col-12">

        <div class="card recent-sales">

            <div class="card-body">

                <div class="profile-overview pt-3">
                    <form method="post" action="{{ route('onlinenotifications.onlinenotification.send') }}" enctype="multipart/form-data">
                    @csrf
                    <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h3 class="card-title"style="padding: 0px;">Maklumat M.P.N</i></h3>
                        <hr>
                        <br>

                        @foreach ($userdetails as $userdetail)
                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Jabatan</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="jabatan" class="form-control" value="{{$userdetail->label}}" readonly>
                            </div>
                        </div>
                        @endforeach

                        <div id="phoneNumbers">
                            <div class="row">
                                <label for="inputText" class="col-lg-2 col-md-3  label">No Penerima</label>
                                <div class="col-lg-0 col-md-1">
                                    <input type="text" class="form-control" value="+673" readonly>
                                </div>
                                <div class="col-lg-0 col-md-8">
                                    <input type="text" name="phone_numbers[]" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="text-center" style="padding-bottom:10px;">
                            <button type="button" class="btn btn-primary"id="addPhoneNumber">Tambah Nombor Telefon</button>
                        </div>
                        
                        <script>
                            document.getElementById('addPhoneNumber').addEventListener('click', function () {
                                const phoneNumbersDiv = document.getElementById('phoneNumbers');
                                const newPhoneNumberDiv = document.createElement('div');
                                newPhoneNumberDiv.classList.add('row');

                                newPhoneNumberDiv.innerHTML = `
                                    <label for="inputText" class="col-lg-2 col-md-3  label"></label>
            
                                    <div class="col-lg-0 col-md-1">
                                        <input type="text" class="form-control" value="+673" readonly>
                                    </div>
                                    <div class="col-lg-0 col-md-8">
                                        <input type="text" name="phone_numbers[]" class="form-control">
                                    </div>

                                    <div class="col-lg-0 col-md-1">
                                        <button type="button" class="btn btn-danger removePhoneNumber">Buang</button>
                                    </div>
                                `;
                                phoneNumbersDiv.appendChild(newPhoneNumberDiv);

                                // Attach the event listener for the remove button
                                newPhoneNumberDiv.querySelector('.removePhoneNumber').addEventListener('click', function () {
                                    phoneNumbersDiv.removeChild(newPhoneNumberDiv);
                                });
                            });

                            // Attach the event listener for the initial remove button
                            document.querySelectorAll('.removePhoneNumber').forEach(button => {
                                button.addEventListener('click', function () {
                                    const row = this.parentElement.parentElement;
                                    document.getElementById('phoneNumbers').removeChild(row);
                                });
                            });

                            document.querySelector('form').addEventListener('submit', function () {
                                const phoneNumbers = Array.from(document.querySelectorAll('input[name="phone_numbers[]"]'))
                                                        .map(input => input.value)
                                                        .filter(value => value.trim() !== '');

                                document.getElementById('allPhoneNumbers').value = phoneNumbers.join(',');
                            });
                        </script>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Perkara</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" name="title" class="form-control">
                            </div>
                        </div>

                        <div class="row">
    <label for="inputText" class="col-lg-2 col-md-3 label">Teks</label>
    <div class="col-lg-9 col-md-9">
        <textarea 
            name="message" 
            rows="5" 
            class="form-control" 
            placeholder="Perenggan 1" 
            maxlength="400" 
            required 
            onkeydown="if (event.key === 'Enter') event.preventDefault();" 
            {{-- #============= ORI CODE ============== --}}
            {{-- oninput="document.getElementById('charCountVal1').innerText = this.value.length + ' / 400 aksara';"></textarea> --}}
            {{-- #================================ --}}
            oninput="document.getElementById('charCountVal1').innerText = this.value.length + ' / 400 huruf';"></textarea>
            {{-- #================================ --}}
        {{-- #============= ORI CODE ============== --}}
        {{-- <div id="charCountVal1">0 / 400 aksara</div> --}}
        {{-- #================================ --}}
        <div id="charCountVal1">0 / 400 huruf</div>
        {{-- #================================ --}}
    </div>
</div>



<div class="row">
    <label for="inputText" class="col-lg-2 col-md-3 label"></label>
    <div class="col-lg-9 col-md-9">
        <textarea 
            name="additionalmessage" 
            rows="5" 
            class="form-control" 
            placeholder="Perenggan 2" 
            maxlength="400" 
            required 
            onkeydown="if (event.key === 'Enter') event.preventDefault();" 
            {{-- #============= ORI CODE ============== --}}
            {{-- oninput="document.getElementById('charCountVal2').innerText = this.value.length + ' / 400 aksara';"></textarea> --}}
            {{-- #================================ --}}
            oninput="document.getElementById('charCountVal2').innerText = this.value.length + ' / 400 huruf';"></textarea>
            {{-- #================================ --}}
        {{-- #============= ORI CODE ============== --}}
        {{-- <div id="charCountVal2">0 / 400 aksara</div> --}}
        {{-- #================================ --}}
        <div id="charCountVal2">0 / 400 huruf</div>
        {{-- #================================ --}}
    </div>
</div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">Fail</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                        <br>

                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Hantar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-12">
        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body overflow-auto">


                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Jabatan</th>
                                <th scope="col">No Penerima</th>
                                <th scope="col">Perkara</th>
                                <th scope="col">No IC Penghantar</th>
                                <th scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>

                           
                        
                        @if(count($onlinenotif) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>Tiada rekod dijumpai</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($onlinenotif as $ons)   

                            <tr>
                                
                                <td>{{ $ons->jabatan }}</td>
                                <td>{{ $ons->phone_number }}</td>
                                <td>{{ $ons->title }}</td>
                                <td>{{ $ons->sender_icno }}</td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Contoh Asas">

                                        <!----View Button----->
                                        <form method="get" action="{{ route('onlinenotifications.onlinenotification.userview',  $ons->id)}}">
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
        </div><!-- End Recent Sales -->

    </div>

<script>
function CharacterCount1(object){
    // #============= ORI CODE ==============
    // document.getElementById("charCountVal1").innerHTML = object.value.length+' / 400 aksara';
    // #================================
    document.getElementById("charCountVal1").innerHTML = object.value.length+' / 400 huruf';
    // #================================
}
</script>

<script>
function CharacterCount2(object){
    // #============= ORI CODE ==============
    // document.getElementById("charCountVal2").innerHTML = object.value.length+' / 400 aksara';
    // #================================
    document.getElementById("charCountVal2").innerHTML = object.value.length+' / 400 huruf';
    // #================================
}
</script>

{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
    @endsection