@extends('layouts.app-all')

@section('title', 'Rating List')

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
  /* Event name, average and stars */
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme .large-text, html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme .medium-text { color: #e8eaf4; }
  html[data-mesh-theme="dark"] body.mesh-dark-ready .mesh-home-theme .fa-star { color: #f3c35f !important; }
</style>
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "Rating List";
?>

<style>                
    .dataTable-info {
        color: white;
    }

        .large-text {
    font-size: 30px;
    }

    .medium-text {
    font-size: 20px;
    }
</style>

<div class="pagetitle">
    <h1>MOE Event</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('moeevent.moeevent.indexadmin') }}">MOE Event</a></li>
        <li class="breadcrumb-item active">Ratings</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <div class="row">

        <div class="col-12">
            <div class="card">

            @if ($eventid == 21) 
                <div class="card-body overflow-auto">
                    <br></br>
                    @if(isset($event))
                    <div class="mb-3">
                        <center><h1 class="large-text"><strong>{{ $event->eventlabel }}</strong></h1></center>
                    </div>
                    @endif

                    @if(count($rate) > 0)
                    @php
                    function calculateAverageRating($ratings)
                    {
                        $totalRatings = 0;
                        $count = 0;

                        foreach ($ratings as $rating) {
                            // Exclude deleted ones from the calculation
                            if (!$rating->is_deleted) {
                                $totalRatings += $rating->rating;
                                $count++;
                            }
                        }

                        // Avoid division by zero
                        return $count > 0 ? number_format($totalRatings / $count, 2) : 0;
                    }
                    @endphp
                    <div class="text-center mb-3">
                        <h2 class="medium-text">Average Rating: {{ calculateAverageRating($rate) }}</h2>
                    </div>
                    @endif

                    <!-- ==================================================================================================== -->
                    <!-- Recently Added by Amal 'Izzah (PB) -->
                    <div class="row align-items-center text-center">
                        <div class="col">
                            <a href="{{ $qrCodeUrl }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-qr-code-scan"> Feedback</i>
                            </a>

                            <!-- Export to Excel - Fira -->
                            <a href="{{ route('export.to.excelratinglist', ['id' => $event->id]) }}" class="btn btn-success">Export Excel</a>
                        </div>
                    </div>
                    <!-- ==================================================================================================== -->

                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Feedback</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($rate) == 0)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>
                            @else
                            @foreach($rate as $rating)
                            <tr>
                                <td>{{$rating->jabatan}}</td>
                                <td>
                                    @for ($i = 1; $i <= $rating->rating; $i++)
                                        <i class="fa fa-star" style="color: #F9A602;"></i>
                                    @endfor
                                </td>
                                <td>{{$rating->feedback}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            @else 
                <div class="card-body overflow-auto">
                    <br></br>
                        @if(isset($event))
                        <div class="mb-3">
                            <center><h1 class="large-text"><strong>{{ $event->eventlabel }}</strong></h1></center>
                        </div>
                        @endif
    
                        @if(count($rate) > 0)
                        <div class="text-center mb-3">
                            <h2 class="medium-text">Average Rating: {{ $averageRating }}</h2>
                        </div>
                        @endif
    
    
                        <!-- ==================================================================================================== -->
                        <!-- Recently Added by Amal 'Izzah (PB) -->
                        <div class="text-center mb-3">
                            <a href="{{ $qrCodeUrl }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-qr-code-scan"> Feedback</i>
                            </a>

                            <!-- Export to Excel - Fira -->
                            <a href="{{ route('export.to.excelratinglist2', ['id' => $event->id]) }}" class="btn btn-success">Export Excel</a>
                        </div>
    
                        <!-- ==================================================================================================== -->
    
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Ratings</th>
                                    <th scope="col">Overall Rating</th>
                                    <th scope="col">Feedback</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @if(count($rate) == 0)
                                <tr class="text-center">
                                    <td colspan="8">
                                        <h5>No records found</h5>
                                    </td>
                                </tr>
                                @else
                                @foreach($rate as $rating)
                                <tr>
                                    <td>{{$rating->jabatan}}</td>
                                    <td>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusInfoModal_{{$rating->rateID}}"> <i class="bi bi-file-text-fill"></i></button>
                                        </div>
    
                                        <!-- Modal for displaying questions and individual ratings -->
                                        <div class="modal fade" id="statusInfoModal_{{$rating->rateID}}" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 50%;" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="statusInfoModalLabel">Ratings</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Questions</th>
                                                                    <th>Ratings</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($questions as $index => $question)
                                                                    <tr>
                                                                        <td>{{$question}}</td>
                                                                        <td>
                                                                            <!-- Display stars for individual ratings -->
                                                                            @for ($i = 1; $i <= $rating->{'rating'.($index+1)}; $i++)
                                                                                <i class="fa fa-star" style="color: #F9A602;"></i>
                                                                            @endfor
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #fff; background-color: #6c757d; border-color: #6c757d;">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                                <td>
                                    <!-- Display overall rating -->
                                    <i class="fa fa-star" style="color: #F9A602;" > {{$totalRatings[$rating->rateID]}}</i>
                                </td>
    
                                <td>{{$rating->feedback}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
    
                </div>
            @endif
            </div>
        </div>

    </div>
</section>
{{-- #============= ORI CODE ============== --}}
{{-- = --}}
{{-- #================================ --}}
{{-- Stray "=" removed: it printed a lone "=" at the bottom of the page --}}
{{-- #================================ --}}
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection


