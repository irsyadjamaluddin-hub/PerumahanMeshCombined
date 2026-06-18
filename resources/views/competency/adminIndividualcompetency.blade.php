@extends('layouts.app-all')

@section('title', 'Admin Individual Competency Profile')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php
$pagename = "IndividualCompetency";
?>

<section class="section">
    <div class="row">



        <div class="card">
            <div class="card-body mt-3">
                <h5 class="card-title"
                    style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                    MINISTRY OF EDUCATION<br>Individual Competency Profile (Focal Admin)</h5>

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

                            <form class="" method="post"
                                action="{{ route('competencies.competencie.admincompetencystore') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <tr>
                                    <th scope="row">IC Number</th>
                                    <td><input type="text" name="indv_icno" class="form-control"></td>

                                    <th scope="row">Supervisor's IC Number</th>
                                    <td><input type="text" name="" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td><input type="text" name="indv_name" class="form-control"></td>
                                    <th scope="row">Supervisor's Name</th>
                                    <td><input type="text" name="" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Department</th>
                                    <td><input type="text" name="indv_dept" class="form-control" disabled></td>
                                    <th scope="row">Department</th>
                                    <td><input type="text" name="" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Bahagian/Unit</th>
                                    <td><input type="text" name="indv_post" class="form-control" disabled></td>
                                    <th scope="row">Bahagian/Unit</th>
                                    <td><input type="text" name="" class="form-control" disabled></td>
                                </tr>
                                <tr>
                                    <th scope="row">Salary Scale -<br>Division</th>
                                    <td><input type="text" name="indv_div" class="form-control" disabled></td>
                                    <th scope="row">Date</th>
                                    <td><input type="date" name="date" class="form-control"></td>
                                </tr>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                <select class="form-control @error('pe_lo_rcl') is-invalid @enderror"
                                                    name="pe_lo_rcl">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    name="pc_dcf_rcl">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
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


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End Default Tabs -->

                </div><!-- End Col Core Competencies -->

            </div>
        </div>




        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
</section>
@endsection