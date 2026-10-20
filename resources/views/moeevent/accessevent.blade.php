@extends('layouts.app-all')

@section('title', 'Grant Access')

@section('content')

<?php
$pagename = "moeevent";
?>

<div class="pagetitle">
    <h1>Grant Access</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('moeevent.moeevent.indexadmin') }}">MOE Event</a></li>
            <li class="breadcrumb-item active">Grant Access</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('moeevent.moeevent.indexadmin') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn-primary mt-2 mb-2 btn-sm" id="addbtn2" href="#">
        <i class="bi bi-plus-lg"></i> Add IC No.
    </button>
</div>

@if(session('success_message'))
<div class="alert alert-success" role="alert">
    {{ session('success_message') }}
</div>
@endif

<!-- Form to submit IC numbers -->
<form action="{{ route('moeevent.moeevent.storeAccess', $event->id) }}" method="post" id="grantAccessForm">
    @csrf
    <table class="table-achiev">
        <thead>
            <tr>
                <th class="text-center">IC No.</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="ic_no_list">
            <!-- Dynamic table rows for IC numbers -->
            <tr>
                <td><input type="text" name="ic_no[]" class="form-control" placeholder="Enter IC Number"></td>
                <td>
                    <center>
                        <button type="button" class="btn btn-outline-danger remove_ic_no">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </center>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<!-- Script to handle adding and removing IC numbers -->
<script>
    $(document).ready(function() {
        // Add IC number row
        $("#addbtn2").click(function() {
            $("#ic_no_list").append('<tr><td><input type="text" name="ic_no[]" class="form-control" placeholder="Enter IC Number"></td><td><center><button type="button" class="btn btn-outline-danger remove_ic_no"><i class="bi bi-trash-fill"></i></button></center></td></tr>');
        });

        // Remove IC number row
        $(document).on('click', '.remove_ic_no', function() {
            $(this).closest('tr').remove();
        });
    });
</script>

@endsection
