@extends('layouts.app-all')

@section('title', 'Competency List')

@section('content')

<?php
$pagename = "SupervisorCompetency";
?>

<section class="section">
    <div class="row">

        <div class="card">
            <div class="card-body mt-3">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MINISTRY OF EDUCATION<br> Competency List</h5>

                <div class="col" style="text-align: right; padding: 5px;">
                    <a href="{{route('competency.competency.adminIndividualcompetency')}}" class="btn btn-primary">
                        Add New Individual
                    </a>
                </div>

                <div class="overflow-auto" style="text-align: center;">
                    <table class="table-achiev datatable" id="tableprestasi">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">IC Number</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if(count($competencies) == 0)

                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>No records found</h5>
                                </td>
                            </tr>

                            @else
                            @foreach($competencies as $competencie)

                            <tr>
                                <td>{{ $competencie->indv_name }}</td>
                                <td>{{ $competencie->indv_icno }}</td>

                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('competencies.competencie.editadmincompetency', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>


                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('competencies.competencie.destroyadmincompetency', $competencie->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <a onclick='return confirm("Confirm to delete data?")'>
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
        </div>

    </div>
</section>
@endsection