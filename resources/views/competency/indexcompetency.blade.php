@extends('layouts.app-all')

@section('title', 'Competency List')

@section('content')

<?php
$pagename = "Competency";
?>

<section class="section">
    <div class="row">

        <div class="card mt-3">
            <div class="card-body pt-3">
                <h5 class="card-title"
                    style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                    MINISTRY OF EDUCATION<br> Competency List</h5>


                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link w-100 active" data-bs-toggle="tab"
                            data-bs-target="#profile-individual">Individual</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#profile-asses">To
                            assess</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab"
                            data-bs-target="#profile-collab">Reassessment</button>
                    </li>

                </ul>

                <br>

                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-individual" id="profile-individual">

                        <div class="overflow-auto" style="text-align: center;">

                            <table class="table-achiev" id="tableprestasi">

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

                                                <form method="get"
                                                    action="{{ route('competencies.competencie.editcompetency', $competencie->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </button>

                                                </form>

                                                <!---- Chart Button----->

                                                <form method="get"
                                                    action="{{ route('competencies.competencie.individualchart', $competencie->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-bar-chart-line"></i>
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

                    <div class="tab-pane fade profile-asses pt-2" id="profile-asses">

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
                                    @foreach($competencies1 as $competencie)

                                    <tr>
                                        <td>{{ $competencie->indv_name }}</td>
                                        <td>{{ $competencie->indv_icno }}</td>

                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                <!----Edit Button----->

                                                <form method="get"
                                                    action="{{ route('competencies.competencie.editsupervisorcompetency', $competencie->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
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


                    <!-- Collabrator Tab -->

                    <div class="tab-pane fade profile-collab pt-2" id="profile-collab">

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

                                    @if(count($competencies2) == 0)

                                    <tr class="text-center">
                                        <td colspan="8">
                                            <h5>No records found</h5>
                                        </td>
                                    </tr>

                                    @else
                                    @foreach($competencies2 as $competencie)

                                    <tr>
                                        <td>{{ $competencie->indv_name }}</td>
                                        <td>{{ $competencie->indv_icno }}</td>

                                        <td>
                                            <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                                <!----Edit Button----->

                                                <form method="get"
                                                    action="{{ route('competencies.competencie.editreassessmentcompetency', $competencie->id ) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="bi bi-pencil-fill"></i>
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
    </div>
    </div>

</section>
@endsection