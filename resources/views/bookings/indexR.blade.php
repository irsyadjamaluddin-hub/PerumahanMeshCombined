@extends('layouts.app-all')

@section('title', 'Booking')

@section('content')

<?php
$pagename = "Booking";
?>

<img src="/img/bmr.png">


<div class="pagetitle">

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Booking System</li>
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
            <div class="col-md-11">


            </div>

            <!-- <div class="col-md-1">
        <a href="{{ route('bookings.booking.createR') }}" class="btn btn-primary text-right">
          <i class="bi bi-plus-lg"></i>
        </a>
      </div>
    </div> -->

            <div class="col-12">




                <div class="card-body overflow-auto">
                    <!-- <h5 class="card-title">Recent Sales <span>| Today</span></h5> -->

                    <table class="table table-borderless mt-3">
                        <thead>
                            <tr>
                                <th scope="col"><img src="/img/meeting-room.png" width="130" height="130">
                                    <br>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#ExtralargeModal">
                                        Persidangan 1
                                    </button>

                                    <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Persidangan 1</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <section class="section profile">

                                                        <!-- QO Table -->
                                                        <div class="col-12">
                                                            <div class="card recent-sales">
                                                                
                                                                <div class="card-body">

                                                                    <div class="profile-overview pt-3">



                                                                        <form class="" method="post"
                                                                            action="{{ route('bookings.booking.store') }}"
                                                                            enctype="multipart/form-data">
                                                                            @csrf

                                                                            <br>


                                                                            <div class="col profile-overview"
                                                                                style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                                                <h3 class="card-title"
                                                                                    style="padding: 0px;">Persidangan 1</i></h3>
                                                                                <hr>
                                                                                <br>


                                                                                <div class="row">
                                                                                    <label for="inputText"
                                                                                        class="col-lg-2 col-md-3  label">Name
                                                                                    </label>
                                                                                    <div class="col-lg-8 col-md-9">
                                                                                        <input type="text" name="name"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <label for="inputText"
                                                                                        class="col-lg-2 col-md-3  label">Jawatan</label>
                                                                                    <div class="col-lg-8 col-md-9">
                                                                                        <input type="text"
                                                                                            name="jawatan"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <label for="inputText"
                                                                                        class="col-lg-2 col-md-3  label">Jabatan</label>
                                                                                    <div class="col-lg-8 col-md-9">
                                                                                        <input type="text" name="dept"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <label for="inputText"
                                                                                        class="col-lg-2 col-md-3  label">No.
                                                                                        Telefon</label>
                                                                                    <div class="col-lg-8 col-md-9">
                                                                                        <input type="text" name="tel_no"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <label for="inputText"
                                                                                        class="col-lg-2 col-md-3  label">Tajuk</label>
                                                                                    <div class="col-lg-8 col-md-9">
                                                                                        <input type="text" name="agenda"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <label for="inputText"
                                                                                        class="col-lg-2 col-md-3  label">Anjuran</label>
                                                                                    <div class="col-lg-8 col-md-9">
                                                                                        <input type="text"
                                                                                            name="anjuran"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <label for="inputDate"
                                                                                        class="col-lg-2 col-md-3  label">Tarikh</label>
                                                                                    <div class="col-lg-8 col-md-9">
                                                                                        <input type="date" name="date_no" class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <label for="inputText"
                                                                                        class="col-lg-2 col-md-3  label">Jumlah Hadir</label>
                                                                                    <div class="col-lg-8 col-md-8">
                                                                                        <input type="text" name="hadir" class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <input type="text" name="room_no" class="form-control" value="P1" readonly hidden>

                                                                                <div class="row ">
                                                                                    <label for="inputTime" class="col-lg-2 col-md-3  label">Jam</label>
                                                                                            <div class="col-sm-4">
                                                                                                <select class="form-select" name="start_time" aria-label="Default select example">
                                                                                                <option selected>Start</option>
                                                                                                <option value="7:00">7.00am</option>
                                                                                                <option value="8:00">8.00am</option>
                                                                                                <option value="9:00">9.00am</option>
                                                                                                <option value="10:00">10.00am</option>
                                                                                                <option value="11:00">11.00am</option>
                                                                                                <option value="12:00">12.00pm</option>
                                                                                                <option value="13:00">1.00pm</option>
                                                                                                <option value="14:00">2.00pm</option>
                                                                                                <option value="15:00">3.00pm</option>
                                                                                                <option value="16:00">4.00pm</option>
                                                                                                <option value="17:00">5.00pm</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        
                                                                                            <div class="col-sm-4">
                                                                                                <select class="form-select" name="end_time" aria-label="Default select example">
                                                                                                <option selected>End</option>
                                                                                                <option value="7:00">7.00am</option>
                                                                                                <option value="8:00">8.00am</option>
                                                                                                <option value="9:00">9.00am</option>
                                                                                                <option value="10:00">10.00am</option>
                                                                                                <option value="11:00">11.00am</option>
                                                                                                <option value="12:00">12.00pm</option>
                                                                                                <option value="13:00">1.00pm</option>
                                                                                                <option value="14:00">2.00pm</option>
                                                                                                <option value="15:00">3.00pm</option>
                                                                                                <option value="16:00">4.00pm</option>
                                                                                                <option value="17:00">5.00pm</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                            <br>

                                                                            <br>

                                                                            <div class="text-center">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div><!-- End Recent Sales -->
                                            </div>

                                        </div>
                                    </div>
                </div><!-- End Extra Large Modal-->
                </th>

                <th scope="col"><img src="/img/meeting-room.png" width="130" height="130">
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#ExtralargeModal2">
                        Persidangan 2
                    </button>

                    <div class="modal fade" id="ExtralargeModal2" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Persidangan 2</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <a href="{{ route('bookings.booking.indexR') }}"
                                        class="btn btn-primary text-right mb-2">
                                        <i class="bi bi-arrow-left-circle"></i>
                                    </a>


                                    <!-- QO Table -->
                                    <div class="col-12">
                                        <div class="card recent-sales">



                                            <div class="card-body">

                                                <div class="profile-overview pt-3">



                                                    <form class="" method="post"
                                                        action="{{ route('bookings.booking.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf

                                                        <br>


                                                        <div class="col profile-overview"
                                                            style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                            <h3 class="card-title" style="padding: 0px;">Persidangan
                                                                2</i></h3>
                                                            <hr>
                                                            <br>


                                                            <div class="row">
                                                                <label for="inputText"
                                                                    class="col-lg-4 col-md-3  label">Name </label>
                                                                <div class="col-lg-8 col-md-9">
                                                                    <input type="text" name="name" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label for="inputText"
                                                                    class="col-lg-4 col-md-3  label">Jawatan</label>
                                                                <div class="col-lg-8 col-md-9">
                                                                    <input type="text" name="jawatan"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label for="inputText"
                                                                    class="col-lg-4 col-md-3  label">Jabatan</label>
                                                                <div class="col-lg-8 col-md-9">
                                                                    <input type="text" name="dept" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label for="inputText"
                                                                    class="col-lg-4 col-md-3  label">No. Telefon</label>
                                                                <div class="col-lg-8 col-md-9">
                                                                    <input type="text" name="tel_no"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label for="inputText"
                                                                    class="col-lg-4 col-md-3  label">Tajuk</label>
                                                                <div class="col-lg-8 col-md-9">
                                                                    <input type="text" name="agenda"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label for="inputText"
                                                                    class="col-lg-4 col-md-3  label">Anjuran</label>
                                                                <div class="col-lg-8 col-md-9">
                                                                    <input type="text" name="anjuran"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <label for="inputDate"
                                                                    class="col-lg-4 col-md-3  label">Tarikh</label>
                                                                <div class="col-lg-8 col-md-9">
                                                                    <input type="date" name="date_no"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label for="inputText"
                                                                    class="col-lg-4 col-md-3  label">Jumlah
                                                                    Hadir</label>
                                                                <div class="col-lg-8 col-md-9">
                                                                    <input type="text" name="hadir"
                                                                        class="form-control">
                                                                </div>
                                                            </div>



                                                            <div class="row">
                                                                <label for="inputTime"
                                                                    class="col-lg-4 col-md-3  label">Jam</label>
                                                                <div class="col-lg-8 col-md-9">

                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">7.00 -
                                                                        8.00am</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">8.00 -
                                                                        9.00am</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">9.00 -
                                                                        10.00am</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">10.00 -
                                                                        11.00am</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">11.00 -
                                                                        12.00pm</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">12.00 -
                                                                        1.00pm</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">1.00 -
                                                                        2.00pm</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">2.00 -
                                                                        3.00pm</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">3.00 -
                                                                        4.00pm</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                    <br>
                                                                    <br>
                                                                    <label for="inputTime"
                                                                        class="col-lg-4 col-md-3  label">4.00 -
                                                                        5.00pm</label>
                                                                    <button type="button"
                                                                        class="btn btn-primary">Book</button>
                                                                </div>

                                                                <br>

                                                                <div class="text-center">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>

                                                    </form>


                                                </div>

                                            </div>


                                        </div>

                                    </div>
                                </div><!-- End Recent Sales -->

                            </div>
                        </div>

                    </div>
            </div>
        </div><!-- End Extra Large Modal-->
        </th>
        <th scope="col"><img src="/img/meeting-room.png" width="130" height="130">
            <br>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal3">
                Persidangan 5
            </button>

            <div class="modal fade" id="ExtralargeModal3" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Persidangan 5</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <a href="{{ route('bookings.booking.indexR') }}" class="btn btn-primary text-right mb-2">
                                <i class="bi bi-arrow-left-circle"></i>
                            </a>


                            <!-- QO Table -->
                            <div class="col-12">
                                <div class="card recent-sales">



                                    <div class="card-body">

                                        <div class="profile-overview pt-3">



                                            <form class="" method="post" action="{{ route('bookings.booking.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <br>


                                                <div class="col profile-overview"
                                                    style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                    <h3 class="card-title" style="padding: 0px;">Persidangan 5</i></h3>
                                                    <hr>
                                                    <br>


                                                    <div class="row">
                                                        <label for="inputText" class="col-lg-4 col-md-3  label">Name
                                                        </label>
                                                        <div class="col-lg-8 col-md-9">
                                                            <input type="text" name="name" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label for="inputText"
                                                            class="col-lg-4 col-md-3  label">Jawatan</label>
                                                        <div class="col-lg-8 col-md-9">
                                                            <input type="text" name="jawatan" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label for="inputText"
                                                            class="col-lg-4 col-md-3  label">Jabatan</label>
                                                        <div class="col-lg-8 col-md-9">
                                                            <input type="text" name="dept" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label for="inputText" class="col-lg-4 col-md-3  label">No.
                                                            Telefon</label>
                                                        <div class="col-lg-8 col-md-9">
                                                            <input type="text" name="tel_no" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label for="inputText"
                                                            class="col-lg-4 col-md-3  label">Tajuk</label>
                                                        <div class="col-lg-8 col-md-9">
                                                            <input type="text" name="agenda" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label for="inputText"
                                                            class="col-lg-4 col-md-3  label">Anjuran</label>
                                                        <div class="col-lg-8 col-md-9">
                                                            <input type="text" name="anjuran" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label for="inputDate"
                                                            class="col-lg-4 col-md-3  label">Tarikh</label>
                                                        <div class="col-lg-8 col-md-9">
                                                            <input type="date" name="date_no" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <label for="inputText" class="col-lg-4 col-md-3  label">Jumlah
                                                            Hadir</label>
                                                        <div class="col-lg-8 col-md-9">
                                                            <input type="text" name="hadir" class="form-control">
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                        <label for="inputTime"
                                                            class="col-lg-4 col-md-3  label">Jam</label>
                                                        <div class="col-lg-8 col-md-9">

                                                            <label for="inputTime" class="col-lg-4 col-md-3  label">7.00
                                                                - 8.00am</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime" class="col-lg-4 col-md-3  label">8.00
                                                                - 9.00am</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime" class="col-lg-4 col-md-3  label">9.00
                                                                - 10.00am</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime"
                                                                class="col-lg-4 col-md-3  label">10.00 - 11.00am</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime"
                                                                class="col-lg-4 col-md-3  label">11.00 - 12.00pm</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime"
                                                                class="col-lg-4 col-md-3  label">12.00 - 1.00pm</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime" class="col-lg-4 col-md-3  label">1.00
                                                                - 2.00pm</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime" class="col-lg-4 col-md-3  label">2.00
                                                                - 3.00pm</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime" class="col-lg-4 col-md-3  label">3.00
                                                                - 4.00pm</label>
                                                            <button type="button" class="btn btn-primary">Book</button>
                                                            <br>
                                                            <br>
                                                            <label for="inputTime" class="col-lg-4 col-md-3  label">4.00
                                                                - 5.00pm</label>
                                                            <button type="button" class="btn btn-primary">Book</button>


                                                        </div>
                                                        <br>
                                                        <!-- take hidden ic_no so that easy to identify data belong/from who -->



                                                        <br>

                                                        <div class="text-center">
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>

                                            </form>


                                        </div>

                                    </div>


                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div>

            </div>
    </div>
    </div><!-- End Extra Large Modal-->
    </th>

    <th scope="col"><img src="/img/meeting-room.png" width="130" height="130">
        <br>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal4">
            Persidangan 6
        </button>

        <div class="modal fade" id="ExtralargeModal4" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Persidangan 6</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="{{ route('bookings.booking.indexR') }}" class="btn btn-primary text-right mb-2">
                            <i class="bi bi-arrow-left-circle"></i>
                        </a>


                        <!-- QO Table -->
                        <div class="col-12">
                            <div class="card recent-sales">



                                <div class="card-body">

                                    <div class="profile-overview pt-3">



                                        <form class="" method="post" action="{{ route('bookings.booking.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <br>


                                            <div class="col profile-overview"
                                                style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                <h3 class="card-title" style="padding: 0px;">Persidangan 6</i></h3>
                                                <hr>
                                                <br>


                                                <div class="row">
                                                    <label for="inputText" class="col-lg-4 col-md-3  label">Name
                                                    </label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="name" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText"
                                                        class="col-lg-4 col-md-3  label">Jawatan</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="jawatan" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText"
                                                        class="col-lg-4 col-md-3  label">Jabatan</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="dept" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText" class="col-lg-4 col-md-3  label">No.
                                                        Telefon</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="tel_no" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText"
                                                        class="col-lg-4 col-md-3  label">Tajuk</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="agenda" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText"
                                                        class="col-lg-4 col-md-3  label">Anjuran</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="anjuran" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputDate"
                                                        class="col-lg-4 col-md-3  label">Tarikh</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="date" name="date_no" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText" class="col-lg-4 col-md-3  label">Jumlah
                                                        Hadir</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="hadir" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <label for="inputTime" class="col-lg-4 col-md-3  label">Jam</label>
                                                    <div class="col-lg-8 col-md-9">

                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">7.00 -
                                                            8.00am</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">8.00 -
                                                            9.00am</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">9.00 -
                                                            10.00am</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">10.00 -
                                                            11.00am</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">11.00 -
                                                            12.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">12.00 -
                                                            1.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">1.00 -
                                                            2.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">2.00 -
                                                            3.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">3.00 -
                                                            4.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">4.00 -
                                                            5.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>


                                                    </div>

                                                    <br>

                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>

                                        </form>


                                    </div>

                                </div>


                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                </div>
            </div>

        </div>
        </div>
        </div><!-- End Extra Large Modal-->
    </th>

    <th scope="col"><img src="/img/meeting-room.png" width="130" height="130">
        <br>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal5">
            Meeting Room
        </button>

        <div class="modal fade" id="ExtralargeModal5" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Meeting Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="{{ route('bookings.booking.indexR') }}" class="btn btn-primary text-right mb-2">
                            <i class="bi bi-arrow-left-circle"></i>
                        </a>


                        <!-- QO Table -->
                        <div class="col-12">
                            <div class="card recent-sales">



                                <div class="card-body">

                                    <div class="profile-overview pt-3">



                                        <form class="" method="post" action="{{ route('bookings.booking.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <br>


                                            <div class="col profile-overview"
                                                style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                                                <h3 class="card-title" style="padding: 0px;">Meeting Room(One Stop
                                                    Center)</i></h3>
                                                <hr>
                                                <br>


                                                <div class="row">
                                                    <label for="inputText" class="col-lg-4 col-md-3  label">Name
                                                    </label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="name" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText"
                                                        class="col-lg-4 col-md-3  label">Jawatan</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="jawatan" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText"
                                                        class="col-lg-4 col-md-3  label">Jabatan</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="dept" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText" class="col-lg-4 col-md-3  label">No.
                                                        Telefon</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="tel_no" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText"
                                                        class="col-lg-4 col-md-3  label">Tajuk</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="agenda" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText"
                                                        class="col-lg-4 col-md-3  label">Anjuran</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="anjuran" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputDate"
                                                        class="col-lg-4 col-md-3  label">Tarikh</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="date" name="date_no" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="inputText" class="col-lg-4 col-md-3  label">Jumlah
                                                        Hadir</label>
                                                    <div class="col-lg-8 col-md-9">
                                                        <input type="text" name="hadir" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <label for="inputTime" class="col-lg-4 col-md-3  label">Jam</label>
                                                    <div class="col-lg-8 col-md-9">

                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">7.00 -
                                                            8.00am</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">8.00 -
                                                            9.00am</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">9.00 -
                                                            10.00am</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">10.00 -
                                                            11.00am</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">11.00 -
                                                            12.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">12.00 -
                                                            1.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">1.00 -
                                                            2.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">2.00 -
                                                            3.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">3.00 -
                                                            4.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>
                                                        <br>
                                                        <br>
                                                        <label for="inputTime" class="col-lg-4 col-md-3  label">4.00 -
                                                            5.00pm</label>
                                                        <button type="button" class="btn btn-primary">Book</button>


                                                    </div>


                                                    <!-- take hidden ic_no so that easy to identify data belong/from who -->



                                                    <br>

                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>

                                        </form>


                                    </div>

                                </div>


                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                </div>
            </div>

        </div>
        </div>
        </div><!-- End Extra Large Modal-->
    </th>


    </tr>
    </thead>

    </table>

    </div>


    </div><!-- End Recent Sales -->

    
    <div class="card">
        <div class="card-body">

            <div class="overflow-auto">
                <table class="table table-borderless">
                    <thead>

                        <tr>

                            <th scope="col">P1</th>
                            <th scope="col"></th>

                            <th scope="col">P2</th>
                            <th scope="col"></th>

                            <th scope="col">P5</th>
                            <th scope="col"></th>

                            <th scope="col">P6</th>
                            <th scope="col"></th>

                            <th scope="col">MR</th>
                            <th scope="col"></th>



                        </tr>

                        <tr>

                            <th scope="col-lg-2">Time</th>
                            <th scope="col">Booking</th>

                            <th scope="col-lg-2">Time</th>
                            <th scope="col">Booking</th>

                            <th scope="col-lg-2">Time</th>
                            <th scope="col">Booking</th>

                            <th scope="col-lg-2">Time</th>
                            <th scope="col">Booking</th>

                            <th scope="col-lg-2">Time</th>
                            <th scope="col">Booking</th>




                        </tr>
                    </thead>



                    <tbody>
                        <tr>
                            <td>7.00-8.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>7.00-8.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>7.00-8.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>7.00-8.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>7.00-8.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>

                        </tr>
                        <tr>
                            <td>8.00-9.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>8.00-9.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>8.00-9.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>8.00-9.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>8.00-9.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>




                        </tr>
                        <tr>
                            <td>9.00-10.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>9.00-10.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>9.00-10.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>9.00-10.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>9.00-10.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>




                        </tr>

                        <tr>
                            <td>10.00-11.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>10.00-11.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>10.00-11.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>10.00-11.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>10.00-11.00am</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>


                        </tr>
                        <tr>
                            <td>11.00-12.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>11.00-12.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>11.00-12.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>11.00-12.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>11.00-12.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>


                        </tr>
                        <tr>
                            <td>12.00-1.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>12.00-1.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>12.00-1.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>12.00-1.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>12.00-1.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>



                        </tr>
                        <tr>
                            <td>1.00-2.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>1.00-2.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>1.00-2.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>1.00-2.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>1.00-2.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>




                        </tr>
                        <tr>
                            <td>2.00-3.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>2.00-3.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>2.00-3.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>2.00-3.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>2.00-3.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>



                        </tr>

                        <tr>
                            <td>3.00-4.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>3.00-4.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>3.00-4.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>3.00-4.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                            <td>3.00-4.00pm</td>
                            <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>



                        </tr>
                        <td>4.00-5.00pm</td>
                        <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                        <td>4.00-5.00pm</td>
                        <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                        <td>4.00-5.00pm</td>
                        <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                        <td>4.00-5.00pm</td>
                        <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>
                        <td>4.00-5.00pm</td>
                        <td><button type="button" class="btn btn-primary btn-sm">Book</button></td>



                        </tr>

                    </tbody>
                </table>
            </div>


        </div>
    </div>




    @endsection