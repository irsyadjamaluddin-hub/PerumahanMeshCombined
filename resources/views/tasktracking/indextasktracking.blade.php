@extends('layouts.app-all')

@section('title', 'Task Tracking (MEC) ')

@section('content')


<?php
$pagename = "TaskTracking";
?>

<div class="pagetitle">
    <h1>Task Tracking (MEC)</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item">Task Tracking (MEC)</li>
            <li class="breadcrumb-item active"><a href="">Index</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <i class=" fas fa-fw fa-check"></i>
            {!! session('success_message') !!}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-md-10">
            <a href="{{ route('tasktracking.createtaskinternal') }}" class="btn btn-primary text-right" style="height: 95%; padding-top: 4px;" title="Internal">
                <i class="bi bi-plus-lg"> INT</i>
            </a>
            <a href="{{ route('tasktracking.createtaskexternal') }}" class="btn btn-primary text-right" style="height:  95%; padding-top: 4px;" title="External">
                <i class="bi bi-plus-lg"> EXT</i>
            </a>
        </div>
        <div class="col-md-2" style="text-align:center;">
            {{-- @if (Auth::user()->hasRole('ROLE_TASKTRACKING_STAFFKOD')) --}}
                <a href="{{ route('tasktracking.staffkod') }}"  title="Staff Kod" class="btn btn-primary">
                    <i class="bi bi-person-add"></i>
                </a>
            {{-- @endif --}}
            @if (Auth::user()->hasRole('ROLE_SUPERADMIN'))
                <a href="{{ route('tasktracking.statustindakan') }}" title="Status dan Tindakan" class="btn btn-primary">
                    <i class="bi bi-chat-left-dots"></i>
                </a>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-12">
            <div class="card recent-sales">

                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#in">In</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#out">Out</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#selesai">Selesai</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#mastertab">Main</button>
                    </li>
                </ul>
                <br>
                <div class ="tab-content pt-2">
                    <!-- first tab -->
                    <div class="tab-pane fade show active in" id="in">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Task (IN)</h5>
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                    <th scope="col">ID Tugasan</th>
                                    <th scope="col">Perkara</th>
                                    <th scope="col">Daripada</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Tindakan</th>
                                    <th scope="col" style="text-align: center;">Status</th>
                                    <th scope="col" style="text-align: center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if(isset($tasks) == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($tasks as $task)
                                            <tr>
                                                @if($task->task_int_ext == "Internal")
                                                    <td>INT {{ $task->id }}</td>
                                                @else
                                                    <td>EXT {{ $task->id }}</td>
                                                @endif
                                                <td>{{ $task->task_perkara }}</td>
                                                <td>{{ optional($task->staffkodgiver)->kod }}</td>
                                                <td>{{ $task->taskCreated ? $task->taskCreated->task_kategori : 'N/A' }}</td> <!-- Access the related model -->
                                                <td>{{ $task->task_tindakan }}</td>
                                                <td style="text-align: center;">
                                                    @if(isset($task->taskStatus))
                                                        @if($task->taskStatus->nama_id_colour == "Kuning")
                                                            <span class="badge rounded-pill bg-warning">{{ $task->task_userstatus }}</span>
                                                        @elseif($task->taskStatus->nama_id_colour == "Biru Terang")
                                                            <span class="badge rounded-pill bg-info">{{ $task->task_userstatus }}</span>
                                                        @elseif($task->taskStatus->nama_id_colour == "Biru")
                                                            <span class="badge rounded-pill bg-primary">{{ $task->task_userstatus }}</span>
                                                        @elseif($task->taskStatus->nama_id_colour == "Merah")
                                                            <span class="badge rounded-pill bg-danger">{{ $task->task_userstatus }}</span>
                                                        @elseif($task->taskStatus->nama_id_colour == "Hijau")
                                                            <span class="badge rounded-pill bg-success">{{ $task->task_userstatus }}</span>
                                                        @endif
                                                    @else
                                                        <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                        <!----Edit Button----->
                                                        <form method="get" action="{{ route('tasktracking.edittaskgiven', $task->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-primary">
                                                                <i class="bi bi-pencil-fill"></i>
                                                            </button>
                                                        </form>
                                                        @if(isset($task->taskStatus))
                                                            <!----Dalam Proses Button----->
                                                            @if ($task->taskStatus->nama_id_colour == "Kuning")
                                                            @else
                                                            <form method="post" action="{{ route('tasktracking.updatetaskstatus', ['id' => $task->id]) }}">
                                                                @csrf
                                                                <input type="text" name="task_userstatus"  value="{{ $kuningStatus->text }}" hidden>
                                                                <button type="submit" class="btn btn-outline-warning">
                                                                    <i class="bi bi-clock"></i>
                                                                </button>
                                                            </form>
                                                            @endif
                                                            <!----Selesai Button----->
                                                            @if ($task->taskStatus->nama_id_colour == "Hijau")
                                                            @else
                                                            <form method="post" action="{{ route('tasktracking.updatetaskstatus', ['id' => $task->id]) }}">
                                                                @csrf
                                                                <input type="text" name="task_userstatus"  value="{{ $hijauStatus->text }}" hidden>
                                                                <button type="submit" class="btn btn-outline-success">
                                                                    <i class="bi bi-check2-circle"></i>
                                                                </button>
                                                            </form>
                                                            @endif
                                                        @else
                                                        <!----Dalam Proses Button----->
                                                        <form method="post" action="{{ route('tasktracking.updatetaskstatus', ['id' => $task->id]) }}">
                                                            @csrf
                                                            <input type="text" name="task_userstatus"  value="{{ $kuningStatus->text }}" hidden>
                                                            <button type="submit" class="btn btn-outline-warning">
                                                                <i class="bi bi-clock"></i>
                                                            </button>
                                                        </form>
                                                        <!----Selesai Button----->
                                                        <form method="post" action="{{ route('tasktracking.updatetaskstatus', ['id' => $task->id]) }}">
                                                            @csrf
                                                            <input type="text" name="task_userstatus"  value="{{ $hijauStatus->text }}" hidden>
                                                            <button type="submit" class="btn btn-outline-success">
                                                                <i class="bi bi-check2-circle"></i>
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <!-- second tab -->
                    <div class="tab-pane fade out" id="out">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #006A4E;">Task (Out)</h5>
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Tugasan</th>
                                        <th scope="col">Perkara</th>
                                        <th scope="col">Kepada</th>
                                        <th scope="col">Tarikh</th>
                                        <th scope="col" class="border-start" style="text-align: center;">Status User</th>
                                        <th scope="col" class="border-end" style="text-align: center;">Status Staff</th>
                                        <th scope="col" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($tasksouts) == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($tasksouts as $tasksout)
                                            <tr>
                                                <td>
                                                    @if($tasksout->task_int_ext == "Internal")
                                                        INT {{ $tasksout->id }}
                                                    @else
                                                        EXT {{ $tasksout->id }}
                                                    @endif
                                                </td>
                                                <td>{{ $tasksout->task_perkara }}</td>
                                                <td>{{ $tasksout->staffkodreceiver->kod }}</td>
                                                <td>{{ $tasksout->taskCreated->task_date }}</td>
                                                <td class="border-start" style="text-align: center;">
                                                    @if(isset($tasksout->taskStatus))
                                                        @if($tasksout->taskStatus->nama_id_colour == "Kuning")
                                                            <span class="badge rounded-pill bg-warning">{{ $tasksout->task_userstatus }}</span>
                                                        @elseif($tasksout->taskStatus->nama_id_colour == "Biru Terang")
                                                            <span class="badge rounded-pill bg-info">{{ $tasksout->task_userstatus }}</span>
                                                        @elseif($tasksout->taskStatus->nama_id_colour == "Biru")
                                                            <span class="badge rounded-pill bg-primary">{{ $tasksout->task_userstatus }}</span>
                                                        @elseif($tasksout->taskStatus->nama_id_colour == "Merah")
                                                            <span class="badge rounded-pill bg-danger">{{ $tasksout->task_userstatus }}</span>
                                                        @elseif($tasksout->taskStatus->nama_id_colour == "Hijau")
                                                            <i class="bi bi-person-check" style="color: rgb(25, 135, 84); font-size:25px;" title="Selesai"></i>
                                                        @endif
                                                    @else
                                                        <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                                    @endif
                                                </td>
                                                <td class="border-end" style="width: 10%; text-align: center;">
                                                    @if($tasksout->task_staffstatus == "Selesai")
                                                        <i class="bi bi-check2-all" style="color: rgb(25, 135, 84); font-size:25px;" title="Selesai"></i>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                        <!----Edit Button----->
                                                        <form method="get" action="{{ route('tasktracking.edittaskcreated', $tasksout->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-primary">
                                                                <i class="bi bi-pencil-fill"></i>
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
                    </div>

                    <!-- third tab -->
                    <div class="tab-pane fade selesai" id="selesai">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">Task (IN)</h5>
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                    <th scope="col">ID Tugasan</th>
                                    <th scope="col">Perkara</th>
                                    <th scope="col">Daripada</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Tindakan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="text-align: center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if(isset($tasksselesai) == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($tasksselesai as $taskselesai)
                                            <tr>
                                                <td>INT{{ $taskselesai->id }}</td>
                                                <td>{{ $taskselesai->task_perkara }}</td>
                                                <td>{{ $taskselesai->staffkodgiver->kod }}</td>
                                                <td>{{ $taskselesai->taskCreated ? $taskselesai->taskCreated->task_kategori : 'N/A' }}</td> <!-- Access the related model -->
                                                <td>{{ $taskselesai->task_tindakan }}</td>
                                                @if($taskselesai->task_userstatus =="Selesai")
                                                    <td><span class="badge rounded-pill bg-success">Selesai</span></td>
                                                @endif

                                                <td style="text-align: center">
                                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                        <!----Edit Button----->
                                                        <form method="get" action="{{ route('tasktracking.edittaskgiven', $taskselesai->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-primary">
                                                                <i class="bi bi-pencil-fill"></i>
                                                            </button>
                                                        </form>
                                                        <!----Dalam Proses Button----->
                                                        <form method="post" action="{{ route('tasktracking.updatetaskstatus', ['id' => $taskselesai->id]) }}">
                                                            @csrf
                                                            <input type="text" name="task_userstatus"  value="{{ $kuningStatus->text }}" hidden>
                                                            <button type="submit" class="btn btn-outline-warning">
                                                                <i class="bi bi-clock"></i>
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
                    </div>
                    <!-- fourth tab -->
                    <div class="tab-pane fade mastertab" id="mastertab">
                        <div class="card-body overflow-auto">
                            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #006A4E;">Main</h5>
                            <table class="table table-borderless datatable mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Tugasan</th>
                                        <th scope="col">Perkara</th>
                                        <th scope="col">Kepada</th>
                                        <th scope="col">Tarikh</th>
                                        <th scope="col" class="border-start" style="text-align: center;">Status User</th>
                                        <th scope="col" class="border-end" style="text-align: center;">Status Staff</th>
                                        <th scope="col" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($taskmain) == 0)
                                        <tr class="text-center">
                                            <td colspan="8">
                                                <h5>No records found</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($taskmain as $taskmains)
                                            <tr>
                                                <td>MTID {{ $taskmains->id }}</td>
                                                <td>
                                                    @foreach($taskmains->tasksGiven as $taskGiven)
                                                        {{ $taskGiven->task_perkara }}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <!-- Vertically centered Modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_receiver{{ $taskmains->id }}">
                                                        <i class="bi bi-person-lines-fill"></i>
                                                    </button>
                                                    <div class="modal fade" id="modal_receiver{{ $taskmains->id }}" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">MTID {{ $taskmains->id }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr class="text-center">
                                                                                <th>ICNo.</th>
                                                                                <th>Status</th>
                                                                                <th>Updated At</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <!-- End Vertically centered Modal-->
                                                                            @foreach($taskmains->tasksGiven as $taskGiven)
                                                                                <tr>
                                                                                    <td>{{ $taskGiven->task_kod }}</td>
                                                                                    <td>
                                                                                        @if(isset($taskGiven->taskStatus))    
                                                                                            @if($taskGiven->taskStatus->nama_id_colour == "Kuning")
                                                                                                <span class="badge rounded-pill bg-warning">{{ $taskGiven->taskStatus->text }}</span>
                                                                                            @elseif($taskGiven->taskStatus->nama_id_colour == "Biru Terang")
                                                                                                <span class="badge rounded-pill bg-info">{{ $taskGiven->taskStatus->text }}</span>
                                                                                            @elseif($taskGiven->taskStatus->nama_id_colour == "Biru")
                                                                                                <span class="badge rounded-pill bg-primary">{{ $taskGiven->taskStatus->text }}</span>
                                                                                            @elseif($taskGiven->taskStatus->nama_id_colour == "Merah")
                                                                                                <span class="badge rounded-pill bg-danger">{{ $taskGiven->taskStatus->text }}</span>
                                                                                            @elseif($taskGiven->taskStatus->nama_id_colour == "Hijau")
                                                                                                <i class="bi bi-person-check" style="color: rgb(25, 135, 84); font-size:25px;" title="Selesai"></i>
                                                                                            @endif
                                                                                        @else
                                                                                            <span class="badge rounded-pill bg-danger">Untuk Tindakan</span>
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ $taskGiven->updated_at }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $taskmains->task_date }}</td>
                                                @php
                                                    $allGreen = true;
                                                    foreach($taskmains->tasksGiven as $taskGiven) {
                                                        if (!isset($taskGiven->taskStatus) || $taskGiven->taskStatus->nama_id_colour != "Hijau") {
                                                            $allGreen = false;
                                                            break;
                                                        }
                                                    }
                                                @endphp

                                                
                                                <td class="border-start" style="text-align: center;">
                                                    <!-- Display Overall Status -->
                                                    @if($allGreen)
                                                        <i class="bi bi-person-check" style="color: rgb(25, 135, 84); font-size:25px;" title="Selesai"></i>
                                                        
                                                    @else
                                                        <span class="badge rounded-pill bg-warning">Dalam Proses</span>
                                                    @endif
                                                </td>
                                                <td class="border-end" style="width: 10%; text-align: center;">
                                                    @if($taskmains->task_staffstatus == "Selesai")
                                                        <i class="bi bi-check2-all" style="color: rgb(25, 135, 84); font-size:25px;" title="Selesai"></i>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                                        <!----Edit Button----->
                                                        <form method="get" action="{{ route('tasktracking.editmaintask', $taskmains->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-primary">
                                                                <i class="bi bi-pencil-fill"></i>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

