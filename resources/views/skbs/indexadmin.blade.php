@extends('layouts.app-all')

@section('title', 'Admin SKB')

@section('content')
<?php
$pagename = "Admin_SKB";
?>

<div class="pagetitle">
  <h1> Surat Kebenaran Bertugas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <!-- <li class="breadcrumb-item">Users</li> -->
      <li class="breadcrumb-item active">SKB</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">

  <div class="col-md-12">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
      <i class=" fas fa-fw fa-check"></i>
      {!! session('success_message') !!}
    </div>
    @endif

    <div class="row mb-2">

    <!-- W.A>L Table -->
    <div class="col-12">
      <div class="card recent-sales">



        <div class="card-body overflow-auto">


          <table class="table table-borderless datatable mt-3">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">IC No.</th>
                <th scope="col">Department</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Letter</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              @if(count($qos) == 0)

              <tr class="text-center">
                <td colspan="8">
                  <h5>No records found</h5>
                </td>
              </tr>

              @else
              @foreach($qos as $qo)

              <tr>
                <td>{{ $qo->name }}</td>
                <td>{{ $qo->ic_no }}</td>
                <td>{{ optional($qo->department)->label }}</td>
                <td>{{ date('d/m/Y', strtotime($qo->start_date)) }}</td>
                <td>{{ date('d/m/Y', strtotime($qo->end_date)) }}</td>


                <!-- <td> 
                                      @if($qo->status == "discharge")
                                        <span class="badge bg-success">Discharge</span>
                                      @else(($qo->status) == "restricted")
                                        <span class="badge bg-danger">Restricted</span>
                                      @endif
                                    </td> -->


                <td><a href="{{ route('skbs.skb.showadmin',$qo->emp_qo_infos_id) }}" target="_blank">View</a></td>


                <td>
                  <div class="btn-group gap-2" role="group" aria-label="Basic example">
                    <!----Edit Button----->
                    <form method="get" action="{{ route('skbs.skb.editadmin', $qo->emp_qo_infos_id ) }}">
                      @csrf

                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                      </button>

                    </form>


                    <!----Delete Button----->
                    <form method="post" action="{{ route('skbs.skb.destroy', $qo->emp_qo_infos_id ) }}">
                      @csrf

                      @method('delete')

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

      </div><!-- End Recent Sales -->
    </div><!-- Col-12 -->

  </div>
  </div>
</section>


@endsection