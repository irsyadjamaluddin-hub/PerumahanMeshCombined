@extends('layouts.app-all')

@section('title', 'Reassessment Competency')

@section('content')

<?php
$pagename = "CollabratorCompetency";
?>
<div class="card">
      <div class="card-body mt-3">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">MINISTRY OF EDUCATION<br> Reassessment Competency</h5>

        <div class="col-lg-12 overflow-auto">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th scope="row"></th>
                <td>
                    
              @foreach ($competencies as $competencie)
                  <form class=" search-form d-flex align-items-center" method="get" action="{{ route('competency.competency.collabratorcompetencysearch', $competencie->id) }}">
                    @csrf
                    <input type="text" name="ic_search" class="form-control" placeholder="Search IC No. Eg. 00123456">
                    <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                  </form>
                </td>

              

              </tr>

            

              <input type="text" name="id" class="bg-gray-200 form-control " value="{{$competencie->id}}" hidden>


              <tr>
                <th scope="row">IC Number</th>
                <td><input type="text" name="collab_icno" value="{{$competencie->collab_icno}}" class="form-control"></td>

               
              </tr>
              <tr>
                <th scope="row">Name</th>
                <td><input type="text" name="indv_name" value="{{$competencie->collab_name}}" class="form-control"></td>
           
              </tr>
         

              
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    </section>
@endsection