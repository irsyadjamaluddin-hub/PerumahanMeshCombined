@extends('layouts.app-all')

@section('title', 'Dashboard Individual Competency Profile')

@section('content')

<?php
$pagename = "IndividualCompetency";
?>

<section class="section">
  <div class="row">

    <div class="card">
      <div class="card-body mt-3">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MINISTRY OF EDUCATION<br> Dashboard Individual View Competency Profile</h5>

        <div class="col-lg-12 overflow-auto">
          <table class="table table-bordered">
            <tbody>
@foreach ($competencies as $competencie)
                <tr style="vertical-align:middle;">
                  <th scope="row">IC Number</th>
                  <td><input type="text" name="indv_icno" value="{{$competencie->indv_icno}}" class="form-control" disabled></td>
                  <th scope="row">Supervisor's IC Number</th>
                  <td><input type="text" name="supv_icno" value="{{$competencie->supv_icno}}" class="form-control" disabled></td>
                </tr>
                <tr>
                  <th scope="row">Name</th>
                  <td><input type="text" name="indv_name" value="{{$competencie->indv_name}}" class="form-control" disabled></td>
                  <th scope="row">Supervisor's Name</th>
                  <td><input type="text" name="supv_name" value="{{$competencie->supv_name}}" class="form-control" disabled></td>                  
                </tr>
                <tr>
                  <th scope="row">Department</th>
                  <td><input type="text" name="indv_dept" value="{{$competencie->indv_dept}}" class="form-control" disabled></td>
                  <th scope="row">Department</th>
                  <td><input type="text" name="supv_dept" value="{{$competencie->supv_dept}}" class="form-control" disabled></td>
                </tr>
                <tr>
                  <th scope="row">Bahagian/Unit</th>
                  <td><input type="text" name="indv_post" value="{{$competencie->indv_post}}" class="form-control" disabled></td>
                  <th scope="row">Bahagian/Unit</th>
                  <td><input type="text" name="supv_post" value="{{$competencie->supv_post}}" class="form-control" disabled></td>
                </tr>
                <tr>
                  <th scope="row">Salary Scale -<br>Division</th>
                  <td><input type="text" name="indv_div" value="{{$competencie->indv_div}}" class="form-control" disabled></td>
                  <th scope="row">Date</th>
                  <td><input type="date" name="date" value="{{$competencie->date}}" class="form-control" disabled></td>
                </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>


    <!-- Competency Progress -->
    <div class="card">
      <div class="card-body mt-3">
        <div class="col">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Competency Progress</h5>

                    <!-- If else division -->
                    @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")
                              @php
                              $outcome1 = ($competencie->sd_st_outcome);
                              $rcl1 = ($competencie->sd_st_rcl);
                              $difference1 = ($outcome1 - $rcl1);

                              $outcome2 = ($competencie->sd_ca_outcome);
                              $rcl2 = ($competencie->sd_ca_rcl);
                              $difference2 = ($outcome2 - $rcl2);

                              $outcome4 = ($competencie->pe_cc_outcome);
                              $rcl4 = ($competencie->pe_cc_rcl);
                              $difference4 = ($outcome4 - $rcl4);

                              $outcome5 = ($competencie->pe_lo_outcome);
                              $rcl5 = ($competencie->pe_lo_rcl);
                              $difference5 = ($outcome5 - $rcl5);

                              $outcome7 = ($competencie->pc_dps_outcome);
                              $rcl7 = ($competencie->pc_dps_rcl);
                              $difference7 = ($outcome7 - $rcl7);

                              $outcome8 = ($competencie->pc_df_outcome);
                              $rcl8 = ($competencie->pc_df_rcl);
                              $difference8 = ($outcome8 - $rcl8);

                              $outcome10 = ($competencie->oc_pmtd_outcome);
                              $rcl10 = ($competencie->oc_pmtd_rcl);
                              $difference10 = ($outcome10 - $rcl10);

                              $outcome11 = ($competencie->oc_cg_outcome);
                              $rcl11 = ($competencie->oc_cg_rcl);
                              $difference11 = ($outcome11 - $rcl11);                              

                              $days = array("$difference1", "$difference2",  "$difference4", "$difference5", "$difference7", "$difference8",  "$difference10", "$difference11");

                              $countdifftwo = 0;
                              foreach($days as $day) {
                                if($day == "2"){
                                  $countdifftwo ++;
                                }
                              }

                              $countdiffthree = 0;
                              foreach($days as $day) {
                                if($day == "3"){
                                  $countdiffthree ++;
                                }
                              }

                              $countdiffone = 0;
                              foreach($days as $day) {
                                if($day == "1"){
                                  $countdiffone ++;
                                }
                              }

                              $countdiffzero = 0;
                              foreach($days as $day) {
                                if($day == "0"){
                                  $countdiffzero ++;
                                }
                              }

                              $Total = $countdifftwo + $countdiffthree + $countdiffone + $countdiffzero;
                              $Percentage = ($Total / 8) * 100;
                              @endphp

                    <!-- If else division -->
                    @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")
                              @php
                              $outcome1 = ($competencie->sd_po_outcome);
                              $rcl1 = ($competencie->sd_po_rcl);
                              $difference1 = ($outcome1 - $rcl1);

                              $outcome2 = ($competencie->pe_tw_outcome);
                              $rcl2 = ($competencie->pe_tw_rcl);
                              $difference2 = ($outcome2 - $rcl2);

                              $outcome3 = ($competencie->pc_per_outcome);
                              $rcl3 = ($competencie->pc_per_rcl);
                              $difference3 = ($outcome3 - $rcl3);

                              $outcome4 = ($competencie->oc_qdcf_outcome);
                              $rcl4 = ($competencie->oc_qdcf_rcl);
                              $difference4 = ($outcome4 - $rcl4);                              

                              $days = array("$difference1", "$difference2", "$difference3", "$difference4");

                              $countdifftwo = 0;
                              foreach($days as $day) {
                                if($day == "2"){
                                  $countdifftwo ++;
                                }
                              }

                              $countdiffthree = 0;
                              foreach($days as $day) {
                                if($day == "3"){
                                  $countdiffthree ++;
                                }
                              }

                              $countdiffone = 0;
                              foreach($days as $day) {
                                if($day == "1"){
                                  $countdiffone ++;
                                }
                              }

                              $countdiffzero = 0;
                              foreach($days as $day) {
                                if($day == "0"){
                                  $countdiffzero ++;
                                }
                              }

                              $Total = $countdifftwo + $countdiffthree + $countdiffone + $countdiffzero;
                              $Percentage = ($Total / 8) * 100;
                              @endphp
                    @else
                    <tr></tr>
                    @endif
                    <!-- End If else division -->                     

              <!-- Progress Bars with Striped Backgrounds-->
              <div class="progress mt-3" style="height: 45px;">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="font-size: 20px; font-weight: bold; width: <?php echo $Percentage; ?>%;" aria-valuenow= "<?php echo $Percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $Percentage; ?>%</div>
              </div>
              <!-- End Progress Bars with Striped Animated Backgrounds -->          

        </div>
      </div>
    </div>
    <!-- End Competency Progress -->


    <!-- Total / Jumlah -->
    <div class="card">
      <div class="card-body mt-3">
        <div class="row">

          <div class="col-lg-6">
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Jumlah Kompetensi / Total Competency</h5>

            <div class="row">
              <div class="col-lg-12" style="text-align: center;">
                <h5 class="card-title" style="font-weight: bold; font-size: 40px;">9</h5>
                <p style="font-size: 20px; font-weight: bold;">Total Competency</p>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6" style="text-align: center;">
                <h5 class="card-title" style="font-weight: bold; font-size: 35px; padding-top: 20px; color:red;">3</h5>
                <p style="font-size: 20px; font-weight: bold;">GAP</p>
              </div>
              <div class="col-lg-6" style="text-align: center;">
                <h5 class="card-title" style="font-weight: bold; font-size: 35px; padding-top: 20px; color:blue;">6</h5>
                <p style="font-size: 20px; font-weight: bold;">ACHIEVED</p>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
              <!-- Donut Chart -->
              <div id="donutChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#donutChart"), {
                    series: [3, 7],
                    chart: {
                      height: 350,
                      type: 'donut',
                      toolbar: {
                        show: true
                      }
                    },
                    labels: ['Gap', 'Achieved'],
                  }).render();
                });
              </script>
              <!-- End Donut Chart -->
          </div>

        </div>
      </div>
    </div>
    <!-- End of Total / Jumlah -->

    <!-- Competencies -->    
    <div class="card">
      <div class="card-body mt-3">
        <div class="col">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Competencies</h5>

                    <table class="table table-bordered" style="text-align: center; width: 60%; margin-left: auto; margin-right: auto;">
                      <tbody>
                        <tr style="background-color: #4682B4; color: white;">
                            <th scope="row">Competencies</th>
                            <th scope="row">Gap Level</th>
                        </tr>

                        <!-- If else division -->
                        @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")
                        <tr>
                            <th scope="row">Strategic Thinking</th>
                              <!-- Gap Level -->                      
                              @php
                              $outcome = ($competencie->sd_st_outcome);
                              $rcl = ($competencie->sd_st_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp


                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @endif
                              <!-- End of Gap Level --> 
                        </tr>

                        <tr>
                            <th scope="row">Change & Adaptability</th>
                              <!-- Gap Level -->
                              @php
                              $outcome = ($competencie->sd_ca_outcome);
                              $rcl = ($competencie->sd_ca_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp

                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif (($difference) == "-1")
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td>
                                <input type="text" name="" class="form-control" disabled>
                              </td>

                              @endif
                              <!-- End of Gap Level -->
                        </tr>

                        <!-- If else division -->
                        @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")
                        <tr>
                            <th scope="row">Planning & Organising</th>
                              <!-- Gap Level -->                                            
                              @php
                              $outcome = ($competencie->sd_po_outcome);
                              $rcl = ($competencie->sd_po_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp

                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif (($difference) == "-1")
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td>
                                <input type="text" name="" class="form-control" disabled>
                              </td>

                              @endif
                              <!-- End of Gap Level -->                                            
                        </tr>

                        @else
                        <tr></tr>
                        @endif
                        <!-- End If else division -->                    


                        <!-- If else division -->
                        @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")
                        <tr>
                            <th scope="row">Collaboration & Communication</th>
                              <!-- Gap Level -->                      
                              @php
                              $outcome = ($competencie->pe_cc_outcome);
                              $rcl = ($competencie->pe_cc_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp


                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @endif
                              <!-- End of Gap Level -->                      
                        </tr>

                        <tr>
                            <th scope="row">Leading Others</th>
                              <!-- Gap Level -->
                              @php
                              $outcome = ($competencie->pe_lo_outcome);
                              $rcl = ($competencie->pe_lo_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp


                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @endif
                              <!-- End of Gap Level -->                   
                        </tr>

                        <!-- If else division -->
                        @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")
                        <tr>
                            <th scope="row">Team Working</th>
                              <!-- Gap Level -->                                            
                              @php
                              $outcome = ($competencie->pe_tw_outcome);
                              $rcl = ($competencie->pe_tw_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp

                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif (($difference) == "-1")
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td>
                                <input type="text" name="" class="form-control" disabled>
                              </td>

                              @endif
                              <!-- End of Gap Level -->                            
                        </tr>
                        @else
                        <tr></tr>
                        @endif
                        <!-- End If else division -->                    


                        <!-- If else division -->
                        @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")
                        <tr>
                            <th scope="row">Delivery & Problem Solving</th>
                              <!-- Gap Level -->
                              @php
                              $outcome = ($competencie->pc_dps_outcome);
                              $rcl = ($competencie->pc_dps_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp

                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif (($difference) == "-1")
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td>
                                <input type="text" name="" class="form-control" disabled>
                              </td>

                              @endif
                              <!-- End of Gap Level -->
                        </tr>

                        <tr>
                            <th scope="row">Digital Fluency</th>
                              <!-- Gap Level -->
                              @php
                              $outcome = ($competencie->pc_df_outcome);
                              $rcl = ($competencie->pc_df_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp


                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @endif
                              <!-- End of Gap Level -->
                        </tr>

                        <!-- If else division -->
                        @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")                        
                        <tr>
                            <th scope="row">Personal Effectiveness & Resilience</th>
                              <!-- Gap Level -->                      
                              @php
                              $outcome = ($competencie->pc_per_outcome);
                              $rcl = ($competencie->pc_per_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp


                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @endif
                              <!-- End of Gap Level -->                            
                        </tr>
                        @else
                        <tr></tr>
                        @endif
                        <!-- End If else division -->                    


                        <!-- If else division -->
                        @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")
                        <tr>
                            <th scope="row">Performance Management & Talent Development</th>
                              <!-- Gap Level -->
                              @php
                              $outcome = ($competencie->oc_pmtd_outcome);
                              $rcl = ($competencie->oc_pmtd_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp

                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif (($difference) == "-1")
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td>
                                <input type="text" name="" class="form-control" disabled>
                              </td>

                              @endif
                              <!-- End of Gap Level -->
                        </tr>
                        
                        <tr>
                            <th scope="row">Corporate Governance</th>
                              <!-- Gap Level -->
                              @php
                              $outcome = ($competencie->oc_cg_outcome);
                              $rcl = ($competencie->oc_cg_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp

                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif (($difference) == "-1")
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td>
                                <input type="text" name="" class="form-control" disabled>
                              </td>

                              @endif
                              <!-- End of Gap Level -->                                                        
                        </tr>

                        <!-- If else division -->
                        @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")                                                
                        <tr>
                            <th scope="row">Quality Delivery & Customer Focus</th>
                              <!-- Gap Level -->                                            
                              @php
                              $outcome = ($competencie->oc_qdcf_outcome);
                              $rcl = ($competencie->oc_qdcf_rcl);
                              $difference = ($outcome - $rcl);
                              @endphp

                              @if(($difference) == "-2" ||($difference) == "-3" || ($difference) == "-4")
                              <td style="background-color: Red; color: black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif(($difference) == "0" ||($difference) == "1" || ($difference) == "2" ||($difference) == "3")
                              <td style="background-color: Green; color: Black;">
                                @php echo $difference @endphp
                              </td>

                              @elseif (($difference) == "-1")
                              <td style="background-color: Orange; color: black; ">
                                @php echo $difference @endphp
                              </td>

                              @else
                              <td>
                                <input type="text" name="" class="form-control" disabled>
                              </td>

                              @endif
                              <!-- End of Gap Level -->                            
                        </tr>
                        @else
                        <tr></tr>
                        @endif
                        <!-- End If else division -->
                        
                      </tbody>
                    </table>

        </div>
      </div>
    </div>
    <!-- End Competencies -->


    <!-- Learning Intervention -->
    <div class="card">
      <div class="card-body mt-3">
        <div class="col">
          <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Learning Intervention</h5>

                    <table class="table table-bordered" style="text-align: center; width: 90%; margin-left: auto; margin-right: auto;">
                      <tbody>
                        <tr style="background-color: #4682B4; color: white;">
                            <th scope="row">Competencies</th>
                            <th scope="row">Formal Training</th>
                        </tr>

                    <!-- If else division -->
                    @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")
                        <tr>
                            <th scope="row">Strategic Thinking</th>
                            <td>{{$competencie->sd_st_ft}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Change & Adaptability</th>
                            <td>{{$competencie->sd_ca_ft}}</td>
                        </tr>
                    <!-- If else division -->
                    @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")
                        <tr>
                            <th scope="row">Planning & Organising</th>
                            <td>{{$competencie->sd_po_ft}}</td>
                        </tr>
                    @else
                    <tr></tr>
                    @endif
                    <!-- End If else division -->

                    <!-- If else division -->
                    @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")
                        <tr>
                            <th scope="row">Collaboration & Communication</th>
                            <td>{{$competencie->pe_cc_ft}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Leading Others</th>
                            <td>{{$competencie->pe_lo_ft}}</td>
                        </tr>
                    <!-- If else division -->
                    @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")
                        <tr>
                            <th scope="row">Team Working</th>
                            <td>{{$competencie->pe_tw_ft}}</td>
                        </tr>
                    @else
                    <tr></tr>
                    @endif
                    <!-- End If else division -->


                    <!-- If else division -->
                    @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")
                        <tr>
                            <th scope="row">Delivery & Problem Solving</th>
                            <td>{{$competencie->pc_dps_ft}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Digital Fluency</th>
                            <td>{{$competencie->pc_df_ft}}</td>
                        </tr>
                    <!-- If else division -->
                    @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")
                        <tr>
                            <th scope="row">Personal Effectiveness & Resilience</th>
                            <td>{{$competencie->pc_per_ft}}</td>
                        </tr>
                    @else
                    <tr></tr>
                    @endif
                    <!-- End If else division -->
                        
                    <!-- If else division -->
                    @if(($competencie->indv_div) == "I" || ($competencie->indv_div) == "II"  || ($competencie->indv_div) == "III")                        
                        <tr>
                            <th scope="row">Performance Management & Talent Development</th>
                            <td>{{$competencie->oc_pmtd_ft}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Corporate Governance</th>
                            <td>{{$competencie->oc_cg_ft}}</td>
                        </tr>
                    <!-- If else division -->
                    @elseif(($competencie->indv_div) == "V" || ($competencie->indv_div) == "IV")
                        <tr>
                            <th scope="row">Quality Delivery & Customer Focus</th>
                            <td>{{$competencie->oc_qdcf_ft}}</td>
                        </tr>
                    @else
                    <tr></tr>
                    @endif
                    <!-- End If else division -->
                        
                      </tbody>
                    </table>

        </div>
      </div>
    </div>
    <!-- End Learning Intervention -->


@endforeach
  </div>
</section>
@endsection