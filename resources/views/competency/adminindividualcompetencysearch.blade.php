@extends('layouts.app-all')

@section('title', 'Admin Individual Competency Profile')

@section('content')

<?php $pagename = 'IndividualCompetency'; ?>

<section class="section">
    <div class="row">

        <div class="card">
            <div class="card-body mt-3">
                <h5 class="card-title"
                    style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                    MINISTRY OF EDUCATION<br>Individual Competency Profile (Focal Admin)</h5>


                @if(count($errors))

                <div class="alert alert-danger">
                    <ul>

                        @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @endif

                <div class="col-lg-12 overflow-auto">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    <form class=" search-form d-flex align-items-center" method="get"
                                        action="{{ route('competency.competency.adminindividualcompetencysearchIC') }}">
                                        @csrf
                                        <input type="text" name="ic_search" class="form-control"
                                            placeholder="Search IC No. Eg. 00123456">
                                        <button type="submit" class="btn btn-primary" title="Search"><i
                                                class="bi bi-search"></i></button>
                                    </form>
                                </td>

                                <th scope="row"></th>
                                <td></td>

                            </tr>

                            <form class="" method="POST"
                                action="{{ route('competencies.competencie.admincompetencystore') }}"
                                enctype="multipart/form-data">
                                @csrf

                                @if (count($biodatas) == 0)
                                <tr>
                                    <th></th>
                                    <td><input type="text" class="bg-gray-200 text-danger form-control"
                                            value="IC Number Not found, Try Again" readonly> </td>
                                    <th></th>
                                    <td></td>
                                </tr>
                                @else
                                @foreach ($biodatas as $biodata)
                                <tr>
                                    <th scope="row">IC Number</th>
                                    <td><input type="text" name="indv_icno" value="{{ $biodata->ic_no }}"
                                            class="form-control" disabled></td>
                                    <input type="text" name="indv_icno" class="bg-gray-200 form-control"
                                        value="{{ $biodata->ic_no }}" hidden>
                                    <th scope="row">Supervisor's IC Number</th>
                                    <td><input type="text" name="" class="form-control" disabled></td>
                                </tr>

                                <tr>
                                    <th scope="row">Name</th>
                                    <td><input type="text" name="indv_name" value="{{ $biodata->name }}"
                                            class="form-control" disabled></td>
                                    <input type="text" name="indv_name" class="bg-gray-200 form-control"
                                        value="{{ $biodata->name }}" hidden>
                                    <th scope="row">Supervisor's Name</th>
                                    <td><input type="text" name="" class="form-control" disabled></td>
                                </tr>
                                @endforeach

                                @foreach ($employments as $employment)
                                <tr>
                                    <th scope="row">Department</th>
                                    <td><input type="text" name="indv_dept"
                                            value="{{ optional($employment->department)->label }}" class="form-control"
                                            disabled></td>
                                    <input type="text" name="indv_dept" class="bg-gray-200 form-control"
                                        value="{{ optional($employment->department)->label }}" hidden>
                                    <input type="text" name="indv_dept_id" class="bg-gray-200 form-control"
                                        value="{{ optional($employment->department)->code }}" hidden>

                                    <th scope="row">Department</th>
                                    <td><input type="text" name="" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Bahagian/Unit</th>
                                    <td><input type="text" name="indv_post" value="{{ $employment->bahagian_id }}"
                                            class="form-control" disabled></td>
                                    <input type="text" name="indv_post" class="bg-gray-200 form-control"
                                        value="{{ $employment->bahagian_id }}" hidden>
                                    <th scope="row">Bahagian/Unit</th>
                                    <td><input type="text" name="" class="form-control" disabled></td>
                                </tr>
                                @endforeach

                                @foreach ($salarys as $salary)
                                <tr>
                                    <th scope="row">Salary Scale -<br>Division</th>
                                    <td><input type="text" name="indv_div"
                                            value=" {{ optional($salary->division)->label }}" class="form-control"
                                            disabled></td>
                                    <input type="text" name="indv_div" class="bg-gray-200 form-control"
                                        value=" {{ optional($salary->division)->label }}" hidden>
                                    <th scope="row">Date</th>
                                    <td><input type="date" name="date" class="form-control" disabled></td>
                                </tr>
                                @endforeach
                                @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body mt-3">
                <div class="col">
                    <h5 class="card-title"
                        style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                        Core Competencies</h5>

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Strategic Direction</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">People Engagement</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                                data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact"
                                aria-selected="false">Performance Culture</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="other-tab" data-bs-toggle="tab"
                                data-bs-target="#other-justified" type="button" role="tab" aria-controls="other"
                                aria-selected="false">Organisation Capability</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                        <div class="tab-pane fade show active" id="home-justified" role="tabpanel"
                            aria-labelledby="home-tab">

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

                                        @foreach ($salarys as $salary)
                                        @if (optional($salary->division)->label == 'I' ||
                                        optional($salary->division)->label == 'II' || optional($salary->division)->label
                                        == 'III')
                                        <tr>

                                            <td>
                                                Strategic Thinking
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror"
                                                    name="sd_st_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>


                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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

                                        <tr>

                                            <td>
                                                Change & Adaptability
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror"
                                                    name="sd_ca_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>


                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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


                                        @elseif (optional($salary->division)->label == 'IV' ||
                                        optional($salary->division)->label == 'V')
                                        <tr>

                                            <td>
                                                Planning & Organising
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror"
                                                    name="sd_po_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>


                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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

                                        @else
                                        <tr></tr>
                                        @endif
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
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

                                        @foreach ($salarys as $salary)
                                        @if (optional($salary->division)->label == 'I' ||
                                        optional($salary->division)->label == 'II' || optional($salary->division)->label
                                        == 'III')
                                        <tr>

                                            <td>
                                                Collaboration & Communication
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('pe_cc_rcl') is-invalid @enderror"
                                                    name="pe_cc_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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

                                        <tr>

                                            <td>
                                                Leading Others
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror"
                                                    name="pe_lo_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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


                                        @elseif (optional($salary->division)->label == 'IV' ||
                                        optional($salary->division)->label == 'V')
                                        <tr>

                                            <td>
                                                Team Working
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('pe_tw_rcl') is-invalid @enderror"
                                                    name="pe_tw_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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

                                        @else
                                        <tr></tr>
                                        @endif
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact-justified" role="tabpanel" aria-labelledby="contact-tab">
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
                                        @foreach ($salarys as $salary)
                                        @if (optional($salary->division)->label == 'I' ||
                                        optional($salary->division)->label == 'II' || optional($salary->division)->label
                                        == 'III')
                                        <tr>

                                            <td>
                                                Delivery & Problem Solving
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('pc_dps_rcl') is-invalid @enderror"
                                                    name="pc_dps_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>


                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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

                                        <tr>

                                            <td>
                                                Digital Fluency
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('pc_df_rcl') is-invalid @enderror"
                                                    name="pc_df_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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


                                        @elseif (optional($salary->division)->label == 'IV' ||
                                        optional($salary->division)->label == 'V')

                                        <tr>

                                            <td>
                                                Personal Effectiveness & Resilience
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('pc_per_rcl') is-invalid @enderror"
                                                    name="pc_per_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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
                                        @else
                                        <tr></tr>
                                        @endif
                                        @endforeach


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

                                        @foreach ($salarys as $salary)
                                        @if (optional($salary->division)->label == 'I' ||
                                        optional($salary->division)->label == 'II' || optional($salary->division)->label
                                        == 'III')
                                        <tr>

                                            <td>
                                                Performance Management & Talent Development
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('oc_pmtd_rcl') is-invalid @enderror"
                                                    name="oc_pmtd_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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

                                        <tr>

                                            <td>
                                                Corporate Governance
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('oc_cg_rcl') is-invalid @enderror"
                                                    name="oc_cg_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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


                                        @elseif (optional($salary->division)->label == 'IV' ||
                                        optional($salary->division)->label == 'V')

                                        <tr>

                                            <td>
                                                Quality Delivery & Customer Focus
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button>
                                            </td>

                                            <td>
                                                <select class="form-control @error('oc_qdcf_rcl') is-invalid @enderror"
                                                    name="oc_qdcf_rcl">
                                                    <option value=""></option>
                                                    <option value="0">NA</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

                                            <td>
                                                <input type="text" name="" class="form-control" disabled>
                                            </td>

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
                                        @else
                                        <tr></tr>
                                        @endif
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End Default Tabs -->

                </div><!-- End Col Core Competencies -->

            </div>
        </div>

        <!-- START SPECIALISED COMPETENCIES -->

        @foreach ($employments as $employment)

        <!-- Start Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan -->
        @if (optional($employment->department)->label == 'Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan')


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

                            <select class="form-select js-example-basic-multiple" id="dadomain" multiple="multiple"
                                name="dadomain[]" required>
                                <option></option>
                                @foreach ($dadomains as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                            {!! $errors->first('dadomain', '<p class="help-block text-danger">:message</p>') !!}


                        </div>
                    </div>


                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="hrd-tab" data-bs-toggle="tab" data-bs-target="#home0-justified"
                                type="button" role="tab" aria-controls="home0" aria-selected="true"
                                style="display:none;">Human Resource Development(HRD)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ot-tab" data-bs-toggle="tab" data-bs-target="#home1-justified"
                                type="button" role="tab" aria-controls="home1" aria-selected="false"
                                style="display:none;">Other Technical</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="hrm-tab" data-bs-toggle="tab" data-bs-target="#home2-justified"
                                type="button" role="tab" aria-controls="home2" aria-selected="false"
                                style="display:none;">Human Resource Management</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="finmaw-tab" data-bs-toggle="tab"
                                data-bs-target="#home3-justified" type="button" role="tab" aria-controls="home3"
                                aria-selected="false" style="display:none;">Finance(MAW)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="fsm-tab" data-bs-toggle="tab" data-bs-target="#home4-justified"
                                type="button" role="tab" aria-controls="home4" aria-selected="false"
                                style="display:none;">Food Services Management</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="research-tab" data-bs-toggle="tab"
                                data-bs-target="#home5-justified" type="button" role="tab" aria-controls="home5"
                                aria-selected="false" style="display:none;">Research</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="finam-tab" data-bs-toggle="tab"
                                data-bs-target="#home6-justified" type="button" role="tab" aria-controls="home6"
                                aria-selected="false" style="display:none;">Finance(AM)</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="hse-tab" data-bs-toggle="tab" data-bs-target="#home7-justified"
                                type="button" role="tab" aria-controls="home7" aria-selected="false"
                                style="display:none;">Healthy Safety Environment(HSE)</button>

                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="finhse-tab" data-bs-toggle="tab"
                                data-bs-target="#home8-justified" type="button" role="tab" aria-controls="home8"
                                aria-selected="false" style="display:none;">Finance(HSE)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="hseak-tab" data-bs-toggle="tab"
                                data-bs-target="#home9-justified" type="button" role="tab" aria-controls="home9"
                                aria-selected="false" style="display:none;">Healthy Safety Environment(AK)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="finak-tab" data-bs-toggle="tab"
                                data-bs-target="#home10-justified" type="button" role="tab" aria-controls="home10"
                                aria-selected="false" style="display:none;">Finance(AK)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="trans-tab" data-bs-toggle="tab"
                                data-bs-target="#home11-justified" type="button" role="tab" aria-controls="home11"
                                aria-selected="false" style="display:none;">Transportation</button>
                        </li>
                    </ul>


                    <!-- Human Resource Development Tab -->
                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                        <div class="tab-pane fade show active" id="home0-justified" role="tabpanel"
                            aria-labelledby="home0-tab">
                            <div class="card overflow-auto" id="hrd1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn1"
                                        href="#">
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
                                            <th style="text-align: center; width: 65px;">Outcome (Agreed)</th>
                                            <th style="text-align: center; width: 65px;">Gap Level</th>
                                            <th style="text-align: center;">On the Job<br>70</th>
                                            <th style="text-align: center;">Social Training<br>20</th>
                                            <th style="text-align: center;">Formal Training<br>10</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][hrd_competencies]"
                                                    id="hrd_competencies[0]"
                                                    class="form-control @error('hrd_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('hrd_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Competency Development & Management">Competency
                                                        Development & Management
                                                    </option>
                                                    <option value="Learning and Development">Learning and Development
                                                    </option>
                                                    <option value="Talent Management">Talent Management</option>

                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][hrd_rcl]" id="hrd_rcl[0]"
                                                    class="form-control @error('hrd_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('hrd_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>



                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn1").click(function() {

                                ++i;

                                $("#homes0-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][hrd_competencies]" class="form-control @error('
                                    hrd_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    hrd_competencies .0 ') }}"><option value=""></option><option value="Competency Development & Management">Competency Development & Management</option><option value="Learning and Development">Learning and Development</option><option value="Talent Management">Talent Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][hrd_rcl]"  class="form-control @error('
                                    hrd_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    hrd_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>
                        <!-- End Human Resoruce Development -->


                        <!-- Other Technical -->
                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                            <div class="tab-pane fade show active" id="home1-justified" role="tabpanel"
                                aria-labelledby="home1-tab">
                                <div class="card overflow-auto" id="ot1-tab" style="text-align: center; display: none;">

                                    <div class="col" style="text-align: right;">
                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2"
                                            href="#">
                                            <i class="bi bi-plus-lg "></i>
                                        </button>
                                    </div>


                                    <table class="table-achiev" id="homes1-tab">
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

                                            <tr class="text-center">

                                                <input type="text" name="moreFields[0][indv_icno]"
                                                    class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}"
                                                    hidden>

                                                <td>
                                                    <select type="text" name="moreFields[0][ot_competencies]"
                                                        id="ot_competencies[0]"
                                                        class="form-control @error('ot_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                        value="{{ old('ot_competencies.0') }}">
                                                        <option value=""></option>
                                                        <option value="Career Pathway ">Career Pathway
                                                        </option>
                                                        <option value="Manpower Planning">Manpower Planning
                                                        </option>
                                                        <option value="Procurement and Tender">Procurement and Tender
                                                        </option>
                                                        <option value="Contract Management">Contract Management
                                                        </option>

                                                    </select>
                                                </td>


                                                <td><button type="button" class="btn btn-primary"
                                                        disabled>Evidences</button></td>



                                                <td><select type="text" name="moreFields[0][ot_rcl]" id="ot_rcl[0]"
                                                        class="form-control @error('ot_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                        value="{{ old('ot_rcl.0') }}">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>

                                                <td><input type="text" name="" class="form-control" disabled></td>

                                                <td><input type="text" name="" class="form-control" disabled></td>
                                                <td><input type="text" name="" class="form-control" disabled></td>

                                                <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button></td>
                                                <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button></td>
                                                <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>
                            </div>

                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn2").click(function() {

                                ++i;

                                $("#homes1-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][ot_competencies]" class="form-control @error('
                                    ot_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    ot_competencies .0 ') }}"><option value="Career Pathway">Career Pathway</option><option value="Manpower Planning">Manpower Planning</option><option value="Procurement and Tender">Procurement and Tender</option><option value="Contract Management">Contract Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i + '][ot_rcl]"  class="form-control @error('
                                    ot_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    ot_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>

                        <!-- Human Resource Management -->
                        <div class="tab-pane fade show active" id="home2-justified" role="tabpanel"
                            aria-labelledby="home2-tab">
                            <div class="card overflow-auto" id="hrm1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn3"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes2-tab">
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


                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][hrm_competencies]"
                                                    id="hrm_competencies[0]"
                                                    class="form-control @error('hrm_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('hrm_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Manpower planning">Manpower planning
                                                    </option>
                                                    <option value="Career Pathway">Career Pathway
                                                    </option>
                                                    <option value="Performance and Rewards">Performance and Rewards
                                                    </option>
                                                    <option value="Benefits Management">Benefits Management
                                                    </option>
                                                    <option value="Employee Relations">Employee Relations
                                                    </option>
                                                    <option value="HR Information and Analysis">HR Information and
                                                        Analysis
                                                    </option>
                                                    <option value="Records Repository Management">Records Repository
                                                        Management
                                                    </option>



                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][hrm_rcl]" id="hrm_rcl[0]"
                                                    class="form-control @error('hrm_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('hrm_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>
                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn3").click(function() {

                                ++i;

                                $("#homes2-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][hrm_competencies]" class="form-control @error('
                                    hrm_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    hrm_competencies .0 ') }}"><option value=""></option><option value="Manpower planning">Manpower planning</option><option value="Career Pathway">Career Pathway</option><option value="Performance and Rewards">Performance and Rewards</option><option value="Benefits Management">Benefits Management</option><option value="Employee Relations">Employee Relations</option><option value="HR Information and Analysis">HR Information and Analysis</option><option value="Records Repository Management">Records Repository Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][hrm_rcl]"  class="form-control @error('
                                    hrm_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    hrm_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>



                        </div>
                        <!-- End Human Resource Management -->

                        <!-- Finance Maw -->
                        <div class="tab-pane fade show active" id="home3-justified" role="tabpanel"
                            aria-labelledby="home3-tab">
                            <div class="card overflow-auto" id="finmaw1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn4"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes3-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>


                                            <td>
                                                <select type="text" name="moreFields[0][finmaw_competencies]"
                                                    id="finmaw_competencies[0]"
                                                    class="form-control @error('finmaw_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('finmaw_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Financial Management and Accounting">Financial
                                                        Management and Accounting
                                                    </option>
                                                    <option value="Budget Management (Performance Budgeting)">Budget
                                                        Management (Performance Budgeting)
                                                    </option>
                                                    <option value="Performance and Rewards">Performance and Rewards
                                                    </option>
                                                    <option value="Benefits Management">Benefits Management
                                                    </option>
                                                    <option value="Financial Report and Analysis">Financial Report and
                                                        Analysis
                                                    </option>
                                                    <option value="Payroll Management">Payroll Management
                                                    </option>
                                                    <option value="Procurement and Payments">Procurement and Payments
                                                    </option>
                                                </select>
                                            </td>




                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][f_rcl]" id="finmaw_rcl[0]"
                                                    class="form-control @error('finmaw_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('finmaw_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn4").click(function() {

                                ++i;

                                $("#homes3-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][finmaw_competencies]" class="form-control @error('
                                    finmaw_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    finmaw_competencies .0 ') }}"><option value=""></option><option value="Financial Management and Accounting">Financial Management and Accounting</option><option value="Budget Management (Performance Budgeting)">Budget Management (Performance Budgeting)</option><option value="Performance and Rewards">Performance and Rewards</option><option value="Benefits Management">Benefits Management</option><option value="Financial Report and Analysis">Financial Report and Analysis</option><option value="Payroll Management">Payroll Management</option><option value="Procurement and Payments">Procurement and Payments</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][finmaw_rcl]"  class="form-control @error('
                                    finmaw_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    finmaw_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
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
                            <div class="card overflow-auto" id="fsm1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn5"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes4-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][fsm_competencies]"
                                                    id="fsm_competencies[0]"
                                                    class="form-control @error('fsm_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('fsm_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Food Safety Training">Food Safety Training
                                                    </option>
                                                    <option value="Food Inspection">Food Inspection
                                                    </option>
                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][fsm_rcl]" id="fsm_rcl[0]"
                                                    class="form-control @error('fsm_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('fsm_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>



                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn5").click(function() {

                                ++i;

                                $("#homes4-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][fsm_competencies]" class="form-control @error('
                                    fsm_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    fsm_competencies .0 ') }}"><option value=""></option><option value="Food Safety Training">Food Safety Training</option><option value="Food Inspection">Food Inspection</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][fsm_rcl]"  class="form-control @error('
                                    fsm_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    fsm_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
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
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn6"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes5-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][research_competencies]"
                                                    id="research_competencies[0]"
                                                    class="form-control @error('research_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('reasearch_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Conducting Research">Conducting Research
                                                    </option>

                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][research_rcl]"
                                                    id="research_rcl[0]"
                                                    class="form-control @error('research_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('research_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>



                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn6").click(function() {

                                ++i;

                                $("#homes5-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][research_competencies]" class="form-control @error('
                                    research_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    research_competencies .0 ') }}"><option value=""></option><option value="Conducting Research">Conducting Research</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][research_rcl]"  class="form-control @error('
                                    research_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    research_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>
                        <!-- End Research-->

                        <!-- Finance(AM) -->
                        <div class="tab-pane fade show active" id="home6-justified" role="tabpanel"
                            aria-labelledby="home6-tab">
                            <div class="card overflow-auto" id="finam1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn7"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes6-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][finam_competencies]"
                                                    id="finam_competencies[0]"
                                                    class="form-control @error('finam_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('finam_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Financial Management and Accounting">Financial
                                                        Management and Accounting
                                                    </option>
                                                    <option value="Claims and Payment">Claims and Payment
                                                    </option>
                                                    <option value="Procurement and Contract Management">Procurement and
                                                        Contract Management
                                                    </option>

                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][finam_rcl]" id="finam_rcl[0]"
                                                    class="form-control @error('finam_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('finam_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn7").click(function() {

                                ++i;

                                $("#homes6-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][finam_competencies]" class="form-control @error('
                                    finam_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    finam_competencies .0 ') }}"><option value=""><option value=""></option><option value="Financial Management and Accounting">Financial Management and Accounting</option><option value="Claims and Payment">Claims and Payment</option><option value="Procurement and Contract Management">Procurement and Contract Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][finam_rcl]"  class="form-control @error('
                                    finam_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    finam_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>
                        <!-- end Finance(Am) -->

                        <!-- Healthy Safety Environment -->
                        <div class="tab-pane fade show active" id="home7-justified" role="tabpanel"
                            aria-labelledby="home7-tab">
                            <div class="card overflow-auto" id="hse1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn8"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes7-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][hse_competencies]"
                                                    id="hse_competencies[0]"
                                                    class="form-control @error('hse_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('hse_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Manage Health Aspect in the Workplace">Manage Health
                                                        Aspect in the Workplace
                                                    </option>
                                                    <option value="Safety in Design">Safety in Design
                                                    </option>
                                                    <option value="Environmental Assessment">Environmental Assessment
                                                    </option>

                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][hse_rcl]" id="hse_rcl[0]"
                                                    class="form-control @error('hse_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('hse_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn8").click(function() {

                                ++i;

                                $("#homes7-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][hse_competencies]" class="form-control @error('
                                    hse_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    hse_competencies .0 ') }}"><option value=""><option value=""></option><option value="Management Health Aspect in the Workplace">Management Health Aspect in the Workplace</option><option value="Safety in Design">Safety in Design</option><option value="Environmental Assessment">Environmental Assessment</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][hse_rcl]"  class="form-control @error('
                                    hse_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    hse_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>
                        <!-- End Healthy Safety Environment Tab -->

                        <!-- Start Finance (HSE) -->
                        <div class="tab-pane fade show active" id="home8-justified" role="tabpanel"
                            aria-labelledby="home8-tab">
                            <div class="card overflow-auto" id="finhse1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn9"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes8-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][finhse_competencies]"
                                                    id="finhse_competencies[0]"
                                                    class="form-control @error('finhse_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('finhse_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Procurement and Tender">Procurement and Tender
                                                    </option>
                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][finhse_rcl]" id="finhse_rcl[0]"
                                                    class="form-control @error('finhse_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('finhse_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn9").click(function() {

                                ++i;

                                $("#homes8-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][finhse_competencies]" class="form-control @error('
                                    finhse_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    finhse_competencies .0 ') }}"><option value=""><option value=""></option><option value="Procurement and Tender">Procurement and Tender</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][finhse_rcl]"  class="form-control @error('
                                    finhse_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    finhse_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>
                        <!-- End Finance HSE Tab -->


                        <!-- Healthy Safety Environment (AK) -->
                        <div class="tab-pane fade show active" id="home9-justified" role="tabpanel"
                            aria-labelledby="home9-tab">
                            <div class="card overflow-auto" id="hseak1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn10"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes9-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][hseak_competencies]"
                                                    id="hseak_competencies[0]"
                                                    class="form-control @error('hseak_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('hseak_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Logistic Management">Logistic Management</option>
                                                    <option value="Utilities Management">Utilities Management</option>
                                                    <option value="Security Personnel Management">Security Personnel
                                                        Management</option>
                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][hseak_rcl]" id="hseak_rcl[0]"
                                                    class="form-control @error('hseak_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('hseak_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn10").click(function() {

                                ++i;

                                $("#homes9-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][hseak_competencies]" class="form-control @error('
                                    hseak_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    hseak_competencies .0 ') }}"><option value=""><option value=""></option> <option value="Logistic Management">Logistic Management</option><option value="Utilities Management">Utilities Management</option><option value="Security Personnel Management">Security Personnel Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][hseak_rcl]"  class="form-control @error('
                                    hseak_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    hseak_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>
                        <!-- End Healthy Safety Environment(AK) Tab -->

                        <!-- Finance (AK) -->
                        <div class="tab-pane fade show active" id="home10-justified" role="tabpanel"
                            aria-labelledby="home10-tab">
                            <div class="card overflow-auto" id="finak1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn11"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes10-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][finak_competencies]"
                                                    id="finak_competencies[0]"
                                                    class="form-control @error('finak_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('finak_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Contract Management">Contract Management</option>
                                                    <option value="Benefit Management">Benefit Management</option>

                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][finak_rcl]" id="finak_rcl[0]"
                                                    class="form-control @error('finak_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('finak_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn10").click(function() {

                                ++i;

                                $("#homes10-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][finak_competencies]" class="form-control @error('
                                    finak_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    finak_competencies .0 ') }}"><option value=""><option value=""></option> <option value="Contract Management">Contract Management</option><option value="Benefit Management">Benefit Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][finak_rcl]"  class="form-control @error('
                                    finak_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    finak_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>
                        <!-- End Finance AK Tab -->

                        <!-- Transportation -->
                        <div class="tab-pane fade show active" id="home11-justified" role="tabpanel"
                            aria-labelledby="home11-tab">
                            <div class="card overflow-auto" id="trans1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn12"
                                        href="#">
                                        <i class="bi bi-plus-lg "></i>
                                    </button>
                                </div>


                                <table class="table-achiev" id="homes11-tab">
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

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]"
                                                class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][trans_competencies]"
                                                    id="trans_competencies[0]"
                                                    class="form-control @error('trans_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('trans_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Logistic Management(Bus Transportation)">Logistic
                                                        Management(Bus Transportation)</option>
                                                    <option value="Logistic Management(Boat Transportation)">Logistic
                                                        Management(Boat Transportation)</option>
                                                    <option value="Logistic Management(BG Transportation)">Logistic
                                                        Management(BG Transportation)</option>
                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>



                                            <td><select type="text" name="moreFields[0][trans_rcl]" id="trans_rcl[0]"
                                                    class="form-control @error('trans_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('trans_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn12").click(function() {

                                ++i;

                                $("#homes11-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][trans_competencies]" class="form-control @error('
                                    trans_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    trans_competencies .0 ') }}"><option value=""><option value=""></option>   <option value="Logistic Management(Bus Transportation)">Logistic Management(Bus Transportation)</option><option value="Logistic Management(Boat Transportation)">Logistic Management(Boat Transportation)</option><option value="Logistic Management(BG Transportation)">Logistic Management(BG Transportation)</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][trans_rcl]"  class="form-control @error('
                                    trans_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    trans_rcl .0 ') }}"><option value=""></option><option value="N/A">N/A</option><option value="A">A</option><option value="K">K</option><option value="S">S</option><option value="M">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>
                        <!-- End Transportation AK Tab -->


                    </div>
                    <!-- </div>End Default Tabs / Inda pakai ni -->

                </div><!-- End Col Specialised Competencies -->

            </div>
        </div>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#hrd-tab').hide();
            $('#dadomain').on('change', function() {

                $("#hrd-tab").fadeIn("fast")[$.inArray('1', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#ot-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#hrm-tab").fadeIn("fast")[$.inArray('3', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#finmaw-tab").fadeIn("fast")[$.inArray('4', $(this).val()) >= 0 ? 'show' :
                    'hide']();
                $("#fsm-tab").fadeIn("fast")[$.inArray('5', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#research-tab").fadeIn("fast")[$.inArray('6', $(this).val()) >= 0 ? 'show' :
                    'hide']();
                $("#finam-tab").fadeIn("fast")[$.inArray('7', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#hse-tab").fadeIn("fast")[$.inArray('8', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#finhse-tab").fadeIn("fast")[$.inArray('9', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#hseak-tab").fadeIn("fast")[$.inArray('10', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#finak-tab").fadeIn("fast")[$.inArray('11', $(this).val()) >= 0 ?
                    'show' : 'hide']();
                $("#trans-tab").fadeIn("fast")[$.inArray('12', $(this).val()) >= 0 ?
                    'show' : 'hide']();

                $('#hrd1-tab').fadeIn("fast").hide();
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
                $('#finam-tab').hide();
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
                $('#finam-tab').hide();
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
                $('#finam-tab').show();
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
                $('#finam-tab').hide();
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
                $('#finam-tab').hide();
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
                $('#finam-tab').hide();
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
                $('#finam-tab').hide();
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
                $('#finam-tab').hide();
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

        <!-- End Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan -->


        <!-- Start Jabatan Pendidikan Khas -->
        @if (optional($employment->department)->label == 'Jabatan Pendidikan Khas')
        <div class="card">
            <div class="card-body mt-3">
                <!-- Specialised Competencies -->
                <div class="col">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Specialised Competencies</h5>

                    <div class="row m-4">
                        <div class="col-6" style="text-align: right;">Domain:</div>
                        <div class="col-6">
                            <select class="form-select js-example-basic-multiple" id="jpkhasdomain" multiple="multiple" name="jpkhasdomain[]">
                                <option></option>
                                @foreach ($jpkhasdomains as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                            {!! $errors->first('jpkhasdomain', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="se-tab" data-bs-toggle="tab" data-bs-target="#home12-justified"
                                type="button" role="tab" aria-controls="home12" aria-selected="true"
                                style="display:none;">Special Education</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sfc-tab" data-bs-toggle="tab"
                                data-bs-target="#home13-justified" type="button" role="tab" aria-controls="home13"
                                aria-selected="false" style="display:none;">Specialized Functional Competencies</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="qa-tab" data-bs-toggle="tab" data-bs-target="#home14-justified"
                                type="button" role="tab" aria-controls="home14" aria-selected="false"
                                style="display:none;">Quality Assurance</button>
                        </li>

                    </ul>

                    <!-- Special Education Tab -->
                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                        <div class="tab-pane fade show active" id="home12-justified" role="tabpanel" aria-labelledby="home12-tab">
                            <div class="card overflow-auto" id="se1-tab" style="text-align: center; display: none;">

                                <div class="col" style="text-align: right;">
                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn13" href="#">
                                        <i class="bi bi-plus-lg"></i>
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
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr class="text-center">

                                            <input type="text" name="moreFields[0][indv_icno]" class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                            <td>
                                                <select type="text" name="moreFields[0][secc_competencies]"
                                                    id="secc_competencies[0]"
                                                    class="form-control @error('secc_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('secc_competencies.0') }}">
                                                    <option value=""></option>
                                                    <option value="Assessment">Assessment</option>
                                                    <option value="Equitable Access to Facilitate Learning">Equitable
                                                        Access to Facilitate Learning</option>
                                                    <option value="Special Education Programme">Special Education
                                                        Programme</option>
                                                </select>
                                            </td>


                                            <td><button type="button" class="btn btn-primary"
                                                    disabled>Evidences</button></td>

                                            <td><select type="text" name="moreFields[0][secc_rcl]" id="secc_rcl[0]"
                                                    class="form-control @error('secc_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                    value="{{ old('secc_rcl.0') }}">
                                                    <option value=""></option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">A</option>
                                                    <option value="2">K</option>
                                                    <option value="3">S</option>
                                                    <option value="4">M</option>
                                                </select>
                                            </td>

                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>
                                            <td><input type="text" name="" class="form-control" disabled></td>

                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>
                                            <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                    disabled></button></td>

                                        </tr>

                                    </tbody>

                                </table>
                            </div>

                            <script type="text/javascript">
                            var i = 0;

                            $("#addbtn13").click(function() {

                                ++i;

                                $("#homes12-tab").append(
                                    '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                    i +
                                    '][secc_competencies]" class="form-control @error('
                                    secc_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    secc_competencies .0 ') }}"><option value=""></option><option value="Assessment">Assessment</option><option value="Equitable Access to Facilitate Learning">Equitable Access to Facilitate Learning</option><option value="Special Education Programme">Special Education Programme</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                    i +
                                    '][secc_rcl]"  class="form-control @error('
                                    secc_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                    secc_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                );
                            });

                            $(document).on('click', '.removeDeclare', function() {
                                $(this).parents('tr').remove();
                            });
                            </script>
                        </div>

                        <!-- Specialized Functional Competencies Tab -->

                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                            <div class="tab-pane fade show active" id="home13-justified" role="tabpanel"
                                aria-labelledby="home13-tab">
                                <div class="card overflow-auto" id="sfc1-tab"
                                    style="text-align: center; display: none;">

                                    <div class="col" style="text-align: right;">
                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn14" href="#">
                                            <i class="bi bi-plus-lg"></i>
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
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr class="text-center">

                                                <input type="text" name="moreFields[0][indv_icno]" class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                                <td>
                                                    <select type="text" name="moreFields[0][sefc_competencies]"
                                                        id="sefc_competencies[0]"
                                                        class="form-control @error('sefc_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                        value="{{ old('sefc_competencies.0') }}">
                                                        <option value=""></option>
                                                        <option value="SEFC 1 - Hearing Loss">SEFC 1 - Hearing Loss
                                                        </option>
                                                        <option value="SEFC 2 - Vision Impairment">SEFC 2 - Vision
                                                            Impairment</option>
                                                        <option value="SEFC 3 - Autism">SEFC 3 - Autism</option>
                                                        <option value="SEFC 4 - Intellectual Disability">SEFC 4 -
                                                            Intellectual Disability</option>
                                                        <option
                                                            value="SEFC 5 - Specific Learning Difficulties (Dyslexia)">
                                                            SEFC 5 - Specific Learning Difficulties (Dyslexia)</option>
                                                    </select>
                                                </td>


                                                <td><button type="button" class="btn btn-primary"
                                                        disabled>Evidences</button></td>

                                                <td><select type="text" name="moreFields[0][sefc_rcl]" id="sefc_rcl[0]"
                                                        class="form-control @error('sefc_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                        value="{{ old('sefc_rcl.0') }}">
                                                        <option value=""></option>
                                                        <option value="0">N/A</option>
                                                        <option value="1">A</option>
                                                        <option value="2">K</option>
                                                        <option value="3">S</option>
                                                        <option value="4">M</option>
                                                    </select>
                                                </td>

                                                <td><input type="text" name="" class="form-control" disabled></td>
                                                <td><input type="text" name="" class="form-control" disabled></td>
                                                <td><input type="text" name="" class="form-control" disabled></td>

                                                <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button></td>
                                                <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button></td>
                                                <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                        disabled></button></td>

                                            </tr>

                                        </tbody>


                                    </table>
                                </div>

                                <script type="text/javascript">
                                var i = 0;

                                $("#addbtn14").click(function() {

                                    ++i;

                                    $("#homes13-tab").append(
                                        '<tr class="text-center"><input type="text" name="moreFields[' + i +
                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                        i +
                                        '][sefc_competencies]" class="form-control @error('
                                        sefc_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                        sefc_competencies .0 ') }}"><option value=""></option><option value="SEFC 1 - Hearing Loss">SEFC 1 - Hearing Loss</option><option value="SEFC 2 - Vision Impairment">SEFC 2 - Vision Impairment</option><option value="SEFC 3 - Autism">SEFC 3 - Autism</option><option value="SEFC 4 - Intellectual Disability">SEFC 4 - Intellectual Disability</option><option value="SEFC 5 - Specific Learning Difficulties (Dyslexia)">SEFC 5 - Specific Learning Difficulties (Dyslexia)</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                        i +
                                        '][sefc_rcl]"  class="form-control @error('
                                        sefc_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                        sefc_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                    );
                                });

                                $(document).on('click', '.removeDeclare', function() {
                                    $(this).parents('tr').remove();
                                });
                                </script>
                            </div>

                            <!-- Quality Assurance Tab -->
                            <div class="tab-content pt-2" id="myTabjustifiedContent">
                                <div class="tab-pane fade show active" id="home14-justified" role="tabpanel"
                                    aria-labelledby="home14-tab">
                                    <div class="card overflow-auto" id="qa1-tab"
                                        style="text-align: center; display: none;">

                                        <div class="col" style="text-align: right;">
                                            <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn15" href="#">
                                                <i class="bi bi-plus-lg"></i>
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
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr class="text-center">

                                                    <input type="text" name="moreFields[0][indv_icno]" class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                                    <td>
                                                        <select type="text" name="moreFields[0][qa_competencies]"
                                                            id="qa_competencies[0]"
                                                            class="form-control @error('qa_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                            value="{{ old('qa_competencies.0') }}">
                                                            <option value=""></option>
                                                            <option value="Legal and Policies">Legal and Policies
                                                            </option>
                                                            <option value="Ethics">Ethics</option>
                                                        </select>
                                                    </td>

                                                    <td><button type="button" class="btn btn-primary"
                                                            disabled>Evidences</button></td>

                                                    <td><select type="text" name="moreFields[0][qa_rcl]" id="qa_rcl[0]"
                                                            class="form-control @error('qa_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                            value="{{ old('qa_rcl.0') }}">
                                                            <option value=""></option>
                                                            <option value="0">N/A</option>
                                                            <option value="1">A</option>
                                                            <option value="2">K</option>
                                                            <option value="3">S</option>
                                                            <option value="4">M</option>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" name="" class="form-control" disabled></td>
                                                    <td><input type="text" name="" class="form-control" disabled></td>
                                                    <td><input type="text" name="" class="form-control" disabled></td>

                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>
                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>
                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>

                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>

                                    <script type="text/javascript">
                                    var i = 0;

                                    $("#addbtn15").click(function() {

                                        ++i;

                                        $("#homes14-tab").append(
                                            '<tr class="text-center"><input type="text" name="moreFields[' +
                                            i +
                                            '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                            i +
                                            '][qa_competencies]" class="form-control @error('
                                            qa_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                            qa_competencies .0 ') }}"><option value=""></option><option value="Legal and Policies">Legal and Policies</option><option value="Ethics">Ethics</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                            i +
                                            '][qa_rcl]"  class="form-control @error('
                                            qa_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                            qa_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                        );
                                    });

                                    $(document).on('click', '.removeDeclare', function() {
                                        $(this).parents('tr').remove();
                                    });
                                    </script>
                                </div>

                            </div>
                            <!-- End Default Tabs -->

                        </div><!-- End Col Specialised Competencies -->

                    </div>
                </div>

                <script type="text/javascript">
                $(document).ready(function() {
                    $('#se-tab').hide();
                    $('#jpkhasdomain').on('change', function() {

                        $("#se-tab").fadeIn("fast")[$.inArray('1', $(this).val()) >= 0 ?
                            'show' : 'hide']();
                        $("#sfc-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >= 0 ?
                            'show' : 'hide']();
                        $("#qa-tab").fadeIn("fast")[$.inArray('3', $(this).val()) >= 0 ?
                            'show' : 'hide']();


                        $('#se1-tab').fadeIn("fast").hide();
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

                <!-- END SPECIALISED -->
                @else
                <div></div>
                @endif
                <!-- End Jabatan Pendidikan Khas -->


                <!-- Specialised CCD -->
                @if (optional($employment->department)->label == 'Bahagian Komunikasi Korporat')
                <div class="card">
                    <div class="card-body mt-3">
                        <!-- Specialised Competencies -->
                        <div class="col">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Specialised Competencies</h5>

                            <div class="row m-4">
                                <div class="col-6" style="text-align: right;">Domain:</div>
                                <div class="col-6">
                                    <select class="form-select js-example-basic-multiple" id="ccddomain" multiple="multiple" name="ccddomain[]">
                                        <option></option>
                                        @foreach ($ccddomains as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('ccddomain', '<p class="help-block text-danger">:message</p>') !!}
                                </div>
                            </div>

                            <!-- Default Tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pr-tab" data-bs-toggle="tab" data-bs-target="#home15-justified" type="button" role="tab" aria-controls="home15" aria-selected="true" style="display:none;">Public Relation</button>
                                </li>
                            </ul>

                            <!-- Public Relation Tab -->
                            <div class="tab-content pt-2" id="myTabjustifiedContent">
                                <div class="tab-pane fade show active" id="home15-justified" role="tabpanel" aria-labelledby="home15-tab">
                                    <div class="card overflow-auto" id="pr1-tab" style="text-align: center; display: none;">

                                        <div class="col" style="text-align: right;">
                                            <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn16" href="#">
                                                <i class="bi bi-plus-lg"></i>
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
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr class="text-center">

                                                    <input type="text" name="moreFields[0][indv_icno]" class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}" hidden>

                                                    <td>
                                                        <select type="text" name="moreFields[0][pr_competencies]"
                                                            id="pr_competencies[0]"
                                                            class="form-control @error('pr_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                            value="{{ old('pr_competencies.0') }}">
                                                            <option value=""></option>
                                                            <option
                                                                value="Corporate Branding and Reputation Management">
                                                                Corporate Branding and Reputation Management</option>
                                                            <option value="Creating Corporate Content">Creating
                                                                Corporate Content</option>
                                                            <option value="Stakeholder Management">Stakeholder
                                                                Management</option>
                                                            <option value="Media Relations and Publicity">Media
                                                                Relations and Publicity</option>
                                                            <option value="Internal Communication">Internal
                                                                Communication</option>
                                                        </select>
                                                    </td>


                                                    <td><button type="button" class="btn btn-primary"
                                                            disabled>Evidences</button></td>

                                                    <td><select type="text" name="moreFields[0][pr_rcl]" id="pr_rcl[0]"
                                                            class="form-control @error('pr_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                            value="{{ old('pr_rcl.0') }}">
                                                            <option value=""></option>
                                                            <option value="0">N/A</option>
                                                            <option value="1">A</option>
                                                            <option value="2">K</option>
                                                            <option value="3">S</option>
                                                            <option value="4">M</option>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" name="" class="form-control" disabled></td>
                                                    <td><input type="text" name="" class="form-control" disabled></td>
                                                    <td><input type="text" name="" class="form-control" disabled></td>

                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>
                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>
                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>

                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>

                                    <script type="text/javascript">
                                    var i = 0;

                                    $("#addbtn16").click(function() {

                                        ++i;

                                        $("#homes15-tab").append(
                                            '<tr class="text-center"><input type="text" name="moreFields[' +
                                            i +
                                            '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                            i +
                                            '][pr_competencies]" class="form-control @error('
                                            pr_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                            pr_competencies .0 ') }}"><option value=""></option><option value="Corporate Branding and Reputation Management">Corporate Branding and Reputation Management</option><option value="Creating Corporate Content">Creating Corporate Content</option><option value="Stakeholder Management">Stakeholder Management</option><option value="Media Relations and Publicity">Media Relations and Publicity</option><option value="Internal Communication">Internal Communication</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                            i +
                                            '][pr_rcl]"  class="form-control @error('
                                            pr_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                            pr_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                        );
                                    });

                                    $(document).on('click', '.removeDeclare', function() {
                                        $(this).parents('tr').remove();
                                    });
                                    </script>
                                </div>

                            </div>
                            <!-- End Default Tabs -->

                        </div><!-- End Col Specialised Competencies -->

                    </div>
                </div>

                <script type="text/javascript">
                $(document).ready(function() {
                    $('#pr-tab').hide();
                    $('#ccddomain').on('change', function() {

                        $("#pr-tab").fadeIn("fast")[$.inArray('1', $(this).val()) >= 0 ?
                            'show' : 'hide']();

                        $('#pr1-tab').fadeIn("fast").hide();
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

                <!-- END SPECIALISED -->
                @else
                <div></div>
                @endif
                <!-- End Specialised CCD -->


                <!-- Specialised DICT -->
                @if (optional($employment->department)->label == 'Jabatan Teknologi Maklumat dan Komunikasi')
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
                                    <select class="form-select js-example-basic-multiple" id="dictdomain"
                                        multiple="multiple" name="dictdomain[]">
                                        <option></option>
                                        @foreach ($dictdomains as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('dictdomain', '<p class="help-block text-danger">:message</p>')
                                    !!}
                                </div>
                            </div>

                            <!-- Default Tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="itin-tab" data-bs-toggle="tab"
                                        data-bs-target="#home16-justified" type="button" role="tab"
                                        aria-controls="home16" aria-selected="true" style="display:none;">IT
                                        Infrastructure and Network</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="itsm-tab" data-bs-toggle="tab"
                                        data-bs-target="#home17-justified" type="button" role="tab"
                                        aria-controls="home17" aria-selected="false" style="display:none;">IT Service
                                        Management</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="ito-tab" data-bs-toggle="tab"
                                        data-bs-target="#home18-justified" type="button" role="tab"
                                        aria-controls="home18" aria-selected="false" style="display:none;">IT
                                        Operation</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="its-tab" data-bs-toggle="tab"
                                        data-bs-target="#home19-justified" type="button" role="tab"
                                        aria-controls="home19" aria-selected="false" style="display:none;">IT
                                        Security</button>
                                </li>
                            </ul>

                            <!-- IT Infrastructure and Network Tab -->
                            <div class="tab-content pt-2" id="myTabjustifiedContent">
                                <div class="tab-pane fade show active" id="home16-justified" role="tabpanel"
                                    aria-labelledby="home16-tab">
                                    <div class="card overflow-auto" id="itin1-tab"
                                        style="text-align: center; display: none;">

                                        <div class="col" style="text-align: right;">
                                            <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn17"
                                                href="#">
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
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr class="text-center">

                                                    <input type="text" name="moreFields[0][indv_icno]"
                                                        class="bg-gray-200 form-control" value="{{ $biodata->ic_no }}"
                                                        hidden>

                                                    <td>
                                                        <select type="text" name="moreFields[0][itin_competencies]"
                                                            id="itin_competencies[0]"
                                                            class="form-control @error('itin_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                            value="{{ old('itin_competencies.0') }}">
                                                            <option value=""></option>
                                                            <option value="Network Design NTDS">Network Design NTDS
                                                            </option>
                                                            <option value="Network Support NTAS">Network Support NTAS
                                                            </option>
                                                            <option value="IT Infrastructure Operation ITOP">IT
                                                                Infrastructure Operation ITOP</option>
                                                        </select>
                                                    </td>

                                                    <td><button type="button" class="btn btn-primary"
                                                            disabled>Evidences</button></td>

                                                    <td><select type="text" name="moreFields[0][itin_rcl]"
                                                            id="itin_rcl[0]"
                                                            class="form-control @error('itin_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                            value="{{ old('itin_rcl.0') }}">
                                                            <option value=""></option>
                                                            <option value="0">N/A</option>
                                                            <option value="1">A</option>
                                                            <option value="2">K</option>
                                                            <option value="3">S</option>
                                                            <option value="4">M</option>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" name="" class="form-control" disabled></td>
                                                    <td><input type="text" name="" class="form-control" disabled></td>
                                                    <td><input type="text" name="" class="form-control" disabled></td>

                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>
                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>
                                                    <td><button type="button" class="btn btn-primary ri-file-edit-fill"
                                                            disabled></button></td>

                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>

                                    <script type="text/javascript">
                                    var i = 0;

                                    $("#addbtn17").click(function() {

                                        ++i;

                                        $("#homes16-tab").append(
                                            '<tr class="text-center"><input type="text" name="moreFields[' +
                                            i +
                                            '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                            i +
                                            '][itin_competencies]" class="form-control @error('
                                            itin_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                            itin_competencies .0 ') }}"><option value=""></option><option value="Network Design NTDS">Network Design NTDS</option><option value="Network Support NTAS">Network Support NTAS</option><option value="IT Infrastructure Operation ITOP">IT Infrastructure Operation ITOP</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                            i +
                                            '][itin_rcl]"  class="form-control @error('
                                            itin_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                            itin_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                        );
                                    });

                                    $(document).on('click', '.removeDeclare', function() {
                                        $(this).parents('tr').remove();
                                    });
                                    </script>
                                </div>

                                <!-- IT Service Management Tab -->
                                <div class="tab-content pt-2" id="myTabjustifiedContent">
                                    <div class="tab-pane fade show active" id="home17-justified" role="tabpanel"
                                        aria-labelledby="home17-tab">
                                        <div class="card overflow-auto" id="itsm1-tab"
                                            style="text-align: center; display: none;">

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
                                                        <th style="text-align: center; width: 65px;">Outcome (Agreed)
                                                        </th>
                                                        <th style="text-align: center; width: 65px;">Gap Level</th>
                                                        <th style="text-align: center;">On the Job<br>70</th>
                                                        <th style="text-align: center;">Social Training<br>20</th>
                                                        <th style="text-align: center;">Formal Training<br>10</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <tr class="text-center">

                                                        <input type="text" name="moreFields[0][indv_icno]"
                                                            class="bg-gray-200 form-control"
                                                            value="{{ $biodata->ic_no }}" hidden>

                                                        <td>
                                                            <select type="text" name="moreFields[0][itsm_competencies]"
                                                                id="itsm_competencies[0]"
                                                                class="form-control @error('itsm_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                value="{{ old('itsm_competencies.0') }}">
                                                                <option value=""></option>
                                                                <option value="Incident Management USUP">Incident
                                                                    Management USUP</option>
                                                                <option value="Problem Management PBMG">Problem
                                                                    Management PBMG</option>
                                                                <option value="Technology Service Management ITMG">
                                                                    Technology Service Management ITMG</option>
                                                            </select>
                                                        </td>

                                                        <td><button type="button" class="btn btn-primary"
                                                                disabled>Evidences</button></td>

                                                        <td><select type="text" name="moreFields[0][itsm_rcl]"
                                                                id="itsm_rcl[0]"
                                                                class="form-control @error('itsm_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                value="{{ old('itsm_rcl.0') }}">
                                                                <option value=""></option>
                                                                <option value="0">N/A</option>
                                                                <option value="1">A</option>
                                                                <option value="2">K</option>
                                                                <option value="3">S</option>
                                                                <option value="4">M</option>
                                                            </select>
                                                        </td>

                                                        <td><input type="text" name="" class="form-control" disabled>
                                                        </td>
                                                        <td><input type="text" name="" class="form-control" disabled>
                                                        </td>
                                                        <td><input type="text" name="" class="form-control" disabled>
                                                        </td>

                                                        <td><button type="button"
                                                                class="btn btn-primary ri-file-edit-fill"
                                                                disabled></button></td>
                                                        <td><button type="button"
                                                                class="btn btn-primary ri-file-edit-fill"
                                                                disabled></button></td>
                                                        <td><button type="button"
                                                                class="btn btn-primary ri-file-edit-fill"
                                                                disabled></button></td>

                                                    </tr>

                                                </tbody>

                                            </table>
                                        </div>

                                        <script type="text/javascript">
                                        var i = 0;

                                        $("#addbtn18").click(function() {

                                            ++i;

                                            $("#homes17-tab").append(
                                                '<tr class="text-center"><input type="text" name="moreFields[' +
                                                i +
                                                '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                i +
                                                '][itsm_competencies]" class="form-control @error('
                                                itsm_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                itsm_competencies .0 ') }}"><option value=""></option><option value="Incident Management USUP">Incident Management USUP</option><option value="Problem Management PBMG">Problem Management PBMG</option><option value="Technology Service Management ITMG">Technology Service Management ITMG</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                i +
                                                '][itsm_rcl]"  class="form-control @error('
                                                itsm_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                itsm_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                            );
                                        });

                                        $(document).on('click', '.removeDeclare', function() {
                                            $(this).parents('tr').remove();
                                        });
                                        </script>
                                    </div>

                                    <!-- IT Operation Tab -->
                                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                                        <div class="tab-pane fade show active" id="home18-justified" role="tabpanel"
                                            aria-labelledby="home18-tab">
                                            <div class="card overflow-auto" id="ito1-tab"
                                                style="text-align: center; display: none;">

                                                <div class="col" style="text-align: right;">
                                                    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                        id="addbtn19" href="#">
                                                        <i class="bi bi-plus-lg"></i>
                                                    </button>
                                                </div>

                                                <table class="table-achiev" id="homes18-tab">
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

                                                        <tr class="text-center">

                                                            <input type="text" name="moreFields[0][indv_icno]"
                                                                class="bg-gray-200 form-control"
                                                                value="{{ $biodata->ic_no }}" hidden>

                                                            <td>
                                                                <select type="text"
                                                                    name="moreFields[0][ito_competencies]"
                                                                    id="ito_competencies[0]"
                                                                    class="form-control @error('ito_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                    value="{{ old('ito_competencies.0') }}">
                                                                    <option value=""></option>
                                                                    <option value="Application Support ASUP">Application
                                                                        Support ASUP</option>
                                                                    <option value="System Software SYSP">System Software
                                                                        SYSP</option>
                                                                    <option
                                                                        value="System Installation and Removal HSIN">
                                                                        System Installation and Removal HSIN</option>
                                                                    <option value="Configuration Management CFMG">
                                                                        Configuration Management CFMG</option>
                                                                </select>
                                                            </td>

                                                            <td><button type="button" class="btn btn-primary"
                                                                    disabled>Evidences</button></td>

                                                            <td><select type="text" name="moreFields[0][ito_rcl]"
                                                                    id="ito_rcl[0]"
                                                                    class="form-control @error('ito_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                    value="{{ old('ito_rcl.0') }}">
                                                                    <option value=""></option>
                                                                    <option value="0">N/A</option>
                                                                    <option value="1">A</option>
                                                                    <option value="2">K</option>
                                                                    <option value="3">S</option>
                                                                    <option value="4">M</option>
                                                                </select>
                                                            </td>

                                                            <td><input type="text" name="" class="form-control"
                                                                    disabled></td>
                                                            <td><input type="text" name="" class="form-control"
                                                                    disabled></td>
                                                            <td><input type="text" name="" class="form-control"
                                                                    disabled></td>

                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary ri-file-edit-fill"
                                                                    disabled></button></td>

                                                        </tr>

                                                    </tbody>

                                                </table>
                                            </div>

                                            <script type="text/javascript">
                                            var i = 0;

                                            $("#addbtn19").click(function() {

                                                ++i;

                                                $("#homes18-tab").append(
                                                    '<tr class="text-center"><input type="text" name="moreFields[' +
                                                    i +
                                                    '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                    i +
                                                    '][ito_competencies]" class="form-control @error('
                                                    ito_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                    ito_competencies .0 ') }}"><option value=""></option><option value="Application Support ASUP">Application Support ASUP</option><option value="System Software SYSP">System Software SYSP</option><option value="System Installation and Removal HSIN">System Installation and Removal HSIN</option><option value="Configuration Management CFMG">Configuration Management CFMG</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                    i +
                                                    '][ito_rcl]"  class="form-control @error('
                                                    ito_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                    ito_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                );
                                            });

                                            $(document).on('click', '.removeDeclare', function() {
                                                $(this).parents('tr').remove();
                                            });
                                            </script>
                                        </div>

                                        <!-- IT Security Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home19-justified" role="tabpanel"
                                                aria-labelledby="home19-tab">
                                                <div class="card overflow-auto" id="its1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn20" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes19-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][its_competencies]"
                                                                        id="its_competencies[0]"
                                                                        class="form-control @error('its_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('its_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Information Security SCTY">
                                                                            Information Security SCTY</option>
                                                                        <option value="Information Assurance INAS">
                                                                            Information Assurance INAS</option>
                                                                        <option value="Security Operation SCAD">Security
                                                                            Operation SCAD</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][its_rcl]"
                                                                        id="its_rcl[0]"
                                                                        class="form-control @error('its_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('its_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn20").click(function() {

                                                    ++i;

                                                    $("#homes19-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][its_competencies]" class="form-control @error('
                                                        its_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        its_competencies .0 ') }}"><option value=""></option><option value="Information Security SCTY">Information Security SCTY</option><option value="Information Assurance INAS">Information Assurance INAS</option><option value="Security Operation SCAD">Security Operation SCAD</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][its_rcl]"  class="form-control @error('
                                                        its_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        its_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div>


                                    </div><!-- End Col Specialised Competencies -->
                                </div>
                            </div>

                            <script type="text/javascript">
                            $(document).ready(function() {
                                $('#itin-tab').hide();
                                $('#dictdomain').on('change', function() {

                                    $("#itin-tab").fadeIn("fast")[$.inArray('1', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#itsm-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#ito-tab").fadeIn("fast")[$.inArray('3', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#its-tab").fadeIn("fast")[$.inArray('4', $(this).val()) >= 0 ?
                                        'show' :
                                        'hide']();

                                    $('#itin1-tab').fadeIn("fast").hide();
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

                            <!-- END SPECIALISED -->
                            @else
                            <div></div>
                            @endif
                            <!-- End Specialised DICT -->

                            <!-- Specialised MKPK -->
                            @if (optional($employment->department)->label == 'Majlis Kebangsaan Pengiktirafan Kelulusan (MKPK)')
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
                                                <select class="form-select js-example-basic-multiple" id="mkpkdomain"
                                                    multiple="multiple" name="mkpkdomain[]">
                                                    <option></option>
                                                    @foreach ($mkpkdomains as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('mkpkdomain', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </div>
                                        </div>

                                        <!-- Default Tabs -->
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="mkpkqa-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home20-justified" type="button" role="tab"
                                                    aria-controls="home20" aria-selected="true"
                                                    style="display:none;">Quality Assurance</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="csm-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home21-justified" type="button" role="tab"
                                                    aria-controls="home21" aria-selected="false"
                                                    style="display:none;">Communication and Stakeholder
                                                    Management</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="dm-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home22-justified" type="button" role="tab"
                                                    aria-controls="home22" aria-selected="false"
                                                    style="display:none;">Data Management</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="hr-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home23-justified" type="button" role="tab"
                                                    aria-controls="home23" aria-selected="false"
                                                    style="display:none;">HR</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="as-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home24-justified" type="button" role="tab"
                                                    aria-controls="home24" aria-selected="false"
                                                    style="display:none;">Administrative Services</button>
                                            </li>
                                        </ul>

                                        <!-- Quality Assurance Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home20-justified" role="tabpanel"
                                                aria-labelledby="home20-tab">
                                                <div class="card overflow-auto" id="mkpkqa1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn21" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes20-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][mkpkqa_competencies]"
                                                                        id="mkpkqa_competencies[0]"
                                                                        class="form-control @error('mkpkqa_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('mkpkqa_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Quality Assurance">Quality
                                                                            Assurance</option>
                                                                        <option value="Audit and Compliance">Audit and
                                                                            Compliance</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][mkpkqa_rcl]"
                                                                        id="mkpkqa_rcl[0]"
                                                                        class="form-control @error('mkpkqa_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('mkpkqa_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn21").click(function() {

                                                    ++i;

                                                    $("#homes20-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][mkpkqa_competencies]" class="form-control @error('
                                                        mkpkqa_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        mkpkqa_competencies .0 ') }}"><option value=""></option><option value="Quality Assurance">Quality Assurance</option><option value="Audit and Compliance">Audit and Compliance</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][mkpkqa_rcl]"  class="form-control @error('
                                                        mkpkqa_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        mkpkqa_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div><!-- Quality Assurance Tab -->

                                        <!-- Communication and Stakeholder Management Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home21-justified" role="tabpanel"
                                                aria-labelledby="home21-tab">
                                                <div class="card overflow-auto" id="csm1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn22" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes21-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][csm_competencies]"
                                                                        id="csm_competencies[0]"
                                                                        class="form-control @error('csm_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('csm_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option
                                                                            value="Stakeholder Engagement and Relationship Building">
                                                                            Stakeholder Engagement and Relationship
                                                                            Building</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][csm_rcl]"
                                                                        id="csm_rcl[0]"
                                                                        class="form-control @error('csm_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('csm_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn22").click(function() {

                                                    ++i;

                                                    $("#homes21-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][csm_competencies]" class="form-control @error('
                                                        csm_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        csm_competencies .0 ') }}"><option value=""></option><option value="Stakeholder Engagement and Relationship Building">Stakeholder Engagement and Relationship Building</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][csm_rcl]"  class="form-control @error('
                                                        csm_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        csm_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div><!-- Communication and Stakeholder Management Tab -->

                                        <!-- Data Management Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home22-justified" role="tabpanel"
                                                aria-labelledby="home22-tab">
                                                <div class="card overflow-auto" id="dm1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn23" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes22-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][dm_competencies]"
                                                                        id="dm_competencies[0]"
                                                                        class="form-control @error('dm_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('dm_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Business Performance Management">
                                                                            Business Performance Management</option>
                                                                        <option value="Business Analysis Techniques">
                                                                            Business Analysis Techniques</option>
                                                                        <option value="Data Analysis and Management">
                                                                            Data Analysis and Management</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][dm_rcl]"
                                                                        id="dm_rcl[0]"
                                                                        class="form-control @error('dm_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('dm_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn23").click(function() {

                                                    ++i;

                                                    $("#homes22-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][dm_competencies]" class="form-control @error('
                                                        dm_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        dm_competencies .0 ') }}"><option value=""></option><option value="Business Performance Management">Business Performance Management</option><option value="Business Analysis Techniques">Business Analysis Techniques</option><option value="Data Analysis and Management">Data Analysis and Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][dm_rcl]"  class="form-control @error('
                                                        dm_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        dm_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div><!-- Data Management Tab -->

                                        <!-- HR Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home23-justified" role="tabpanel"
                                                aria-labelledby="home23-tab">
                                                <div class="card overflow-auto" id="hr1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn24" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes23-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][hr_competencies]"
                                                                        id="hr_competencies[0]"
                                                                        class="form-control @error('hr_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('hr_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Records Repository Management">
                                                                            Records Repository Management</option>
                                                                        <option
                                                                            value="Uses Computer and Communication Systems (Business System & Application/Technology">
                                                                            Uses Computer and Communication Systems
                                                                            (Business System & Application/Technology
                                                                        </option>
                                                                        <option value="Effective Communication">
                                                                            Effective Communication</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][hr_rcl]"
                                                                        id="hr_rcl[0]"
                                                                        class="form-control @error('hr_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('hr_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn24").click(function() {

                                                    ++i;

                                                    $("#homes23-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][hr_competencies]" class="form-control @error('
                                                        hr_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        hr_competencies .0 ') }}"><option value=""></option><option value="Records Repository Management">Records Repository Management</option><option value="Uses Computer and Communication Systems (Business System & Application/Technology">Uses Computer and Communication Systems (Business System & Application/Technology</option><option value="Effective Communication">Effective Communication</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][hr_rcl]"  class="form-control @error('
                                                        hr_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        hr_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div><!-- HR Tab -->

                                        <!-- Administrative Services Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home24-justified" role="tabpanel"
                                                aria-labelledby="home24-tab">
                                                <div class="card overflow-auto" id="as1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn25" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes24-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][as_competencies]"
                                                                        id="as_competencies[0]"
                                                                        class="form-control @error('as_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('as_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Analyses and Solves Problem">
                                                                            Analyses and Solves Problem</option>
                                                                        <option
                                                                            value="Manages Knowledge and Information">
                                                                            Manages Knowledge and Information</option>
                                                                        <option
                                                                            value="Personal Effectiveness and Resilience">
                                                                            Personal Effectiveness and Resilience
                                                                        </option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][as_rcl]"
                                                                        id="as_rcl[0]"
                                                                        class="form-control @error('as_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('as_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn25").click(function() {

                                                    ++i;

                                                    $("#homes24-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][as_competencies]" class="form-control @error('
                                                        as_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        as_competencies .0 ') }}"><option value=""></option><option value="Analyses and Solves Problem">Analyses and Solves Problem</option><option value="Manages Knowledge and Information">Manages Knowledge and Information</option><option value="Personal Effectiveness and Resilience">Personal Effectiveness and Resilience</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][as_rcl]"  class="form-control @error('
                                                        as_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        as_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div><!-- Administrative Services Tab -->

                                    </div><!-- End Col Specialised Competencies -->
                                </div>
                            </div>

                            <script type="text/javascript">
                            $(document).ready(function() {
                                $('#mkpkqa-tab').hide();
                                $('#mkpkdomain').on('change', function() {

                                    $("#mkpkqa-tab").fadeIn("fast")[$.inArray('1', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#csm-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#dm-tab").fadeIn("fast")[$.inArray('3', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#hr-tab").fadeIn("fast")[$.inArray('4', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#as-tab").fadeIn("fast")[$.inArray('5', $(this).val()) >= 0 ?
                                        'show' : 'hide']();

                                    $('#mkpkqa1-tab').fadeIn("fast").hide();
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

                            <!-- END SPECIALISED -->
                            @else
                            <div></div>
                            @endif
                            <!-- End Specialised MKPK -->

                            <!-- Specialised JPPE -->
                            @if (optional($employment->department)->label == 'Jabatan Perancangan dan Pengurusan Estet')
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
                                                <select class="form-select js-example-basic-multiple" id="jppedomain"
                                                    multiple="multiple" name="jppedomain[]">
                                                    <option></option>
                                                    @foreach ($jppedomains as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('jppedomain', '<p class="help-block text-danger">
                                                    :message</p>') !!}
                                            </div>
                                        </div>

                                        <!-- Default Tabs -->
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="e-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home25-justified" type="button" role="tab"
                                                    aria-controls="home25" aria-selected="true"
                                                    style="display:none;">Engineering</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="em-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home26-justified" type="button" role="tab"
                                                    aria-controls="home26" aria-selected="false"
                                                    style="display:none;">Estate Management</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="fmmaw-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home27-justified" type="button" role="tab"
                                                    aria-controls="home27" aria-selected="false"
                                                    style="display:none;">Financial Management(MAW)</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="hrda-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home28-justified" type="button" role="tab"
                                                    aria-controls="home28" aria-selected="false"
                                                    style="display:none;">Human Resource(DA)</button>
                                            </li>
                                        </ul>

                                        <!-- Engineering Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home25-justified" role="tabpanel"
                                                aria-labelledby="home25-tab">
                                                <div class="card overflow-auto" id="e1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn26" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes25-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][e_competencies]"
                                                                        id="e_competencies[0]"
                                                                        class="form-control @error('e_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('e_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Civil & Structural Engineering">
                                                                            Civil & Structural Engineering</option>
                                                                        <option
                                                                            value="Mechanical & Electrical Engineering">
                                                                            Mechanical & Electrical Engineering</option>
                                                                        <option value="Construction Technology">
                                                                            Construction Technology</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][e_rcl]"
                                                                        id="e_rcl[0]"
                                                                        class="form-control @error('e_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('e_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn26").click(function() {

                                                    ++i;

                                                    $("#homes25-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][e_competencies]" class="form-control @error('
                                                        e_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        e_competencies .0 ') }}"><option value=""></option><option value="Civil & Structural Engineering">Civil & Structural Engineering</option><option value="Mechanical & Electrical Engineering">Mechanical & Electrical Engineering</option><option value="Construction Technology">Construction Technology</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][e_rcl]"  class="form-control @error('
                                                        e_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        e_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div>

                                        <!-- Estate Management Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home26-justified" role="tabpanel"
                                                aria-labelledby="home26-tab">
                                                <div class="card overflow-auto" id="em1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn27" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes26-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][em_competencies]"
                                                                        id="em_competencies[0]"
                                                                        class="form-control @error('em_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('em_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Facilities Management">Facilities
                                                                            Management</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][em_rcl]"
                                                                        id="em_rcl[0]"
                                                                        class="form-control @error('em_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('em_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn27").click(function() {

                                                    ++i;

                                                    $("#homes26-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][em_competencies]" class="form-control @error('
                                                        em_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        em_competencies .0 ') }}"><option value=""></option><option value="Facilities Management">Facilities Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][em_rcl]"  class="form-control @error('
                                                        em_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        em_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div>

                                        <!-- Financial Management (MAW) Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home27-justified" role="tabpanel"
                                                aria-labelledby="home27-tab">
                                                <div class="card overflow-auto" id="fmmaw1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn28" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes27-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][fmmaw_competencies]"
                                                                        id="fmmaw_competencies[0]"
                                                                        class="form-control @error('fmmaw_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('fmmaw_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Budget Management">Budget
                                                                            Management</option>
                                                                        <option value="Financial Report and Analysis">
                                                                            Financial Report and Analysis</option>
                                                                        <option value="Procurement and Payments">
                                                                            Procurement and Payments</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][fmmaw_rcl]"
                                                                        id="fmmaw_rcl[0]"
                                                                        class="form-control @error('fmmaw_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('fmmaw_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn28").click(function() {

                                                    ++i;

                                                    $("#homes27-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][fmmaw_competencies]" class="form-control @error('
                                                        fmmaw_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        fmmaw_competencies .0 ') }}"><option value=""></option><option value="Budget Management">Budget Management</option><option value="Financial Report and Analysis">Financial Report and Analysis</option><option value="Procurement and Payments">Procurement and Payments</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][fmmaw_rcl]"  class="form-control @error('
                                                        fmmaw_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        fmmaw_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div>

                                        <!-- Human Resource (DA) Tab -->
                                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                                            <div class="tab-pane fade show active" id="home28-justified" role="tabpanel"
                                                aria-labelledby="home28-tab">
                                                <div class="card overflow-auto" id="hrda1-tab"
                                                    style="text-align: center; display: none;">

                                                    <div class="col" style="text-align: right;">
                                                        <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm"
                                                            id="addbtn29" href="#">
                                                            <i class="bi bi-plus-lg"></i>
                                                        </button>
                                                    </div>

                                                    <table class="table-achiev" id="homes28-tab">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center; width: 280px;">
                                                                    Competencies</th>
                                                                <th style="text-align: center;">Evidences</th>
                                                                <th style="text-align: center; width: 65px;">RCL</th>
                                                                <th style="text-align: center; width: 65px;">ICL</th>
                                                                <th style="text-align: center; width: 65px;">Outcome
                                                                    (Agreed)</th>
                                                                <th style="text-align: center; width: 65px;">Gap Level
                                                                </th>
                                                                <th style="text-align: center;">On the Job<br>70</th>
                                                                <th style="text-align: center;">Social Training<br>20
                                                                </th>
                                                                <th style="text-align: center;">Formal Training<br>10
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="text-center">

                                                                <input type="text" name="moreFields[0][indv_icno]"
                                                                    class="bg-gray-200 form-control"
                                                                    value="{{ $biodata->ic_no }}" hidden>

                                                                <td>
                                                                    <select type="text"
                                                                        name="moreFields[0][hrda_competencies]"
                                                                        id="hrda_competencies[0]"
                                                                        class="form-control @error('hrda_competencies.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('hrda_competencies.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="Manpower Planning">Manpower
                                                                            Planning</option>
                                                                        <option value="Career Pathway">Career Pathway
                                                                        </option>
                                                                        <option value="Performance and Rewards">
                                                                            Performance and Rewards</option>
                                                                        <option value="Benefits Management">Benefits
                                                                            Management</option>
                                                                    </select>
                                                                </td>

                                                                <td><button type="button" class="btn btn-primary"
                                                                        disabled>Evidences</button></td>

                                                                <td><select type="text" name="moreFields[0][hrda_rcl]"
                                                                        id="hrda_rcl[0]"
                                                                        class="form-control @error('hrda_rcl.0') bg-red-100 border-2 border-red-500 @enderror"
                                                                        value="{{ old('hrda_rcl.0') }}">
                                                                        <option value=""></option>
                                                                        <option value="0">N/A</option>
                                                                        <option value="1">A</option>
                                                                        <option value="2">K</option>
                                                                        <option value="3">S</option>
                                                                        <option value="4">M</option>
                                                                    </select>
                                                                </td>

                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>
                                                                <td><input type="text" name="" class="form-control"
                                                                        disabled></td>

                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>
                                                                <td><button type="button"
                                                                        class="btn btn-primary ri-file-edit-fill"
                                                                        disabled></button></td>

                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>

                                                <script type="text/javascript">
                                                var i = 0;

                                                $("#addbtn29").click(function() {

                                                    ++i;

                                                    $("#homes28-tab").append(
                                                        '<tr class="text-center"><input type="text" name="moreFields[' +
                                                        i +
                                                        '][indv_icno]"  value="{{ $biodata->ic_no }}"  class="form-control" hidden><td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][hrda_competencies]" class="form-control @error('
                                                        hrda_competencies .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        hrda_competencies .0 ') }}"><option value=""></option><option value="Manpower Planning">Manpower Planning</option><option value="Career Pathway">Career Pathway</option><option value="Performance and Rewards">Performance and Rewards</option><option value="Benefits Management">Benefits Management</option></select></td> <td><button type="button" class="btn btn-primary" disabled>Evidences</button></td>   <td><select type="text" name="moreFields[' +
                                                        i +
                                                        '][hrda_rcl]"  class="form-control @error('
                                                        hrda_rcl .0 ') bg-red-100 border-2 border-red-500 @enderror" value="{{ old('
                                                        hrda_rcl .0 ') }}"><option value=""></option><option value="0">N/A</option><option value="1">A</option><option value="2">K</option><option value="3">S</option><option value="4">M</option></select></td><td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><input type="text" name="" class="form-control" disabled></td>;<td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td><button type="button" class="btn btn-primary ri-file-edit-fill" disabled></button></td><td class=""><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td></tr>'
                                                    );
                                                });

                                                $(document).on('click', '.removeDeclare', function() {
                                                    $(this).parents('tr').remove();
                                                });
                                                </script>
                                            </div>
                                        </div>

                                    </div><!-- End Col Specialised Competencies -->
                                </div>
                            </div>

                            <script type="text/javascript">
                            $(document).ready(function() {
                                $('#e-tab').hide();
                                $('#jppedomain').on('change', function() {

                                    $("#e-tab").fadeIn("fast")[$.inArray('1', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#em-tab").fadeIn("fast")[$.inArray('2', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#fmmaw-tab").fadeIn("fast")[$.inArray('3', $(this).val()) >= 0 ?
                                        'show' : 'hide']();
                                    $("#hrda-tab").fadeIn("fast")[$.inArray('4', $(this).val()) >= 0 ?
                                        'show' : 'hide']();

                                    $('#e1-tab').fadeIn("fast").hide();
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

                            <!-- END SPECIALISED -->
                            @else
                            <div></div>
                            @endif
                            <!-- End Specialised JPPE -->
                            @endforeach




                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>

                        </div>
</section>
@endsection