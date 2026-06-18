@extends('layouts.app-all')

@section('title', 'Show SSM Request')

@section('content')

<?php
$pagename = "SSMRequest";
?>

<div class="pagetitle">
  <h1>Butiran Permohonan SSM</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item">Borang SSM</li>
      <li class="breadcrumb-item active">Butiran Permohonan SSM</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">

<div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
            <!-- <h3 class="card-title">Mengaktifkan Akaun SSM<br> <i>SSM Activation</i></h3> -->
    <div class="profile-overview">
        <h3 class="card-title">Butiran Permohonan SSM<br> <i>SSM Request Details</i></h3>
<hr>

@foreach($ssmsshow as $ssmrq)
      
                        <div class="row">
                            <div class="col-lg-4 label">Nombor Rujukan::</div>
                            <div class="col-lg-8">  {{ ($ssmrq->id) }} </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Nama:</div>
                            <div class="col-lg-8">  {{ ($ssmrq->name) }} </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Nombor Kad Pengenalan:</div>
                            <div class="col-lg-8"> 0{{ ($ssmrq->ic) }} </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Nombor Telefon:</div>
                            <div class="col-lg-8">  {{ ($ssmrq->telephone) }} </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Tempat Bertugas Sekarang:</div>
                            <div class="col-lg-8">  {{ ($ssmrq->current_workplace) }} </div>
                        </div>
                        
                        @if(($ssmrq->huraian) == null)
                        

                        @else
                        <div class="row">
                            <div class="col-lg-4 label">Catatan:</div>
                            <div class="col-lg-8">  {{ ($ssmrq->huraian) }} </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-4 label">Nama Approver:</div>
                            <div class="col-lg-8">  {{ ($ssmrq->approver_name) }} </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Nombor Kad Pengenalan Approver:</div>
                            <div class="col-lg-8">  0{{ ($ssmrq->approver_ic) }} </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 label">Status:</div>
                        @if($ssmrq->status == null)    
                            <div class="col-lg-8"><span class="badge rounded-pill bg-secondary">Permohonan telah dihantar</span></div>
                        @elseif($ssmrq->status=="Selesai")
                          <div class="col-lg-8"><span class="badge rounded-pill bg-success">{{ $ssmrq->status}}</span></div>
                        @elseif($ssmrq->status=="DiTolak")
                          <div class="col-lg-8"><td><span class="badge rounded-pill bg-danger">{{ $ssmrq->status}}</span></div>
                        @elseif($ssmrq->status=="Sedang Diproses")
                          <div class="col-lg-8"><td><span class="badge rounded-pill bg-warning text-dark">{{ $ssmrq->status}}</span></div>
                        @endif    
                        </div>

                        
                                
                        

                        
@endforeach

</div>
</div>
</div>
</div>




</section>
@endsection