@extends('layouts.app-all')

@section('title', 'Admin Booking')

@section('content')

<?php
$pagename = "Admin_Booking";
?>

<div class="pagetitle">
    <h1>Booking System</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Booking System</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
            <div class="card-body">
                <br>
            <section class="section dashboard">
      <div class="row">
        <div class="col-lg-2">
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid green;">
            <div class="card-body" style="padding: 15px;">
                <div class="d-flex align-items-center">
                  <div class="ps-1">
                       <!-- Modal Dialog Scrollable -->
                       @if(count($bookingsingle) == 0)

                            <tr class="text-center">
                              <td colspan="8">
                              <button  type="button" class="alert alert-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                              Room S1
                            </button>
                              </td>
                            </tr>
                            @else

                       @foreach($bookingsingle as $bkgsgle) 
                       @if($bkgsgle->room_no == 'S1' )
                       @if($bkgsgle->status == "2")
                            <button type="button" class="alert alert-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal" >
                              Room S1
                            </button>
                            @else
                            <button type="button" class="alert alert-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal" disabled>
                              Room S1
                            </button>
                            @endif
                            @endif
                                @endforeach
                                @endif


                      
                            <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Create booking</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
                                    @csrf

                          <br>


              <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                <h3 class="card-title" style="padding: 0px;">Booking Form S1</i></h3>
                <hr>
                <br>


                <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Name </label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="name" class="form-control">
                    {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
                  </div>
                </div>

                <br>

                <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">IC Number</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="ic_no" class="form-control">
                  </div>
                </div>

                <br>

                <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Dept</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="dept" class="form-control">
                  </div>
                </div>

                <br>

                <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Que No.</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="que_no" class="form-control">
                  </div>
                </div>

                <br>

                <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Room No.</label>
                  <div class="col-lg-8 col-md-9">
                    <input type="text" name="room_no" class="form-control" value="S1" readonly>
                  </div>
                </div>

                <br>

                <div class="row">
                  <label for="inputText" class="col-lg-4 col-md-3  label">Start Time</label>
                  <div class="col-lg-8 col-md-9">
                    <input type ="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
                  </div>
                </div>
                  

              

              <!-- take hidden ic_no so that easy to identify data belong/from who -->

            

              <br>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

            
        </div><!--End of the Card -->

<br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                  </div>
                  </form>

                  
                </div>
              </div>
            </div><!-- End Modal Dialog Scrollable-->
          </div>
                </div>
          </div>
        </div>
      </a>
      </div>

        <div class="col-lg-2">
       
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid green;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                    <div class="ps-1">
                       <!-- Modal Dialog Scrollable -->
                       @if(count($bookingsingle) == 0)
                        <tr class="text-center">
                          <td colspan="8">
                          <button  type="button" class="alert alert-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                          Room S2
                        </button>
                          </td>
                        </tr>
                        @else

                        @foreach($bookingsingle as $bkgsgle) 
                        @if($bkgsgle->room_no == 'S2' )
                        @if($bkgsgle->status == "2")
                        <button type="button" class="alert alert-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal" >
                          Room S2
                        </button>
                        @else
                        <button type="button" class="alert alert-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal" disabled>
                          Room S2
                        </button>
                        @endif
                        @endif
                            @endforeach
                            @endif
              <div class="modal fade" id="ExtralargeModal2" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Create booking</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
  @csrf

    <br>


    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
      <h3 class="card-title" style="padding: 0px;">Booking Form S2</i></h3>
      <hr>
      <br>


      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Name </label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="name" class="form-control">
          {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">IC Number</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="ic_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Dept</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="dept" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Que No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="que_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Room No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="room_no" class="form-control" value="S2" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label"> Start Time</label>
        <div class="col-lg-8 col-md-9">
          <input type ="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">End Time</label>
        <div class="col-lg-8 col-md-9">
          <input type="time" name="end_time" class="form-control">
        </div>
      </div>
        

    

    <!-- take hidden ic_no so that easy to identify data belong/from who -->

    <br>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

   
</div>

<br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     
                    </div>
                    </form>

                    
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
            </div>
                  </div>
            </div>
          </div>
        </a>
        </div>

        <div class="col-lg-2">
     
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid green;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                   
                
                    <div class="ps-1">
                      <!-- Modal Dialog Scrollable -->
              <button type="button" class="alert alert-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal3">
               Room S3
              </button>
              <div class="modal fade" id="ExtralargeModal3" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Create booking</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
  @csrf

    <br>


    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
      <h3 class="card-title" style="padding: 0px;">Booking Form S3</i></h3>
      <hr>
      <br>


      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Name </label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="name" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">IC Number</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="ic_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Dept</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="dept" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Que No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="que_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Room No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="room_no" class="form-control" value="S3" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Time</label>
        <div class="col-lg-8 col-md-9">
          <input type ="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">End Time</label>
        <div class="col-lg-8 col-md-9">
          <input type="time" name="end_time" class="form-control">
        </div>
      </div>
        

    

    <!-- take hidden ic_no so that easy to identify data belong/from who -->


    <br>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

   
</div>

<br>

  


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     
                    </div>
                    </form>

                    
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
            </div>
                  </div>
            </div>
          </div>
        </a>
        </div>

        <div class="col-lg-2">
       
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid green;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                   
                    

                    <div class="ps-1">
                       <!-- Modal Dialog Scrollable -->
              <button type="button" class="alert alert-success" data-bs-toggle="modal" data-bs-target="#ExtralargeModal4">
               Room S4
              </button>
              <div class="modal fade" id="ExtralargeModal4" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Create booking</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
  @csrf

    <br>


    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
      <h3 class="card-title" style="padding: 0px;">Booking Form S4</i></h3>
      <hr>
      <br>


      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Name </label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="name" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">IC Number</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="ic_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Dept</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="dept" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Que No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="que_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Room No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="room_no" class="form-control" value="S4" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Time</label>
        <div class="col-lg-8 col-md-9">
          <input type ="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">End Time</label>
        <div class="col-lg-8 col-md-9">
          <input type="time" name="end_time" class="form-control">
        </div>
      </div>
        

    

    <!-- take hidden ic_no so that easy to identify data belong/from who -->

    <br>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

   
</div>

<br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     
                    </div>
                    </form>

                    
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
            </div>
                  </div>
            </div>
          </div>
        </a>
        </div>

        <div class="col-lg-2">
     
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid green;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                

                    <div class="ps-1">
                       <!-- Modal Dialog Scrollable -->
              <button type="button" class="alert alert-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal5">
               Room S5
              </button>
              <div class="modal fade" id="ExtralargeModal5" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Create booking</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
  @csrf

    <br>


    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
      <h3 class="card-title" style="padding: 0px;">Booking Form S5</i></h3>
      <hr>
      <br>


      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Name </label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="name" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">IC Number</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="ic_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Dept</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="dept" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Que No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="que_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Room No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="room_no" class="form-control" value="S5" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Time</label>
        <div class="col-lg-8 col-md-9">
          <input type ="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">End Time</label>
        <div class="col-lg-8 col-md-9">
          <input type="time" name="end_time" class="form-control">
        </div>
      </div>
        

    

    <!-- take hidden ic_no so that easy to identify data belong/from who -->

    <br>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

   
</div>

<br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     
                    </div>
                    </form>

                    
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
            </div>
                  </div>
            </div>
          </div>
        </a>
        </div>

        <div class="col-lg-2">
       
          <div class="card info-card sales-card" style="padding: 0px; border: 1px solid green;">
            <div class="card-body" style="padding: 15px;">
                  <div class="d-flex align-items-center">
                   
                    <div class="ps-1">
                       <!-- Modal Dialog Scrollable -->
              <button type="button" class="alert alert-danger" data-bs-toggle="modal" data-bs-target="#ExtralargeModal6">
               Room S7
              </button>
              <div class="modal fade" id="ExtralargeModal6" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Create booking</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="" method="post" action="{{ route('bookings.booking.store') }}" enctype="multipart/form-data">
  @csrf

    <br>


    <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
      <h3 class="card-title" style="padding: 0px;">Booking Form S7</i></h3>
      <hr>
      <br>


      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Name </label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="name" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">IC Number</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="ic_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Dept</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="dept" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Que No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="que_no" class="form-control">
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Room No.</label>
        <div class="col-lg-8 col-md-9">
          <input type="text" name="room_no" class="form-control" value="S7" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">Time</label>
        <div class="col-lg-8 col-md-9">
          <input type ="text" name="start_time" class="form-control" value="{{ now()->toDateTimeString()}}" readonly>
        </div>
      </div>

      <br>

      <div class="row">
        <label for="inputText" class="col-lg-4 col-md-3  label">End Time</label>
        <div class="col-lg-8 col-md-9">
          <input type="time" name="end_time" class="form-control">
        </div>
      </div>
        

    

    <!-- take hidden ic_no so that easy to identify data belong/from who -->

    <br>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

   
</div>

<br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     
                    </div>
                    </form>

                    
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
            </div>
                    
                  </div>
            </div>
          </div>
        </a>
        </div>

        <!-- List of all bookings -->
        <table class="table table-borderless mt-3 overflow-auto">
                            <thead>
                              <h3>Booking History</h3>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">IC No</th>
                                    <th scope="col">Room.No</th>
                                    <th scope="col">Que.No</th>
                                    <th scope="col">Dept</th>
                                    
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>

                                </tr>
                            </thead>
                            <tbody>

                            @if(count($bookings) == 0)

                            <tr class="text-center">
                              <td colspan="8">
                                <h5>No records found</h5>
                              </td>
                            </tr>

                            @else

                            @foreach($bookings as $booking) 
                                <tr>
                                    <td>{{ $booking->name }}</td>
                                    <td>{{ $booking->ic_no }}</td>
                                    <td>{{ $booking->room_no }}</td>

                                    <td>{{ $booking->que_no }}</td>
                                    <td>{{ $booking->dept }}</td>
                                    <td>{{ date('h:i a', strtotime($booking->start_time)) }}</td>

                                    @if ($booking -> end_time == null)
                                    <td><a href="{{ route('bookings.booking.update', $booking->id ) }}"  class="btn btn-outline-danger">End</a></td>
                                    @else
                                    <td>{{date('h:i a', strtotime($booking->end_time))  }}</td>
                                    @endif
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                        
      </div>

    </section>
      
            </div>
          </div>
        </a>
        </div>


            
</div>
</div>

<section class="section profile">

    <div class="col-md-12">

        @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}


        </div>
        @endif

        <div class="row mb-2">
            <div class="col-md-10">

                <div class="search-bar">
                    <!-- Start Search Bar -->
                    <!-- <form class="search-form d-flex align-items-center" method="get" action="{{ route('perjawatans.perjawatan.searchIC') }}">
                        @csrf
                        <input class="form-control" type="text" name="ic_no" placeholder="Search by Name / IC Number (Eg. 00123456)">
                        <button type="submit" class="btn btn-primary" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div> -->
                    <!-- End Search Bar -->

                </div>
                


            

        </div>
        




@endsection