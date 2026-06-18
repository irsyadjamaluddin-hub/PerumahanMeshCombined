@extends('layouts.app-all')

@section('title', 'Supporting Documents')

@section('content')

<?php $pagename = "IndividualCompetency"; ?>

    <br>

    @foreach ($competencies as $competencie)
    <div>
    <a href="{{ route('competencies.competencie.editsupervisorcompetency', [$competencie->id]) }}" class="btn btn-primary mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
    </div>
    @endforeach

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <div class="col-12">
        <div class="card recent-sales">

            <div class="card-body">

                <div class="profile-overview pt-3">

                    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">

                        <h3 class="card-title">List of Documents</h3>

                                <table class="table-achiev datatable" id="tableprestasi1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Catatan</th>
                                            <th style="text-align: center;">File</th>
                                            <th style="text-align: center;">Uploaded Date</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @if(count( $competencyfiles) == 0)

                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>

                                        @else

                                        @foreach( $competencyfiles as $competencyfile)

                                        <tr class="text-center">
                                            <td>{{$competencyfile->catatan}}</td>

                                            <td><a href='{{Storage::url("$competencyfile->file") }}' target="_blank">View</a></td>

                                            @if ($competencyfile->created_at == null)
                                            <td></td>
                                            @else
                                            <td>{{ date('d/m/Y', strtotime($competencyfile->created_at)) }}</td>
                                            @endif
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

    @endsection