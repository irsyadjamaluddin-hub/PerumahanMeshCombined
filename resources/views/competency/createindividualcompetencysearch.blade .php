@extends('layouts.app-all')

@section('title', 'Individual Competency Profile')

@section('content')

<?php
$pagename = "IndividualCompetency";
?>

<section class="section">
    <div class="row">

        <div class="card">
            <div class="card-body mt-3">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MINISTRY OF EDUCATION<br> Individual Competency Profile</h5>

                <div class="col-lg-12 overflow-auto">
                    <table class="table table-bordered">
                        <tbody>


                            <tr>
                                <th scope="row">IC Number</th>
                                <td><input type="text" name="ic_no" value="{{Auth::user()->ic_no }}" class="form-control" readonly></td>

                                <th scope="row">Supervisor's IC Number</th>

                                @if(count($biodatasearchs) == 0)
                                <td><input type="text" class="bg-gray-200 text-danger form-control" value="IC Number Not found, Try Again" readonly> </td>

                                @else
                                @foreach($biodatasearchs as $biodatasearch)
                                <td> <input type="text" name="icno_supervisor" value="{{$biodatasearch->ic_no}}" class="form-control" readonly></td>
                                @endforeach
                                @endif
                            </tr>


                            <tr>
                                <th scope="row">Name</th>
                                <td><input type="text" name="name" value="{{Auth::user()->name }}" class="form-control" readonly></td>

                                <th scope="row">Supervisor's Name</th>

                                @foreach($biodatasearchs as $biodatasearch)

                                <td><input type="text" name="name_supervisor" value="{{$biodatasearch->name}}" class="form-control" readonly></td>

                                @endforeach
                            </tr>


                            <tr>
                                @foreach($employments as $employment)
                                <th scope="row">Department</th>
                                <td><input type="text" name="" value="{{optional($employment->department)->label}}" class="form-control" readonly></td>
                                @endforeach

                                <th scope="row">Department</th>


                                @foreach($employmentsearchs as $employmentsearch)
                                <td><input type="text" name="" class="form-control" value="{{optional($employmentsearch->department)->label}}" readonly></td>
                                @endforeach
                            </tr>


                            <tr>
                                @foreach($employments as $employment)
                                <th scope="row">Position</th>
                                <td><input type="text" name="" value="{{$employment->bahagian_id}}" class="form-control" readonly></td>
                                @endforeach


                                <th scope="row">Position</th>
                                @foreach($employmentsearchs as $employmentsearch)
                                <td><input type="text" name="" class="form-control" value="{{$employmentsearch->bahagian_id}}" readonly></td>
                                @endforeach

                            </tr>
                            <tr>
                                @foreach($employments as $employment)
                                <th scope="row">Bahagian</th>
                                <td><input type="text" name="" value="{{optional($employment->employmentstatus)->label }}" class="form-control" readonly></td>
                                @endforeach

                                <th scope="row">Date</th>


                                @foreach($employmentsearchs as $employmentsearch)
                                <td><input type="text" name="" value="{{optional($employmentsearch->employmentstatus)->label }}" class="form-control" readonly></td>
                                @endforeach
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
                                        <tr>

                                            <td>
                                                Strategic Thinking
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#StrategicThinkingEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="StrategicThinkingEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Strategic Thinking - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td style="background-color: Red; color: white;">
                                                -3
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#StrategicThinkingOTJ"></button>
                                                <div class="modal fade" id="StrategicThinkingOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Strategic Thinking - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#StrategicThinkingCM"></button>
                                                <div class="modal fade" id="StrategicThinkingCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Strategic Thinking - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#StrategicThinkingFT"></button>
                                                <div class="modal fade" id="StrategicThinkingFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Strategic Thinking - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Change & Adaptability
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChangeAdaptabilityEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="ChangeAdaptabilityEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Change & Adaptability - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>

                                            <td>

                                            </td>

                                            <td style="background-color: Green; color: white;">
                                                -1
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#ChangeAdaptabilityOTJ"></button>
                                                <div class="modal fade" id="ChangeAdaptabilityOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Change & Adaptability - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#ChangeAdaptabilityCM"></button>
                                                <div class="modal fade" id="ChangeAdaptabilityCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Change & Adaptability - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#ChangeAdaptabilityFT"></button>
                                                <div class="modal fade" id="ChangeAdaptabilityFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Change & Adaptability - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>
                                        </tr>

                                        <tr>

                                            <td>
                                                Planning & Organising
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PlanningOrganisingEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="PlanningOrganisingEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Planning & Organising - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td style="background-color: Yellow;">
                                                -2
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PlanningOrganisingOTJ"></button>
                                                <div class="modal fade" id="PlanningOrganisingOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Planning & Organising - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PlanningOrganisingCM"></button>
                                                <div class="modal fade" id="PlanningOrganisingCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Planning & Organising - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PlanningOrganisingFT"></button>
                                                <div class="modal fade" id="PlanningOrganisingFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Planning & Organising - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
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
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CollaborationCommunicationEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="CollaborationCommunicationEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Collaboration & Communication - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CollaborationCommunicationOTJ"></button>
                                                <div class="modal fade" id="CollaborationCommunicationOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Collaboration & Communication - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CollaborationCommunicationCM"></button>
                                                <div class="modal fade" id="CollaborationCommunicationCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Collaboration & Communication - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CollaborationCommunicationFT"></button>
                                                <div class="modal fade" id="CollaborationCommunicationFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Collaboration & Communication - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Leading Others
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#LeadingOthersEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="LeadingOthersEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Leading Others - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#LeadingOthersOTJ"></button>
                                                <div class="modal fade" id="LeadingOthersOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Leading Others - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#LeadingOthersCM"></button>
                                                <div class="modal fade" id="LeadingOthersCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Leading Others - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#LeadingOthersFT"></button>
                                                <div class="modal fade" id="LeadingOthersFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Leading Others - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Team Working
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TeamWorkingEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="TeamWorkingEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Team Working - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#TeamWorkingOTJ"></button>
                                                <div class="modal fade" id="TeamWorkingOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Team Working - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#TeamWorkingCM"></button>
                                                <div class="modal fade" id="TeamWorkingCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Team Working - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#TeamWorkingFT"></button>
                                                <div class="modal fade" id="TeamWorkingFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Team Working - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
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
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DeliveryProblemSolvingEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="DeliveryProblemSolvingEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delivery & Problem Solving - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#DeliveryProblemSolvingOTJ"></button>
                                                <div class="modal fade" id="DeliveryProblemSolvingOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delivery & Problem Solving - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#DeliveryProblemSolvingCM"></button>
                                                <div class="modal fade" id="DeliveryProblemSolvingCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delivery & Problem Solving - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#DeliveryProblemSolvingFT"></button>
                                                <div class="modal fade" id="DeliveryProblemSolvingFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delivery & Problem Solving - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Digital Fluency
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DigitalFluencyEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="DigitalFluencyEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Digital Fluency - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#DigitalFluencyOTJ"></button>
                                                <div class="modal fade" id="DigitalFluencyOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Digital Fluency - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#DigitalFluencyCM"></button>
                                                <div class="modal fade" id="DigitalFluencyCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Digital Fluency - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#DigitalFluencyFT"></button>
                                                <div class="modal fade" id="DigitalFluencyFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Digital Fluency - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Personal Effectiveness & Resilience
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PersonalEffectivenessResilienceEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="PersonalEffectivenessResilienceEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Personal Effectiveness & Resilience - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PersonalEffectivenessResilienceOTJ"></button>
                                                <div class="modal fade" id="PersonalEffectivenessResilienceOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Personal Effectiveness & Resilience - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PersonalEffectivenessResilienceCM"></button>
                                                <div class="modal fade" id="PersonalEffectivenessResilienceCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Personal Effectiveness & Resilience - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PersonalEffectivenessResilienceFT"></button>
                                                <div class="modal fade" id="PersonalEffectivenessResilienceFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Personal Effectiveness & Resilience - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
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
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PerformanceManagementTalentDevelopmentEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="PerformanceManagementTalentDevelopmentEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Performance Management & Talent Development - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PerformanceManagementTalentDevelopmentOTJ"></button>
                                                <div class="modal fade" id="PerformanceManagementTalentDevelopmentOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Performance Management & Talent Development - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PerformanceManagementTalentDevelopmentCM"></button>
                                                <div class="modal fade" id="PerformanceManagementTalentDevelopmentCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Performance Management & Talent Development - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#PerformanceManagementTalentDevelopmentFT"></button>
                                                <div class="modal fade" id="PerformanceManagementTalentDevelopmentFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Performance Management & Talent Development - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Corporate Governance
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CorporateGovernanceEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="CorporateGovernanceEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Corporate Governance - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CorporateGovernanceOTJ"></button>
                                                <div class="modal fade" id="CorporateGovernanceOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Corporate Governance - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CorporateGovernanceCM"></button>
                                                <div class="modal fade" id="CorporateGovernanceCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Corporate Governance - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CorporateGovernanceFT"></button>
                                                <div class="modal fade" id="CorporateGovernanceFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Corporate Governance - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Quality Delivery & Customer Focus
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#QualityDeliveryCustomerFocusEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="QualityDeliveryCustomerFocusEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Quality Delivery & Customer Focus - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#QualityDeliveryCustomerFocusOTJ"></button>
                                                <div class="modal fade" id="QualityDeliveryCustomerFocusOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Quality Delivery & Customer Focus - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#QualityDeliveryCustomerFocusCM"></button>
                                                <div class="modal fade" id="QualityDeliveryCustomerFocusCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Quality Delivery & Customer Focus - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#QualityDeliveryCustomerFocusFT"></button>
                                                <div class="modal fade" id="QualityDeliveryCustomerFocusFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Quality Delivery & Customer Focus - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
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


        <div class="card">
            <div class="card-body mt-3">
                <!-- Specialised Competencies -->
                <div class="col">
                    <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Specialised Competencies</h5>

                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home1-tab" data-bs-toggle="tab" data-bs-target="#home1-justified" type="button" role="tab" aria-controls="home1" aria-selected="true">Engineering</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile2-tab" data-bs-toggle="tab" data-bs-target="#profile2-justified" type="button" role="tab" aria-controls="profile2" aria-selected="false">Estate Management</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact3-tab" data-bs-toggle="tab" data-bs-target="#contact3-justified" type="button" role="tab" aria-controls="contact3" aria-selected="false">Financial Management (MAW)</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="other4-tab" data-bs-toggle="tab" data-bs-target="#other4-justified" type="button" role="tab" aria-controls="other4" aria-selected="false">Human Resource (DA)</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabjustifiedContent">
                        <div class="tab-pane fade show active" id="home1-justified" role="tabpanel" aria-labelledby="home1-tab">
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
                                                Civil & Structural Engineering
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CivilStructuralEngineeringEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="CivilStructuralEngineeringEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Civil & Structural Engineering - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td style="background-color: Red; color: white;">
                                                -3
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CivilStructuralEngineeringOTJ"></button>
                                                <div class="modal fade" id="CivilStructuralEngineeringOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Civil & Structural Engineering - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CivilStructuralEngineeringCM"></button>
                                                <div class="modal fade" id="CivilStructuralEngineeringCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Civil & Structural Engineering - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#CivilStructuralEngineeringFT"></button>
                                                <div class="modal fade" id="CivilStructuralEngineeringFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Civil & Structural Engineering - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Mechanical & Electrical Engineering
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#MechanicalElectricalEngineeringEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="MechanicalElectricalEngineeringEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Mechanical & Electrical Engineering - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td style="background-color: Yellow;">
                                                -2
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#MechanicalElectricalEngineeringOTJ"></button>
                                                <div class="modal fade" id="MechanicalElectricalEngineeringOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Mechanical & Electrical Engineering - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#MechanicalElectricalEngineeringCM"></button>
                                                <div class="modal fade" id="MechanicalElectricalEngineeringCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Mechanical & Electrical Engineering - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#MechanicalElectricalEngineeringFT"></button>
                                                <div class="modal fade" id="MechanicalElectricalEngineeringFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Mechanical & Electrical Engineering - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>
                                                Construction Technology
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ConstructionTechnologyEvidence">
                                                    Evidences
                                                </button>
                                                <div class="modal fade" id="ConstructionTechnologyEvidence" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Construction Technology - Evidences</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" style="height: 150px"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                <select class="form-control @error('self') is-invalid @enderror" name="self">
                                                    <option value=""></option>
                                                    <option value="NA">NA</option>
                                                    <option value="A">A</option>
                                                    <option value="K">K</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                </select>
                                            </td>


                                            <td>

                                            </td>

                                            <td style="background-color: Green; color: white;">
                                                -1
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#ConstructionTechnologyOTJ"></button>
                                                <div class="modal fade" id="ConstructionTechnologyOTJ" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Construction Technology - On the Job</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#ConstructionTechnologyCM"></button>
                                                <div class="modal fade" id="ConstructionTechnologyCM" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Construction Technology - Social Learning</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                            <td>
                                                <!-- Basic Modal -->
                                                <button type="button" class="btn btn-primary ri-file-edit-fill" data-bs-toggle="modal" data-bs-target="#ConstructionTechnologyFT"></button>
                                                <div class="modal fade" id="ConstructionTechnologyFT" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Construction Technology - Formal Training</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Supervisor add here
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile2-justified" role="tabpanel" aria-labelledby="profile2-tab">
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

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact3-justified" role="tabpanel" aria-labelledby="contact3-tab">
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

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="other4-justified" role="tabpanel" aria-labelledby="other4-tab">
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

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End Default Tabs -->

                </div><!-- End Col Specialised Competencies -->
            </div>
        </div>

    </div>
</section>
@endsection