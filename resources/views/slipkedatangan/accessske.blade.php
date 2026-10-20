{{-- ====== NEW FILE ======== --}}


{{-- ====== NEWLY ADDED ======== --}}


{{-- Share Perkara by IC No. feature — "Grant Access" form. Submits IC Nos. to
     SKController@storeAccess, which merges them into SKPerkara.shared_with. --}}
{{-- ====== ========. --}}
@extends('layouts.app-all')

@section('title', 'Grant Access')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" sections; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "Slip Kehadiran";
?>

<div class="pagetitle">
    <h1>Grant Access</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sk.slipkedatangan.indexadmin') }}">Hadir @MOEBN</a></li>
            <li class="breadcrumb-item active">Grant Access</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

    <!----- Back out Button  ----->
    <div class="col-md-1 text-left">
        <a href="{{ route('sk.slipkedatangan.indexadmin') }}" class="btn btn-primary text-right" style="margin-bottom: 10px; height: 2.39rem;">
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
            <!-- Dynamic table rows for IC numbers -->
            @forelse($icNos as $icNo)
            <tr>
                <td>
                    <input type="text" name="ic_no[]" class="form-control" value="{{ $icNo }}" placeholder="Enter IC Number" inputmode="numeric" pattern="\d*" maxlength="8" data-existing="1">
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
            @empty
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
            @endforelse
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

            $.each(groups, function(value, elements) {
                if (elements.length < 2) return;

                var hasExisting = elements.some(function(el) {
                    return $(el).data('existing') == 1;
                });

                elements.forEach(function(el) {
                    var $input = $(el);
                    var $warning = $input.next('.invalid-feedback');
                    var isExisting = $input.data('existing') == 1;

                    if (hasExisting && !isExisting) {
                        hasWarning = true;
                        $input.addClass('is-invalid');
                        $warning.text('ic already existed and being shared').show();
                    } else if (!hasExisting) {
                        hasWarning = true;
                        $input.addClass('is-invalid');
                        $warning.text('similar ic detected, cannot duplicate').show();
                    }
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

{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection
