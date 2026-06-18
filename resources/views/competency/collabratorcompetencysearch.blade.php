@extends('layouts.app-all')

@section('title', 'Reassessment Competency')

@section('content')

    <?php
    $pagename = 'CollabratorCompetency';
    ?>

    <section class="section">
        <div class="row">



            <div class="card">
                <div class="card-body mt-3">
                    <h5 class="card-title"
                        style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">
                        MINISTRY OF EDUCATION<br> Reassessment Competency</h5>

                    <div class="col-lg-12 overflow-auto">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td>
                                    @foreach ($competencies as $competencie)
                                        <form class=" search-form d-flex align-items-center" method="get"
                                            action="{{ route('competency.competency.collabratorcompetencysearch', $competencie->id) }}">
                                            @csrf
                                            <input type="text" name="ic_search" class="form-control"
                                                placeholder="Search IC No. Eg. 00123456">
                                            <button type="submit" class="btn btn-primary" title="Search"><i
                                                    class="bi bi-search"></i></button>
                                        </form>
                                    </td>

                                   

                                </tr>

                                <form class="" method="POST"
                                    action="{{ route('competencies.competencie.collabratorcompetencystore') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    
              <input type="text" name="id" class="bg-gray-200 form-control " value="{{$competencie->id}}" hidden>

              @endforeach

                                    @if (count($biodatas) == 0)
                                        <tr>
                                            <th></th>
                                            <td><input type="text" class="bg-gray-200 text-danger form-control"
                                                    value="IC Number Not found, Try Again" readonly> </td>

                                        </tr>
                                    @else
                                        @foreach ($biodatas as $biodata)
                                            <tr>
                                                <th scope="row">IC Number</th>


                                                <td><input type="text" name="collab_icno" value="{{ $biodata->ic_no }}"
                                                        class="form-control" disabled></td>
                                                <input type="text" name="collab_icno" class="bg-gray-200 form-control"
                                                    value="{{ $biodata->ic_no }}" hidden>


                                              
                                            </tr>


                                            <tr>
                                                <th scope="row">Name</th>
                                                <td><input type="text" name="collab_name" value="{{ $biodata->name }}"
                                                        class="form-control" disabled></td>
                                                <input type="text" name="collab_name" class="bg-gray-200 form-control"
                                                    value="{{ $biodata->name }}" hidden>
                                            </tr>
                                        @endforeach
                                        @endif
                                        
                           

                            </tbody>
                        </table>

                        <div class="text-center"> <button type="submit" class="btn btn-primary">Submit</button> </div>

           
</form>
                    </div>
                </div>
            </div>
</section>
@endsection