@extends('layouts.app-all')

@section('title', 'Create Message')

@section('content')

<?php
$pagename = "Online Notification Service";
?>

<div class="pagetitle">
  <h1>Send a Notification</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Online Notification Form</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

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




<section class="section profile">

    <div class="col-12">

        <div class="card recent-sales">

            <div class="card-body">

                <div class="profile-overview pt-3">
                    <form method="post" action="{{ route('onlinenotifications.onlinenotification.save') }}" enctype="multipart/form-data">
                    @csrf
                    <br>
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                        <h3 class="card-title"style="padding: 0px;">Maklumat O.N.S</i></h3>
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
                            <button type="button" class="btn btn-primary"id="addPhoneNumber">Add Phone Number</button>
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
                                        <button type="button" class="btn btn-danger removePhoneNumber">Remove</button>
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
                            <label for="inputText" class="col-lg-2 col-md-3  label">Text</label>
                            <div class="col-lg-9 col-md-9">
                                <textarea type="text" name="message" row="5" onkeyup="CharacterCount1(this)" class="form-control" placeholder="Para 1" maxlength="400" required></textarea>
                                <div id="charCountVal1">0 / 400 characters</div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label"></label>
                            <div class="col-lg-9 col-md-9">
                                <textarea type="text" name="additionalmessage" row="5" onkeyup="CharacterCount2(this)" placeholder="Para 2" class="form-control" maxlength="400" required></textarea>
                                <div id="charCountVal2">0 / 400 characters</div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="inputText" class="col-lg-2 col-md-3  label">File</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                        <br>

                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  
</section>

<script>
function CharacterCount1(object){
    document.getElementById("charCountVal1").innerHTML = object.value.length+' characters';
}
</script>

<script>
function CharacterCount2(object){
    document.getElementById("charCountVal2").innerHTML = object.value.length+' characters';
}
</script>
@endsection