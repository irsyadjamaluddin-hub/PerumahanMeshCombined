{{-- ====== NEWLY ADDED ======== --}}
{{-- Share Perkara by IC No. feature — lists currently-shared IC Nos. (with revoke buttons,
     SKController@revokeAccess) plus an inline form to add more (SKController@storeAccess). --}}
{{-- ====== ========. --}}
@extends('layouts.app-all')

@section('title', 'Users with Access')

@section('content')

<?php
$pagename = "Slip Kehadiran";
?>

<div class="pagetitle">
    <h1>Users with Access</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sk.slipkedatangan.indexadmin') }}">Hadir @MOEBN</a></li>
            <li class="breadcrumb-item active">Access</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

@if(session('success_message'))
<div class="alert alert-success" role="alert">
    {{ session('success_message') }}
</div>
@endif

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('sk.slipkedatangan.indexadmin') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
        <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

<!-- Display perkara information -->
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Perkara: {{ $skperkara->label }}</h5>
    </div>
</div>

<!-- Display shared users -->
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Users with Access</h5>
        <table class="table-achiev">
            <thead>
                <tr>
                    <th class="text-center">IC No.</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sharedUsers as $icNo)
                <tr>
                    <td class="text-center">{{ $icNo }}</td>
                    <td class="text-center">
                        <form method="post" action="{{ route('sk.slipkedatangan.revokeAccess', ['skperkara' => $skperkara->id, 'icNo' => $icNo]) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add more IC numbers without leaving this page -->
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Add IC No.</h5>
            <button type="button" class="btn btn-primary btn-sm" id="addbtn2">
                <i class="bi bi-plus-lg"></i> Add IC No.
            </button>
        </div>
        <br>

        <form action="{{ route('sk.slipkedatangan.storeAccess', $skperkara->id) }}" method="post" id="grantAccessForm">
            @csrf
            <table class="table-achiev">
                <thead>
                    <tr>
                        <th class="text-center">IC No.</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="ic_no_list">
                    <tr>
                        <td>
                            <input type="text" name="ic_no[]" class="form-control" placeholder="Enter IC Number" inputmode="numeric" pattern="\d*" maxlength="8">
                            <div class="invalid-feedback d-block" style="display:none;"></div>
                        </td>
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
    </div>
</div>

<!-- Script to handle adding and removing IC numbers -->
<script>
    var existingSharedIcNos = @json($sharedUsers);

    $(document).ready(function() {
        var icExistenceCache = {}; // value -> true/false, populated by AJAX lookups

        // Add IC number row
        $("#addbtn2").click(function() {
            $("#ic_no_list").append('<tr><td><input type="text" name="ic_no[]" class="form-control" placeholder="Enter IC Number" inputmode="numeric" pattern="\\d*" maxlength="8"><div class="invalid-feedback d-block" style="display:none;"></div></td><td><center><button type="button" class="btn btn-outline-danger remove_ic_no"><i class="bi bi-trash-fill"></i></button></center></td></tr>');
            checkIcNos();
        });

        // Remove IC number row
        $(document).on('click', '.remove_ic_no', function() {
            $(this).closest('tr').remove();
            checkIcNos();
        });

        // Restrict IC number inputs to digits only, max 8 characters
        $(document).on('input', 'input[name="ic_no[]"]', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 8);
            checkIcNos();
            scheduleExistenceLookup($(this));
        });

        // Prevent submitting while any IC No. warning is active
        $("#grantAccessForm").on('submit', function(e) {
            if (checkIcNos()) {
                e.preventDefault();
            }
        });

        // Looks up whether a typed IC No. exists in biodatas, once typing settles
        function scheduleExistenceLookup($input) {
            clearTimeout($input.data('icCheckTimer'));

            var value = $input.val().trim();

            if (value.length !== 8 || icExistenceCache.hasOwnProperty(value)) {
                return;
            }

            var timer = setTimeout(function() {
                if ($input.val().trim() !== value) return; // value changed since typing settled

                $.getJSON("{{ route('sk.slipkedatangan.checkIcExists') }}", { ic_no: value })
                    .done(function(response) {
                        icExistenceCache[value] = !!response.exists;
                        checkIcNos();
                    });
            }, 400);

            $input.data('icCheckTimer', timer);
        }

        // Returns true if any warning is active
        function checkIcNos() {
            var $inputs = $('input[name="ic_no[]"]');
            var groups = {};

            $inputs.each(function() {
                var value = $(this).val().trim();
                if (!value) return;
                if (!groups[value]) groups[value] = [];
                groups[value].push(this);
            });

            var hasWarning = false;

            $inputs.each(function() {
                var $input = $(this);
                var $warning = $input.next('.invalid-feedback');
                $input.removeClass('is-invalid');
                $warning.hide().text('');
            });

            $inputs.each(function() {
                var $input = $(this);
                var value = $input.val().trim();
                if (!value) return;

                var $warning = $input.next('.invalid-feedback');

                if (existingSharedIcNos.indexOf(value) !== -1) {
                    hasWarning = true;
                    $input.addClass('is-invalid');
                    $warning.text('ic already existed and being shared').show();
                }
            });

            $.each(groups, function(value, elements) {
                if (elements.length < 2) return;

                elements.forEach(function(el) {
                    var $input = $(el);
                    if ($input.hasClass('is-invalid')) return; // already flagged as already-shared

                    var $warning = $input.next('.invalid-feedback');
                    hasWarning = true;
                    $input.addClass('is-invalid');
                    $warning.text('similar ic detected, cannot duplicate').show();
                });
            });

            $inputs.each(function() {
                var $input = $(this);
                if ($input.hasClass('is-invalid')) return;

                var value = $input.val().trim();
                if (value.length !== 8) return;

                if (icExistenceCache[value] === false) {
                    hasWarning = true;
                    $input.addClass('is-invalid');
                    $input.next('.invalid-feedback').text('this ic does not exist.').show();
                }
            });

            $("#grantAccessForm button[type=\"submit\"]").prop('disabled', hasWarning);

            return hasWarning;
        }
    });
</script>

@endsection
