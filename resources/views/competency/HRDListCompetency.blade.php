@extends('layouts.app-all')

@section('title', 'HRD Competency List')

@section('content')

<?php
$pagename = "HRDCompetencyList";
?>

<section class="section">
    <div class="row">

        <div class="card">
            <div class="card-body mt-3">
                <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MINISTRY OF EDUCATION<br> HRD Competency List</h5>

                <div class="overflow-auto" style="text-align: center;">
                    <table class="table-achiev datatable" id="tableprestasi">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">IC Number</th>
                                <th style="text-align: center;">Competencies</th>
                                <th style="text-align: center;">Formal Training</th>
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
                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                    Strategic Thinking
                                @endif
                                <!-- If else division -->                                
                                @if(($competencie->indv_div) == "IV" || ($competencie->indv_div) == "V")
                                    Planning & Organising
                                @endif                                    
                                </td>
                                <td>
                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                    {{ $competencie->sd_st_ft }}
                                @endif
                                <!-- If else division -->                                
                                @if(($competencie->indv_div) == "IV" || ($competencie->indv_div) == "V")
                                    {{ $competencie->sd_po_ft }}
                                @endif
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('competencies.competencie.HRDViewIndividual', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </form>
                                        <!---- Chart Button----->
                                        <form method="get" action="{{ route('competencies.competencie.individualchart', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-bar-chart-line"></i>
                                            </button>
                                        </form>                                        
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>{{ $competencie->indv_name }}</td>
                                <td>{{ $competencie->indv_icno }}</td>
                                <td>
                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                    Change & Adaptability
                                @endif
                                <!-- If else division -->                                
                                @if(($competencie->indv_div) == "IV" || ($competencie->indv_div) == "V")
                                    Team Working
                                @endif                                    
                                </td>
                                <td>
                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                    {{ $competencie->sd_ca_ft }}
                                @endif
                                <!-- If else division -->                                
                                @if(($competencie->indv_div) == "IV" || ($competencie->indv_div) == "V")
                                    {{ $competencie->pe_tw_ft }}
                                @endif
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('competencies.competencie.HRDViewIndividual', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </form>
                                        <!---- Chart Button----->
                                        <form method="get" action="{{ route('competencies.competencie.individualchart', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-bar-chart-line"></i>
                                            </button>
                                        </form>                                        
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>{{ $competencie->indv_name }}</td>
                                <td>{{ $competencie->indv_icno }}</td>
                                <td>
                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                    Collaboration & Communication
                                @endif
                                <!-- If else division -->                                
                                @if(($competencie->indv_div) == "IV" || ($competencie->indv_div) == "V")
                                    Personal Effectiveness & Resilience
                                @endif                                    
                                </td>
                                <td>
                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                    {{ $competencie->pe_cc_ft }}
                                @endif
                                <!-- If else division -->                                
                                @if(($competencie->indv_div) == "IV" || ($competencie->indv_div) == "V")
                                    {{ $competencie->pc_per_ft }}
                                @endif
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('competencies.competencie.HRDViewIndividual', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </form>
                                        <!---- Chart Button----->
                                        <form method="get" action="{{ route('competencies.competencie.individualchart', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-bar-chart-line"></i>
                                            </button>
                                        </form>                                        
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>{{ $competencie->indv_name }}</td>
                                <td>{{ $competencie->indv_icno }}</td>
                                <td>
                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                    Leading Others
                                @endif
                                <!-- If else division -->                                
                                @if(($competencie->indv_div) == "IV" || ($competencie->indv_div) == "V")
                                    Quality Delivery & Customer Focus
                                @endif                                    
                                </td>
                                <td>
                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                                    {{ $competencie->pe_lo_ft }}
                                @endif
                                <!-- If else division -->                                
                                @if(($competencie->indv_div) == "IV" || ($competencie->indv_div) == "V")
                                    {{ $competencie->oc_qdcf_ft }}
                                @endif
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('competencies.competencie.HRDViewIndividual', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </form>
                                        <!---- Chart Button----->
                                        <form method="get" action="{{ route('competencies.competencie.individualchart', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-bar-chart-line"></i>
                                            </button>
                                        </form>                                        
                                    </div>
                                </td>
                            </tr>

                                <!-- If else division -->
                                @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II" || ($competencie->indv_div) == "III")
                            <tr>
                                <td>{{ $competencie->indv_name }}</td>
                                <td>{{ $competencie->indv_icno }}</td>
                                <td>
                                    Delivery & Problem Solving
                                </td>
                                <td>
                                    {{ $competencie->oc_qdcf_ft }}
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('competencies.competencie.HRDViewIndividual', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </form>
                                        <!---- Chart Button----->
                                        <form method="get" action="{{ route('competencies.competencie.individualchart', $competencie->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-bar-chart-line"></i>
                                            </button>
                                        </form>                                        
                                    </div>
                                </td>
                            </tr>
                                @endif                              

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