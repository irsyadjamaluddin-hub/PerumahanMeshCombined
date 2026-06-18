@extends('layouts.app-all')

@section('title', 'Update PPS Visitors')

@section('content')

<?php
$pagename = "";
?>

<section class="section profile">
  <div class="row">

  <div class="col-lg-12">
    <a href="{{ route('pps.pps.index') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
  </div>

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class="bi bi-patch-check"> {!! session('success_message') !!}</i>
        </div>
        @endif

    <div class="card">
      <div class="card-body mt-3 overflow-auto">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Pusat Perkhidmatan Setempat (PPS)<br> Number of Visitors</h5>

        <!-- ==================================================================================================== -->
        <!-- Added by Amal 'Izzah (PB) -->

        <br>

        <div>
    <a href="{{ route('pps.pps.addpps', ['counter' => $counter]) }}" class="btn btn-primary">
        <i class="bi bi-plus-square"></i>
    </a>
</div>

        <br>

<!-- Default Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($years as $year)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $year }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $year }}" type="button" role="tab" aria-controls="{{ $year }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $year }}</button>
        </li>
    @endforeach
</ul>

<br>

<div class="tab-content pt-2" id="myTabContent">
    @foreach($years as $year)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $year }}" role="tabpanel" aria-labelledby="{{ $year }}-tab">
            <form class="" method="post" action="{{ route('pps.pps.updatepps')}}" enctype="multipart/form-data">
                @csrf
                <h1 class="card-title" style="text-align: center;">{{$ppsVisitor->counter}}</h1>
                <!-- Loop through data for the specific year -->
                @foreach ($data as $item)
                    @if ($item->year == $year)
                        <input type="hidden" name="id[]" value="{{$item->id}}">
                        <input type="hidden" name="year[]" value="{{$item->year}}">
                        <!-- Display inputs for each month -->
                        <!-- Adjust the following fields according to your requirements -->
                        <div class="row">
                            <div class="col-lg-3 label">January</div>
                            <div class="col-lg-9"><input type="number" name="january" value="{{$item->january}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">February</div>
                            <div class="col-lg-9"><input type="number" name="february" value="{{$item->february}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">March</div>
                            <div class="col-lg-9"><input type="number" name="march" value="{{$item->march}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">April</div>
                            <div class="col-lg-9"><input type="number" name="april" value="{{$item->april}}" class="form-control text-center"></div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-lg-3 label">May</div>
                            <div class="col-lg-9"><input type="number" name="may" value="{{$item->may}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">June</div>
                            <div class="col-lg-9"><input type="number" name="june" value="{{$item->june}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">July</div>
                            <div class="col-lg-9"><input type="number" name="july" value="{{$item->july}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">August</div>
                            <div class="col-lg-9"><input type="number" name="august" value="{{$item->august}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">September</div>
                            <div class="col-lg-9"><input type="number" name="september" value="{{$item->september}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">October</div>
                            <div class="col-lg-9"><input type="number" name="october" value="{{$item->october}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">November</div>
                            <div class="col-lg-9"><input type="number" name="november" value="{{$item->november}}" class="form-control text-center"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-3 label">December</div>
                            <div class="col-lg-9"><input type="number" name="december" value="{{$item->december}}" class="form-control text-center"></div>
                        </div>

                        <br>
        
                    @endif
                @endforeach
                
                <div class="col" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    @endforeach
</div>
<!-- End Default Tabs -->

<!-- Ensure you have included Bootstrap JS file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    // Activate the tab using JavaScript
    document.addEventListener("DOMContentLoaded", function() {
        var url = window.location.href;
        var tabId = url.substring(url.indexOf("#") + 1);
        if (tabId) {
            var tab = document.getElementById(tabId + "-tab");
            if (tab) {
                tab.click();
            }
        }
    });
</script>


          <!-- ==================================================================================================== -->


      </div>
    </div>

  </div>
</section>

@endsection