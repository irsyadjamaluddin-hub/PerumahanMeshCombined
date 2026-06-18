@extends('layouts.app-all')

@section('title', 'Admin Individual Competency Profile')

@section('content')

<?php $pagename = 'IndividualCompetency'; ?>

<section class="section">
    <div class="row">
        <form class="" method="post" action="{{ route('competency.competency.updateadmincompetency') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body mt-3">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MINISTRY OF EDUCATION<br>Edit Admin View Individual Competency Profile</h5>

                    <div class="col-lg-12 overflow-auto">
                        <table class="table table-bordered">
                            <tbody>

                                @foreach ($competencies as $competencie)
                                <input type="text" name="id" class="bg-gray-200 form-control " value="{{ $competencie->id }}" hidden>

                                <tr>
                                    <th scope="row">IC Number</th>
                                    <td><input type="text" name="indv_icno" value="{{ $competencie->indv_icno }}" class="form-control" disabled></td>
                                    <th scope="row">Supervisor's IC Number</th>
                                    <td><input type="text" name="" value="{{ $competencie->supv_icno }}" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td><input type="text" name="indv_name" value="{{ $competencie->indv_name }}" class="form-control" disabled></td>
                                    <th scope="row">Supervisor's Name</th>
                                    <td><input type="text" name="" value="{{ $competencie->supv_name }}" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Department</th>
                                    <td><input type="text" name="indv_dept" value="{{ $competencie->indv_dept }}" class="form-control" disabled></td>
                                    <th scope="row">Department</th>
                                    <td><input type="text" name="" value="{{ $competencie->supv_dept }}" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Unit</th>
                                    <td><input type="text" name="indv_post" value="{{ $competencie->indv_post }}" class="form-control" disabled></td>
                                    <th scope="row">Unit</th>
                                    <td><input type="text" name="" value="{{ $competencie->supv_post }}" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Salary Scale - Division</th>
                                    <td><input type="text" name="indv_div" value="{{ $competencie->indv_div }}" class="form-control" disabled></td>
                                    <th scope="row">Date</th>
                                    <td><input type="text" name="" value="{{ $competencie->date }}" class="form-control" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body mt-3">
                    <div class="col">
                        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Core Competencies</h5>

                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Strategic Direction</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">People Engagement</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false">Performance Culture</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="other-tab" data-bs-toggle="tab" data-bs-target="#other-justified" type="button" role="tab" aria-controls="other" aria-selected="false">Organisation Capability</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">

                                <div class="card overflow-auto" style="text-align: center;">
                                    <table class="table-achiev" id="tableprestasi">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; width: 280px;">Competencies</th>
                                                <th style="text-align: center;">Evidences</th>
                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                <th style="text-align: center; width: 65px;">Gap Level</th>
                                                <th style="text-align: center;">On the Job<br>70</th>
                                                <th style="text-align: center;">Social Learning<br>20</th>
                                                <th style="text-align: center;">Formal Training<br>10</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        <!-- If else division -->
                                        @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                            <tr>
                                                <td>
                                                    Strategic Thinking
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>


                                        <!-- RCL -->
                                                @if ($competencie->sd_st_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('sd_st_rcl') is-invalid @enderror"
                                                        name="sd_st_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_st_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('sd_st_rcl') is-invalid @enderror"
                                                        name="sd_st_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_st_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('sd_st_rcl') is-invalid @enderror"
                                                        name="sd_st_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_st_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('sd_st_rcl') is-invalid @enderror"
                                                        name="sd_st_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_st_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('sd_st_rcl') is-invalid @enderror"
                                                        name="sd_st_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('sd_st_rcl') is-invalid @enderror"
                                                        name="sd_st_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif
                                        <!-- End of RCL -->


                                                @if ($competencie->sd_st_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_st_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_st_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_st_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_st_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif



                                                @if ($competencie->sd_st_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_st_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_st_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_st_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_st_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif


                                                <!-- Gap LEVEL -->
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>

                                                <!-- End Gap Level -->

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td>
                                                    Change & Adaptability
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        disabled>Evidences</button>
                                                </td>

                                                @if ($competencie->sd_ca_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('sd_ca_rcl') is-invalid @enderror"
                                                        name="sd_ca_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_ca_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('sd_ca_rcl') is-invalid @enderror"
                                                        name="sd_ca_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_ca_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('sd_ca_rcl') is-invalid @enderror"
                                                        name="sd_ca_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_ca_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('sd_ca_rcl') is-invalid @enderror"
                                                        name="sd_ca_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_ca_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('sd_ca_rcl') is-invalid @enderror"
                                                        name="sd_ca_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('sd_ca_rcl') is-invalid @enderror"
                                                        name="sd_ca_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                <!-- <td>
                                            <input type="text" name="" class="form-control" disabled>
                                          </td> -->

                                                @if ($competencie->sd_ca_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_ca_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_ca_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_ca_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_ca_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif



                                                @if ($competencie->sd_ca_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_ca_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_ca_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_ca_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_ca_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif


                                                <!-- Gap Level -->
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                <!-- End Gap Level -->



                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>
                                            </tr>

                                        <!-- If else division -->
                                        @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")

                                            <tr>

                                                <td>
                                                    Planning & Organising
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        disabled>Evidences</button>
                                                </td>



                                                @if ($competencie->sd_po_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('sd_po_rcl') is-invalid @enderror"
                                                        name="sd_po_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_po_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('sd_po_rcl') is-invalid @enderror"
                                                        name="sd_po_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_po_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('sd_po_rcl') is-invalid @enderror"
                                                        name="sd_po_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_po_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('sd_po_rcl') is-invalid @enderror"
                                                        name="sd_po_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->sd_po_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('sd_po_rcl') is-invalid @enderror"
                                                        name="sd_po_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('sd_po_rcl') is-invalid @enderror"
                                                        name="sd_po_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->sd_po_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_po_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_po_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_po_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_po_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                @if ($competencie->sd_po_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_po_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_po_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_po_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->sd_po_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                <!-- Gap Level -->
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>

                                                <!-- End Gap Level -->


                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>
                                            </tr>

                                        @else
                                        <tr></tr>
                                        @endif
                                        <!-- End If else division -->

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="profile-justified" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="card overflow-auto" style="text-align: center;">
                                    <table class="table-achiev" id="tableprestasi">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; width: 280px;">Competencies</th>
                                                <th style="text-align: center;">Evidences</th>
                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                <th style="text-align: center; width: 65px;">Gap Level</th>
                                                <th style="text-align: center;">On the Job<br>70</th>
                                                <th style="text-align: center;">Social Learning<br>20</th>
                                                <th style="text-align: center;">Formal Training<br>10</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <!-- If else division -->
                                        @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                            <tr>

                                                <td>
                                                    Collaboration & Communication
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>


                                                @if ($competencie->pe_cc_rcl == '0')
                                                <td>
                                                    <select value="N/A" class="form-control @error('pe_cc_rcl') is-invalid @enderror" name="pe_cc_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_cc_rcl == '1')
                                                <td>
                                                    <select value="A" class="form-control @error('pe_cc_rcl') is-invalid @enderror" name="pe_cc_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_cc_rcl == '2')
                                                <td>
                                                    <select value="K" class="form-control @error('pe_cc_rcl') is-invalid @enderror" name="pe_cc_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_cc_rcl == '3')
                                                <td>
                                                    <select value="S" class="form-control @error('pe_cc_rcl') is-invalid @enderror" name="pe_cc_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_cc_rcl == '4')
                                                <td>
                                                    <select value="M" class="form-control @error('pe_cc_rcl') is-invalid @enderror" name="pe_cc_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select class="form-control @error('pe_cc_rcl') is-invalid @enderror" name="pe_cc_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->pe_cc_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_cc_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_cc_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_cc_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_cc_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif


                                                @if ($competencie->pe_cc_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_cc_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_cc_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_cc_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_cc_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif


                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td>
                                                    Leading Others
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>


                                                @if ($competencie->pe_lo_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('pe_lo_rcl') is-invalid @enderror"
                                                        name="pe_lo_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_lo_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('pe_lo_rcl') is-invalid @enderror"
                                                        name="pe_lo_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_lo_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('pe_lo_rcl') is-invalid @enderror"
                                                        name="pe_lo_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_lo_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('pe_lo_rcl') is-invalid @enderror"
                                                        name="pe_lo_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_lo_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('pe_lo_rcl') is-invalid @enderror"
                                                        name="pe_lo_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('pe_lo_rcl') is-invalid @enderror"
                                                        name="pe_lo_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->pe_lo_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_lo_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_lo_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_lo_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_lo_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif


                                                @if ($competencie->pe_lo_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_lo_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_lo_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_lo_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_lo_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif


                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                            </tr>


                                        <!-- If else division -->
                                        @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")
                                            <tr>

                                                <td>
                                                    Team Working
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>


                                                @if ($competencie->pe_tw_rcl == '0')
                                                <td>
                                                    <select value="N/A" class="form-control @error('pe_tw_rcl') is-invalid @enderror" name="pe_tw_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_tw_rcl == '1')
                                                <td>
                                                    <select value="A" class="form-control @error('pe_tw_rcl') is-invalid @enderror" name="pe_tw_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_tw_rcl == '2')
                                                <td>
                                                    <select value="K" class="form-control @error('pe_tw_rcl') is-invalid @enderror" name="pe_tw_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_tw_rcl == '3')
                                                <td>
                                                    <select value="S" class="form-control @error('pe_tw_rcl') is-invalid @enderror" name="pe_tw_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pe_tw_rcl == '4')
                                                <td>
                                                    <select value="M" class="form-control @error('pe_tw_rcl') is-invalid @enderror" name="pe_tw_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select class="form-control @error('pe_tw_rcl') is-invalid @enderror" name="pe_tw_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->pe_tw_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_tw_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_tw_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_tw_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_tw_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif


                                                @if ($competencie->pe_tw_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_tw_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_tw_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_tw_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pe_tw_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                            </tr>

                                        @else
                                        <tr></tr>
                                        @endif
                                        <!-- End If else division -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="contact-justified" role="tabpanel"
                                aria-labelledby="contact-tab">
                                <div class="card overflow-auto" style="text-align: center;">
                                    <table class="table-achiev" id="tableprestasi">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; width: 280px;">Competencies</th>
                                                <th style="text-align: center;">Evidences</th>
                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                <th style="text-align: center; width: 65px;">Gap Level</th>
                                                <th style="text-align: center;">On the Job<br>70</th>
                                                <th style="text-align: center;">Social Training<br>20</th>
                                                <th style="text-align: center;">Formal Training<br>10</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <!-- If else division -->
                                        @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                            <tr>

                                                <td>
                                                    Delivery & Problem Solving
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>


                                                @if ($competencie->pc_dps_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('pc_dps_rcl') is-invalid @enderror"
                                                        name="pc_dps_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_dps_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('pc_dps_rcl') is-invalid @enderror"
                                                        name="pc_dps_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_dps_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('pc_dps_rcl') is-invalid @enderror"
                                                        name="pc_dps_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_dps_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('pc_dps_rcl') is-invalid @enderror"
                                                        name="pc_dps_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_dps_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('pc_dps_rcl') is-invalid @enderror"
                                                        name="pc_dps_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('pc_dps_rcl') is-invalid @enderror"
                                                        name="pc_dps_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->pc_dps_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_dps_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_dps_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_dps_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_dps_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                @if ($competencie->pc_dps_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_dps_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_dps_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_dps_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_dps_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td>
                                                    Digital Fluency
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>


                                                @if ($competencie->pc_df_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('pc_df_rcl') is-invalid @enderror"
                                                        name="pc_df_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_df_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('pc_df_rcl') is-invalid @enderror"
                                                        name="pc_df_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_df_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('pc_df_rcl') is-invalid @enderror"
                                                        name="pc_df_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_df_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('pc_df_rcl') is-invalid @enderror"
                                                        name="pc_df_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_df_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('pc_df_rcl') is-invalid @enderror"
                                                        name="pc_df_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('pc_df_rcl') is-invalid @enderror"
                                                        name="pc_df_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->pc_df_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_df_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_df_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_df_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_df_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                @if ($competencie->pc_df_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_df_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_df_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_df_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_df_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                            </tr>


                                        <!-- If else division -->
                                        @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")

                                            <tr>

                                                <td>
                                                    Personal Effectiveness & Resilience
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>

                                                @if ($competencie->pc_per_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('pc_per_rcl') is-invalid @enderror"
                                                        name="pc_per_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_per_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('pc_per_rcl') is-invalid @enderror"
                                                        name="pc_per_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_per_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('pc_per_rcl') is-invalid @enderror"
                                                        name="pc_per_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_per_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('pc_per_rcl') is-invalid @enderror"
                                                        name="pc_per_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->pc_per_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('pc_per_rcl') is-invalid @enderror"
                                                        name="pc_per_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('pc_per_rcl') is-invalid @enderror"
                                                        name="pc_per_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->pc_per_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_per_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_per_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_per_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_per_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                @if ($competencie->pc_per_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_per_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_per_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_per_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->pc_per_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                            </tr>

                                        @else
                                        <tr></tr>
                                        @endif
                                        <!-- End If else division -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="other-justified" role="tabpanel" aria-labelledby="other-tab">
                                <div class="card overflow-auto" style="text-align: center;">
                                    <table class="table-achiev" id="tableprestasi">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; width: 280px;">Competencies</th>
                                                <th style="text-align: center;">Evidences</th>
                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                <th style="text-align: center; width: 65px;">Gap Level</th>
                                                <th style="text-align: center;">On the Job<br>70</th>
                                                <th style="text-align: center;">Social Training<br>20</th>
                                                <th style="text-align: center;">Formal Training<br>10</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <!-- If else division -->
                                        @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                            <tr>

                                                <td>
                                                    Performance Management & Talent Development
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>


                                                @if ($competencie->oc_pmtd_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('oc_pmtd_rcl') is-invalid @enderror"
                                                        name="oc_pmtd_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_pmtd_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('oc_pmtd_rcl') is-invalid @enderror"
                                                        name="oc_pmtd_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_pmtd_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('oc_pmtd_rcl') is-invalid @enderror"
                                                        name="oc_pmtd_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_pmtd_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('oc_pmtd_rcl') is-invalid @enderror"
                                                        name="oc_pmtd_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_pmtd_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('oc_pmtd_rcl') is-invalid @enderror"
                                                        name="oc_pmtd_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('oc_pmtd_rcl') is-invalid @enderror"
                                                        name="oc_pmtd_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->oc_pmtd_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_pmtd_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_pmtd_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_pmtd_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_pmtd_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                @if ($competencie->oc_pmtd_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_pmtd_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_pmtd_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_pmtd_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_pmtd_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td>
                                                    Corporate Governance
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>



                                                @if ($competencie->oc_cg_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('oc_cg_rcl') is-invalid @enderror"
                                                        name="oc_cg_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_cg_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('oc_cg_rcl') is-invalid @enderror"
                                                        name="oc_cg_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_cg_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('oc_cg_rcl') is-invalid @enderror"
                                                        name="oc_cg_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_cg_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('oc_cg_rcl') is-invalid @enderror"
                                                        name="oc_cg_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_cg_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('oc_cg_rcl') is-invalid @enderror"
                                                        name="oc_cg_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('oc_cg_rcl') is-invalid @enderror"
                                                        name="oc_cg_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->oc_cg_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_cg_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_cg_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_cg_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_cg_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                @if ($competencie->oc_cg_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_cg_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_cg_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_cg_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_cg_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button>
                                                </td>

                                            </tr>

                                        <!-- If else division -->
                                        @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")

                                            <tr>

                                                <td>
                                                    Quality Delivery & Customer Focus
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                </td>


                                                @if ($competencie->oc_qdcf_rcl == '0')
                                                <td>
                                                    <select value="N/A"
                                                        class="form-control @error('oc_qdcf_rcl') is-invalid @enderror"
                                                        name="oc_qdcf_rcl">
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_qdcf_rcl == '1')
                                                <td>
                                                    <select value="A"
                                                        class="form-control @error('oc_qdcf_rcl') is-invalid @enderror"
                                                        name="oc_qdcf_rcl">
                                                        <option value="1">A</option>
                                                        <option value="0">NA</option>

                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_qdcf_rcl == '2')
                                                <td>
                                                    <select value="K"
                                                        class="form-control @error('oc_qdcf_rcl') is-invalid @enderror"
                                                        name="oc_qdcf_rcl">
                                                        <option value="2">K</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_qdcf_rcl == '3')
                                                <td>
                                                    <select value="S"
                                                        class="form-control @error('oc_qdcf_rcl') is-invalid @enderror"
                                                        name="oc_qdcf_rcl">
                                                        <option value="3">S</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>

                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @elseif($competencie->oc_qdcf_rcl == '4')
                                                <td>
                                                    <select value="M"
                                                        class="form-control @error('oc_qdcf_rcl') is-invalid @enderror"
                                                        name="oc_qdcf_rcl">
                                                        <option value="4">M</option>
                                                        <option value="0">NA</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                    </select>
                                                </td>
                                                @else
                                                <td>
                                                    <select
                                                        class="form-control @error('oc_qdcf_rcl') is-invalid @enderror"
                                                        name="oc_qdcf_rcl">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>
                                                @endif


                                                @if ($competencie->oc_qdcf_icl == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_qdcf_icl == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_qdcf_icl == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_qdcf_icl == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_qdcf_icl == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                @if ($competencie->oc_qdcf_outcome == '0')
                                                <td>
                                                    <input type="text" name="" value="NA" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_qdcf_outcome == '1')
                                                <td>
                                                    <input type="text" name="" value="A" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_qdcf_outcome == '2')
                                                <td>
                                                    <input type="text" name="" value="K" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_qdcf_outcome == '3')
                                                <td>
                                                    <input type="text" name="" value="S" class="form-control" disabled>
                                                </td>
                                                @elseif($competencie->oc_qdcf_outcome == '4')
                                                <td>
                                                    <input type="text" name="" value="M" class="form-control" disabled>
                                                </td>
                                                @else
                                                <td>
                                                    <input type="text" name="" value=" " class="form-control" disabled>
                                                </td>
                                                @endif

                                                <td>
                                                    <input type="text" name="" class="form-control" disabled>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button>
                                                </td>

                                            </tr>

                                        @else
                                        <tr></tr>
                                        @endif
                                        <!-- End If else division -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- End Default Tabs -->

                    </div><!-- End Col Core Competencies -->

                </div>
            </div>
            @endforeach

            @foreach ($employments as $employment)
                    <!-- START SPECIALISED -->
                    @if(optional($employment->department)->label == 'Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan')

                    <?php
                    $compA = json_decode($competencie->dadomain);
                    $encodedC = '123';
                    ?>

                    <input id="abcdef" type="hidden" value="{{$encodedC}}">

                    <div class="card">

                        <div class="card-body mt-3">

                            <!-- Specialised Competencies -->
                            <div class="col">
                                <h5 class="card-title"
                                    style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                                    Specialised Competencies</h5>

                                <div class="row m-4">
                                    <div class="col-6" style="text-align: right;">Domain:</div>
                                    <div class="col-6">
                                        <select class="form-select js-example-basic-multiple" id="dadomain"
                                            multiple="multiple" name="dadomain[]">

                                            @foreach ($dadomains as $key => $value)
                                            @if(in_array($key, $compA))
                                            <option value="{{ $key }}" selected>
                                                @else
                                            <option value="{{ $key }}">
                                                @endif
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('dadomain', '<p class="help-block text-danger">:message</p>')
                                        !!}

                                    </div>
                                </div>

                                @php
                                $compB = json_decode($competencie->dadomain);
                                @endphp

                               <!-- Default Tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @if(in_array("1", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hrd-tab" data-bs-toggle="tab"
                                            data-bs-target="#home0-justified" type="button" role="tab"
                                            aria-controls="home0" aria-selected="true">Human Resource
                                            Development(HRD)</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hrd-tab" data-bs-toggle="tab"
                                            data-bs-target="#home0-justified" type="button" role="tab"
                                            aria-controls="home0" aria-selected="true" style="display:none;">Human
                                            Resource Development(HRD)</button>
                                    </li>
                                    @endif


                                    @if(in_array("2", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ot-tab" data-bs-toggle="tab"
                                            data-bs-target="#home1-justified" type="button" role="tab"
                                            aria-controls="home1" aria-selected="false">Other Technical</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ot-tab" data-bs-toggle="tab"
                                            data-bs-target="#home1-justified" type="button" role="tab"
                                            aria-controls="home1" aria-selected="false" style="display:none;">Other
                                            Technical</button>
                                    </li>
                                    @endif


                                    @if(in_array("3", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hrm-tab" data-bs-toggle="tab"
                                            data-bs-target="#home2-justified" type="button" role="tab"
                                            aria-controls="home2" aria-selected="false">Human Resource
                                            Management</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hrm-tab" data-bs-toggle="tab"
                                            data-bs-target="#home2-justified" type="button" role="tab"
                                            aria-controls="home2" aria-selected="false" style="display:none;">Human
                                            Resource Management</button>
                                    </li>
                                    @endif

                                    @if(in_array("4", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finmaw-tab" data-bs-toggle="tab"
                                            data-bs-target="#home3-justified" type="button" role="tab"
                                            aria-controls="home3" aria-selected="false">Finance(MAW)</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finmaw-tab" data-bs-toggle="tab"
                                            data-bs-target="#home3-justified" type="button" role="tab"
                                            aria-controls="home3" aria-selected="false"
                                            style="display:none;">Finance(MAW)</button>
                                    </li>
                                    @endif

                                    @if(in_array("5", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="fsm-tab" data-bs-toggle="tab"
                                            data-bs-target="#home4-justified" type="button" role="tab"
                                            aria-controls="home4" aria-selected="false">Food Services
                                            Management</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="fsm-tab" data-bs-toggle="tab"
                                            data-bs-target="#home4-justified" type="button" role="tab"
                                            aria-controls="home4" aria-selected="false" style="display:none;">Food
                                            Services Management</button>
                                    </li>
                                    @endif

                                    @if(in_array("6", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="research-tab" data-bs-toggle="tab"
                                            data-bs-target="#home5-justified" type="button" role="tab"
                                            aria-controls="home5" aria-selected="false">Research</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="research-tab" data-bs-toggle="tab"
                                            data-bs-target="#home5-justified" type="button" role="tab"
                                            aria-controls="home5" aria-selected="false"
                                            style="display:none;">Research</button>
                                    </li>
                                    @endif


                                    @if(in_array("7", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finam-tab" data-bs-toggle="tab"
                                            data-bs-target="#home6-justified" type="button" role="tab"
                                            aria-controls="home6" aria-selected="false">Finance(AM)</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finam-tab" data-bs-toggle="tab"
                                            data-bs-target="#home6-justified" type="button" role="tab"
                                            aria-controls="home6" aria-selected="false"
                                            style="display:none;">Finance(AM)</button>
                                    </li>
                                    @endif

                                    @if(in_array("8", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hse-tab" data-bs-toggle="tab"
                                            data-bs-target="#home7-justified" type="button" role="tab"
                                            aria-controls="home7" aria-selected="false">Healthy Safety
                                            Environment</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hse-tab" data-bs-toggle="tab"
                                            data-bs-target="#home7-justified" type="button" role="tab"
                                            aria-controls="home7" aria-selected="false" style="display:none;">Healthy
                                            Safety Environment</button>
                                    </li>
                                    @endif

                                    @if(in_array("9", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finhse-tab" data-bs-toggle="tab"
                                            data-bs-target="#home8-justified" type="button" role="tab"
                                            aria-controls="home8" aria-selected="false">Finance(HSE)</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finhse-tab" data-bs-toggle="tab"
                                            data-bs-target="#home8-justified" type="button" role="tab"
                                            aria-controls="home8" aria-selected="false"
                                            style="display:none;">Finance(HSE)</button>
                                    </li>
                                    @endif


                                    @if(in_array("10", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hseak-tab" data-bs-toggle="tab"
                                            data-bs-target="#home9-justified" type="button" role="tab"
                                            aria-controls="home9" aria-selected="false">Healthy Safety
                                            Environment(AK)</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hseak-tab" data-bs-toggle="tab"
                                            data-bs-target="#home9-justified" type="button" role="tab"
                                            aria-controls="home9" aria-selected="false" style="display:none;">Healthy
                                            Safety Environment(AK)</button>
                                    </li>
                                    @endif

                                    @if(in_array("11", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finak-tab" data-bs-toggle="tab"
                                            data-bs-target="#home10-justified" type="button" role="tab"
                                            aria-controls="home10" aria-selected="false">Finance(AK)</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="finak-tab" data-bs-toggle="tab"
                                            data-bs-target="#home10-justified" type="button" role="tab"
                                            aria-controls="home10" aria-selected="false"
                                            style="display:none;">Finance(AK)</button>
                                    </li>
                                    @endif

                                    @if(in_array("12", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="trans-tab" data-bs-toggle="tab"
                                            data-bs-target="#home11-justified" type="button" role="tab"
                                            aria-controls="home11" aria-selected="false">Transportation</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="trans-tab" data-bs-toggle="tab"
                                            data-bs-target="#home11-justified" type="button" role="tab"
                                            aria-controls="home11" aria-selected="false"
                                            style="display:none;">Transportation</button>
                                    </li>
                                    @endif
                                </ul>


                                <!-- Human Resources Development Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home0-justified" role="tabpanel"
                                        aria-labelledby="home0-tab">
                                        <div class="card overflow-auto" id="hrd1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn1" href="#">
                                                    <i class="bi bi-plus-lg "></i>
                                                </button>
                                            </div>


                                            <table class="table-achiev" id="homes0-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)
                                                        </th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compdahrds) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compdahrds as $compdahrd )
                                                    <tr>
                                                        <td>
                                                            {{ $compdahrd->hrd_competencies }}


                                                        </td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary"
                                                                disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compdahrd->hrd_rcl == '0')
                                                        <td>
                                                            N/A
                                                        </td>

                                                        <td>
                                                            <input type="text" name="" class="form-control" disabled>
                                                        </td>
                                                        @elseif($compdahrd->hrd_rcl == '1')
                                                        <td>
                                                            A
                                                        </td>
                                                        @elseif($compdahrd->hrd_rcl == '2')
                                                        <td>
                                                            K
                                                        </td>
                                                        @elseif($compdahrd->hrd_rcl == '3')
                                                        <td>
                                                            S
                                                        </td>
                                                        @elseif($compdahrd->hrd_rcl == '4')
                                                        <td>
                                                            M
                                                        </td>
                                                        @else
                                                        <td>

                                                        </td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->

                                                        <td>

                                                        </td>
                                                        <!-- end ICL -->


                                                        <td></td>

                                                        <td></td>

                                                        <td><button type="button"
                                                                class="btn btn-primary ri-file-edit-fill"
                                                                disabled></button></td>
                                                        <td><button type="button"
                                                                class="btn btn-primary ri-file-edit-fill"
                                                                disabled></button></td>
                                                        <td><button type="button"
                                                                class="btn btn-primary ri-file-edit-fill"
                                                                disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompdahrd', $compdahrd->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn1').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="hrd_competencies[]"><option value=""></option><option value="Competency Development & Management">Competency Development & Management</option><option value="Learning and Development">Learning and Development</option><option value="Talent Management">Talent Management</option></select></td>';

                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                html += '<td><select class="form-control @error('
                                                fm_rcl
                                                    ') is-invalid @enderror" name="hrd_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes0-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>

                                    <!-- End Human Resource Development Tab1 -->



                                    <!-- Other Technical -->
                                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                                        <div class="tab-pane fade show active" id="home1-justified" role="tabpanel"
                                            aria-labelledby="home1-tab">
                                            <div class="card overflow-auto" id="ot1-tab"
                                                style="text-align: center;display:none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn2" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes1-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)</th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdaots) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdaots as $compdaot )
                                                        <tr>
                                                            <td>
                                                                {{ $compdaot->ot_competencies }}

                                                            </td>

                                                            <td><button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdaot->ot_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdaot->ot_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdaot->ot_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdaot->ot_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdaot->ot_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- End ICL -->

                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdaot', $compdaot->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif



                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn2').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="ot_competencies[]"><option value=""></option><option value="Career Pathway">Career Pathway</option><option value="Manpower Planning">Manpower Planning</option><option value="Procurement and Tender">Procurement and Tender</option><option value="Contract Management">Contract Management</option></select></td>';

                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                html += '<td><select class="form-control @error('
                                                fsm_rcl
                                                    ') is-invalid @enderror" name="ot_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text" name="" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" name="" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" name="" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes1-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>

                                    <!-- End Other Technical Tab 2 -->

                                    <!-- Human Resources Management Tab -->
                                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                                        <div class="tab-pane fade show active" id="home2-justified" role="tabpanel"
                                            aria-labelledby="home2-tab">
                                            <div class="card overflow-auto" id="hrm1-tab"
                                                style="text-align: center;  display:none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn3" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes2-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdahrms) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdahrms as $compdahrm )
                                                        <tr>
                                                            <td>
                                                                {{ $compdahrm->hrm_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdahrm->hrm_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdahrm->hrm_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdahrm->hrm_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdahrm->hrm_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdahrm->hrm_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdahrm', $compdahrm->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>

                                                </table>

                                            </div>

                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn3').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="hrm_competencies[]"><option value=""></option><option value="Manpower planning">Manpower planning</option><option value="Career Pathway">Career Pathway</option><option value="Performance and Rewards">Performance and Rewards</option><option value="Benefits Management">Benefits Management</option><option value="Employee Relations">Employee Relations</option><option value="HR Information and Analysis">HR Information and Analysis</option><option value="Records Repository Management">Records Repository Management</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    fm_rcl
                                                        ') is-invalid @enderror" name="hrm_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text"class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text"  class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes2-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- Human Resource Management Tab 3 -->


                                        <!-- Finance Maw -->
                                        <div class="tab-pane fade show active" id="home3-justified" role="tabpanel"
                                            aria-labelledby="home3-tab">
                                            <div class="card overflow-auto" id="finmaw1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn4" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes3-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdafinmaws) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdafinmaws as $compdafinmaw )
                                                        <tr>
                                                            <td>
                                                                {{ $compdafinmaw->finmaw_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdafinmaw->finmaw_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdafinmaw->finmaw_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdafinmaw->finmaw_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdafinmaw->finmaw_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdafinmaw->finmaw_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdafinmaw', $compdafinmaw->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn4').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="finmaw_competencies[]"><option value=""></option><option value="Financial Management and Accounting">Financial Management and Accounting</option><option value="Budget Management (Performance Budgeting)">Budget Management (Performance Budgeting)</option><option value="Performance and Rewards">Performance and Rewards</option><option value="Benefits Management">Benefits Management</option><option value="Financial Report and Analysis">Financial Report and Analysis</option><option value="Payroll Management">Payroll Management</option><option value="Procurement and Payments">Procurement and Payments</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="finmaw_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes3-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- end tab 4 -->

                                        <!-- Food Service Management -->

                                        <div class="tab-pane fade show active" id="home4-justified" role="tabpanel"
                                            aria-labelledby="home4-tab">
                                            <div class="card overflow-auto" id="fsm1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn5" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes4-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdafsms) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdafsms as $compdafsm )
                                                        <tr>
                                                            <td>
                                                                {{ $compdafsm->fsm_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdafsm->fsm_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdafsm->fsm_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdafsm->fsm_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdafsm->fsm_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdafsm->fsm_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdafsm', $compdafsm->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn5').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="fsm_competencies[]"><option value=""><option value=""></option><option value="Food Safety Training">Food Safety Training</option><option value="Food Inspection">Food Inspection</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="fsm_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes4-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- End Tab 5 -->

                                        <!-- Research -->
                                        <div class="tab-pane fade show active" id="home5-justified" role="tabpanel"
                                            aria-labelledby="home5-tab">
                                            <div class="card overflow-auto" id="research1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn6" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes5-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @if(count($compdaresearchs) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdaresearchs as $compdaresearch )
                                                        <tr>
                                                            <td>
                                                                {{ $compdaresearch->research_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdaresearch->research_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdaresearch->research_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdaresearch->research_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdaresearch->research_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdaresearch->research_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdaresearch', $compdaresearch->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn6').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="research_competencies[]"><option value=""></option><option value="Conducting Research">Conducting Research</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="research_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes5-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>

                                        <!-- End Research Tab 6 -->

                                        <!-- Finance (AM) -->
                                        <div class="tab-pane fade show active" id="home6-justified" role="tabpanel"
                                            aria-labelledby="home6-tab">
                                            <div class="card overflow-auto" id="finam1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn7" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes6-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdafinams) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdafinams as $compdafinam )
                                                        <tr>
                                                            <td>
                                                                {{ $compdafinam->finam_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdafinam->finam_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdafinam->finam_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdafinam->finam_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdafinam->finam_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdafinam->finam_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdafinam', $compdafinam->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn7').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="finam_competencies[]"></option><option value="Financial Management and Accounting">Financial Management and Accounting</option><option value="Claims and Payment">Claims and Payment</option><option value="Procurement and Contract Management">Procurement and Contract Management</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="finam_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes6-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- end Finam tab 7 -->

                                        <!-- Healthy Safety Environment (HSE) -->
                                        <div class="tab-pane fade show active" id="home7-justified" role="tabpanel"
                                            aria-labelledby="home7-tab">
                                            <div class="card overflow-auto" id="hse1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn8" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes7-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdahses) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdahses as $compdahse )
                                                        <tr>
                                                            <td>
                                                                {{ $compdahse->hse_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdahse->hse_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdahse->hse_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdahse->hse_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdahse->hse_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdahse->hse_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdahse', $compdahse->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn8').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="hse_competencies[]"></option><option value="Manage Health Aspect in the Workplace">Manage Health Aspect in the Workplace</option><option value="Safety in Design">Safety in Design</option><option value="Environmental Assessment">Environmental Assessment</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="hse_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes7-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- end HSE tab 8 -->

                                        <!-- Finance(HSE) -->
                                        <div class="tab-pane fade show active" id="home8-justified" role="tabpanel"
                                            aria-labelledby="home8-tab">
                                            <div class="card overflow-auto" id="finhse1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn9" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes8-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdafinhses) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdafinhses as $compdafinhse )
                                                        <tr>
                                                            <td>
                                                                {{ $compdafinhse->finhse_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdafinhse->finhse_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdafinhse->finhse_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdafinhse->finhse_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdafinhse->finhse_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdafinhse->finhse_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdafinhse', $compdafinhse->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn9').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="finhse_competencies[]"></option><option value="Procurement and Tender">Procurement and Tender</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="finhse_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes7-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- end Finance tab 9 -->

                                        <!-- Healthy Safety Environment (ak) -->
                                        <div class="tab-pane fade show active" id="home9-justified" role="tabpanel"
                                            aria-labelledby="home9-tab">
                                            <div class="card overflow-auto" id="hseak1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn10" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes9-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdahseaks) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdahseaks as $compdahseak )
                                                        <tr>
                                                            <td>
                                                                {{ $compdahseak->hseak_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdahseak->hseak_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdahseak->hseak_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdahseak->hseak_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdahseak->hseak_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdahseak->hseak_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdahseak', $compdahseak->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn10').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="hseak_competencies[]"></option><option value="Logistic Management">Logistic Management</option><option value="Utilities Management">Utilities Management</option><option value="Security Personnel Management">Security Personnel Management</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="hseak_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes9-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- end HSEAK tab 10 -->

                                        <!-- FINAK  -->
                                        <div class="tab-pane fade show active" id="home10-justified" role="tabpanel"
                                            aria-labelledby="home10-tab">
                                            <div class="card overflow-auto" id="finak1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn11" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes10-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdafinaks) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdafinaks as $compdafinak )
                                                        <tr>
                                                            <td>
                                                                {{ $compdafinak->finak_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdafinak->finak_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdafinak->finak_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdafinak->finak_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdafinak->finak_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdafinak->finak_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdafinak', $compdafinak->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn11').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="finak_competencies[]"></option><option value="Contract Management">Contract Management</option><option value="Benefit Management">Benefit Management</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="finak_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes10-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- end FINAK tab 11 -->

                                        <!-- TRANSPORTATION -->
                                        <div class="tab-pane fade show active" id="home11-justified" role="tabpanel"
                                            aria-labelledby="home11-tab">
                                            <div class="card overflow-auto" id="trans1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn12" href="#">
                                                        <i class="bi bi-plus-lg "></i>
                                                    </button>
                                                </div>


                                                <table class="table-achiev" id="homes11-tab">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; width: 280px;">Competencies
                                                            </th>
                                                            <th style="text-align: center;">Evidences</th>
                                                            <th style="text-align: center; width: 65px;">RCL</th>
                                                            <th style="text-align: center; width: 65px;">ICL</th>
                                                            <th style="text-align: center; width: 65px;">Outcome
                                                                (Agreed)
                                                            </th>
                                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                                            <th style="text-align: center;">On the Job<br>70</th>
                                                            <th style="text-align: center;">Social Training<br>20</th>
                                                            <th style="text-align: center;">Formal Training<br>10</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @if(count($compdatranss) == 0)

                                                        <tr class="text-center">
                                                            <td colspan="8">
                                                                <h5>No records found</h5>
                                                            </td>
                                                        </tr>

                                                        @else
                                                        @foreach( $compdatranss as $compdatrans )
                                                        <tr>
                                                            <td>
                                                                {{ $compdatrans->trans_competencies }}


                                                            </td>

                                                            <td>
                                                                <button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button>
                                                            </td>

                                                            <!-- Rcl -->
                                                            @if ($compdatrans->trans_rcl == '0')
                                                            <td>
                                                                N/A
                                                            </td>

                                                            <td>
                                                                <input type="text" name="" class="form-control"
                                                                    disabled>
                                                            </td>
                                                            @elseif($compdatrans->trans_rcl == '1')
                                                            <td>
                                                                A
                                                            </td>
                                                            @elseif($compdatrans->trans_rcl == '2')
                                                            <td>
                                                                K
                                                            </td>
                                                            @elseif($compdatrans->trans_rcl == '3')
                                                            <td>
                                                                S
                                                            </td>
                                                            @elseif($compdatrans->trans_rcl == '4')
                                                            <td>
                                                                M
                                                            </td>
                                                            @else
                                                            <td>

                                                            </td>
                                                            @endif
                                                            <!-- End rcl -->

                                                            <!-- ICL -->

                                                            <td>

                                                            </td>
                                                            <!-- end ICL -->


                                                            <td></td>

                                                            <td></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                            <td>
                                                                <div class="col" style="text-align: center;">
                                                                    <a href="{{ route('competency.competency.destroycompdatrans', $compdatrans->id ) }}"
                                                                        class="btn btn-outline-danger">
                                                                        <i class="bi bi-trash-fill"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>


                                                </table>

                                            </div>


                                            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#addbtn12').off().on('click', function() {

                                                    var html = '';
                                                    html += '<tr>';

                                                    html += '<td><select class="form-control @error('
                                                    competencies
                                                        ') is-invalid @enderror" name="trans_competencies[]"></option><option value="Logistic Management(Bus Transportation)">Logistic Management(Bus Transportation)</option><option value="Logistic Management(Boat Transportation)">Logistic Management(Boat Transportation)</option><option value="Logistic Management(BG Transportation)">Logistic Management(BG Transportation)</option></select></td>';

                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';

                                                    html += '<td><select class="form-control @error('
                                                    outcome
                                                        ') is-invalid @enderror" name="trans_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><input type="text" name="" class="form-control" disabled></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                    html +=
                                                        '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';


                                                    html +=
                                                        '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                    html += '</tr>';
                                                    $('#homes7-tab').append(html);
                                                })

                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>
                                        <!-- end TRANSPORTATION tab 12 -->


                                    </div>
                                    <!-- </div>End Default Tabs / Inda pakai ni -->

                                </div><!-- End Col Specialised Competencies -->

                            </div>
                        </div>

  <script type="text/javascript">
                        $(document).ready(function() {

                            $('#dadomain').on('change', function() {
                                $("#hrd-tab").fadeIn("fast")[$.inArray('1', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#ot-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >=
                                    0 ? 'show' : 'hide']();
                                $("#hrm-tab").fadeIn("fast")[$.inArray('3', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#finmaw-tab").fadeIn("fast")[$.inArray('4', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#fsm-tab").fadeIn("fast")[$.inArray('5', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#research-tab").fadeIn("fast")[$.inArray('6', $(this).val()) >=
                                    0 ? 'show' : 'hide']();
                                $("#finam-tab").fadeIn("fast")[$.inArray('7', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#hse-tab").fadeIn("fast")[$.inArray('8', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#finhse-tab").fadeIn("fast")[$.inArray('9', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#hseak-tab").fadeIn("fast")[$.inArray('10', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#finak-tab").fadeIn("fast")[$.inArray('11', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#trans-tab").fadeIn("fast")[$.inArray('12', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();

                                if ($('#abcdef').val() == "1") {
                                    $('#hrd1-tab').fadeIn("fast").show();
                                } else {
                                    $('#hrd1-tab').fadeIn("fast").hide();
                                }
                                if ($('#abcdef').val() == "2") {
                                    $('#hrd1-tab').fadeIn("fast").show();
                                }
                                $('#ot1-tab').fadeIn("fast").hide();
                                $('#hrm1-tab').fadeIn("fast").hide();
                                $('#finmaw1-tab').fadeIn("fast").hide();
                                $('#fsm1-tab').fadeIn("fast").hide();
                                $('#research1-tab').fadeIn("fast").hide();
                                $('#finam1-tab').fadeIn("fast").hide();
                                $('#hse1-tab').fadeIn("fast").hide();
                                $('#finhse1-tab').fadeIn("fast").hide();
                                $('#hseak1-tab').fadeIn("fast").hide();
                                $('#finak1-tab').fadeIn("fast").hide();

                            });
                        });
                        $(document).ready(function() {
                            $('#hrd-tab').on('click', function() {
                                $('#hrd1-tab').fadeIn("fast").show();
                                $('#ot1-tab').fadeIn("fast").hide();
                                $('#hrm1-tab').fadeIn("fast").hide();
                                $('#finmaw1-tab').fadeIn("fast").hide();
                                $('#fsm1-tab').fadeIn("fast").hide();
                                $('#research1-tab').fadeIn("fast").hide();
                                $('#finam1-tab').fadeIn("fast").hide();
                                $('#hse1-tab').fadeIn("fast").hide();
                                $('#finhse1-tab').fadeIn("fast").hide();
                                $('#hseak1-tab').fadeIn("fast").hide();
                                $('#finak1-tab').fadeIn("fast").hide();
                                $('#trans1-tab').fadeIn("fast").hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#ot-tab').on('click', function() {
                                $('#hrd1-tab').fadeIn("fast").hide();
                                $('#ot1-tab').show();
                                $('#hrm1-tab').fadeIn("fast").hide();
                                $('#finmaw1-tab').fadeIn("fast").hide();
                                $('#fsm1-tab').fadeIn("fast").hide();
                                $('#research1-tab').fadeIn("fast").hide();
                                $('#finam1-tab').fadeIn("fast").hide();
                                $('#hse1-tab').fadeIn("fast").hide();
                                $('#finhse1-tab').fadeIn("fast").hide();
                                $('#hseak1-tab').fadeIn("fast").hide();
                                $('#finak1-tab').fadeIn("fast").hide();
                                $('#trans1-tab').fadeIn("fast").hide();
                            });
                        });


                        $(document).ready(function() {
                            $('#hrm-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').show();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').hide();
                                $('#finam-tab').hide();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#finmaw-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').show();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').hide();
                                $('#finam-tab').hide();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').hide();
                            });
                        });


                        $(document).ready(function() {
                            $('#fsm-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').show();
                                $('#research1-tab').hide();
                                $('#finam1-tab').hide();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').hide();
                            });
                        });


                        $(document).ready(function() {
                            $('#research-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').show();
                                $('#finam1-tab').hide();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').hide();
                            });
                        });


                        $(document).ready(function() {
                            $('#finam-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').hide();
                                $('#finam1-tab').show();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').hide();
                            });
                        });


                        $(document).ready(function() {
                            $('#hse-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').hide();
                                $('#finam1-tab').hide();
                                $('#hse1-tab').show();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').hide();
                            });
                        });


                        $(document).ready(function() {
                            $('#finhse-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').hide();
                                $('#finam1-tab').hide();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').show();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#hseak-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').hide();
                                $('#finam1-tab').hide();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').show();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').hide();
                            });
                        });


                        $(document).ready(function() {
                            $('#finak-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').hide();
                                $('#finam1-tab').hide();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').show();
                                $('#trans1-tab').hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#trans-tab').on('click', function() {
                                $('#hrd1-tab').hide();
                                $('#ot1-tab').hide();
                                $('#hrm1-tab').hide();
                                $('#finmaw1-tab').hide();
                                $('#fsm1-tab').hide();
                                $('#research1-tab').hide();
                                $('#finam1-tab').hide();
                                $('#hse1-tab').hide();
                                $('#finhse1-tab').hide();
                                $('#hseak1-tab').hide();
                                $('#finak1-tab').hide();
                                $('#trans1-tab').show();
                            });
                        });
                        </script>



                        <script>
                        $(document).ready(function() {
                            $('.js-example-basic-multiple').select2();
                        });
                        </script>

                        <!-- END SPECIALISED -->
                        @else
                        <div> </div>
                        @endif


<!-- START JPKhas Specialised -->
                    @if(optional($employment->department)->label == 'Jabatan Pendidikan Khas')

                    <?php                
                    $compA = json_decode($competencie->jpkhasdomain);
                    $encodedC = '123';
                    ?>

                    <input id="abcdef" type="hidden" value="{{$encodedC}}">

                    <div class="card">

                        <div class="card-body mt-3">

                            <!-- Specialised Competencies -->
                            <div class="col">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                                    Specialised Competencies</h5>

                                <div class="row m-4">
                                    <div class="col-6" style="text-align: right;">Domain:</div>
                                    <div class="col-6">
                                        <select class="form-select js-example-basic-multiple" id="jpkhasdomain"
                                            multiple="multiple" name="jpkhasdomain[]">

                                            @foreach ($jpkhasdomains as $key => $value)
                                            @if(in_array($key, $compA))
                                            <option value="{{ $key }}" selected>
                                                @else
                                            <option value="{{ $key }}">
                                                @endif
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('jpkhasdomain', '<p class="help-block text-danger">:message</p>')
                                        !!}

                                    </div>
                                </div>

                                @php
                                $compB = json_decode($competencie->jpkhasdomain);
                                @endphp

                               <!-- Default Tabs -->
                               <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @if(in_array("1", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="se-tab" data-bs-toggle="tab"
                                            data-bs-target="#home12-justified" type="button" role="tab"
                                            aria-controls="home12" aria-selected="true">Specialised Education Core Competencies</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="se-tab" data-bs-toggle="tab"
                                            data-bs-target="#home12-justified" type="button" role="tab"
                                            aria-controls="home12" aria-selected="true" style="display:none;">Specialised Education Core Competencies</button>
                                    </li>
                                    @endif


                                    @if(in_array("2", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sfc-tab" data-bs-toggle="tab"
                                            data-bs-target="#home13-justified" type="button" role="tab"
                                            aria-controls="home13" aria-selected="false">Specialised Education Functional Competencies</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sfc-tab" data-bs-toggle="tab"
                                            data-bs-target="#home13-justified" type="button" role="tab"
                                            aria-controls="home13" aria-selected="false" style="display:none;">Specialised Education Functional Competencies</button>
                                    </li>
                                    @endif


                                    @if(in_array("3", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="qa-tab" data-bs-toggle="tab"
                                            data-bs-target="#home14-justified" type="button" role="tab"
                                            aria-controls="home14" aria-selected="false">Quality Assurance</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="qa-tab" data-bs-toggle="tab"
                                            data-bs-target="#home14-justified" type="button" role="tab"
                                            aria-controls="home14" aria-selected="false" style="display:none;">Quality Assurance</button>
                                    </li>
                                    @endif
                                </ul>

                                <!-- Specialised Education Core Competencies Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home12-justified" role="tabpanel"
                                        aria-labelledby="home12-tab">
                                        <div class="card overflow-auto" id="se1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn13" href="#">
                                                    <i class="bi bi-plus-lg "></i>
                                                </button>
                                            </div>


                                            <table class="table-achiev" id="homes12-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compjpkhasseccs) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compjpkhasseccs as $compjpkhassecc )
                                                    <tr>
                                                        <td>{{ $compjpkhassecc->secc_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compjpkhassecc->secc_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compjpkhassecc->secc_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compjpkhassecc->secc_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compjpkhassecc->secc_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compjpkhassecc->secc_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- end ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompjpkhassecc', $compjpkhassecc->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn13').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="secc_competencies[]"><option value=""></option><option value="Assessment">Assessment</option><option value="Equitable Access to Facilitate Learning">Equitable Access to Facilitate Learning</option><option value="Special Education Programme">Special Education Programme</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                secc_rcl
                                                    ') is-invalid @enderror" name="secc_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes12-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Specialised Education Core Competencies Tab -->

                                <!-- Specialised Education Functional Competencies Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home13-justified" role="tabpanel"
                                        aria-labelledby="home13-tab">
                                        <div class="card overflow-auto" id="sfc1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn14" href="#">
                                                    <i class="bi bi-plus-lg "></i>
                                                </button>
                                            </div>


                                            <table class="table-achiev" id="homes13-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compjpkhassefcs) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compjpkhassefcs as $compjpkhassefc )
                                                    <tr>
                                                        <td>{{ $compjpkhassefc->sefc_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compjpkhassefc->sefc_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compjpkhassefc->sefc_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compjpkhassefc->sefc_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compjpkhassefc->sefc_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compjpkhassefc->sefc_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- end ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompjpkhassefc', $compjpkhassefc->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn14').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="sefc_competencies[]"><option value=""></option><option value="SEFC 1 - Hearing Loss">SEFC 1 - Hearing Loss</option><option value="SEFC 2 - Vision Impairment">SEFC 2 - Vision Impairment</option><option value="SEFC 3 - Autism">SEFC 3 - Autism</option><option value="SEFC 4 - Intellectual Disability">SEFC 4 - Intellectual Disability</option><option value="SEFC 5 - Specific Learning Difficulties (Dyslexia)">SEFC 5 - Specific Learning Difficulties (Dyslexia)</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                sefc_rcl
                                                    ') is-invalid @enderror" name="sefc_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes13-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Specialised Education Functional Competencies Tab -->
                                    
                                <!-- Quality Assurance Competencies Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home14-justified" role="tabpanel"
                                        aria-labelledby="home14-tab">
                                        <div class="card overflow-auto" id="qa1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn15" href="#">
                                                    <i class="bi bi-plus-lg "></i>
                                                </button>
                                            </div>


                                            <table class="table-achiev" id="homes14-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compjpkhasqas) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compjpkhasqas as $compjpkhasqa )
                                                    <tr>
                                                        <td>{{ $compjpkhasqa->qa_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compjpkhasqa->qa_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compjpkhasqa->qa_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compjpkhasqa->qa_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compjpkhasqa->qa_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compjpkhasqa->qa_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- end ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompjpkhasqa', $compjpkhasqa->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn15').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="qa_competencies[]"><option value=""></option><option value="Legal and Policies">Legal and Policies</option><option value="Ethics">Ethics</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                qa_rcl
                                                    ') is-invalid @enderror" name="qa_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes14-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Quality Assurance Competencies Tab -->


                                    </div>
                                </div><!-- End Col Specialised Competencies -->
                            </div>
                        </div>

                        <script type="text/javascript">
                        $(document).ready(function() {

                            $('#jpkhasdomain').on('change', function() {
                                $("#se-tab").fadeIn("fast")[$.inArray('1', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#sfc-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >=
                                    0 ? 'show' : 'hide']();
                                $("#qa-tab").fadeIn("fast")[$.inArray('3', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();

                                if ($('#abcdef').val() == "1") {
                                    $('#se1-tab').fadeIn("fast").show();
                                } else {
                                    $('#se1-tab').fadeIn("fast").hide();
                                }
                                if ($('#abcdef').val() == "2") {
                                    $('#se1-tab').fadeIn("fast").show();
                                }
                                $('#sfc1-tab').fadeIn("fast").hide();
                                $('#qa1-tab').fadeIn("fast").hide();
                            });
                        });
                        
                        $(document).ready(function() {
                            $('#se-tab').on('click', function() {
                                $('#se1-tab').fadeIn("fast").show();
                                $('#sfc1-tab').fadeIn("fast").hide();
                                $('#qa1-tab').fadeIn("fast").hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#sfc-tab').on('click', function() {
                                $('#se1-tab').fadeIn("fast").hide();
                                $('#sfc1-tab').show();
                                $('#qa1-tab').fadeIn("fast").hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#qa-tab').on('click', function() {
                                $('#se1-tab').hide();
                                $('#sfc1-tab').hide();
                                $('#qa1-tab').show();
                            });
                        });
                        </script>

                        <script>
                        $(document).ready(function() {
                            $('.js-example-basic-multiple').select2();
                        });
                        </script>

                        @else
                        <div></div>
                        @endif                        
<!-- END JPKhas Specialised -->

<!-- Specialised CCD -->
                    @if (optional($employment->department)->label == 'Bahagian Komunikasi Korporat')
                    <?php                
                    $compA = json_decode($competencie->ccddomain);
                    $encodedC = '123';
                    ?>

                    <input id="abcdef" type="hidden" value="{{$encodedC}}">

                    <div class="card">

                        <div class="card-body mt-3">

                            <!-- Specialised Competencies -->
                            <div class="col">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                                    Specialised Competencies</h5>

                                <div class="row m-4">
                                    <div class="col-6" style="text-align: right;">Domain:</div>
                                    <div class="col-6">
                                        <select class="form-select js-example-basic-multiple" id="ccddomain"
                                            multiple="multiple" name="ccddomain[]">

                                            @foreach ($ccddomains as $key => $value)
                                            @if(in_array($key, $compA))
                                            <option value="{{ $key }}" selected>
                                                @else
                                            <option value="{{ $key }}">
                                                @endif
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('ccddomain', '<p class="help-block text-danger">:message</p>')
                                        !!}

                                    </div>
                                </div>

                                @php
                                $compB = json_decode($competencie->ccddomain);
                                @endphp

                               <!-- Default Tabs -->
                               <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @if(in_array("1", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pr-tab" data-bs-toggle="tab"
                                            data-bs-target="#home15-justified" type="button" role="tab"
                                            aria-controls="home15" aria-selected="true">Public Relation</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pr-tab" data-bs-toggle="tab"
                                            data-bs-target="#home15-justified" type="button" role="tab"
                                            aria-controls="home15" aria-selected="true" style="display:none;">Public Relation</button>
                                    </li>
                                    @endif
                                </ul>

                                <!-- Public Relation Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home15-justified" role="tabpanel"
                                        aria-labelledby="home15-tab">
                                        <div class="card overflow-auto" id="pr1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn16" href="#">
                                                    <i class="bi bi-plus-lg "></i>
                                                </button>
                                            </div>


                                            <table class="table-achiev" id="homes15-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compccdprs) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compccdprs as $compccdpr )
                                                    <tr>
                                                        <td>{{ $compccdpr->pr_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compccdpr->pr_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compccdpr->pr_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compccdpr->pr_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compccdpr->pr_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compccdpr->pr_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- end ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompccdpr', $compccdpr->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn16').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="pr_competencies[]"><option value=""></option><option value="Corporate Branding and Reputation Management">Corporate Branding and Reputation Management</option><option value="Creating Corporate Content">Creating Corporate Content</option><option value="Stakeholder Management">Stakeholder Management</option><option value="Media Relations and Publicity">Media Relations and Publicity</option><option value="Internal Communication">Internal Communication</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                pr_rcl
                                                    ') is-invalid @enderror" name="pr_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes15-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Public Relation Tab -->

                                    </div>
                                </div><!-- End Col Specialised Competencies -->
                            </div>
                        </div>

                        <script type="text/javascript">
                        $(document).ready(function() {

                            $('#ccddomain').on('change', function() {
                                $("#pr-tab").fadeIn("fast")[$.inArray('1', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();

                                if ($('#abcdef').val() == "1") {
                                    $('#pr1-tab').fadeIn("fast").show();
                                } else {
                                    $('#pr1-tab').fadeIn("fast").hide();
                                }
                                if ($('#abcdef').val() == "2") {
                                    $('#pr1-tab').fadeIn("fast").show();
                                }
                                // $('#sfc1-tab').fadeIn("fast").hide();
                                // $('#qa1-tab').fadeIn("fast").hide();
                            });
                        });
                        
                        $(document).ready(function() {
                            $('#pr-tab').on('click', function() {
                                $('#pr1-tab').fadeIn("fast").show();
                            });
                        });
                        </script>

                        <script>
                        $(document).ready(function() {
                            $('.js-example-basic-multiple').select2();
                        });
                        </script>
                        @else
                        <div></div>
                        @endif
<!-- End Specialised CCD -->

<!-- START DICT Specialised -->
                    @if(optional($employment->department)->label == 'Jabatan Teknologi Maklumat dan Komunikasi')

                    <?php                
                    $compA = json_decode($competencie->dictdomain);
                    $encodedC = '123';
                    ?>

                    <input id="abcdef" type="hidden" value="{{$encodedC}}">

                    <div class="card">

                        <div class="card-body mt-3">

                            <!-- Specialised Competencies -->
                            <div class="col">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                                    Specialised Competencies</h5>

                                <div class="row m-4">
                                    <div class="col-6" style="text-align: right;">Domain:</div>
                                    <div class="col-6">
                                        <select class="form-select js-example-basic-multiple" id="dictdomain"
                                            multiple="multiple" name="dictdomain[]">

                                            @foreach ($dictdomains as $key => $value)
                                            @if(in_array($key, $compA))
                                            <option value="{{ $key }}" selected>
                                                @else
                                            <option value="{{ $key }}">
                                                @endif
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('dictdomain', '<p class="help-block text-danger">:message</p>')
                                        !!}

                                    </div>
                                </div>

                                @php
                                $compB = json_decode($competencie->dictdomain);
                                @endphp

                                <!-- Default Tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @if(in_array("1", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="itin-tab" data-bs-toggle="tab"
                                            data-bs-target="#home16-justified" type="button" role="tab"
                                            aria-controls="home16" aria-selected="true">IT Infrastructure and Network</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="itin-tab" data-bs-toggle="tab"
                                            data-bs-target="#home16-justified" type="button" role="tab"
                                            aria-controls="home16" aria-selected="true" style="display:none;">IT Infrastructure and Network</button>
                                    </li>
                                    @endif


                                    @if(in_array("2", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="itsm-tab" data-bs-toggle="tab"
                                            data-bs-target="#home17-justified" type="button" role="tab"
                                            aria-controls="home17" aria-selected="false">IT Service Management</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="itsm-tab" data-bs-toggle="tab"
                                            data-bs-target="#home17-justified" type="button" role="tab"
                                            aria-controls="home17" aria-selected="false" style="display:none;">IT Service Management</button>
                                    </li>
                                    @endif


                                    @if(in_array("3", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ito-tab" data-bs-toggle="tab"
                                            data-bs-target="#home18-justified" type="button" role="tab"
                                            aria-controls="home18" aria-selected="false">IT Operation</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ito-tab" data-bs-toggle="tab"
                                            data-bs-target="#home18-justified" type="button" role="tab"
                                            aria-controls="home18" aria-selected="false" style="display:none;">IT Operation</button>
                                    </li>
                                    @endif

                                    @if(in_array("4", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="its-tab" data-bs-toggle="tab"
                                            data-bs-target="#home19-justified" type="button" role="tab"
                                            aria-controls="home19" aria-selected="false">IT Security</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="its-tab" data-bs-toggle="tab"
                                            data-bs-target="#home19-justified" type="button" role="tab"
                                            aria-controls="home19" aria-selected="false" style="display:none;">IT Security</button>
                                    </li>
                                    @endif                                    
                                </ul>

                                <!-- IT Infrastructure and Network Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home16-justified" role="tabpanel"
                                        aria-labelledby="home16-tab">
                                        <div class="card overflow-auto" id="itin1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn17" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes16-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compdictitins) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compdictitins as $compdictitin )
                                                    <tr>
                                                        <td>{{ $compdictitin->itin_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compdictitin->itin_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compdictitin->itin_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compdictitin->itin_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compdictitin->itin_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compdictitin->itin_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompdictitin', $compdictitin->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn17').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="itin_competencies[]"><option value=""></option><option value="Network Design NTDS">Network Design NTDS</option><option value="Network Support NTAS">Network Support NTAS</option><option value="IT Infrastructure Operation ITOP">IT Infrastructure Operation ITOP</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                itin_rcl
                                                    ') is-invalid @enderror" name="itin_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes16-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End IT Infrastructure and Network Tab -->

                                <!-- IT Service Management Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home17-justified" role="tabpanel"
                                        aria-labelledby="home17-tab">
                                        <div class="card overflow-auto" id="itsm1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn18" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes17-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compdictitsms) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compdictitsms as $compdictitsm )
                                                    <tr>
                                                        <td>{{ $compdictitsm->itsm_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compdictitsm->itsm_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compdictitsm->itsm_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compdictitsm->itsm_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compdictitsm->itsm_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compdictitsm->itsm_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompdictitsm', $compdictitsm->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn18').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="itsm_competencies[]"><option value=""></option><option value="Incident Management USUP">Incident Management USUP</option><option value="Problem Management PBMG">Problem Management PBMG</option><option value="Technology Service Management ITMG">Technology Service Management ITMG</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                itsm_rcl
                                                    ') is-invalid @enderror" name="itsm_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes17-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End IT Service Management Tab -->

                                <!-- IT Operation Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home18-justified" role="tabpanel"
                                        aria-labelledby="home18-tab">
                                        <div class="card overflow-auto" id="ito1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn19" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes18-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compdictitos) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compdictitos as $compdictito )
                                                    <tr>
                                                        <td>{{ $compdictito->ito_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compdictito->ito_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compdictito->ito_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compdictito->ito_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compdictito->ito_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compdictito->ito_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompdictito', $compdictito->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn19').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="ito_competencies[]"><option value=""></option><option value="Application Support ASUP">Application Support ASUP</option><option value="System Software SYSP">System Software SYSP</option><option value="System Installation and Removal HSIN">System Installation and Removal HSIN</option><option value="Configuration Management CFMG">Configuration Management CFMG</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                ito_rcl
                                                    ') is-invalid @enderror" name="ito_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes18-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End IT Operation Tab -->

                                <!-- IT Security Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home19-justified" role="tabpanel"
                                        aria-labelledby="home19-tab">
                                        <div class="card overflow-auto" id="its1-tab"
                                            style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                    id="addbtn20" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes19-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compdictitss) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compdictitss as $compdictits )
                                                    <tr>
                                                        <td>{{ $compdictits->its_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compdictits->its_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compdictits->its_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compdictits->its_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compdictits->its_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compdictits->its_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompdictits', $compdictits->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn20').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="its_competencies[]"><option value=""></option><option value="Information Security SCTY">Information Security SCTY</option><option value="Information Assurance INAS">Information Assurance INAS</option><option value="Security Operation SCAD">Security Operation SCAD</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                its_rcl
                                                    ') is-invalid @enderror" name="its_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes19-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End IT Security Tab -->

                                    </div>
                                </div><!-- End Col Specialised Competencies -->
                            </div>
                        </div>

                        <script type="text/javascript">
                        $(document).ready(function() {

                            $('#dictdomain').on('change', function() {
                                $("#itin-tab").fadeIn("fast")[$.inArray('1', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#itsm-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >=
                                    0 ? 'show' : 'hide']();
                                $("#ito-tab").fadeIn("fast")[$.inArray('3', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#its-tab").fadeIn("fast")[$.inArray('4', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();                                    

                                if ($('#abcdef').val() == "1") {
                                    $('#itin1-tab').fadeIn("fast").show();
                                } else {
                                    $('#itin1-tab').fadeIn("fast").hide();
                                }
                                if ($('#abcdef').val() == "2") {
                                    $('#itin1-tab').fadeIn("fast").show();
                                }
                                $('#itsm1-tab').fadeIn("fast").hide();
                                $('#ito1-tab').fadeIn("fast").hide();
                                $('#its1-tab').fadeIn("fast").hide();
                            });
                        });
                        
                        $(document).ready(function() {
                            $('#itin-tab').on('click', function() {
                                $('#itin1-tab').fadeIn("fast").show();
                                $('#itsm1-tab').fadeIn("fast").hide();
                                $('#ito1-tab').fadeIn("fast").hide();
                                $('#its1-tab').fadeIn("fast").hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#itsm-tab').on('click', function() {
                                $('#itin1-tab').fadeIn("fast").hide();
                                $('#itsm1-tab').show();
                                $('#ito1-tab').fadeIn("fast").hide();
                                $('#its1-tab').fadeIn("fast").hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#ito-tab').on('click', function() {
                                $('#itin1-tab').hide();
                                $('#itsm1-tab').hide();
                                $('#ito1-tab').show();
                                $('#its1-tab').hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#its-tab').on('click', function() {
                                $('#itin1-tab').hide();
                                $('#itsm1-tab').hide();
                                $('#ito1-tab').hide();
                                $('#its1-tab').show();
                            });
                        });                        
                        </script>

                        <script>
                        $(document).ready(function() {
                            $('.js-example-basic-multiple').select2();
                        });
                        </script>

                        @else
                        <div></div>
                        @endif                        
<!-- END DICT Specialised -->                                    

<!-- START MKPK Specialised -->
                    @if(optional($employment->department)->label == 'Majlis Kebangsaan Pengiktirafan Kelulusan (MKPK)')

                    <?php                
                    $compA = json_decode($competencie->mkpkdomain);
                    $encodedC = '123';
                    ?>

                    <input id="abcdef" type="hidden" value="{{$encodedC}}">

                    <div class="card">

                        <div class="card-body mt-3">

                            <!-- Specialised Competencies -->
                            <div class="col">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Specialised Competencies</h5>

                                <div class="row m-4">
                                    <div class="col-6" style="text-align: right;">Domain:</div>
                                    <div class="col-6">
                                        <select class="form-select js-example-basic-multiple" id="mkpkdomain" multiple="multiple" name="mkpkdomain[]">

                                            @foreach ($mkpkdomains as $key => $value)
                                            @if(in_array($key, $compA))
                                            <option value="{{ $key }}" selected>
                                                @else
                                            <option value="{{ $key }}">
                                                @endif
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('mkpkdomain', '<p class="help-block text-danger">:message</p>') !!}

                                    </div>
                                </div>

                                @php
                                $compB = json_decode($competencie->mkpkdomain);
                                @endphp

                                <!-- Default Tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @if(in_array("1", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="mkpkqa-tab" data-bs-toggle="tab" data-bs-target="#home20-justified" type="button" role="tab"
                                            aria-controls="home20" aria-selected="true">Quality Assurance</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="mkpkqa-tab" data-bs-toggle="tab" data-bs-target="#home20-justified" type="button" role="tab"
                                            aria-controls="home20" aria-selected="true" style="display:none;">Quality Assurance</button>
                                    </li>
                                    @endif

                                    @if(in_array("2", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="csm-tab" data-bs-toggle="tab" data-bs-target="#home21-justified" type="button" role="tab"
                                            aria-controls="home21" aria-selected="false">Communication and Stakeholder Management</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="csm-tab" data-bs-toggle="tab" data-bs-target="#home21-justified" type="button" role="tab"
                                            aria-controls="home21" aria-selected="false" style="display:none;">Communication and Stakeholder Management</button>
                                    </li>
                                    @endif


                                    @if(in_array("3", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="dm-tab" data-bs-toggle="tab" data-bs-target="#home22-justified" type="button" role="tab"
                                            aria-controls="home22" aria-selected="false">Data Management</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="dm-tab" data-bs-toggle="tab" data-bs-target="#home22-justified" type="button" role="tab"
                                            aria-controls="home22" aria-selected="false" style="display:none;">Data Management</button>
                                    </li>
                                    @endif

                                    @if(in_array("4", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hr-tab" data-bs-toggle="tab" data-bs-target="#home23-justified" type="button" role="tab"
                                            aria-controls="home23" aria-selected="false">HR</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hr-tab" data-bs-toggle="tab" data-bs-target="#home23-justified" type="button" role="tab"
                                            aria-controls="home23" aria-selected="false" style="display:none;">HR</button>
                                    </li>
                                    @endif                                    

                                    @if(in_array("5", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="as-tab" data-bs-toggle="tab" data-bs-target="#home24-justified" type="button" role="tab"
                                            aria-controls="home24" aria-selected="false">Administrative Services</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="as-tab" data-bs-toggle="tab" data-bs-target="#home24-justified" type="button" role="tab"
                                            aria-controls="home24" aria-selected="false" style="display:none;">Administrative Services</button>
                                    </li>
                                    @endif                                                                        
                                </ul>

                                <!-- Quality Assurance Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home20-justified" role="tabpanel" aria-labelledby="home20-tab">
                                        <div class="card overflow-auto" id="mkpkqa1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn21" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes20-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compmkpkqas) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compmkpkqas as $compmkpkqa )
                                                    <tr>
                                                        <td>{{ $compmkpkqa->mkpkqa_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- RCL -->
                                                        @if ($compmkpkqa->mkpkqa_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compmkpkqa->mkpkqa_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compmkpkqa->mkpkqa_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compmkpkqa->mkpkqa_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compmkpkqa->mkpkqa_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End RCL -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompmkpkqa', $compmkpkqa->id ) }}" class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn21').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="mkpkqa_competencies[]"><option value=""></option><option value="Quality Assurance">Quality Assurance</option><option value="Audit and Compliance">Audit and Compliance</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                mkpkqa_rcl
                                                    ') is-invalid @enderror" name="mkpkqa_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes20-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Quality Assurance Tab -->

                                <!-- Communication and Stakeholder Management Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home21-justified" role="tabpanel" aria-labelledby="home21-tab">
                                        <div class="card overflow-auto" id="csm1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn22" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes21-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compmkpkcsms) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compmkpkcsms as $compmkpkcsm )
                                                    <tr>
                                                        <td>{{ $compmkpkcsm->csm_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- RCL -->
                                                        @if ($compmkpkcsm->csm_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compmkpkcsm->csm_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compmkpkcsm->csm_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compmkpkcsm->csm_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compmkpkcsm->csm_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End RCL -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompmkpkcsm', $compmkpkcsm->id ) }}" class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn22').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="csm_competencies[]"><option value=""></option><option value="Stakeholder Engagement and Relationship Building">Stakeholder Engagement and Relationship Building</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                csm_rcl
                                                    ') is-invalid @enderror" name="csm_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes21-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Communication and Stakeholder Management Tab -->

                                <!-- Data Management Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home22-justified" role="tabpanel" aria-labelledby="home22-tab">
                                        <div class="card overflow-auto" id="dm1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn23" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes22-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compmkpkdms) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compmkpkdms as $compmkpkdm )
                                                    <tr>
                                                        <td>{{ $compmkpkdm->dm_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- RCL -->
                                                        @if ($compmkpkdm->dm_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compmkpkdm->dm_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compmkpkdm->dm_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compmkpkdm->dm_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compmkpkdm->dm_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End RCL -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompmkpkdm', $compmkpkdm->id ) }}" class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn23').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="dm_competencies[]"><option value=""></option><option value="Business Performance Management">Business Performance Management</option><option value="Business Analysis Techniques">Business Analysis Techniques</option><option value="Data Analysis and Management">Data Analysis and Management</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                dm_rcl
                                                    ') is-invalid @enderror" name="dm_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes22-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Data Management Tab -->                                    
                                    
                                <!-- HR Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home23-justified" role="tabpanel" aria-labelledby="home23-tab">
                                        <div class="card overflow-auto" id="hr1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn24" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes23-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compmkpkhrs) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compmkpkhrs as $compmkpkhr )
                                                    <tr>
                                                        <td>{{ $compmkpkhr->hr_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- RCL -->
                                                        @if ($compmkpkhr->hr_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compmkpkhr->hr_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compmkpkhr->hr_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compmkpkhr->hr_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compmkpkhr->hr_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End RCL -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompmkpkhr', $compmkpkhr->id ) }}" class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn24').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="hr_competencies[]"><option value=""></option><option value="Records Repository Management">Records Repository Management</option><option value="Uses Computer and Communication Systems (Business System & Application/Technology">Uses Computer and Communication Systems (Business System & Application/Technology</option><option value="Effective Communication">Effective Communication</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                hr_rcl
                                                    ') is-invalid @enderror" name="hr_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes23-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End HR Tab -->                                    

                                <!-- Administrative Services Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home24-justified" role="tabpanel" aria-labelledby="home24-tab">
                                        <div class="card overflow-auto" id="as1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn25" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes24-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compmkpkass) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compmkpkass as $compmkpkas )
                                                    <tr>
                                                        <td>{{ $compmkpkas->as_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- RCL -->
                                                        @if ($compmkpkas->as_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compmkpkas->as_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compmkpkas->as_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compmkpkas->as_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compmkpkas->as_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End RCL -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompmkpkas', $compmkpkas->id ) }}" class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn25').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="as_competencies[]"><option value=""></option><option value="Analyses and Solves Problem">Analyses and Solves Problem</option><option value="Manages Knowledge and Information">Manages Knowledge and Information</option><option value="Personal Effectiveness and Resilience">Personal Effectiveness and Resilience</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                as_rcl
                                                    ') is-invalid @enderror" name="as_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes24-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Administrative Services Tab -->                                                                        

                                    </div>
                                </div><!-- End Col Specialised Competencies -->
                            </div>
                        </div>

                        <script type="text/javascript">
                        $(document).ready(function() {

                            $('#mkpkdomain').on('change', function() {
                                $("#mkpkqa-tab").fadeIn("fast")[$.inArray('1', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#csm-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >=
                                    0 ? 'show' : 'hide']();
                                $("#dm-tab").fadeIn("fast")[$.inArray('3', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();
                                $("#hr-tab").fadeIn("fast")[$.inArray('4', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();                                    
                                $("#as-tab").fadeIn("fast")[$.inArray('5', $(this)
                                    .val()) >= 0 ? 'show' : 'hide']();

                                if ($('#abcdef').val() == "1") {
                                    $('#mkpkqa1-tab').fadeIn("fast").show();
                                } else {
                                    $('#mkpkqa1-tab').fadeIn("fast").hide();
                                }
                                if ($('#abcdef').val() == "2") {
                                    $('#mkpkqa1-tab').fadeIn("fast").show();
                                }
                                $('#csm1-tab').fadeIn("fast").hide();
                                $('#dm1-tab').fadeIn("fast").hide();
                                $('#hr1-tab').fadeIn("fast").hide();
                                $('#as1-tab').fadeIn("fast").hide();                                
                            });
                        });
                        
                        $(document).ready(function() {
                            $('#mkpkqa-tab').on('click', function() {
                                $('#mkpkqa1-tab').fadeIn("fast").show();
                                $('#csm1-tab').fadeIn("fast").hide();
                                $('#dm1-tab').fadeIn("fast").hide();
                                $('#hr1-tab').fadeIn("fast").hide();
                                $('#as1-tab').fadeIn("fast").hide();                                
                            });
                        });

                        $(document).ready(function() {
                            $('#csm-tab').on('click', function() {
                                $('#mkpkqa1-tab').fadeIn("fast").hide();
                                $('#csm1-tab').show();
                                $('#dm1-tab').fadeIn("fast").hide();
                                $('#hr1-tab').fadeIn("fast").hide();
                                $('#as1-tab').fadeIn("fast").hide();                                
                            });
                        });

                        $(document).ready(function() {
                            $('#dm-tab').on('click', function() {
                                $('#mkpkqa1-tab').hide();
                                $('#csm1-tab').hide();
                                $('#dm1-tab').show();
                                $('#hr1-tab').hide();
                                $('#as1-tab').hide();                                
                            });
                        });

                        $(document).ready(function() {
                            $('#hr-tab').on('click', function() {
                                $('#mkpkqa1-tab').hide();
                                $('#csm1-tab').hide();
                                $('#dm1-tab').hide();
                                $('#hr1-tab').show();
                                $('#as1-tab').hide();                                
                            });
                        });

                        $(document).ready(function() {
                            $('#as-tab').on('click', function() {
                                $('#mkpkqa1-tab').hide();
                                $('#csm1-tab').hide();
                                $('#dm1-tab').hide();
                                $('#hr1-tab').hide();
                                $('#as1-tab').show();
                            });
                        });                                                
                        </script>

                        <script>
                        $(document).ready(function() {
                            $('.js-example-basic-multiple').select2();
                        });
                        </script>

                        @else
                        <div></div>
                        @endif                        
<!-- END MKPK Specialised -->                                    

<!-- START JPPE Specialised -->
                    @if(optional($employment->department)->label == 'Jabatan Perancangan dan Pengurusan Estet')

                    <?php                
                    $compA = json_decode($competencie->jppedomain);
                    $encodedC = '123';
                    ?>

                    <input id="abcdef" type="hidden" value="{{$encodedC}}">

                    <div class="card">

                        <div class="card-body mt-3">

                            <!-- Specialised Competencies -->
                            <div class="col">
                                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Specialised Competencies</h5>

                                <div class="row m-4">
                                    <div class="col-6" style="text-align: right;">Domain:</div>
                                    <div class="col-6">
                                        <select class="form-select js-example-basic-multiple" id="jppedomain" multiple="multiple" name="jppedomain[]">

                                            @foreach ($jppedomains as $key => $value)
                                            @if(in_array($key, $compA))
                                            <option value="{{ $key }}" selected>
                                                @else
                                            <option value="{{ $key }}">
                                                @endif
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('jppedomain', '<p class="help-block text-danger">:message</p>')
                                        !!}

                                    </div>
                                </div>

                                @php
                                $compB = json_decode($competencie->jppedomain);
                                @endphp

                                <!-- Default Tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @if(in_array("1", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="e-tab" data-bs-toggle="tab" data-bs-target="#home25-justified" type="button" role="tab"
                                            aria-controls="home25" aria-selected="true">Engineering</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="e-tab" data-bs-toggle="tab" data-bs-target="#home25-justified" type="button" role="tab"
                                            aria-controls="home25" aria-selected="true" style="display:none;">Engineering</button>
                                    </li>
                                    @endif

                                    @if(in_array("2", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="em-tab" data-bs-toggle="tab" data-bs-target="#home26-justified" type="button" role="tab"
                                            aria-controls="home26" aria-selected="false">Estate Management</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="em-tab" data-bs-toggle="tab" data-bs-target="#home26-justified" type="button" role="tab"
                                            aria-controls="home26" aria-selected="false" style="display:none;">Estate Management</button>
                                    </li>
                                    @endif

                                    @if(in_array("3", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="fmmaw-tab" data-bs-toggle="tab" data-bs-target="#home27-justified" type="button" role="tab"
                                            aria-controls="home27" aria-selected="false">Financial Management(MAW)</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="fmmaw-tab" data-bs-toggle="tab" data-bs-target="#home27-justified" type="button" role="tab"
                                            aria-controls="home27" aria-selected="false" style="display:none;">Financial Management(MAW)</button>
                                    </li>
                                    @endif

                                    @if(in_array("4", $compA))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hrda-tab" data-bs-toggle="tab" data-bs-target="#home28-justified" type="button" role="tab"
                                            aria-controls="home28" aria-selected="false">Human Resource(DA)</button>
                                    </li>
                                    @else
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hrda-tab" data-bs-toggle="tab" data-bs-target="#home28-justified" type="button" role="tab"
                                            aria-controls="home28" aria-selected="false" style="display:none;">Human Resource(DA)</button>
                                    </li>
                                    @endif                                    
                                </ul>

                                <!-- Engineering Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home25-justified" role="tabpanel" aria-labelledby="home25-tab">
                                        <div class="card overflow-auto" id="e1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn26" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes25-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compjppees) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compjppees as $compjppee )
                                                    <tr>
                                                        <td>{{ $compjppee->e_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compjppee->e_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compjppee->e_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compjppee->e_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compjppee->e_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compjppee->e_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompjppee', $compjppee->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn26').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="e_competencies[]"><option value=""></option><option value="Civil & Structural Engineering">Civil & Structural Engineering</option><option value="Mechanical & Electrical Engineering">Mechanical & Electrical Engineering</option><option value="Construction Technology">Construction Technology</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                e_rcl
                                                    ') is-invalid @enderror" name="e_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes25-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Engineering Tab -->

                                <!-- Estate Management Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home26-justified" role="tabpanel" aria-labelledby="home26-tab">
                                        <div class="card overflow-auto" id="em1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn27" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes26-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compjppeems) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compjppeems as $compjppeem )
                                                    <tr>
                                                        <td>{{ $compjppeem->em_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compjppeem->em_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compjppeem->em_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compjppeem->em_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compjppeem->em_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compjppeem->em_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompjppeem', $compjppeem->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn27').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="em_competencies[]"><option value=""></option><option value="Facilities Management">Facilities Management</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                em_rcl
                                                    ') is-invalid @enderror" name="em_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes26-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Estate Management Tab -->

                                <!-- Financial Management(MAW) Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home27-justified" role="tabpanel" aria-labelledby="home27-tab">
                                        <div class="card overflow-auto" id="fmmaw1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn28" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes27-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compjppefmmaws) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compjppefmmaws as $compjppefmmaw )
                                                    <tr>
                                                        <td>{{ $compjppefmmaw->fmmaw_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compjppefmmaw->fmmaw_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compjppefmmaw->fmmaw_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compjppefmmaw->fmmaw_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compjppefmmaw->fmmaw_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compjppefmmaw->fmmaw_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompjppefmmaw', $compjppefmmaw->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn28').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="fmmaw_competencies[]"><option value=""></option><option value="Budget Management">Budget Management</option><option value="Financial Report and Analysis">Financial Report and Analysis</option><option value="Procurement and Payments">Procurement and Payments</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                fmmaw_rcl
                                                    ') is-invalid @enderror" name="fmmaw_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes27-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Financial Management(MAW) Tab -->

                                <!-- Human Resource(DA) Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home28-justified" role="tabpanel" aria-labelledby="home28-tab">
                                        <div class="card overflow-auto" id="hrda1-tab" style="text-align: center;  display:none;">

                                            <div class="col" style="text-align: right;">
                                                <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn29" href="#">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>

                                            <table class="table-achiev" id="homes28-tab">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; width: 280px;">Competencies</th>
                                                        <th style="text-align: center;">Evidences</th>
                                                        <th style="text-align: center; width: 65px;">RCL</th>
                                                        <th style="text-align: center; width: 65px;">ICL</th>
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @if(count($compjppehrdas) == 0)

                                                    <tr class="text-center">
                                                        <td colspan="8">
                                                            <h5>No records found</h5>
                                                        </td>
                                                    </tr>

                                                    @else
                                                    @foreach( $compjppehrdas as $compjppehrda )
                                                    <tr>
                                                        <td>{{ $compjppehrda->hrda_competencies }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary" disabled>Evidences</button>
                                                        </td>

                                                        <!-- Rcl -->
                                                        @if ($compjppehrda->hrda_rcl == '0')
                                                        <td>N/A</td>
                                                        @elseif($compjppehrda->hrda_rcl == '1')
                                                        <td>A</td>
                                                        @elseif($compjppehrda->hrda_rcl == '2')
                                                        <td>K</td>
                                                        @elseif($compjppehrda->hrda_rcl == '3')
                                                        <td>S</td>
                                                        @elseif($compjppehrda->hrda_rcl == '4')
                                                        <td>M</td>
                                                        @else
                                                        <td></td>
                                                        @endif
                                                        <!-- End rcl -->

                                                        <!-- ICL -->
                                                        <td></td>
                                                        <!-- End ICL -->

                                                        <td></td>
                                                        <td></td>

                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>
                                                        <td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>

                                                        <td>
                                                            <div class="col" style="text-align: center;">
                                                                <a href="{{ route('competency.competency.destroycompjppehrda', $compjppehrda->id ) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>


                                        <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#addbtn29').off().on('click', function() {

                                                var html = '';
                                                html += '<tr>';

                                                html += '<td><select class="form-control @error('
                                                competencies
                                                    ') is-invalid @enderror" name="hrda_competencies[]"><option value=""></option><option value="Manpower Planning">Manpower Planning</option><option value="Career Pathway">Career Pathway</option><option value="Performance and Rewards">Performance and Rewards</option><option value="Benefits Management">Benefits Management</option></select></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>';
                                                html += '<td><select class="form-control @error('
                                                hrda_rcl
                                                    ') is-invalid @enderror" name="hrda_rcl[]"><option value=""></option><option value="0">NA</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td>';
                                                html +=
                                                    '<td><input type="text"class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text" class="form-control" disabled></td>';
                                                html +=
                                                    '<td><input type="text"  class="form-control" disabled></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td>';
                                                html +=
                                                    '<td><button class="removeDeclare btn btn-danger btn-sm" type="button"><i class="bi bi-dash"></i></button></i></td>';

                                                html += '</tr>';
                                                $('#homes28-tab').append(html);
                                            })

                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>
                                    <!-- End Human Resource(DA) Tab -->

                                    </div>
                                </div><!-- End Col Specialised Competencies -->
                            </div>
                        </div>

                        <script type="text/javascript">
                        $(document).ready(function() {

                            $('#jppedomain').on('change', function() {
                                $("#e-tab").fadeIn("fast")[$.inArray('1', $(this).val()) >= 0 ? 'show' : 'hide']();
                                $("#em-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >= 0 ? 'show' : 'hide']();
                                $("#fmmaw-tab").fadeIn("fast")[$.inArray('3', $(this).val()) >= 0 ? 'show' : 'hide']();
                                $("#hrda-tab").fadeIn("fast")[$.inArray('4', $(this).val()) >= 0 ? 'show' : 'hide']();

                                if ($('#abcdef').val() == "1") {
                                    $('#e1-tab').fadeIn("fast").show();
                                } else {
                                    $('#e1-tab').fadeIn("fast").hide();
                                }
                                if ($('#abcdef').val() == "2") {
                                    $('#e1-tab').fadeIn("fast").show();
                                }
                                $('#em1-tab').fadeIn("fast").hide();
                                $('#fmmaw1-tab').fadeIn("fast").hide();
                                $('#hrda1-tab').fadeIn("fast").hide();
                            });
                        });
                        
                        $(document).ready(function() {
                            $('#e-tab').on('click', function() {
                                $('#e1-tab').fadeIn("fast").show();
                                $('#em1-tab').fadeIn("fast").hide();
                                $('#fmmaw1-tab').fadeIn("fast").hide();
                                $('#hrda1-tab').fadeIn("fast").hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#em-tab').on('click', function() {
                                $('#e1-tab').fadeIn("fast").hide();
                                $('#em1-tab').show();
                                $('#fmmaw1-tab').fadeIn("fast").hide();
                                $('#hrda1-tab').fadeIn("fast").hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#fmmaw-tab').on('click', function() {
                                $('#e1-tab').hide();
                                $('#em1-tab').hide();
                                $('#fmmaw1-tab').show();
                                $('#hrda1-tab').hide();
                            });
                        });

                        $(document).ready(function() {
                            $('#hrda-tab').on('click', function() {
                                $('#e1-tab').hide();
                                $('#em1-tab').hide();
                                $('#fmmaw1-tab').hide();
                                $('#hrda1-tab').show();
                            });
                        });
                        </script>

                        <script>
                        $(document).ready(function() {
                            $('.js-example-basic-multiple').select2();
                        });
                        </script>

                        @else
                        <div></div>
                        @endif                        
<!-- END JPPE Specialised -->                                    


                        <div class="col" style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

        </form>

    </div>
    </div>
    @endforeach

    </div>
</section>
@endsection