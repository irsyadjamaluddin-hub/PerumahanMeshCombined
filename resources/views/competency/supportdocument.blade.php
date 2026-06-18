@extends('layouts.app-all')

@section('title', 'Supporting Documents')

@section('content')

<?php $pagename = "IndividualCompetency"; ?>

    <br>

    @foreach ($competencies as $competencie)
    <div>
    <a href="{{ route('competencies.competencie.editcompetency', [$competencie->id]) }}" class="btn btn-primary mb-2">
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

                        <h3 class="card-title">Upload Documents</h3>

                        <form class="" method="post" action="{{ route('competencies.competencie.supportdocumentstore') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtnfile" href="#">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>

                            @foreach($competencies as $competencie)
                            <input type="text" name="id" class="bg-gray-200 form-control " value="{{$competencie->id}}" hidden>
                            @endforeach


                            <table class="table-achiev" id="supportdocument">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Catatan</th>
                                        <th style="text-align: center;">File</th>
                                        <th style="text-align: center;">Upload Date</th>
                                        <th></th>
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

                                        <td>
                                            <div class="col" style="text-align: center;">
                                                <a href="{{ route('competency.competency.destroycompetencyfile', $competencyfile->id ) }}" class="btn btn-outline-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @endif

                                </tbody>
                            </table>

                            <script type="text/javascript">
                            $(document).ready(function() {
                                $('#addbtnfile').off().on('click',
                                    function() {

                                        var html = '';
                                        html += '<tr>';

                                        html += '<td><input id="catatan" type="text"  placeholder="Catatan"  class="form-control @error('catatan') is-invalid @enderror" name="catatan[]" value="{{ old('catatan') }}"></td>';

                                        html += '<td><input id="file" type="file"   class="form-control @error('file') is-invalid @enderror" name="file[]" value="{{ old('file ') }}"></td>';

                                        html += '<td></td>';

                                        html += '<td> <button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                        html += '</tr>';

                                        $('#supportdocument').append(html);
                                    })

                            });


                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>


                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <br>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>


@endsection